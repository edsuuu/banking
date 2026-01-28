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
        // Alterar wallet_transactions para usar FK
        Schema::table('wallet_transactions', function (Blueprint $table) {
            $table->foreignId('transaction_type_id')->nullable()->after('wallet_id');
        });

        // Alterar wallet_holds para usar FK
        Schema::table('wallet_holds', function (Blueprint $table) {
            $table->foreignId('hold_status_id')->nullable()->after('reason');
        });

        // Alterar withdrawal_requests para usar FKs
        Schema::table('withdrawal_requests', function (Blueprint $table) {
            $table->foreignId('withdrawal_method_id')->nullable()->after('amount');
            $table->foreignId('transaction_status_id')->nullable()->after('withdrawal_method_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wallet_transactions', function (Blueprint $table) {
            $table->dropColumn('transaction_type_id');
        });

        Schema::table('wallet_holds', function (Blueprint $table) {
            $table->dropColumn('hold_status_id');
        });

        Schema::table('withdrawal_requests', function (Blueprint $table) {
            $table->dropColumn(['withdrawal_method_id', 'transaction_status_id']);
        });
    }
};
