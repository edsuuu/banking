<?php

namespace App\Exceptions\Wallet;

class TransactionTypeNotFoundException extends WalletException
{
    public function __construct(string $code)
    {
        parent::__construct("Tipo de transação não encontrado: {$code}");
    }
}
