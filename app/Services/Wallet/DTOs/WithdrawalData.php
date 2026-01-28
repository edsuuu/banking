<?php

namespace App\Services\Wallet\DTOs;

readonly class WithdrawalData
{
    public function __construct(
        public string $amount,
        public int $withdrawalMethodId,
        public string $bankName,
        public string $agency,
        public string $account,
        public ?string $accountDigit = null,
        public ?string $pixKey = null,
    ) {}

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            amount: $data['amount'],
            withdrawalMethodId: $data['withdrawal_method_id'],
            bankName: $data['bank_name'],
            agency: $data['agency'],
            account: $data['account'],
            accountDigit: $data['account_digit'] ?? null,
            pixKey: $data['pix_key'] ?? null,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toBankAccountArray(): array
    {
        return [
            'bank_name' => $this->bankName,
            'agency' => $this->agency,
            'account' => $this->account,
            'account_digit' => $this->accountDigit,
            'pix_key' => $this->pixKey,
        ];
    }
}
