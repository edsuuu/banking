<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Models\Business;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $document = '';
    public string $phone = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $terms = false;
    public bool $isSocial = false;
    public ?string $google_id = null;

    public function mount()
    {
        if (session()->has('social_user')) {
            $socialUser = session('social_user');
            $this->name = $socialUser['name'] ?? '';
            $this->email = $socialUser['email'] ?? '';
            $this->google_id = $socialUser['google_id'] ?? null;
            $this->isSocial = true;
        }
    }

    protected function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u', 'regex:/^\S+\s+\S+.*$/'],
            'email' => 'required|email:dns,rfc|max:255|unique:users,email' . ($this->isSocial ? ',' . ($this->getExistingUserId() ?: 'NULL') : ''),
            'document' => 'required|string|cpf_ou_cnpj|unique:users,document' . ($this->isSocial ? ',' . ($this->getExistingUserId() ?: 'NULL') : ''),
            'phone' => 'required|string|celular_com_ddd|unique:users,phone' . ($this->isSocial ? ',' . ($this->getExistingUserId() ?: 'NULL') : ''),
            'terms' => 'accepted',
        ];

        if (!$this->isSocial) {
            $rules['password'] = 'required|string|min:8|max:100|confirmed';
        }

        return $rules;
    }

    protected function getExistingUserId()
    {
        return User::where('email', $this->email)->value('id');
    }

    protected function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.regex' => 'Digite seu nome e sobrenome.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Digite um e-mail válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'document.required' => 'O CPF ou CNPJ é obrigatório.',
            'document.cpf_ou_cnpj' => 'O documento informado é inválido.',
            'document.unique' => 'Este documento já está em uso.',
            'phone.required' => 'O telefone é obrigatório.',
            'phone.celular_com_ddd' => 'O telefone informado é inválido.',
            'phone.unique' => 'Este telefone já está em uso.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'As senhas não conferem.',
            'terms.accepted' => 'Você precisa aceitar os termos de uso.',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'name' => 'Nome Completo',
            'email' => 'E-mail Corporativo',
            'document' => 'CPF ou CNPJ',
            'phone' => 'Telefone',
            'password' => 'Senha',
            'terms' => 'Termos de Uso',
        ];
    }

    public function register()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $plan = Plan::query()->where('slug', 'starter')->first();

            $documentDigits = preg_replace('/[^0-9]/', '', $this->document);
            $isCnpj = strlen($documentDigits) === 14;

            $businessData = [
                'plan_id' => $plan?->id,
                'trading_name' => explode(' ', $this->name)[0] . ' Business',
            ];

            if ($isCnpj) {
                $businessData['tax_id'] = $this->document;
                $businessData['legal_name'] = $this->name;
            }

            $business = Business::query()->create($businessData);

            $userData = [
                'business_id' => $business->id,
                'google_id' => $this->google_id,
                'name' => $this->name,
                'email' => $this->email,
                'document' => $this->document,
                'phone' => $this->phone,
                'terms' => $this->terms,
            ];

            if ($this->isSocial) {
                $user = User::where('email', $this->email)->first();
                if ($user) {
                    $user->update($userData);
                } else {
                    $userData['password'] = Hash::make(Str::random(16));
                    $user = User::query()->create($userData);
                }
            } else {
                $userData['password'] = Hash::make($this->password);
                $user = User::query()->create($userData);
            }

            DB::commit();

            Auth::login($user);

            session()->forget('social_user');

            return redirect()->intended(route('dashboard'));

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::channel('auth')->error('Registration Error: ' . $e->getMessage(), [
                'email' => $this->email,
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            $this->addError('email', 'Ocorreu um erro ao processar seu cadastro. Por favor, tente novamente.');
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
