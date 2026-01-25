<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebhookLog extends Model
{
    protected $fillable = [
        'business_webhook_id',
        'event_name',
        'payload',
        'headers',
        'status_code',
        'response_body',
        'duration_ms',
    ];

    protected $casts = [
        'payload' => 'array',
        'headers' => 'array',
    ];

    public function webhook(): BelongsTo
    {
        return $this->belongsTo(BusinessWebhook::class, 'business_webhook_id');
    }
}
