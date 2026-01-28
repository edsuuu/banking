<?php

namespace App\Services\Wallet\Contracts;

use App\Models\Wallet;
use App\Models\WalletHold;
use Carbon\Carbon;

interface HoldServiceInterface
{
    public function createHold(
        Wallet $wallet,
        string $amount,
        string $reason,
        ?Carbon $expiresAt = null
    ): WalletHold;

    public function releaseHold(WalletHold $hold): void;

    public function expireHolds(): int;
}
