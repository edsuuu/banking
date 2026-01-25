<?php

namespace App\Livewire\Settings\Security;

use Livewire\Component;

class Sessions extends Component
{
    public $showTwoFactorModal = false;

    public function openTwoFactorModal()
    {
        $this->showTwoFactorModal = true;
    }

    public function closeTwoFactorModal()
    {
        $this->showTwoFactorModal = false;
    }

    public function render()
    {
        return view('livewire.settings.security.sessions');
    }
}
