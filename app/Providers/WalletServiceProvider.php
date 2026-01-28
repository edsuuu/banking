<?php

namespace App\Providers;

use App\Services\Wallet\Contracts\BalanceServiceInterface;
use App\Services\Wallet\Contracts\DepositServiceInterface;
use App\Services\Wallet\Contracts\HoldServiceInterface;
use App\Services\Wallet\Contracts\TransferServiceInterface;
use App\Services\Wallet\Contracts\WithdrawalServiceInterface;
use App\Services\Wallet\Operations\DepositService;
use App\Services\Wallet\Operations\HoldService;
use App\Services\Wallet\Operations\TransferService;
use App\Services\Wallet\Operations\WithdrawalService;
use App\Services\Wallet\Queries\BalanceService;
use Illuminate\Support\ServiceProvider;

class WalletServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DepositServiceInterface::class, DepositService::class);
        $this->app->bind(WithdrawalServiceInterface::class, WithdrawalService::class);
        $this->app->bind(TransferServiceInterface::class, TransferService::class);
        $this->app->bind(HoldServiceInterface::class, HoldService::class);
        $this->app->bind(BalanceServiceInterface::class, BalanceService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
