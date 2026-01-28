<?php

namespace App\Exceptions\Wallet;

class InsufficientBalanceException extends WalletException
{
    public function __construct(
        public readonly string $requested,
        public readonly string $available,
        string $message = 'Saldo insuficiente'
    ) {
        parent::__construct($message);
    }

    public static function forWithdrawal(string $requested, string $available): self
    {
        return new self(
            $requested,
            $available,
            "Saldo insuficiente para saque. Solicitado: R$ {$requested}, Disponível: R$ {$available}"
        );
    }

    public static function forTransfer(string $requested, string $available): self
    {
        return new self(
            $requested,
            $available,
            "Saldo insuficiente para transferência. Solicitado: R$ {$requested}, Disponível: R$ {$available}"
        );
    }

    public static function forHold(string $requested, string $available): self
    {
        return new self(
            $requested,
            $available,
            "Saldo insuficiente para bloqueio. Solicitado: R$ {$requested}, Disponível: R$ {$available}"
        );
    }

    public static function forRefund(string $requested, string $available): self
    {
        return new self(
            $requested,
            $available,
            "Saldo insuficiente para estorno. Solicitado: R$ {$requested}, Disponível: R$ {$available}"
        );
    }
}
