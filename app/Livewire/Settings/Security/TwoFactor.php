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

    /**
     * Enable two factor authentication for the user.
     *
     * @param  \Laravel\Fortify\Actions\EnableTwoFactorAuthentication  $enable
     * @return void
     */
    public function enable(EnableTwoFactorAuthentication $enable)
    {
        $enable(Auth::user());

        $this->showingQrCode = true;
        $this->showingConfirmation = true;
    }

    /**
     * Confirm two factor authentication for the user.
     *
     * @param  \Laravel\Fortify\Actions\ConfirmTwoFactorAuthentication  $confirm
     * @return void
     */
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

    /**
     * Disable two factor authentication for the user.
     *
     * @param  \Laravel\Fortify\Actions\DisableTwoFactorAuthentication  $disable
     * @return void
     */
    public function disable(DisableTwoFactorAuthentication $disable)
    {
        $disable(Auth::user());

        $this->showingQrCode = false;
        $this->showingConfirmation = false;
        $this->showingRecoveryCodes = false;
        
        // Ensure the component state reflects the change
        $this->dispatch('two-factor-disabled');
    }

    /**
     * Generate new recovery codes for the user.
     *
     * @param  \Laravel\Fortify\Actions\GenerateNewRecoveryCodes  $generate
     * @return void
     */
    public function regenerateRecoveryCodes(GenerateNewRecoveryCodes $generate)
    {
        $generate(Auth::user());

        $this->showingRecoveryCodes = true;
    }

    public function close(DisableTwoFactorAuthentication $disable)
    {
        $user = Auth::user()->fresh();

        // If user started activation but didn't confirm, clean up the secret
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
