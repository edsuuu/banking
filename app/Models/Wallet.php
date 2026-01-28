<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'business_id',
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * @return HasMany<WalletTransaction>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(WalletTransaction::class)->orderByDesc('created_at');
    }

    /**
     * @return HasMany<WalletHold>
     */
    public function holds(): HasMany
    {
        return $this->hasMany(WalletHold::class);
    }

    /**
     * @return HasMany<WalletHold>
     */
    public function activeHolds(): HasMany
    {
        return $this->holds()->where('status', 'active');
    }

    /**
     * @return HasMany<WithdrawalRequest>
     */
    public function withdrawalRequests(): HasMany
    {
        return $this->hasMany(WithdrawalRequest::class)->orderByDesc('created_at');
    }

    /**
     * Calcula o saldo disponível a partir das transações (append-only)
     */
    public function calculateAvailableBalance(): string
    {
        $credits = $this->transactions()
            ->whereHas('transactionType', fn ($q) => $q->where('direction', 'credit'))
            ->sum('amount');

        $debits = $this->transactions()
            ->whereHas('transactionType', fn ($q) => $q->where('direction', 'debit'))
            ->sum('amount');

        return bcsub((string) $credits, (string) $debits, 2);
    }

    /**
     * Calcula o saldo pendente (transações marcadas como pending)
     */
    public function calculatePendingBalance(): string
    {
        return (string) $this->transactions()
            ->whereJsonContains('metadata->pending', true)
            ->sum('amount');
    }

    /**
     * Calcula o total bloqueado em holds ativos
     */
    public function calculateHoldsTotal(): string
    {
        return (string) $this->activeHolds()->sum('amount');
    }

    /**
     * Calcula o saldo efetivo (disponível - holds ativos)
     */
    public function calculateEffectiveBalance(): string
    {
        $available = $this->calculateAvailableBalance();
        $holds = $this->calculateHoldsTotal();

        return bcsub($available, $holds, 2);
    }

    /**
     * Retorna o saldo atual após a última transação
     */
    public function getLastBalanceAttribute(): string
    {
        $lastTransaction = $this->transactions()->latest()->first();

        return $lastTransaction?->balance_after ?? '0.00';
    }
}
