<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => new VehicleTypeResource($this->type),
            'make' => new VehicleMakeResource($this->make),
            'model' => $this->model,
            'year' => $this->year,
            'attributes' => $this->attributes->map(function ($attribute) {
                return [
                    'name' => $attribute->name,
                    'value' => $attribute->pivot->value,
                    'unit' => $attribute->unit,
                ];
            }),
        ];
    }
}
