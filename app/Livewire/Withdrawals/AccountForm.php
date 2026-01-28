<?php

namespace App\Livewire\Withdrawals;

use App\Models\BankAccount;
use App\Services\Integration\BrasilAPIService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Illuminate\View\View;
use Exception;

class AccountForm extends Component
{
    public ?BankAccount $currentAccount = null;
    public Collection $savedAccounts;
    public string $activeTab = 'new';

    public string $bankSearch = '';
    public string $selectedBankCode = '';
    public string $selectedBankName = '';

    public string $agency = '';
    public string $account = '';
    public string $accountType = 'corrente';
    public string $holderName = '';
    public string $holderDocument = '';
    public string $pixKeyType = '';
    public string $pixKey = '';

    protected function rules(): array
    {
        $rules = [
            'selectedBankCode' => ['required', 'string', 'max:10'],
            'agency' => ['required', 'string', 'max:10'],
            'account' => ['required', 'string', 'max:20'],
            'accountType' => ['required', 'in:corrente,poupanca'],
            'holderName' => ['required', 'string', 'max:100'],
            'holderDocument' => ['required', 'cpf_ou_cnpj'],
            'pixKeyType' => ['nullable', 'in:cpf,cnpj,email,phone,random'],
        ];

        if ($this->pixKeyType) {
            $rules['pixKey'] = match ($this->pixKeyType) {
                'cpf' => ['required', 'cpf'],
                'cnpj' => ['required', 'cnpj'],
                'email' => ['required', 'email', 'max:60'],
                'phone' => ['required', 'celular_com_ddd'],
                'random' => ['required', 'string', 'regex:/^[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}$/'],
                default => ['nullable', 'string', 'max:100'],
            };
        }

        return $rules;
    }

    protected function messages(): array
    {
        return [
            'selectedBankCode.required' => 'Selecione o banco.',
            'agency.required' => 'Informe a agência.',
            'account.required' => 'Informe a conta.',
            'holderName.required' => 'Informe o nome do titular.',
            'holderDocument.required' => 'Informe o CPF ou CNPJ do titular.',
            'holderDocument.cpf_ou_cnpj' => 'CPF ou CNPJ inválido.',
            'pixKey.required' => 'Informe a chave PIX.',
            'pixKey.cpf' => 'CPF inválido.',
            'pixKey.cnpj' => 'CNPJ inválido.',
            'pixKey.email' => 'E-mail inválido.',
            'pixKey.celular_com_ddd' => 'Telefone inválido. Use o formato (11) 99999-9999.',
            'pixKey.regex' => 'Chave aleatória inválida. Use o formato UUID.',
        ];
    }

    public function mount(): void
    {
        $this->savedAccounts = collect();
        $this->loadData();
    }

    protected function loadData(): void
    {
        $user = Auth::user();

        if ($user?->business) {
            $this->currentAccount = $user->business->activeBankAccount;
            $this->savedAccounts = $user->business
                ->bankAccounts()
                ->where('is_active', false)
                ->orderByDesc('created_at')
                ->get();
        }
    }

    public function updatedPixKeyType(): void
    {
        $this->pixKey = '';
        $this->resetErrorBag('pixKey');
    }

    #[Computed]
    public function bankResults(): Collection
    {
        if (strlen($this->bankSearch) < 2) {
            return collect();
        }

        $brasilAPI = app(BrasilAPIService::class);
        return $brasilAPI->searchBanks($this->bankSearch);
    }

    public function selectBank(string $code, string $name): void
    {
        $this->selectedBankCode = $code;
        $this->selectedBankName = $name;
        $this->bankSearch = '';
    }

    public function clearSelectedBank(): void
    {
        $this->selectedBankCode = '';
        $this->selectedBankName = '';
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function selectSavedAccount(int $accountId): void
    {
        $user = Auth::user();

        if (! $user?->business) {
            return;
        }

        BankAccount::query()
            ->where('business_id', $user->business->id)
            ->update(['is_active' => false]);

        BankAccount::query()
            ->where('id', $accountId)
            ->where('business_id', $user->business->id)
            ->update(['is_active' => true]);

        $this->dispatch('account-updated');
        $this->dispatch('closeModal');
    }

    public function deleteSavedAccount(int $accountId): void
    {
        $user = Auth::user();

        if (! $user?->business) {
            return;
        }

        BankAccount::query()
            ->where('id', $accountId)
            ->where('business_id', $user->business->id)
            ->where('is_active', false)
            ->delete();

        $this->loadData();
    }

    public function submit(): void
    {
        $this->holderDocument = preg_replace('/\D/', '', $this->holderDocument);

        if ($this->pixKeyType === 'cpf' || $this->pixKeyType === 'cnpj') {
//            $this->pixKey = preg_replace('/\D/', '', $this->pixKey);
        }
        if ($this->pixKeyType === 'phone') {
            $this->pixKey = preg_replace('/\D/', '', $this->pixKey);
        }

        $this->validate();

        $user = Auth::user();

        if (! $user?->business) {
            $this->addError('selectedBankCode', 'Usuário não possui business associado.');

            return;
        }

        try {
            BankAccount::query()
                ->where('business_id', $user->business->id)
                ->update(['is_active' => false]);

            BankAccount::create([
                'business_id' => $user->business->id,
                'bank_code' => $this->selectedBankCode,
                'bank_name' => $this->selectedBankName,
                'agency' => $this->agency,
                'account' => $this->account,
                'account_type' => $this->accountType,
                'holder_name' => $this->holderName,
                'holder_document' => $this->holderDocument,
                'pix_key_type' => $this->pixKeyType ?: null,
                'pix_key' => $this->pixKey ?: null,
                'is_active' => true,
            ]);

            $this->addError('selectedBankCode', 'Erro ao salvar conta. Tente novamente.');
        } catch (Exception $e) {
            Log::channel('daily')->error('Erro ao salvar conta bancária', [
                'user_id' => $user->id,
                'business_id' => $user->business->id,
                'exception' => $e,
            ]);
            $this->addError('selectedBankCode', 'Erro ao salvar conta. Tente novamente.');
        }
    }

    public function render(): View
    {
        return view('livewire.withdrawals.account-form', [
            'pixKeyTypes' => BankAccount::pixKeyTypes(),
        ]);
    }
}
