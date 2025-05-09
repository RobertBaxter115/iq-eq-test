<?php

namespace Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('data_type'); // e.g., 'string', 'integer', 'float', 'boolean'
            $table->string('unit')->nullable(); // e.g., 'km/h', 'kg', 'L'
            $table->timestamps();
        });

        Schema::create('vehicle_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_attribute_id')->constrained()->onDelete('cascade');
            $table->text('value');
            $table->timestamps();

            $table->unique(['vehicle_id', 'vehicle_attribute_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_attribute_values');
        Schema::dropIfExists('vehicle_attributes');
    }
}; 