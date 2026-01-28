<?php

namespace App\Services\Wallet\Operations;

use App\Exceptions\Wallet\InsufficientBalanceException;
use App\Exceptions\Wallet\InvalidAmountException;
use App\Exceptions\Wallet\TransactionTypeNotFoundException;
use App\Models\TransactionType;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Services\Wallet\Contracts\TransferServiceInterface;
use Illuminate\Support\Facades\DB;

class TransferService implements TransferServiceInterface
{
    public function transfer(
        Wallet $from,
        Wallet $to,
        string $amount,
        ?string $description = null,
        array $metadata = []
    ): void {
        $this->validateAmount($amount);

        $effectiveBalance = $from->calculateEffectiveBalance();

        if (bccomp($effectiveBalance, $amount, 2) < 0) {
            throw InsufficientBalanceException::forTransfer($amount, $effectiveBalance);
        }

        $transferOutType = TransactionType::findByCode('transfer_out');
        $transferInType = TransactionType::findByCode('transfer_in');

        if (! $transferOutType) {
            throw new TransactionTypeNotFoundException('transfer_out');
        }

        if (! $transferInType) {
            throw new TransactionTypeNotFoundException('transfer_in');
        }

        DB::transaction(function () use ($from, $to, $amount, $description, $metadata, $transferOutType, $transferInType): void {
            $from->lockForUpdate();
            $to->lockForUpdate();

            $fromCurrentBalance = $from->calculateAvailableBalance();
            $newFromBalance = bcsub($fromCurrentBalance, $amount, 2);

            WalletTransaction::query()->create([
                'wallet_id' => $from->id,
                'transaction_type_id' => $transferOutType->id,
                'type' => $transferOutType->code,
                'amount' => $amount,
                'balance_after' => $newFromBalance,
                'reference_type' => Wallet::class,
                'reference_id' => $to->id,
                'description' => $description ?? 'Transferência enviada',
                'metadata' => $metadata,
            ]);

            $toCurrentBalance = $to->calculateAvailableBalance();
            $newToBalance = bcadd($toCurrentBalance, $amount, 2);

            WalletTransaction::query()->create([
                'wallet_id' => $to->id,
                'transaction_type_id' => $transferInType->id,
                'type' => $transferInType->code,
                'amount' => $amount,
                'balance_after' => $newToBalance,
                'reference_type' => Wallet::class,
                'reference_id' => $from->id,
                'description' => $description ?? 'Transferência recebida',
                'metadata' => $metadata,
            ]);
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
