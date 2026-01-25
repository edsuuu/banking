<?php

namespace App\Livewire\Settings\Security;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;
use Laravel\Fortify\Actions\ConfirmTwoFactorAuthentication;

class TwoFactor extends Component
{
    public $showingQrCode = false;
    public $showingConfirmation = false;
    public $showingRecoveryCodes = false;
    public $code;

    public function enable(EnableTwoFactorAuthentication $enable)
    {
        $enable(Auth::user());

        $this->showingQrCode = true;
        $this->showingConfirmation = true;
    }

    public function confirm(ConfirmTwoFactorAuthentication $confirm)
    {
        $this->validate([
            'code' => 'required|string',
        ]);

        $confirm(Auth::user(), $this->code);

        if (Auth::user()->fresh()->two_factor_confirmed_at) {
            $this->showingQrCode = false;
            $this->showingConfirmation = false;
            $this->showingRecoveryCodes = true;
        } else {
            $this->addError('code', 'O código informado é inválido.');
        }
    }

    public function disable(DisableTwoFactorAuthentication $disable)
    {
        $disable(Auth::user());

        $this->showingQrCode = false;
        $this->showingConfirmation = false;
        $this->showingRecoveryCodes = false;
        
        $this->dispatch('two-factor-disabled');
    }

    public function regenerateRecoveryCodes(GenerateNewRecoveryCodes $generate)
    {
        $generate(Auth::user());

        $this->showingRecoveryCodes = true;
    }

    public function close(DisableTwoFactorAuthentication $disable)
    {
        $user = Auth::user()->fresh();

        if ($user->two_factor_secret && ! $user->two_factor_confirmed_at) {
            $disable($user);
        }

        $this->dispatch('close-two-factor-modal');
    }

    public function render()
    {
        $user = Auth::user()->fresh();
        $confirmed = $user->two_factor_confirmed_at !== null;

        return view('livewire.settings.security.two-factor', [
            'enabled' => $user->two_factor_secret !== null,
            'confirmed' => $confirmed,
            'isPending' => $user->two_factor_secret !== null && ! $confirmed,
        ]);
    }
}
