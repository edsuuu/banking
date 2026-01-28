<?php

namespace App\Livewire\Withdrawals;

use App\Models\BankAccount;
use App\Models\Wallet;
use App\Models\WithdrawalMethod;
use App\Models\WithdrawalRequest;
use App\Services\Wallet\WalletService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public ?Wallet $wallet = null;
    public ?BankAccount $activeBankAccount = null;
    public string $availableBalance = '0.00';
    public string $pendingBalance = '0.00';
    public string $effectiveBalance = '0.00';

    /** @var Collection<int, WithdrawalRequest> */
    public Collection $withdrawalHistory;

    /** @var Collection<int, \App\Models\WalletTransaction> */
    public Collection $recentTransactions;

    /** @var Collection<int, WithdrawalMethod> */
    public Collection $withdrawalMethods;

    protected WalletService $walletService;

    public function boot(WalletService $walletService): void
    {
        $this->walletService = $walletService;
    }

    public function mount(): void
    {
        $this->withdrawalHistory = collect();
        $this->recentTransactions = collect();
        $this->withdrawalMethods = WithdrawalMethod::query()->where('is_active', true)->get();

        $this->loadWalletData();
    }

    #[On('withdrawal-created')]
    #[On('account-updated')]
    public function refreshData(): void
    {
        $this->loadWalletData();
    }

    protected function loadWalletData(): void
    {
        $user = Auth::user();

        if (! $user || ! $user->business) {
            return;
        }

        // Carregar conta bancária ativa
        $this->activeBankAccount = $user->business->activeBankAccount;

        $this->wallet = $this->walletService->getWallet($user->business);
        $this->availableBalance = $this->walletService->getAvailableBalance($this->wallet);
        $this->pendingBalance = $this->walletService->getPendingBalance($this->wallet);
        $this->effectiveBalance = $this->walletService->getEffectiveBalance($this->wallet);

        $this->withdrawalHistory = $this->wallet
            ->withdrawalRequests()
            ->with(['withdrawalMethod', 'transactionStatus'])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $this->recentTransactions = $this->wallet
            ->transactions()
            ->with('transactionType')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();
    }

    public function getFormattedAvailableBalanceProperty(): string
    {
        return number_format((float) $this->availableBalance, 2, ',', '.');
    }

    public function getFormattedPendingBalanceProperty(): string
    {
        return number_format((float) $this->pendingBalance, 2, ',', '.');
    }

    public function getFormattedEffectiveBalanceProperty(): string
    {
        return number_format((float) $this->effectiveBalance, 2, ',', '.');
    }

    public function formatCurrency(string $value): string
    {
        return number_format((float) $value, 2, ',', '.');
    }

    public function render(): View
    {
        return view('livewire.withdrawals.index');
    }
}
