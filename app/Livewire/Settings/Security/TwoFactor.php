<?php

namespace App\Livewire\Settings\Security;

use Livewire\Component;

class TwoFactor extends Component
{
    public function close()
    {
        $this->dispatch('close-two-factor-modal');
    }

    public function render()
    {
        return view('livewire.settings.security.two-factor');
    }
}
