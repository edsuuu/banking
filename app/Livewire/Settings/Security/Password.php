<?php

namespace App\Livewire\Settings\Security;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Password extends Component
{
    public $password = '';
    public $password_confirmation = '';

    protected function rules()
    {
        return [
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    protected function messages()
    {
        return [
            'password.required' => 'A nova senha é obrigatória.',
            'password.min' => 'A nova senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação da nova senha não confere.',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'password' => 'nova senha',
        ];
    }

    public function updatePassword()
    {
        $this->validate();

        try {
            Auth::user()->update([
                'password' => Hash::make($this->password),
            ]);

            $this->reset(['password', 'password_confirmation']);
            
            $this->dispatch('password-updated');
            session()->flash('status', 'Sua senha foi atualizada com sucesso!');

        } catch (\Exception $e) {
            Log::channel('auth')->error('Password Update Error: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'exception' => $e
            ]);
            $this->addError('password', 'Ocorreu um erro ao atualizar sua senha.');
        }
    }

    public function render()
    {
        return view('livewire.settings.security.password');
    }
}
