<?php

namespace App\Jobs;

use App\Models\Vehicle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateVehicleFlat implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        private readonly Vehicle $vehicle
    ) {
    }

    public function handle(): void
    {
        $attributes = $this->vehicle->attributes()
            ->pluck('value', 'name')
            ->toArray();

        $this->vehicle->flat()->updateOrCreate(
            ['vehicle_id' => $this->vehicle->id],
            [
                'model' => $this->vehicle->model,
                'year' => $this->vehicle->year,
                'make_name' => $this->vehicle->make->name,
                'type_name' => $this->vehicle->type->name,
                'top_speed' => $attributes['top_speed'] ?? null,
                'length' => $attributes['length'] ?? null,
                'width' => $attributes['width'] ?? null,
                'height' => $attributes['height'] ?? null,
                'weight' => $attributes['weight'] ?? null,
                'engine_type' => $attributes['engine_type'] ?? null,
                'engine_displacement' => $attributes['engine_displacement'] ?? null,
                'horsepower' => $attributes['horsepower'] ?? null,
                'torque' => $attributes['torque'] ?? null,
                'transmission_type' => $attributes['transmission_type'] ?? null,
                'number_of_gears' => $attributes['number_of_gears'] ?? null,
                'fuel_type' => $attributes['fuel_type'] ?? null,
                'fuel_capacity' => $attributes['fuel_capacity'] ?? null,
                'fuel_economy' => $attributes['fuel_economy'] ?? null,
            ]
        );
    }
}
