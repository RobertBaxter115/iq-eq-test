<?php

namespace App\Contracts\Services;

use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Collection;

interface VehicleMakeServiceInterface
{
    public function getMakesByType(VehicleType $vehicleType): Collection;
}
