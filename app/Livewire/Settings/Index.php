<?php

namespace App\Livewire\Settings;

use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component
{
    #[Url]
    public $activeTab = 'profile';

    #[Url]
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
