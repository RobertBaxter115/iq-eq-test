<?php

namespace App\DTOs;

class VehicleMakeDTO
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $countryOfOrigin,
        public readonly ?int $foundedYear,
    ) {
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            countryOfOrigin: $data['country_of_origin'] ?? null,
            foundedYear: $data['founded_year'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'country_of_origin' => $this->countryOfOrigin,
            'founded_year' => $this->foundedYear,
        ];
    }
}
