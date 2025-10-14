<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_authorizations', function (Blueprint $table) {
            $table->id();
            $table->string('form_number')->nullable();
            $table->date('form_date')->nullable();

            $table->foreignId('driver_id')->nullable()->constrained('drivers')->nullOnDelete();
            $table->string('driver_signature')->nullable();

            $table->text('travellers_names')->nullable();
            $table->string('travellers_signature')->nullable();

            $table->text('purpose_of_travel')->nullable();
            $table->string('destination')->nullable();

            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->nullOnDelete();
            $table->string('vehicle_type')->nullable();
            $table->integer('estimated_kms')->nullable();
            $table->integer('estimated_fuel_litres')->nullable();

            // Destination details
            $table->date('date_expected_back')->nullable();
            $table->string('alternative_drivers')->nullable();

            // Trip dates
            $table->date('depart_date')->nullable();
            $table->time('depart_time')->nullable();
            $table->date('return_date')->nullable();
            $table->time('return_time')->nullable();

            // Permissions
            $table->boolean('permit_carry_non_staff')->default(false);
            $table->boolean('permit_personal_use')->default(false);

            // Time of operations
            $table->time('operations_time_from')->nullable();
            $table->time('operations_time_to')->nullable();

            // Mileage
            $table->integer('ending_mileage')->nullable();
            $table->integer('beginning_mileage')->nullable();
            $table->integer('total_mileage')->nullable();

            // Acknowledgements & signatures
            $table->string('ack_name')->nullable();
            $table->string('ack_signature')->nullable();
            $table->date('ack_date')->nullable();

            $table->string('traveller_supervisor_signature')->nullable();
            $table->date('traveller_supervisor_date')->nullable();

            $table->string('fleet_supervisor_signature')->nullable();
            $table->date('fleet_supervisor_date')->nullable();

            $table->string('supply_chain_manager_signature')->nullable();
            $table->date('supply_chain_manager_date')->nullable();

            // Comments & times
            $table->text('passenger_comments')->nullable();
            $table->timestamp('picked_at')->nullable();
            $table->timestamp('dropped_at')->nullable();
            $table->text('drivers_conduct')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_authorizations');
    }
};
