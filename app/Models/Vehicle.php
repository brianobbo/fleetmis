<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = [
        'registration_number',
        'make_model',
        'year_of_manufacture',
        'fuel_type',
        'odometer_reading',
        'engine_number',
        'chassis_number',
        'insurance_expiry_date',
        'service_interval',
        'vehicle_status',
        'document_uploads'
    ];

    protected $casts = [
        'year_of_manufacture' => 'integer',
        'odometer_reading' => 'integer',
        'insurance_expiry_date' => 'date',
        'document_uploads' => 'array'
    ];

    public function drivers(): HasMany
    {
        return $this->hasMany(Driver::class, 'assigned_vehicle_id');
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(DriverAssignment::class);
    }
}
