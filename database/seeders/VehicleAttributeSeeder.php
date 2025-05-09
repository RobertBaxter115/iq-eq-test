<?php

namespace Database\Seeders;

use App\Models\VehicleAttribute;
use Illuminate\Database\Seeder;

class VehicleAttributeSeeder extends Seeder
{
    public function run(): void
    {
        $attributes = [
            [
                'name' => 'top_speed',
                'description' => 'Maximum speed the vehicle can achieve',
                'data_type' => 'float',
                'unit' => 'km/h',
            ],
            [
                'name' => 'length',
                'description' => 'Vehicle length',
                'data_type' => 'float',
                'unit' => 'm',
            ],
            [
                'name' => 'width',
                'description' => 'Vehicle width',
                'data_type' => 'float',
                'unit' => 'm',
            ],
            [
                'name' => 'height',
                'description' => 'Vehicle height',
                'data_type' => 'float',
                'unit' => 'm',
            ],
            [
                'name' => 'weight',
                'description' => 'Vehicle weight',
                'data_type' => 'float',
                'unit' => 'kg',
            ],
            [
                'name' => 'engine_type',
                'description' => 'Type of engine',
                'data_type' => 'string',
                'unit' => null,
            ],
            [
                'name' => 'engine_displacement',
                'description' => 'Engine displacement volume',
                'data_type' => 'float',
                'unit' => 'cc',
            ],
            [
                'name' => 'horsepower',
                'description' => 'Engine power output',
                'data_type' => 'integer',
                'unit' => 'hp',
            ],
            [
                'name' => 'torque',
                'description' => 'Engine torque output',
                'data_type' => 'integer',
                'unit' => 'Nm',
            ],
            [
                'name' => 'transmission_type',
                'description' => 'Type of transmission',
                'data_type' => 'string',
                'unit' => null,
            ],
            [
                'name' => 'number_of_gears',
                'description' => 'Number of transmission gears',
                'data_type' => 'integer',
                'unit' => null,
            ],
            [
                'name' => 'fuel_type',
                'description' => 'Type of fuel used',
                'data_type' => 'string',
                'unit' => null,
            ],
            [
                'name' => 'fuel_capacity',
                'description' => 'Fuel tank capacity',
                'data_type' => 'float',
                'unit' => 'L',
            ],
            [
                'name' => 'fuel_economy',
                'description' => 'Fuel consumption rate',
                'data_type' => 'float',
                'unit' => 'L/100km',
            ],
        ];

        foreach ($attributes as $attribute) {
            VehicleAttribute::create($attribute);
        }
    }
} 