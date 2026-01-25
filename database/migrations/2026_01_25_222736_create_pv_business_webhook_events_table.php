<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pv_business_webhook_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_webhook_id')->constrained('business_webhooks')->cascadeOnDelete();
            $table->foreignId('webhook_event_id')->constrained('webhook_events')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pv_business_webhook_events');
    }
};
