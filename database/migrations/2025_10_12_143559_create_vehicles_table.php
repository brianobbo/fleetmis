<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('make_model');
            $table->year('year_of_manufacture');
            $table->enum('fuel_type', ['Petrol', 'Diesel', 'Hybrid', 'Electric']);
            $table->integer('odometer_reading')->default(0);
            $table->string('engine_number')->nullable();
            $table->string('chassis_number')->nullable();
            $table->date('insurance_expiry_date')->nullable();
            $table->string('service_interval')->nullable();
            $table->enum('vehicle_status', ['Active', 'Inactive', 'Repair'])->default('Active');
            $table->json('document_uploads')->nullable(); // Store file paths as JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
