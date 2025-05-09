<?php

namespace App\Contracts\Services;

use App\DTOs\VehicleParameterDTO;
use App\Models\Vehicle;

interface VehicleServiceInterface
{
    public function updateParameter(Vehicle $vehicle, VehicleParameterDTO $parameterDTO): Vehicle;
}
