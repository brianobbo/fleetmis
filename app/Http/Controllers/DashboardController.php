<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\DriverAssignment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(): View
    {
        $stats = [
            'total_vehicles' => Vehicle::count(),
            'total_drivers' => Driver::count(),
            'active_assignments' => DriverAssignment::where(function($query) {
                $query->where('end_date', '>', now())
                      ->orWhereNull('end_date');
            })->count(),
            'vehicles_in_repair' => Vehicle::where('vehicle_status', 'Repair')->count(),
            'active_vehicles' => Vehicle::where('vehicle_status', 'Active')->count(),
            'inactive_drivers' => Driver::where('status', 'Inactive')->count(),
            'expiring_licenses' => Driver::where('license_expiry', '<=', now()->addDays(30))->count(),
        ];

        return view('dashboard', compact('stats'));
    }
}