<?php

namespace App\Services\Wallet\Contracts;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface BalanceServiceInterface
{
    public function getAvailableBalance(Wallet $wallet): string;

    public function getPendingBalance(Wallet $wallet): string;

    public function getTotalBalance(Wallet $wallet): string;

    public function getEffectiveBalance(Wallet $wallet): string;

    /**
     * @return LengthAwarePaginator<WalletTransaction>
     */
    public function getTransactionHistory(
        Wallet $wallet,
        array $filters = [],
        int $perPage = 15
    ): LengthAwarePaginator;

    /**
     * @return Collection<int, \App\Models\WithdrawalRequest>
     */
    public function getWithdrawalHistory(Wallet $wallet): Collection;
}
