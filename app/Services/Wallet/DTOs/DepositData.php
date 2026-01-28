<?php

namespace App\Services\Wallet\DTOs;

readonly class DepositData
{
    public function __construct(
        public string $amount,
        public ?string $referenceType = null,
        public ?int $referenceId = null,
        public ?string $description = null,
        public array $metadata = [],
    ) {}

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            amount: $data['amount'],
            referenceType: $data['reference_type'] ?? null,
            referenceId: $data['reference_id'] ?? null,
            description: $data['description'] ?? null,
            metadata: $data['metadata'] ?? [],
        );
    }
}
