<?php

namespace App\Livewire\Webhooks;

use Livewire\Component;
use App\Models\BusinessWebhook;
use Illuminate\Support\Facades\Auth;

class Delete extends Component
{
    public $webhookId;

    public function mount($id = null)
    {
        if ($id) {
            $this->webhookId = $id;
        }
    }

    public function delete()
    {
        $webhook = BusinessWebhook::where('business_id', Auth::user()->business_id)->find($this->webhookId);

        if ($webhook) {
            $webhook->delete();
            $this->dispatch('webhook-updated'); // Refresh list
            $this->dispatch('notify', ['type' => 'success', 'message' => 'Webhook removido com sucesso.']);
        }

        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.webhooks.delete');
    }
}
