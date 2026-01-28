<?php

namespace App\Services\Wallet;

use App\Models\Business;
use App\Models\Wallet;
use App\Models\WalletHold;
use App\Models\WalletTransaction;
use App\Models\WithdrawalRequest;
use App\Services\Wallet\Contracts\BalanceServiceInterface;
use App\Services\Wallet\Contracts\DepositServiceInterface;
use App\Services\Wallet\Contracts\HoldServiceInterface;
use App\Services\Wallet\Contracts\TransferServiceInterface;
use App\Services\Wallet\Contracts\WithdrawalServiceInterface;
use App\Services\Wallet\Operations\RefundService;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class WalletService
{
    public function __construct(
        protected DepositServiceInterface $depositService,
        protected WithdrawalServiceInterface $withdrawalService,
        protected TransferServiceInterface $transferService,
        protected HoldServiceInterface $holdService,
        protected BalanceServiceInterface $balanceService,
        protected RefundService $refundService,
    ) {}

    public function getWallet(Business $business): Wallet
    {
        return $business->wallet ?? $this->createWallet($business);
    }

    public function createWallet(Business $business): Wallet
    {
        return Wallet::query()->create([
            'business_id' => $business->id,
        ]);
    }

    public function getAvailableBalance(Wallet $wallet): string
    {
        return $this->balanceService->getAvailableBalance($wallet);
    }

    public function getPendingBalance(Wallet $wallet): string
    {
        return $this->balanceService->getPendingBalance($wallet);
    }

    public function getTotalBalance(Wallet $wallet): string
    {
        return $this->balanceService->getTotalBalance($wallet);
    }

    public function getEffectiveBalance(Wallet $wallet): string
    {
        return $this->balanceService->getEffectiveBalance($wallet);
    }

    public function deposit(
        Wallet $wallet,
        string $amount,
        ?string $referenceType = null,
        ?int $referenceId = null,
        ?string $description = null,
        array $metadata = []
    ): WalletTransaction {
        return $this->depositService->deposit(
            $wallet,
            $amount,
            $referenceType,
            $referenceId,
            $description,
            $metadata
        );
    }

    public function addPendingBalance(
        Wallet $wallet,
        string $amount,
        ?string $description = null
    ): WalletTransaction {
        return $this->depositService->addPendingBalance($wallet, $amount, $description);
    }

    public function releasePendingBalance(Wallet $wallet, string $amount): void
    {
        $this->depositService->releasePendingBalance($wallet, $amount);
    }

    public function requestWithdrawal(
        Wallet $wallet,
        string $amount,
        int $withdrawalMethodId,
        array $bankAccount
    ): WithdrawalRequest {
        return $this->withdrawalService->requestWithdrawal(
            $wallet,
            $amount,
            $withdrawalMethodId,
            $bankAccount
        );
    }

    public function processWithdrawal(WithdrawalRequest $withdrawal): WalletTransaction
    {
        return $this->withdrawalService->processWithdrawal($withdrawal);
    }

    public function cancelWithdrawal(WithdrawalRequest $withdrawal, string $reason): void
    {
        $this->withdrawalService->cancelWithdrawal($withdrawal, $reason);
    }

    public function transfer(
        Wallet $from,
        Wallet $to,
        string $amount,
        ?string $description = null,
        array $metadata = []
    ): void {
        $this->transferService->transfer($from, $to, $amount, $description, $metadata);
    }

    public function createHold(
        Wallet $wallet,
        string $amount,
        string $reason,
        ?Carbon $expiresAt = null
    ): WalletHold {
        return $this->holdService->createHold($wallet, $amount, $reason, $expiresAt);
    }

    public function releaseHold(WalletHold $hold): void
    {
        $this->holdService->releaseHold($hold);
    }

    public function expireHolds(): int
    {
        return $this->holdService->expireHolds();
    }

    public function refund(WalletTransaction $originalTransaction, ?string $reason = null): WalletTransaction
    {
        return $this->refundService->refund($originalTransaction, $reason);
    }

    /**
     * @return LengthAwarePaginator<WalletTransaction>
     */
    public function getTransactionHistory(
        Wallet $wallet,
        array $filters = [],
        int $perPage = 15
    ): LengthAwarePaginator {
        return $this->balanceService->getTransactionHistory($wallet, $filters, $perPage);
    }

    /**
     * @return Collection<int, WithdrawalRequest>
     */
    public function getWithdrawalHistory(Wallet $wallet): Collection
    {
        return $this->balanceService->getWithdrawalHistory($wallet);
    }
}
