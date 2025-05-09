<?php

namespace App\DTOs;

class VehicleDTO
{
    public function __construct(
        public readonly int $vehicleTypeId,
        public readonly int $vehicleMakeId,
        public readonly string $model,
        public readonly int $year,
    ) {
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            vehicleTypeId: $data['vehicle_type_id'],
            vehicleMakeId: $data['vehicle_make_id'],
            model: $data['model'],
            year: $data['year'],
        );
    }

    public function toArray(): array
    {
        return [
            'vehicle_type_id' => $this->vehicleTypeId,
            'vehicle_make_id' => $this->vehicleMakeId,
            'model' => $this->model,
            'year' => $this->year,
        ];
    }
}
