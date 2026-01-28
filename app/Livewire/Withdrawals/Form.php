<?php

namespace App\Livewire\Withdrawals;

use App\Models\WithdrawalMethod;
use App\Services\Wallet\WalletService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\View\View;
use Exception;

class Form extends Component
{
    public string $amount = '';
    public int $withdrawalMethodId = 0;
    public string $availableBalance = '0.00';

    protected WalletService $walletService;

    protected function rules(): array
    {
        return [
            'amount' => ['required', 'numeric', 'min:50'],
            'withdrawalMethodId' => ['required', 'exists:withdrawal_methods,id'],
        ];
    }

    protected function messages(): array
    {
        return [
            'amount.required' => 'Informe o valor do saque.',
            'amount.min' => 'O valor mínimo para saque é R$ 50,00.',
            'withdrawalMethodId.required' => 'Selecione o método de recebimento.',
        ];
    }

    public function boot(WalletService $walletService): void
    {
        $this->walletService = $walletService;
    }

    public function mount(): void
    {
        $user = Auth::user();

        if ($user?->business) {
            $wallet = $this->walletService->getWallet($user->business);
            $this->availableBalance = $this->walletService->getEffectiveBalance($wallet);
        }

        $pix = WithdrawalMethod::query()->where('code', 'pix')->where('is_active', true)->first();
        if ($pix) {
            $this->withdrawalMethodId = $pix->id;
        }
    }

    public function submit(): void
    {
        $this->amount = $this->parseCurrency($this->amount);

        $this->validate();

        $user = Auth::user();

        if (! $user?->business) {
            $this->addError('amount', 'Usuário não possui business associado.');

            return;
        }

        if (! $user->business->activeBankAccount) {
            $this->addError('amount', 'Cadastre uma conta bancária antes de solicitar saque.');

            return;
        }

        $wallet = $this->walletService->getWallet($user->business);
        $effectiveBalance = $this->walletService->getEffectiveBalance($wallet);

        if (bccomp($effectiveBalance, $this->amount, 2) < 0) {
            $this->addError('amount', 'Saldo insuficiente para saque.');

            return;
        }

        try {
            $this->walletService->requestWithdrawal(
                $wallet,
                $this->amount,
                $this->withdrawalMethodId,
                []
            );

            $this->dispatch('withdrawal-created');
            $this->dispatch('closeModal');
        } catch (Exception $e) {
            Log::channel('daily')->error('Erro ao solicitar saque', [
                'user_id' => $user->id,
                'business_id' => $user->business->id,
                'amount' => $this->amount,
                'exception' => $e,
            ]);
            $this->addError('amount', 'Erro ao processar saque. Tente novamente.');
        }
    }

    protected function parseCurrency(string $value): string
    {
        $cleaned = str_replace('.', '', $value);
        $cleaned = str_replace(',', '.', $cleaned);

        return $cleaned;
    }

    public function getFormattedAvailableBalanceProperty(): string
    {
        return number_format((float) $this->availableBalance, 2, ',', '.');
    }

    public function render(): View
    {
        return view('livewire.withdrawals.form', [
            'withdrawalMethods' => WithdrawalMethod::query()->where('is_active', true)->get(),
        ]);
    }
}
