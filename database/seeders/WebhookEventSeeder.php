<?php

namespace Database\Seeders;

use App\Models\WebhookEvent;
use Illuminate\Database\Seeder;

class WebhookEventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            // Old events
            [
                'name' => 'sale.created',
                'description' => 'Disparado quando uma nova venda é criada.',
            ],
            [
                'name' => 'sale.paid',
                'description' => 'Disparado quando o pagamento de uma venda é confirmado.',
            ],
            [
                'name' => 'sale.canceled',
                'description' => 'Disparado quando uma venda é cancelada.',
            ],
            [
                'name' => 'customer.created',
                'description' => 'Disparado quando um novo cliente é cadastrado.',
            ],
            [
                'name' => 'subscription.renewed',
                'description' => 'Disparado quando uma assinatura é renovada.',
            ],
             [
                'name' => 'subscription.canceled',
                'description' => 'Disparado quando uma assinatura é cancelada.',
            ],
            // New events required by the view design
            [
                'name' => 'charge.created',
                'description' => 'Cobrança Criada',
            ],
            [
                'name' => 'charge.paid',
                'description' => 'Pagamento Confirmado',
            ],
            [
                'name' => 'refund.success',
                'description' => 'Reembolso Concluído',
            ],
            [
                'name' => 'subscription.updated',
                'description' => 'Assinatura Atualizada',
            ],
            [
                'name' => 'charge.failed',
                'description' => 'Falha no Pagamento',
            ],
            [
                'name' => 'refund.created',
                'description' => 'Reembolso Solicitado',
            ],
        ];

        foreach ($events as $event) {
            WebhookEvent::query()->firstOrCreate(
                ['name' => $event['name']],
                ['description' => $event['description']]
            );
        }
    }
}
