<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class VehicleAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'data_type',
        'unit',
    ];

    public function vehicles(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class, 'vehicle_vehicle_attribute')
            ->withPivot('value')
            ->withTimestamps();
    }
}
