<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::query()->create([
            'name' => 'Starter',
            'slug' => 'starter',
            'description' => 'Ideal para quem está começando agora.',
            'price' => 0,
            'features' => [
                'Até 50 vendas/mês',
                'Taxa de 4.99% + R$0,50',
                'Saque em 30 dias',
            ],
        ]);

        Plan::query()->create([
            'name' => 'FinPay Plus',
            'slug' => 'finpay-plus',
            'description' => 'Para negócios em plena expansão.',
            'price' => 97.00,
            'features' => [
                'Vendas Ilimitadas',
                'Taxa reduzida (1.5%)',
                'Saque em 2 dias (Pix)',
                'Checkout Customizado',
                'Suporte Prioritário',
            ],
        ]);

        Plan::query()->create([
            'name' => 'Enterprise',
            'slug' => 'enterprise',
            'description' => 'Soluções sob medida para grandes volumes.',
            'price' => 0, // Custom
            'features' => [
                'Taxas Personalizadas',
                'Gerente de Contas Dedicado',
                'API de Alta Performance',
                'SLA de 99.9%',
            ],
        ]);
    }
}
