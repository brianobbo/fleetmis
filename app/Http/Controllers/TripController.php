<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TripController extends Controller
{
    public function index(Request $request): View
    {
        $query = Trip::with(['driver', 'vehicle'])->orderByDesc('id');

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('trip_id', 'like', "%{$search}%")
                  ->orWhere('destination', 'like', "%{$search}%")
                  ->orWhere('purpose_of_trip', 'like', "%{$search}%");
            });
        }

        $trips = $query->paginate(10)->withQueryString();
        return view('trips.index', compact('trips'));
    }

    public function create(): View
    {
        $drivers = Driver::where('status', 'Active')->get();
        $vehicles = Vehicle::where('vehicle_status', 'Active')->get();
        return view('trips.create', compact('drivers', 'vehicles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);
        Trip::create($validated);
        return redirect()->route('trips.index')->with('success', 'Trip created successfully.');
    }

    public function show(Trip $trip): View
    {
        $trip->load(['driver', 'vehicle']);
        return view('trips.show', compact('trip'));
    }

    public function edit(Trip $trip): View
    {
        $drivers = Driver::where('status', 'Active')->get();
        $vehicles = Vehicle::where('vehicle_status', 'Active')->get();
        return view('trips.edit', compact('trip', 'drivers', 'vehicles'));
    }

    public function update(Request $request, Trip $trip): RedirectResponse
    {
        $validated = $this->validateRequest($request, $trip->id);
        $trip->update($validated);
        return redirect()->route('trips.index')->with('success', 'Trip updated successfully.');
    }

    public function destroy(Trip $trip): RedirectResponse
    {
        $trip->delete();
        return redirect()->route('trips.index')->with('success', 'Trip deleted successfully.');
    }

    private function validateRequest(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'driver_id' => 'nullable|exists:drivers,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            // Accept HTML datetime-local format
            'time_out' => 'nullable|date_format:Y-m-d\\TH:i',
            'odometer_start' => 'nullable|integer|min:0',
            'destination' => 'nullable|string|max:255',
            'purpose_of_trip' => 'nullable|string',
            'fuel_before_trip' => 'nullable|integer|min:0',
            'time_in' => 'nullable|date_format:Y-m-d\\TH:i|after_or_equal:time_out',
            'odometer_end' => 'nullable|integer|min:0',
            'fuel_after_trip' => 'nullable|integer|min:0',
            'comments' => 'nullable|string',
            'approved_by' => 'nullable|string|max:255',
        ]);
    }
}
