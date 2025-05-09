<?php

namespace App\DTOs;

class VehicleParameterDTO
{
    public function __construct(
        public readonly string $parameter,
        public readonly mixed $value,
    ) {
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            parameter: $data['parameter'],
            value: $data['value'],
        );
    }

    public function toArray(): array
    {
        return [
            'parameter' => $this->parameter,
            'value' => $this->value,
        ];
    }
}
