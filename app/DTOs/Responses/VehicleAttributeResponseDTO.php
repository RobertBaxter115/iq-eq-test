<?php

namespace App\DTOs\Responses;

use App\Models\VehicleAttribute;

class VehicleAttributeResponseDTO
{
    public function __construct(
        public readonly VehicleAttribute $attribute,
    ) {
    }

    public function toArray(): array
    {
        return [
            'attribute' => $this->attribute,
        ];
    }
}
