<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HoldStatus extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'label',
        'is_active',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * @return HasMany<WalletHold>
     */
    public function holds(): HasMany
    {
        return $this->hasMany(WalletHold::class);
    }

    public static function findByCode(string $code): ?self
    {
        return self::query()->where('code', $code)->first();
    }

    public static function active(): self
    {
        return self::findByCode('active');
    }

    public static function released(): self
    {
        return self::findByCode('released');
    }

    public static function expired(): self
    {
        return self::findByCode('expired');
    }
}
