<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WebhookEvent extends Model
{
    protected $fillable = ['name', 'description'];

    public function webhooks(): BelongsToMany
    {
        return $this->belongsToMany(BusinessWebhook::class, 'pv_business_webhook_events');
    }
}
