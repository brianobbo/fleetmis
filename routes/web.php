<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DriverAssignmentController;
use App\Http\Controllers\VehicleAuthorizationController;
use App\Http\Controllers\TripController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Vehicle routes
Route::resource('vehicles', VehicleController::class);

// Driver routes
Route::resource('drivers', DriverController::class);

// Driver Assignment routes
Route::resource('driver-assignments', DriverAssignmentController::class);

// Vehicle Authorization routes
Route::resource('vehicle-authorizations', VehicleAuthorizationController::class);

// Trip routes
Route::resource('trips', TripController::class);
