<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class GlobalModal extends Component
{
    public bool $isOpen = false;
    public string $component = '';
    public array $params = [];

    #[On('openModal')]
    public function openModal(string $component, array $params = [])
    {
        $this->isOpen = true;
        $this->component = $component;
        $this->params = $params;
    }

    #[On('closeModal')]
    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['component', 'params']);
    }

    public function render()
    {
        return view('livewire.global-modal');
    }
}
