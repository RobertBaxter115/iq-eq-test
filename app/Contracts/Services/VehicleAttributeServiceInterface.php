<?php

namespace App\Contracts\Services;

use App\DTOs\Responses\VehicleAttributeResponseDTO;
use App\Models\VehicleAttribute;
use Illuminate\Database\Eloquent\Collection;

interface VehicleAttributeServiceInterface
{
    public function getAllAttributes(): Collection;
    public function getAttributeById(int $id): VehicleAttributeResponseDTO;
    public function createAttribute(array $data): VehicleAttributeResponseDTO;
    public function updateAttribute(VehicleAttribute $attribute, array $data): VehicleAttributeResponseDTO;
    public function deleteAttribute(VehicleAttribute $attribute): bool;
}
