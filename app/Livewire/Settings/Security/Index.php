<?php

namespace App\Livewire\Settings\Security;

use Livewire\Component;

class Index extends Component
{
    public $subTab = 'sessions';

    public function mount($subTab = 'sessions')
    {
        $this->subTab = $subTab;
    }

    public function setSubTab($tab)
    {
        $this->subTab = $tab;
    }

    public function render()
    {
        return view('livewire.settings.security.index');
    }
}
