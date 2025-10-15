<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('trip_id')->unique();
            $table->foreignId('driver_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('vehicle_id')->nullable()->constrained()->nullOnDelete();
            $table->dateTime('time_out')->nullable();
            $table->unsignedInteger('odometer_start')->nullable();
            $table->string('destination')->nullable();
            $table->text('purpose_of_trip')->nullable();
            $table->unsignedInteger('fuel_before_trip')->nullable();
            $table->dateTime('time_in')->nullable();
            $table->unsignedInteger('odometer_end')->nullable();
            $table->unsignedInteger('fuel_after_trip')->nullable();
            $table->text('comments')->nullable();
            $table->string('approved_by')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
