<?php

namespace App\Livewire\Webhooks;

use Livewire\Component;

class Delete extends Component
{
    public $webhookId;

    public function mount($id)
    {
        $this->webhookId = $id;
    }

    public function delete()
    {
        // Webhook::find($this->webhookId)->delete();
        
        $this->dispatch('closeModal');
        $this->dispatch('webhook-deleted');
    }

    public function render()
    {
        return view('livewire.webhooks.delete');
    }
}
