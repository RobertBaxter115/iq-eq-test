<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_type_id',
        'vehicle_make_id',
        'model',
        'year',
    ];

    protected $casts = [
        'year' => 'integer',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }

    public function make(): BelongsTo
    {
        return $this->belongsTo(VehicleMake::class, 'vehicle_make_id');
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(VehicleAttribute::class, 'vehicle_vehicle_attribute')
            ->withPivot('value')
            ->withTimestamps();
    }

    public function flat(): HasOne
    {
        return $this->hasOne(VehicleFlat::class);
    }
}
