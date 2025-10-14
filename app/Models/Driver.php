<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Driver extends Model
{
    protected $fillable = [
        'driver_id',
        'full_name',
        'national_id_no',
        'license_number',
        'license_class',
        'license_expiry',
        'contact_number',
        'assigned_vehicle_id',
        'status'
    ];

    protected $casts = [
        'license_expiry' => 'date'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($driver) {
            if (empty($driver->driver_id)) {
                $driver->driver_id = 'D' . str_pad(Driver::count() + 1, 5, '0', STR_PAD_LEFT);
            }
        });
    }

    public function assignedVehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'assigned_vehicle_id');
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(DriverAssignment::class);
    }
}
