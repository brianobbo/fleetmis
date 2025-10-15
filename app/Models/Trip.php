<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trip extends Model
{
    protected $fillable = [
        'trip_id',
        'driver_id',
        'vehicle_id',
        'time_out',
        'odometer_start',
        'destination',
        'purpose_of_trip',
        'fuel_before_trip',
        'time_in',
        'odometer_end',
        'fuel_after_trip',
        'comments',
        'approved_by',
    ];

    protected $casts = [
        'time_out' => 'datetime',
        'time_in' => 'datetime',
        'odometer_start' => 'integer',
        'odometer_end' => 'integer',
        'fuel_before_trip' => 'integer',
        'fuel_after_trip' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Trip $trip) {
            if (empty($trip->trip_id)) {
                $trip->trip_id = self::generateTripId();
            }
        });
    }

    private static function generateTripId(): string
    {
        $year = now()->year;
        $latestForYear = self::whereYear('created_at', $year)
            ->orderByDesc('id')
            ->value('trip_id');

        $sequence = 1;
        if ($latestForYear && preg_match('/TRP-' . $year . '-(\d{3,})/', $latestForYear, $matches)) {
            $sequence = (int) $matches[1] + 1;
        }

        return sprintf('TRP-%d-%03d', $year, $sequence);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
