<?php

namespace App\Livewire\Settings\Profile;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    public $name;
    public $email;
    public $document;
    public $phone;
    
    public $businessLegalName;
    public $businessTradingName;
    public $businessAddress;
    
    public $isEditing = false;

    public function mount()
    {
        $user = Auth::user();
        
        $this->name = $user->name;
        $this->email = $user->email;
        $this->document = $user->document;
        $this->phone = $user->phone;

        if ($user->business) {
            $this->businessLegalName = $user->business->legal_name;
            $this->businessTradingName = $user->business->trading_name;
            $primaryAddress = $user->business->primaryAddress;
            if ($primaryAddress) {
                $this->businessAddress = "{$primaryAddress->street}, {$primaryAddress->number} - {$primaryAddress->neighborhood}, {$primaryAddress->city} - {$primaryAddress->state}";
            }
        } else {
            $this->businessLegalName = "Não vinculado";
            $this->businessTradingName = "Não vinculado";
            $this->businessAddress = "Não vinculado";
        }
    }

    public function toggleEdit()
    {
        $this->isEditing = !$this->isEditing;
    }

    public function cancel()
    {
        $this->mount();
        $this->isEditing = false;
    }

    public function save()
    {
        $this->validate();

        try {
            $user = Auth::user();
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'document' => $this->document,
                'phone' => $this->phone,
            ]);

            $this->isEditing = false;
            $this->dispatch('profile-updated');

        } catch (\Exception $e) {
            Log::channel('auth')->error('Profile Update Error: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'exception' => $e
            ]);
            $this->addError('name', 'Ocorreu um erro ao atualizar seu perfil.');
        }
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u', 'regex:/^\S+\s+\S+.*$/'],
            'email' => 'required|email:dns,rfc|unique:users,email,' . Auth::id(),
            'document' => 'nullable|string|cpf_ou_cnpj|unique:users,document,' . Auth::id(),
            'phone' => 'nullable|string|celular_com_ddd|unique:users,phone,' . Auth::id(),
        ];
    }

    protected function messages()
    {
        return [
            'name.regex' => 'Digite seu nome e sobrenome.',
            'email.email' => 'Digite um e-mail válido.',
            'document.cpf_ou_cnpj' => 'O CPF ou CNPJ informado é inválido.',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'name' => 'Nome Completo',
            'email' => 'E-mail',
            'document' => 'CPF/CNPJ',
            'phone' => 'Telefone',
        ];
    }

    public function render()
    {
        return view('livewire.settings.profile.index');
    }
}
