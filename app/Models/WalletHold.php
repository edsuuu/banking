<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WalletHold extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'wallet_id',
        'amount',
        'reason',
        'hold_status_id',
        'status', // Mantido para compatibilidade
        'expires_at',
        'released_at',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'expires_at' => 'datetime',
        'released_at' => 'datetime',
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function holdStatus(): BelongsTo
    {
        return $this->belongsTo(HoldStatus::class);
    }

    /**
     * Verifica se o hold está ativo
     */
    public function isActive(): bool
    {
        return $this->holdStatus?->code === 'active' || $this->status === 'active';
    }

    /**
     * Verifica se o hold expirou
     */
    public function isExpired(): bool
    {
        if ($this->expires_at === null) {
            return false;
        }

        return $this->expires_at->isPast();
    }
}
