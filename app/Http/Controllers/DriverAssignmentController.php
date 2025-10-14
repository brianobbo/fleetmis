<?php

namespace App\Http\Controllers;

use App\Models\DriverAssignment;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DriverAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $assignments = DriverAssignment::with(['driver', 'vehicle'])->paginate(10);
        return view('driver-assignments.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $drivers = Driver::where('status', 'Active')->get();
        $vehicles = Vehicle::where('vehicle_status', 'Active')->get();
        return view('driver-assignments.create', compact('drivers', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'assignment_type' => 'required|in:Permanent,Temporary',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'nullable|date|after:start_date',
            'remarks' => 'nullable|string|max:1000'
        ]);

        // Check if driver is already assigned to another vehicle
        $existingAssignment = DriverAssignment::where('driver_id', $validated['driver_id'])
            ->where(function($query) {
                $query->where('end_date', '>', now())
                      ->orWhereNull('end_date');
            })
            ->first();

        if ($existingAssignment) {
            return back()->withErrors(['driver_id' => 'This driver is already assigned to another vehicle.']);
        }

        DriverAssignment::create($validated);

        return redirect()->route('driver-assignments.index')
            ->with('success', 'Driver assignment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DriverAssignment $driverAssignment): View
    {
        $driverAssignment->load(['driver', 'vehicle']);
        return view('driver-assignments.show', compact('driverAssignment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DriverAssignment $driverAssignment): View
    {
        $drivers = Driver::where('status', 'Active')->get();
        $vehicles = Vehicle::where('vehicle_status', 'Active')->get();
        return view('driver-assignments.edit', compact('driverAssignment', 'drivers', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DriverAssignment $driverAssignment): RedirectResponse
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'assignment_type' => 'required|in:Permanent,Temporary',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'remarks' => 'nullable|string|max:1000'
        ]);

        // Check if driver is already assigned to another vehicle (excluding current assignment)
        $existingAssignment = DriverAssignment::where('driver_id', $validated['driver_id'])
            ->where('id', '!=', $driverAssignment->id)
            ->where(function($query) {
                $query->where('end_date', '>', now())
                      ->orWhereNull('end_date');
            })
            ->first();

        if ($existingAssignment) {
            return back()->withErrors(['driver_id' => 'This driver is already assigned to another vehicle.']);
        }

        $driverAssignment->update($validated);

        return redirect()->route('driver-assignments.index')
            ->with('success', 'Driver assignment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DriverAssignment $driverAssignment): RedirectResponse
    {
        $driverAssignment->delete();

        return redirect()->route('driver-assignments.index')
            ->with('success', 'Driver assignment deleted successfully.');
    }
}
