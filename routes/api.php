<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Driver;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API route to get driver details for assignment forms
Route::get('/drivers/{driver}/details', function (Driver $driver) {
    return response()->json([
        'id' => $driver->id,
        'driver_id' => $driver->driver_id,
        'full_name' => $driver->full_name,
        'license_number' => $driver->license_number,
        'license_class' => $driver->license_class,
        'license_expiry' => $driver->license_expiry->format('Y-m-d'),
        'contact_number' => $driver->contact_number,
        'status' => $driver->status
    ]);
});
