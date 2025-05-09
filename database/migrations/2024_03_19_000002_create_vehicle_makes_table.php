<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_makes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country_of_origin')->nullable();
            $table->year('founded_year')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_makes');
    }
}; 