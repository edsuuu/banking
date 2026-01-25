<?php

namespace App\Livewire\Webhooks;

use Livewire\Component;

class Edit extends Component
{
    public $webhookId;
    public $name;
    public $url;
    public $events = [];
    public $active;

    public $availableEvents = [
        'charge.created' => 'Cobrança Criada',
        'charge.paid' => 'Cobrança Paga',
        'refund.success' => 'Reembolso Efetuado',
        'subscription.canceled' => 'Assinatura Cancelada',
    ];

    public function mount($id = null)
    {
        // Aqui buscaríamos o webhook no banco pelo ID
        // $webhook = Webhook::find($id);

        // Dados mockados para simulação
        $this->webhookId = $id;
        $this->name = 'Produção - API Principal';
        $this->url = 'https://api.meusistema.com.br/webhooks/finpay';
        $this->events = ['charge.created', 'charge.paid'];
        $this->active = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:3',
            'url' => 'required|url',
            'events' => 'required|array|min:1',
        ]);

        // Webhook::find($this->webhookId)->update([...]);

        $this->dispatch('closeModal');
        $this->dispatch('webhook-updated');
    }

    public function delete()
    {
        // Webhook::find($this->webhookId)->delete();
        $this->dispatch('closeModal');
        $this->dispatch('webhook-deleted');
    }

    public function render()
    {
        return view('livewire.webhooks.edit');
    }
}
