<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Business;
use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PlanSeeder::class,
        ]);

        $starterPlan = Plan::query()->where('slug', 'starter')->first();

        $business = Business::query()->create([
            'plan_id' => $starterPlan?->id,
            'tax_id' => '12.345.678/0001-90',
            'legal_name' => 'João Silva Tecnologia LTDA',
            'trading_name' => 'FinPay Tech',
        ]);

        User::factory()->create([
            'business_id' => $business->id,
            'name' => 'João Silva',
            'email' => 'joao@finpay.com.br',
            'password' => Hash::make('password'),
            'document' => '12.345.678/0001-90',
            'phone' => '(11) 99999-9999',
        ]);
    }
}
