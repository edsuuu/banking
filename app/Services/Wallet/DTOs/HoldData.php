<?php

namespace App\Services\Wallet\DTOs;

readonly class HoldData
{
    public function __construct(
        public string $amount,
        public string $reason,
        public ?\DateTimeInterface $expiresAt = null,
    ) {}

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            amount: $data['amount'],
            reason: $data['reason'],
            expiresAt: isset($data['expires_at']) ? new \DateTimeImmutable($data['expires_at']) : null,
        );
    }
}
