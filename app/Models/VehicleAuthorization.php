<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleAuthorization extends Model
{
    protected $fillable = [
        'form_number',
        'form_date',
        'driver_id',
        'driver_signature',
        'travellers_names',
        'travellers_signature',
        'purpose_of_travel',
        'destination',
        'vehicle_id',
        'vehicle_type',
        'estimated_kms',
        'estimated_fuel_litres',
        'date_expected_back',
        'alternative_drivers',
        'depart_date',
        'depart_time',
        'return_date',
        'return_time',
        'permit_carry_non_staff',
        'permit_personal_use',
        'operations_time_from',
        'operations_time_to',
        'ending_mileage',
        'beginning_mileage',
        'total_mileage',
        'ack_name',
        'ack_signature',
        'ack_date',
        'traveller_supervisor_signature',
        'traveller_supervisor_date',
        'fleet_supervisor_signature',
        'fleet_supervisor_date',
        'supply_chain_manager_signature',
        'supply_chain_manager_date',
        'passenger_comments',
        'picked_at',
        'dropped_at',
        'drivers_conduct',
    ];

    protected $casts = [
        'form_date' => 'date',
        'date_expected_back' => 'date',
        'depart_date' => 'date',
        'return_date' => 'date',
        'operations_time_from' => 'datetime:H:i',
        'operations_time_to' => 'datetime:H:i',
        'depart_time' => 'datetime:H:i',
        'return_time' => 'datetime:H:i',
        'ack_date' => 'date',
        'traveller_supervisor_date' => 'date',
        'fleet_supervisor_date' => 'date',
        'supply_chain_manager_date' => 'date',
        'picked_at' => 'datetime',
        'dropped_at' => 'datetime',
        'permit_carry_non_staff' => 'boolean',
        'permit_personal_use' => 'boolean',
        'estimated_kms' => 'integer',
        'estimated_fuel_litres' => 'integer',
        'ending_mileage' => 'integer',
        'beginning_mileage' => 'integer',
        'total_mileage' => 'integer',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
