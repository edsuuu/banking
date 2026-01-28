<?php

namespace App\Services\Wallet\Contracts;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\WithdrawalRequest;

interface WithdrawalServiceInterface
{
    public function requestWithdrawal(
        Wallet $wallet,
        string $amount,
        int $withdrawalMethodId,
        array $bankAccount
    ): WithdrawalRequest;

    public function processWithdrawal(WithdrawalRequest $withdrawal): WalletTransaction;

    public function cancelWithdrawal(WithdrawalRequest $withdrawal, string $reason): void;
}
