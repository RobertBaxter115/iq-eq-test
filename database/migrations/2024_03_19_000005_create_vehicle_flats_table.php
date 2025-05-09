<?php

namespace Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_flats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->string('model');
            $table->year('year');
            $table->string('make_name');
            $table->string('type_name');
            $table->decimal('top_speed', 8, 2)->nullable();
            $table->decimal('length', 8, 2)->nullable();
            $table->decimal('width', 8, 2)->nullable();
            $table->decimal('height', 8, 2)->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('engine_type')->nullable();
            $table->decimal('engine_displacement', 8, 2)->nullable();
            $table->integer('horsepower')->nullable();
            $table->integer('torque')->nullable();
            $table->string('transmission_type')->nullable();
            $table->integer('number_of_gears')->nullable();
            $table->string('fuel_type')->nullable();
            $table->decimal('fuel_capacity', 8, 2)->nullable();
            $table->decimal('fuel_economy', 8, 2)->nullable();
            $table->timestamps();

            $table->unique('vehicle_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_flats');
    }
}; 