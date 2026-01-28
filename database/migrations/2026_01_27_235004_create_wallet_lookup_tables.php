<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabela de tipos de transação
        Schema::create('transaction_types', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // deposit, withdrawal, transfer_in, etc
            $table->string('label'); // Depósito, Saque, etc
            $table->enum('direction', ['credit', 'debit', 'neutral'])->default('neutral');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabela de status de transação
        Schema::create('transaction_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // pending, completed, failed, cancelled
            $table->string('label'); // Pendente, Concluído, etc
            $table->string('color')->default('gray');
            $table->boolean('is_final')->default(false); // Se é um status final
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabela de status de holds
        Schema::create('hold_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // active, released, expired
            $table->string('label');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabela de métodos de saque
        Schema::create('withdrawal_methods', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // ted, pix
            $table->string('label'); // TED, PIX
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed dos dados iniciais
        DB::table('transaction_types')->insert([
            ['code' => 'deposit', 'label' => 'Depósito', 'direction' => 'credit', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'withdrawal', 'label' => 'Saque', 'direction' => 'debit', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'transfer_in', 'label' => 'Transferência Recebida', 'direction' => 'credit', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'transfer_out', 'label' => 'Transferência Enviada', 'direction' => 'debit', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'refund', 'label' => 'Estorno', 'direction' => 'credit', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'fee', 'label' => 'Taxa', 'direction' => 'debit', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'adjustment', 'label' => 'Ajuste', 'direction' => 'neutral', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('transaction_statuses')->insert([
            ['code' => 'pending', 'label' => 'Pendente', 'color' => 'blue', 'is_final' => false, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'completed', 'label' => 'Concluído', 'color' => 'green', 'is_final' => true, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'failed', 'label' => 'Falhou', 'color' => 'red', 'is_final' => true, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'cancelled', 'label' => 'Cancelado', 'color' => 'gray', 'is_final' => true, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('hold_statuses')->insert([
            ['code' => 'active', 'label' => 'Ativo', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'released', 'label' => 'Liberado', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'expired', 'label' => 'Expirado', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('withdrawal_methods')->insert([
            ['code' => 'ted', 'label' => 'TED', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'pix', 'label' => 'PIX', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawal_methods');
        Schema::dropIfExists('hold_statuses');
        Schema::dropIfExists('transaction_statuses');
        Schema::dropIfExists('transaction_types');
    }
};
