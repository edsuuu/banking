<?php

namespace App\Services\Wallet\Operations;

use App\Exceptions\Wallet\InsufficientBalanceException;
use App\Exceptions\Wallet\InvalidAmountException;
use App\Exceptions\Wallet\TransactionTypeNotFoundException;
use App\Exceptions\Wallet\WithdrawalException;
use App\Models\TransactionStatus;
use App\Models\TransactionType;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\WithdrawalMethod;
use App\Models\WithdrawalRequest;
use App\Services\Wallet\Contracts\WithdrawalServiceInterface;
use Illuminate\Support\Facades\DB;

class WithdrawalService implements WithdrawalServiceInterface
{
    public function __construct(
        protected HoldService $holdService
    ) {}

    public function requestWithdrawal(
        Wallet $wallet,
        string $amount,
        int $withdrawalMethodId,
        array $bankAccount
    ): WithdrawalRequest {
        $this->validateAmount($amount);

        $effectiveBalance = $wallet->calculateEffectiveBalance();

        if (bccomp($effectiveBalance, $amount, 2) < 0) {
            throw InsufficientBalanceException::forWithdrawal($amount, $effectiveBalance);
        }

        $pendingStatus = TransactionStatus::pending();
        $method = WithdrawalMethod::query()->find($withdrawalMethodId);

        return DB::transaction(function () use ($wallet, $amount, $method, $pendingStatus, $bankAccount): WithdrawalRequest {
            $wallet->lockForUpdate();

            $this->holdService->createHold($wallet, $amount, 'Saque em processamento');

            return WithdrawalRequest::query()->create([
                'wallet_id' => $wallet->id,
                'amount' => $amount,
                'withdrawal_method_id' => $method?->id,
                'transaction_status_id' => $pendingStatus?->id,
                'method' => $method?->code ?? 'pix',
                'status' => 'pending',
                'bank_account' => $bankAccount,
            ]);
        });
    }

    public function processWithdrawal(WithdrawalRequest $withdrawal): WalletTransaction
    {
        if (! $withdrawal->isPending()) {
            throw WithdrawalException::alreadyProcessed($withdrawal->id);
        }

        $transactionType = TransactionType::findByCode('withdrawal');

        if (! $transactionType) {
            throw new TransactionTypeNotFoundException('withdrawal');
        }

        return DB::transaction(function () use ($withdrawal, $transactionType): WalletTransaction {
            $wallet = $withdrawal->wallet;
            $wallet->lockForUpdate();

            $currentBalance = $wallet->calculateAvailableBalance();
            $newBalance = bcsub($currentBalance, $withdrawal->amount, 2);

            if (bccomp($newBalance, '0', 2) < 0) {
                throw InsufficientBalanceException::forWithdrawal($withdrawal->amount, $currentBalance);
            }

            $transaction = WalletTransaction::query()->create([
                'wallet_id' => $wallet->id,
                'transaction_type_id' => $transactionType->id,
                'type' => $transactionType->code,
                'amount' => $withdrawal->amount,
                'balance_after' => $newBalance,
                'reference_type' => WithdrawalRequest::class,
                'reference_id' => $withdrawal->id,
                'description' => "Saque via {$withdrawal->withdrawalMethod?->label}",
            ]);

            $completedStatus = TransactionStatus::completed();

            $withdrawal->update([
                'transaction_status_id' => $completedStatus?->id,
                'status' => 'completed',
                'transaction_id' => $transaction->id,
                'processed_at' => now(),
            ]);

            $this->holdService->releaseHoldsForAmount($wallet, $withdrawal->amount, 'Saque em processamento');

            return $transaction;
        });
    }

    public function cancelWithdrawal(WithdrawalRequest $withdrawal, string $reason): void
    {
        if (! $withdrawal->isPending()) {
            throw WithdrawalException::notPending($withdrawal->id);
        }

        $cancelledStatus = TransactionStatus::cancelled();

        DB::transaction(function () use ($withdrawal, $reason, $cancelledStatus): void {
            $withdrawal->update([
                'transaction_status_id' => $cancelledStatus?->id,
                'status' => 'cancelled',
                'failure_reason' => $reason,
            ]);

            $this->holdService->releaseHoldsForAmount(
                $withdrawal->wallet,
                $withdrawal->amount,
                'Saque em processamento'
            );
        });
    }

    protected function validateAmount(string $amount): void
    {
        if (! is_numeric($amount)) {
            throw InvalidAmountException::mustBeNumeric($amount);
        }

        if (bccomp($amount, '0', 2) <= 0) {
            throw InvalidAmountException::mustBePositive($amount);
        }
    }
}
