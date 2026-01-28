<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class WalletTransaction extends Model
{
    use HasUuids;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'wallet_id',
        'transaction_type_id',
        'type', // Mantido para compatibilidade, será removido futuramente
        'amount',
        'balance_after',
        'reference_type',
        'reference_id',
        'description',
        'metadata',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'balance_after' => 'decimal:2',
        'metadata' => 'array',
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function transactionType(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class);
    }

    /**
     * Referência polimórfica para a entidade relacionada (produto, pedido, etc)
     */
    public function reference(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Verifica se é uma transação de crédito
     */
    public function isCredit(): bool
    {
        return $this->transactionType?->isCredit() ?? false;
    }

    /**
     * Verifica se é uma transação de débito
     */
    public function isDebit(): bool
    {
        return $this->transactionType?->isDebit() ?? false;
    }

    /**
     * Retorna o valor formatado com sinal
     */
    public function getFormattedAmountAttribute(): string
    {
        $prefix = $this->isCredit() ? '+' : '-';

        return $prefix . ' R$ ' . number_format((float) $this->amount, 2, ',', '.');
    }
}
