<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankAccount extends Model
{
    protected $fillable = [
        'business_id',
        'bank_code',
        'bank_name',
        'agency',
        'account',
        'account_type',
        'holder_name',
        'holder_document',
        'pix_key_type',
        'pix_key',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    /**
     * Scope para buscar contas ativas
     */
    public function scopeActive(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Formata exibição da conta
     */
    public function getFormattedAccountAttribute(): string
    {
        return "Ag: {$this->agency} • C/{$this->getAccountTypeLabel()}: {$this->account}";
    }

    /**
     * Label do tipo de conta
     */
    public function getAccountTypeLabel(): string
    {
        return match ($this->account_type) {
            'corrente' => 'C',
            'poupanca' => 'P',
            default => 'C',
        };
    }

    /**
     * Formata a chave PIX para exibição
     */
    public function getFormattedPixKeyAttribute(): ?string
    {
        if (! $this->pix_key) {
            return null;
        }

        return match ($this->pix_key_type) {
            'cpf' => 'CPF: ' . $this->maskDocument($this->pix_key),
            'cnpj' => 'CNPJ: ' . $this->maskDocument($this->pix_key),
            'email' => $this->pix_key,
            'phone' => $this->maskPhone($this->pix_key),
            'random' => substr($this->pix_key, 0, 8) . '...',
            default => $this->pix_key,
        };
    }

    /**
     * Mascara documento
     */
    protected function maskDocument(string $doc): string
    {
        $clean = preg_replace('/\D/', '', $doc);

        if (strlen($clean) === 11) {
            return '***.' . substr($clean, 3, 3) . '.' . substr($clean, 6, 3) . '-**';
        }

        return '**.' . substr($clean, 2, 3) . '.' . substr($clean, 5, 3) . '/****-**';
    }

    /**
     * Mascara telefone
     */
    protected function maskPhone(string $phone): string
    {
        $clean = preg_replace('/\D/', '', $phone);

        return '(**) *****-' . substr($clean, -4);
    }

    /**
     * Tipos de chave PIX disponíveis
     */
    public static function pixKeyTypes(): array
    {
        return [
            'cpf' => 'CPF',
            'cnpj' => 'CNPJ',
            'email' => 'E-mail',
            'phone' => 'Telefone',
            'random' => 'Chave Aleatória',
        ];
    }

    /**
     * Lista de bancos
     */
    public static function banks(): array
    {
        return [
            '001' => 'Banco do Brasil',
            '033' => 'Santander',
            '104' => 'Caixa Econômica',
            '237' => 'Bradesco',
            '341' => 'Itaú Unibanco',
            '260' => 'Nubank',
            '077' => 'Banco Inter',
            '212' => 'Banco Original',
            '336' => 'C6 Bank',
            '380' => 'PicPay',
            '290' => 'PagBank',
            '756' => 'Sicoob',
            '748' => 'Sicredi',
        ];
    }
}
