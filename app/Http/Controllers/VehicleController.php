<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Vehicle::with('drivers');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('registration_number', 'like', "%{$search}%")
                  ->orWhere('make_model', 'like', "%{$search}%")
                  ->orWhere('engine_number', 'like', "%{$search}%")
                  ->orWhere('chassis_number', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('vehicle_status', $request->get('status'));
        }

        // Filter by fuel type
        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->get('fuel_type'));
        }

        $vehicles = $query->paginate(10)->withQueryString();
        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'registration_number' => 'required|string|unique:vehicles|max:255',
            'make_model' => 'required|string|max:255',
            'year_of_manufacture' => 'required|integer|min:1900|max:' . date('Y'),
            'fuel_type' => 'required|in:Petrol,Diesel,Hybrid,Electric',
            'odometer_reading' => 'required|integer|min:0',
            'engine_number' => 'nullable|string|max:255',
            'chassis_number' => 'nullable|string|max:255',
            'insurance_expiry_date' => 'nullable|date|after:today',
            'service_interval' => 'nullable|string|max:255',
            'vehicle_status' => 'required|in:Active,Inactive,Repair',
            'document_uploads' => 'nullable|array'
        ]);

        Vehicle::create($validated);

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle): View
    {
        $vehicle->load(['drivers', 'assignments.driver']);
        return view('vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle): View
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle): RedirectResponse
    {
        $validated = $request->validate([
            'registration_number' => 'required|string|max:255|unique:vehicles,registration_number,' . $vehicle->id,
            'make_model' => 'required|string|max:255',
            'year_of_manufacture' => 'required|integer|min:1900|max:' . date('Y'),
            'fuel_type' => 'required|in:Petrol,Diesel,Hybrid,Electric',
            'odometer_reading' => 'required|integer|min:0',
            'engine_number' => 'nullable|string|max:255',
            'chassis_number' => 'nullable|string|max:255',
            'insurance_expiry_date' => 'nullable|date|after:today',
            'service_interval' => 'nullable|string|max:255',
            'vehicle_status' => 'required|in:Active,Inactive,Repair',
            'document_uploads' => 'nullable|array'
        ]);

        $vehicle->update($validated);

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle deleted successfully.');
    }
}
