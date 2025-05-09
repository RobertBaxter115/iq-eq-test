<?php

namespace Database\Seeders;

use App\Models\VehicleMake;
use Illuminate\Database\Seeder;

class VehicleMakeSeeder extends Seeder
{
    public function run(): void
    {
        $makes = [
            [
                'name' => 'Toyota',
                'country_of_origin' => 'Japan',
                'founded_year' => 1937,
            ],
            [
                'name' => 'BMW',
                'country_of_origin' => 'Germany',
                'founded_year' => 1916,
            ],
            [
                'name' => 'Ford',
                'country_of_origin' => 'United States',
                'founded_year' => 1903,
            ],
            [
                'name' => 'Mercedes-Benz',
                'country_of_origin' => 'Germany',
                'founded_year' => 1926,
            ],
            [
                'name' => 'Honda',
                'country_of_origin' => 'Japan',
                'founded_year' => 1948,
            ],
        ];

        foreach ($makes as $make) {
            VehicleMake::create($make);
        }
    }
} 