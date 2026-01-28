<?php

namespace App\Services\Wallet\Contracts;

use App\Models\Wallet;

interface TransferServiceInterface
{
    public function transfer(
        Wallet $from,
        Wallet $to,
        string $amount,
        ?string $description = null,
        array $metadata = []
    ): void;
}
