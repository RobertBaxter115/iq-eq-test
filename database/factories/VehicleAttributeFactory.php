<?php

namespace Database\Factories;

use App\Models\VehicleAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleAttributeFactory extends Factory
{
    protected $model = VehicleAttribute::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'data_type' => $this->faker->randomElement(['string', 'integer', 'float', 'boolean']),
            'unit' => $this->faker->optional()->word,
        ];
    }
} 