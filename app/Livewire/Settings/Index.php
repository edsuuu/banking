<?php

namespace App\Livewire\Settings;

use Livewire\Component;

class Index extends Component
{
    public $activeTab = 'profile';
    public $securitySubTab = 'sessions';

    public function setTab($tab, $subTab = 'sessions')
    {
        $this->activeTab = $tab;
        $this->securitySubTab = $subTab;
    }

    public function render()
    {
        return view('livewire.settings.index');
    }
}
