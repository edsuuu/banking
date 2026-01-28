<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();

            // Dados bancários
            $table->string('bank_code', 10);
            $table->string('bank_name', 100);
            $table->string('agency', 10);
            $table->string('account', 20);
            $table->enum('account_type', ['corrente', 'poupanca'])->default('corrente');

            // Dados do titular
            $table->string('holder_name', 100);
            $table->string('holder_document', 20); // CPF ou CNPJ

            // Chave PIX
            $table->enum('pix_key_type', ['cpf', 'cnpj', 'email', 'phone', 'random'])->nullable();
            $table->string('pix_key', 100)->nullable();

            // Controle
            $table->boolean('is_active')->default(false);
            $table->timestamps();

            // Índices
            $table->index(['business_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
