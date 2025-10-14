<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $drivers = Driver::with('assignedVehicle')->paginate(10);
        return view('drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $vehicles = Vehicle::where('vehicle_status', 'Active')->get();
        return view('drivers.create', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'national_id_no' => 'required|string|unique:drivers|max:255',
            'license_number' => 'required|string|unique:drivers|max:255',
            'license_class' => 'required|in:B,CM,DL',
            'license_expiry' => 'required|date|after:today',
            'contact_number' => 'required|string|max:20',
            'assigned_vehicle_id' => 'nullable|exists:vehicles,id',
            'status' => 'required|in:Active,Inactive,On Leave'
        ]);

        Driver::create($validated);

        return redirect()->route('drivers.index')
            ->with('success', 'Driver created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver): View
    {
        $driver->load(['assignedVehicle', 'assignments.vehicle']);
        return view('drivers.show', compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver): View
    {
        $vehicles = Vehicle::where('vehicle_status', 'Active')->get();
        return view('drivers.edit', compact('driver', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'national_id_no' => 'required|string|max:255|unique:drivers,national_id_no,' . $driver->id,
            'license_number' => 'required|string|max:255|unique:drivers,license_number,' . $driver->id,
            'license_class' => 'required|in:B,CM,DL',
            'license_expiry' => 'required|date|after:today',
            'contact_number' => 'required|string|max:20',
            'assigned_vehicle_id' => 'nullable|exists:vehicles,id',
            'status' => 'required|in:Active,Inactive,On Leave'
        ]);

        $driver->update($validated);

        return redirect()->route('drivers.index')
            ->with('success', 'Driver updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver): RedirectResponse
    {
        $driver->delete();

        return redirect()->route('drivers.index')
            ->with('success', 'Driver deleted successfully.');
    }
}
