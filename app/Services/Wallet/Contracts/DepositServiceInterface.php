<?php

namespace App\Services\Wallet\Contracts;

use App\Models\Wallet;
use App\Models\WalletTransaction;

interface DepositServiceInterface
{
    public function deposit(
        Wallet $wallet,
        string $amount,
        ?string $referenceType = null,
        ?int $referenceId = null,
        ?string $description = null,
        array $metadata = []
    ): WalletTransaction;

    public function addPendingBalance(
        Wallet $wallet,
        string $amount,
        ?string $description = null
    ): WalletTransaction;

    public function releasePendingBalance(
        Wallet $wallet,
        string $amount
    ): void;
}
