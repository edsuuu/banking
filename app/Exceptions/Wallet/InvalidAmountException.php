<?php

namespace App\Exceptions\Wallet;

class InvalidAmountException extends WalletException
{
    public function __construct(
        public readonly string $amount,
        string $message = 'Valor inválido'
    ) {
        parent::__construct($message);
    }

    public static function mustBePositive(string $amount): self
    {
        return new self($amount, "O valor deve ser maior que zero. Recebido: R$ {$amount}");
    }

    public static function mustBeNumeric(string $amount): self
    {
        return new self($amount, "O valor deve ser numérico. Recebido: {$amount}");
    }
}
