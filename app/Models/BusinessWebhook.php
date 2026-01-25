<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusinessWebhook extends Model
{
    protected $fillable = [
        'business_id',
        'url',
        'header_name',
        'header_value',
        'is_active',
        'public_key',
        'secret_key',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(WebhookEvent::class, 'pv_business_webhook_events');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(WebhookLog::class);
    }
}
