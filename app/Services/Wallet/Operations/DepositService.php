<?php

namespace App\Services\Wallet\Operations;

use App\Exceptions\Wallet\InsufficientBalanceException;
use App\Exceptions\Wallet\InvalidAmountException;
use App\Exceptions\Wallet\TransactionTypeNotFoundException;
use App\Models\TransactionType;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Services\Wallet\Contracts\DepositServiceInterface;
use Illuminate\Support\Facades\DB;

class DepositService implements DepositServiceInterface
{
    public function deposit(
        Wallet $wallet,
        string $amount,
        ?string $referenceType = null,
        ?int $referenceId = null,
        ?string $description = null,
        array $metadata = []
    ): WalletTransaction {
        $this->validateAmount($amount);

        $transactionType = TransactionType::findByCode('deposit');

        if (! $transactionType) {
            throw new TransactionTypeNotFoundException('deposit');
        }

        return DB::transaction(function () use ($wallet, $amount, $transactionType, $referenceType, $referenceId, $description, $metadata): WalletTransaction {
            $wallet->lockForUpdate();

            $currentBalance = $wallet->calculateAvailableBalance();
            $newBalance = bcadd($currentBalance, $amount, 2);

            return WalletTransaction::query()->create([
                'wallet_id' => $wallet->id,
                'transaction_type_id' => $transactionType->id,
                'type' => $transactionType->code,
                'amount' => $amount,
                'balance_after' => $newBalance,
                'reference_type' => $referenceType,
                'reference_id' => $referenceId,
                'description' => $description ?? 'Depósito',
                'metadata' => $metadata,
            ]);
        });
    }

    public function addPendingBalance(
        Wallet $wallet,
        string $amount,
        ?string $description = null
    ): WalletTransaction {
        $this->validateAmount($amount);

        $transactionType = TransactionType::findByCode('deposit');

        if (! $transactionType) {
            throw new TransactionTypeNotFoundException('deposit');
        }

        return DB::transaction(function () use ($wallet, $amount, $transactionType, $description): WalletTransaction {
            $wallet->lockForUpdate();

            $currentBalance = $wallet->calculateAvailableBalance();
            $newBalance = bcadd($currentBalance, $amount, 2);

            return WalletTransaction::query()->create([
                'wallet_id' => $wallet->id,
                'transaction_type_id' => $transactionType->id,
                'type' => $transactionType->code,
                'amount' => $amount,
                'balance_after' => $newBalance,
                'description' => $description ?? 'Saldo pendente adicionado',
                'metadata' => ['pending' => true],
            ]);
        });
    }

    public function releasePendingBalance(Wallet $wallet, string $amount): void
    {
        $this->validateAmount($amount);

        $pendingBalance = $wallet->calculatePendingBalance();

        if (bccomp($pendingBalance, $amount, 2) < 0) {
            throw InsufficientBalanceException::forTransfer($amount, $pendingBalance);
        }

        DB::transaction(function () use ($wallet, $amount): void {
            $wallet->lockForUpdate();

            $pendingTransactions = $wallet->transactions()
                ->whereJsonContains('metadata->pending', true)
                ->orderBy('created_at')
                ->get();

            $remaining = $amount;

            foreach ($pendingTransactions as $transaction) {
                if (bccomp($remaining, '0', 2) <= 0) {
                    break;
                }

                $metadata = $transaction->metadata ?? [];
                $metadata['pending'] = false;
                $metadata['released_at'] = now()->toIso8601String();

                $transaction->update(['metadata' => $metadata]);

                $remaining = bcsub($remaining, $transaction->amount, 2);
            }
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
