<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WithdrawalRequest extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'wallet_id',
        'transaction_id',
        'amount',
        'withdrawal_method_id',
        'transaction_status_id',
        'method', // Mantido para compatibilidade
        'status', // Mantido para compatibilidade
        'bank_account',
        'processed_at',
        'failure_reason',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'bank_account' => 'array',
        'processed_at' => 'datetime',
    ];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(WalletTransaction::class, 'transaction_id');
    }

    public function withdrawalMethod(): BelongsTo
    {
        return $this->belongsTo(WithdrawalMethod::class);
    }

    public function transactionStatus(): BelongsTo
    {
        return $this->belongsTo(TransactionStatus::class);
    }

    /**
     * Verifica se está pendente
     */
    public function isPending(): bool
    {
        return $this->transactionStatus?->code === 'pending' || $this->status === 'pending';
    }

    /**
     * Verifica se foi processado com sucesso
     */
    public function isCompleted(): bool
    {
        return $this->transactionStatus?->code === 'completed' || $this->status === 'completed';
    }

    /**
     * Verifica se falhou
     */
    public function isFailed(): bool
    {
        return $this->transactionStatus?->code === 'failed' || $this->status === 'failed';
    }

    /**
     * Retorna os dados bancários formatados
     */
    public function getFormattedBankAccountAttribute(): string
    {
        $account = $this->bank_account;

        return sprintf(
            '%s - Ag: %s | CC: %s',
            $account['bank_name'] ?? 'N/A',
            $account['agency'] ?? 'N/A',
            $account['account'] ?? 'N/A'
        );
    }
}
