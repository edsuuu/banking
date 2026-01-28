<?php

namespace App\Exceptions\Wallet;

class WithdrawalException extends WalletException
{
    public static function alreadyProcessed(int $withdrawalId): self
    {
        return new self("O saque #{$withdrawalId} já foi processado");
    }

    public static function notPending(int $withdrawalId): self
    {
        return new self("O saque #{$withdrawalId} não está pendente");
    }
}
