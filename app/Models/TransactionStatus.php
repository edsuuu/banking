<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransactionStatus extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'label',
        'color',
        'is_final',
        'is_active',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_final' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * @return HasMany<WithdrawalRequest>
     */
    public function withdrawalRequests(): HasMany
    {
        return $this->hasMany(WithdrawalRequest::class);
    }

    public static function findByCode(string $code): ?self
    {
        return self::query()->where('code', $code)->first();
    }

    public static function pending(): self
    {
        return self::findByCode('pending');
    }

    public static function completed(): self
    {
        return self::findByCode('completed');
    }

    public static function failed(): self
    {
        return self::findByCode('failed');
    }

    public static function cancelled(): self
    {
        return self::findByCode('cancelled');
    }
}
