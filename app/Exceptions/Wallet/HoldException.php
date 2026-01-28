<?php

namespace App\Exceptions\Wallet;

class HoldException extends WalletException
{
    public static function notActive(int $holdId): self
    {
        return new self("O hold #{$holdId} não está ativo");
    }

    public static function alreadyReleased(int $holdId): self
    {
        return new self("O hold #{$holdId} já foi liberado");
    }
}
