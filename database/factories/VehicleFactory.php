<?php

namespace Database\Factories;

use App\Models\Vehicle;
use App\Models\VehicleMake;
use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        return [
            'vehicle_type_id' => VehicleType::factory(),
            'vehicle_make_id' => VehicleMake::factory(),
            'model' => $this->faker->word,
            'year' => $this->faker->year,
        ];
    }
} 