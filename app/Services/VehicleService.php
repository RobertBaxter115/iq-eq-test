<?php

namespace App\Services;

use App\Contracts\Services\VehicleServiceInterface;
use App\DTOs\VehicleParameterDTO;
use App\Jobs\UpdateVehicleFlat;
use App\Models\Vehicle;
use App\Models\VehicleAttribute;

class VehicleService implements VehicleServiceInterface
{
    public function updateParameter(Vehicle $vehicle, VehicleParameterDTO $parameterDTO): Vehicle
    {
        // Find or create the attribute
        $attribute = VehicleAttribute::firstOrCreate(
            ['name' => $parameterDTO->parameter],
            [
                'data_type' => $this->determineDataType($parameterDTO->value),
                'unit' => $this->determineUnit($parameterDTO->parameter),
            ]
        );

        // Update the attribute value
        $vehicle->attributes()->syncWithoutDetaching([
            $attribute->id => ['value' => $parameterDTO->value]
        ]);

        // Dispatch job to update flat table
        UpdateVehicleFlat::dispatch($vehicle);

        return $vehicle->fresh();
    }

    public function determineDataType($value): string
    {
        if (is_bool($value)) {
            return 'boolean';
        }
        if (is_int($value)) {
            return 'integer';
        }
        if (is_float($value)) {
            return 'float';
        }
        return 'string';
    }

    public function determineUnit($parameter): ?string
    {
        $units = [
            'top_speed' => 'km/h',
            'length' => 'm',
            'weight' => 'kg',
            'engine_displacement' => 'cc',
            'torque' => 'Nm',
            'fuel_capacity' => 'L',
            'fuel_economy' => 'L/100km',
        ];
        return $units[$parameter] ?? null;
    }
}
