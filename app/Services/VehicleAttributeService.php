<?php

namespace App\Services;

use App\Contracts\Services\VehicleAttributeServiceInterface;
use App\DTOs\Responses\VehicleAttributeResponseDTO;
use App\DTOs\VehicleAttributeDTO;
use App\Models\VehicleAttribute;
use Illuminate\Database\Eloquent\Collection;

class VehicleAttributeService implements VehicleAttributeServiceInterface
{
    public function getAllAttributes(): Collection
    {
        return VehicleAttribute::all();
    }

    public function getAttributeById(int $id): VehicleAttributeResponseDTO
    {
        $attribute = VehicleAttribute::findOrFail($id);
        return new VehicleAttributeResponseDTO($attribute);
    }

    public function createAttribute(array $data): VehicleAttributeResponseDTO
    {
        $dto = VehicleAttributeDTO::fromArray($data);
        $attribute = VehicleAttribute::create($dto->toArray());
        return new VehicleAttributeResponseDTO($attribute);
    }

    public function updateAttribute(VehicleAttribute $attribute, array $data): VehicleAttributeResponseDTO
    {
        $dto = VehicleAttributeDTO::fromArray($data);
        $attribute->update($dto->toArray());
        return new VehicleAttributeResponseDTO($attribute->fresh());
    }

    public function deleteAttribute(VehicleAttribute $attribute): bool
    {
        return $attribute->delete();
    }
}
