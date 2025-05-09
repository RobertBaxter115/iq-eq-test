<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class VehicleAttributeDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly string $data_type,
        public readonly ?string $unit = null
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            description: $data['description'],
            data_type: $data['data_type'],
            unit: $data['unit'] ?? null
        );
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->name,
            description: $request->description,
            data_type: $request->data_type,
            unit: $request->unit
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'data_type' => $this->data_type,
            'unit' => $this->unit
        ];
    }
}
