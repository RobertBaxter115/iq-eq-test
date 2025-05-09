<?php

namespace App\Services;

use App\Contracts\Services\VehicleMakeServiceInterface;
use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Collection;

class VehicleMakeService implements VehicleMakeServiceInterface
{
    public function getMakesByType(VehicleType $vehicleType): \Illuminate\Database\Eloquent\Collection
    {
        return new \Illuminate\Database\Eloquent\Collection(
            $vehicleType->vehicles()
                ->with('make')
                ->get()
                ->pluck('make')
                ->unique('id')
                ->values()
                ->all()
        );
    }
}
