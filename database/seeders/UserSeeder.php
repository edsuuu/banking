<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::where('email', 'admin@finpay.com')->doesntExist()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@finpay.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'document' => '000.000.000-00',
                'terms' => true,
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
