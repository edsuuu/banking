<?php

namespace App\Livewire\Webhooks;

use Livewire\Component;

class Create extends Component
{
    public $name;
    public $url;
    public $events = [];
    public $active = true;

    // Lista fixa de eventos possíveis (exemplo)
    public $availableEvents = [
        'charge.created' => 'Cobrança Criada',
        'charge.paid' => 'Cobrança Paga',
        'refund.success' => 'Reembolso Efetuado',
        'subscription.canceled' => 'Assinatura Cancelada',
    ];

    public function save()
    {
        $this->validate([
            'name' => 'required|min:3',
            'url' => 'required|url',
            'events' => 'required|array|min:1',
        ]);

        // Aqui entraria a lógica de salvar no banco de dados.
        // Como não tenho o model Webhook, vou apenas simular.
        
        // Simulação de sucesso
        // Webhook::create([...]);

        $this->dispatch('closeModal');
        $this->dispatch('webhook-created'); // Evento para atualizar a lista, se necessário
    }

    public function render()
    {
        return view('livewire.webhooks.create');
    }
}
