<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleFlat extends Model
{
    protected $fillable = [
        'vehicle_id',
        'model',
        'year',
        'make_name',
        'type_name',
        'top_speed',
        'length',
        'width',
        'height',
        'weight',
        'engine_type',
        'engine_displacement',
        'horsepower',
        'torque',
        'transmission_type',
        'number_of_gears',
        'fuel_type',
        'fuel_capacity',
        'fuel_economy',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
