<?php

namespace App\Services\Wallet\Queries;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Services\Wallet\Contracts\BalanceServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BalanceService implements BalanceServiceInterface
{
    public function getAvailableBalance(Wallet $wallet): string
    {
        return $wallet->calculateAvailableBalance();
    }

    public function getPendingBalance(Wallet $wallet): string
    {
        return $wallet->calculatePendingBalance();
    }

    public function getTotalBalance(Wallet $wallet): string
    {
        $available = $this->getAvailableBalance($wallet);
        $pending = $this->getPendingBalance($wallet);

        return bcadd($available, $pending, 2);
    }

    public function getEffectiveBalance(Wallet $wallet): string
    {
        return $wallet->calculateEffectiveBalance();
    }

    /**
     * @return LengthAwarePaginator<WalletTransaction>
     */
    public function getTransactionHistory(
        Wallet $wallet,
        array $filters = [],
        int $perPage = 15
    ): LengthAwarePaginator {
        $query = $wallet->transactions()->with('transactionType');

        if (isset($filters['type_id'])) {
            $query->where('transaction_type_id', $filters['type_id']);
        }

        if (isset($filters['type_code'])) {
            $query->whereHas('transactionType', fn ($q) => $q->where('code', $filters['type_code']));
        }

        if (isset($filters['start_date'])) {
            $query->where('created_at', '>=', $filters['start_date']);
        }

        if (isset($filters['end_date'])) {
            $query->where('created_at', '<=', $filters['end_date']);
        }

        if (isset($filters['direction'])) {
            $query->whereHas('transactionType', fn ($q) => $q->where('direction', $filters['direction']));
        }

        return $query->paginate($perPage);
    }

    /**
     * @return Collection<int, \App\Models\WithdrawalRequest>
     */
    public function getWithdrawalHistory(Wallet $wallet): Collection
    {
        return $wallet->withdrawalRequests()
            ->with(['withdrawalMethod', 'transactionStatus'])
            ->get();
    }

    /**
     * @return Collection<int, \App\Models\WithdrawalRequest>
     */
    public function getPendingWithdrawals(Wallet $wallet): Collection
    {
        return $wallet->withdrawalRequests()
            ->where('status', 'pending')
            ->with(['withdrawalMethod', 'transactionStatus'])
            ->get();
    }
}
