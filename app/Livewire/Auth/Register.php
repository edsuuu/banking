<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $document = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $terms = false;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u', 'regex:/^\S+\s+\S+.*$/'],
            'email' => 'required|email:rfc,dns|max:255|unique:users,email',
            'document' => 'required|string|cpf_ou_cnpj|unique:users,document',
            'password' => 'required|string|min:8|max:100|confirmed',
            'terms' => 'accepted',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.regex' => 'Digite seu nome e sobrenome.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Digite um e-mail válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'email.max' => 'O e-mail não pode ter mais de 255 caracteres.',
            'document.required' => 'O CPF ou CNPJ é obrigatório.',
            'document.cpf_ou_cnpj' => 'O documento informado é inválido.',
            'document.unique' => 'Este documento já está em uso.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.max' => 'A senha deve ter no máximo 100 caracteres.',
            'password.confirmed' => 'As senhas não conferem.',
            'terms.accepted' => 'Você precisa aceitar os termos de uso.',
        ];
    }

    protected function attributes()
    {
        return [
            'name' => 'Nome Completo',
            'email' => 'E-mail Corporativo',
            'document' => 'CPF ou CNPJ',
            'password' => 'Senha',
            'terms' => 'Termos de Uso',
        ];
    }

    public function register()
    {
        $this->validate();

        $user = User::query()->create([
            'name' => $this->name,
            'email' => $this->email,
            'document' => $this->document,
            'terms' => $this->terms,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user);

        return redirect()->intended(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
