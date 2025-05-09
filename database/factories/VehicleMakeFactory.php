<?php

namespace Database\Factories;

use App\Models\VehicleMake;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleMakeFactory extends Factory
{
    protected $model = VehicleMake::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'country_of_origin' => $this->faker->country,
            'founded_year' => $this->faker->year,
        ];
    }
} 