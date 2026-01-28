<?php

namespace App\Services\Wallet\Operations;

use App\Exceptions\Wallet\InsufficientBalanceException;
use App\Exceptions\Wallet\TransactionTypeNotFoundException;
use App\Models\TransactionType;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;

class RefundService
{
    public function refund(
        WalletTransaction $originalTransaction,
        ?string $reason = null
    ): WalletTransaction {
        $wallet = $originalTransaction->wallet;

        $refundType = TransactionType::findByCode('refund');

        if (! $refundType) {
            throw new TransactionTypeNotFoundException('refund');
        }

        return DB::transaction(function () use ($wallet, $originalTransaction, $reason, $refundType): WalletTransaction {
            $wallet->lockForUpdate();

            $currentBalance = $wallet->calculateAvailableBalance();

            if ($originalTransaction->isDebit()) {
                $newBalance = bcadd($currentBalance, $originalTransaction->amount, 2);
            } else {
                $newBalance = bcsub($currentBalance, $originalTransaction->amount, 2);

                if (bccomp($newBalance, '0', 2) < 0) {
                    throw InsufficientBalanceException::forRefund(
                        $originalTransaction->amount,
                        $currentBalance
                    );
                }
            }

            return WalletTransaction::query()->create([
                'wallet_id' => $wallet->id,
                'transaction_type_id' => $refundType->id,
                'type' => $refundType->code,
                'amount' => $originalTransaction->amount,
                'balance_after' => $newBalance,
                'reference_type' => WalletTransaction::class,
                'reference_id' => $originalTransaction->id,
                'description' => $reason ?? 'Estorno da transação ' . $originalTransaction->id,
                'metadata' => [
                    'original_transaction_id' => $originalTransaction->id,
                    'original_type' => $originalTransaction->type,
                ],
            ]);
        });
    }
}
