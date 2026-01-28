<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('withdrawal_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')
                ->constrained()
                ->onDelete('cascade');
            $table->uuid('transaction_id')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('method'); // WithdrawalMethod enum (TED, PIX)
            $table->string('status')->default('pending'); // TransactionStatus enum
            $table->json('bank_account'); // Dados bancários
            $table->timestamp('processed_at')->nullable();
            $table->string('failure_reason')->nullable();
            $table->timestamps();

            $table->index(['wallet_id', 'status']);
            $table->index(['wallet_id', 'created_at']);

            $table->foreign('transaction_id')
                ->references('id')
                ->on('wallet_transactions')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawal_requests');
    }
};
