<?php

namespace App\Services\Wallet\Operations;

use App\Exceptions\Wallet\HoldException;
use App\Exceptions\Wallet\InsufficientBalanceException;
use App\Exceptions\Wallet\InvalidAmountException;
use App\Models\HoldStatus;
use App\Models\Wallet;
use App\Models\WalletHold;
use App\Services\Wallet\Contracts\HoldServiceInterface;
use Carbon\Carbon;

class HoldService implements HoldServiceInterface
{
    public function createHold(
        Wallet $wallet,
        string $amount,
        string $reason,
        ?Carbon $expiresAt = null
    ): WalletHold {
        $this->validateAmount($amount);

        $effectiveBalance = $wallet->calculateEffectiveBalance();

        if (bccomp($effectiveBalance, $amount, 2) < 0) {
            throw InsufficientBalanceException::forHold($amount, $effectiveBalance);
        }

        $activeStatus = HoldStatus::active();

        return WalletHold::query()->create([
            'wallet_id' => $wallet->id,
            'amount' => $amount,
            'reason' => $reason,
            'hold_status_id' => $activeStatus?->id,
            'status' => 'active',
            'expires_at' => $expiresAt,
        ]);
    }

    public function releaseHold(WalletHold $hold): void
    {
        if (! $hold->isActive()) {
            throw HoldException::notActive($hold->id);
        }

        $releasedStatus = HoldStatus::released();

        $hold->update([
            'hold_status_id' => $releasedStatus?->id,
            'status' => 'released',
            'released_at' => now(),
        ]);
    }

    public function expireHolds(): int
    {
        $expiredStatus = HoldStatus::expired();

        return WalletHold::query()
            ->where('status', 'active')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<', now())
            ->update([
                'hold_status_id' => $expiredStatus?->id,
                'status' => 'expired',
            ]);
    }

    public function releaseHoldsForAmount(Wallet $wallet, string $amount, string $reason): void
    {
        $holds = $wallet->activeHolds()
            ->where('reason', $reason)
            ->orderBy('created_at')
            ->get();

        $remaining = $amount;

        foreach ($holds as $hold) {
            if (bccomp($remaining, '0', 2) <= 0) {
                break;
            }

            $this->releaseHold($hold);
            $remaining = bcsub($remaining, $hold->amount, 2);
        }
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
