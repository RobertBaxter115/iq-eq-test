<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_make_id')->constrained()->onDelete('cascade');
            $table->string('model');
            $table->year('year');
            $table->decimal('top_speed', 8, 2)->nullable(); // in km/h
            $table->decimal('length', 8, 2)->nullable(); // in meters
            $table->decimal('width', 8, 2)->nullable(); // in meters
            $table->decimal('height', 8, 2)->nullable(); // in meters
            $table->decimal('weight', 8, 2)->nullable(); // in kg
            $table->string('engine_type')->nullable(); // e.g., "V8", "Inline-4"
            $table->decimal('engine_displacement', 8, 2)->nullable(); // in cc
            $table->integer('horsepower')->nullable();
            $table->integer('torque')->nullable(); // in Nm
            $table->string('transmission_type')->nullable(); // e.g., "Manual", "Automatic"
            $table->integer('number_of_gears')->nullable();
            $table->string('fuel_type')->nullable(); // e.g., "Petrol", "Diesel", "Electric"
            $table->decimal('fuel_capacity', 8, 2)->nullable(); // in liters
            $table->decimal('fuel_economy', 8, 2)->nullable(); // in L/100km
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
}; 