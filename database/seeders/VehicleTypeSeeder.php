<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => 'Sedan',
                'description' => 'A passenger car with a three-box configuration with separate compartments for engine, passenger, and cargo.',
            ],
            [
                'name' => 'SUV',
                'description' => 'Sport Utility Vehicle - a vehicle that combines elements of road-going passenger cars with features from off-road vehicles.',
            ],
            [
                'name' => 'Hatchback',
                'description' => 'A car body configuration with a rear door that swings upward to provide access to a cargo area.',
            ],
            [
                'name' => 'Coupe',
                'description' => 'A car with a fixed-roof body style that is shorter than a sedan or saloon of the same model.',
            ],
            [
                'name' => 'Pickup Truck',
                'description' => 'A light-duty truck with an enclosed cab and an open cargo area with low sides and tailgate.',
            ],
        ];

        foreach ($types as $type) {
            VehicleType::create($type);
        }
    }
} 