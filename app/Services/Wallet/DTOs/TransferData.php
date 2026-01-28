<?php

namespace App\Services\Wallet\DTOs;

readonly class TransferData
{
    public function __construct(
        public string $amount,
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
            description: $data['description'] ?? null,
            metadata: $data['metadata'] ?? [],
        );
    }
}
