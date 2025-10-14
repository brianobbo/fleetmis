<?php

namespace App\Http\Controllers;

use App\Models\VehicleAuthorization;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class VehicleAuthorizationController extends Controller
{
    public function index(Request $request): View
    {
        $query = VehicleAuthorization::with(['driver', 'vehicle'])->orderByDesc('id');

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('form_number', 'like', "%{$search}%")
                    ->orWhere('destination', 'like', "%{$search}%")
                    ->orWhere('purpose_of_travel', 'like', "%{$search}%");
            });
        }

        $authorizations = $query->paginate(10)->withQueryString();
        return view('vehicle-authorizations.index', compact('authorizations'));
    }

    public function create(): View
    {
        $drivers = Driver::where('status', 'Active')->get();
        $vehicles = Vehicle::where('vehicle_status', 'Active')->get();
        return view('vehicle-authorizations.create', compact('drivers', 'vehicles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateRequest($request);
        $validated['total_mileage'] = $this->computeTotalMileage($validated);
        VehicleAuthorization::create($validated);
        return redirect()->route('vehicle-authorizations.index')
            ->with('success', 'Vehicle authorization created successfully.');
    }

    public function show(VehicleAuthorization $vehicleAuthorization): View
    {
        $vehicleAuthorization->load(['driver', 'vehicle']);
        return view('vehicle-authorizations.show', compact('vehicleAuthorization'));
    }

    public function edit(VehicleAuthorization $vehicleAuthorization): View
    {
        $drivers = Driver::where('status', 'Active')->get();
        $vehicles = Vehicle::where('vehicle_status', 'Active')->get();
        return view('vehicle-authorizations.edit', compact('vehicleAuthorization', 'drivers', 'vehicles'));
    }

    public function update(Request $request, VehicleAuthorization $vehicleAuthorization): RedirectResponse
    {
        $validated = $this->validateRequest($request, $vehicleAuthorization->id);
        $validated['total_mileage'] = $this->computeTotalMileage($validated);
        $vehicleAuthorization->update($validated);
        return redirect()->route('vehicle-authorizations.index')
            ->with('success', 'Vehicle authorization updated successfully.');
    }

    public function destroy(VehicleAuthorization $vehicleAuthorization): RedirectResponse
    {
        $vehicleAuthorization->delete();
        return redirect()->route('vehicle-authorizations.index')
            ->with('success', 'Vehicle authorization deleted successfully.');
    }

    private function validateRequest(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'form_number' => 'nullable|string|max:100',
            'form_date' => 'nullable|date',
            'driver_id' => 'nullable|exists:drivers,id',
            'driver_signature' => 'nullable|string|max:255',
            'travellers_names' => 'nullable|string',
            'travellers_signature' => 'nullable|string|max:255',
            'purpose_of_travel' => 'nullable|string',
            'destination' => 'nullable|string|max:255',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'vehicle_type' => 'nullable|string|max:100',
            'estimated_kms' => 'nullable|integer|min:0',
            'estimated_fuel_litres' => 'nullable|integer|min:0',
            'date_expected_back' => 'nullable|date|after_or_equal:form_date',
            'alternative_drivers' => 'nullable|string|max:255',
            'depart_date' => 'nullable|date',
            'depart_time' => 'nullable',
            'return_date' => 'nullable|date|after_or_equal:depart_date',
            'return_time' => 'nullable',
            'permit_carry_non_staff' => 'boolean',
            'permit_personal_use' => 'boolean',
            'operations_time_from' => 'nullable',
            'operations_time_to' => 'nullable',
            'ending_mileage' => 'nullable|integer|min:0',
            'beginning_mileage' => 'nullable|integer|min:0',
            'total_mileage' => 'nullable|integer|min:0',
            'ack_name' => 'nullable|string|max:255',
            'ack_signature' => 'nullable|string|max:255',
            'ack_date' => 'nullable|date',
            'traveller_supervisor_signature' => 'nullable|string|max:255',
            'traveller_supervisor_date' => 'nullable|date',
            'fleet_supervisor_signature' => 'nullable|string|max:255',
            'fleet_supervisor_date' => 'nullable|date',
            'supply_chain_manager_signature' => 'nullable|string|max:255',
            'supply_chain_manager_date' => 'nullable|date',
            'passenger_comments' => 'nullable|string',
            'picked_at' => 'nullable|date',
            'dropped_at' => 'nullable|date|after_or_equal:picked_at',
            'drivers_conduct' => 'nullable|string',
        ]);
    }

    private function computeTotalMileage(array $data): ?int
    {
        if (!empty($data['ending_mileage']) && !empty($data['beginning_mileage'])) {
            return max(0, (int)$data['ending_mileage'] - (int)$data['beginning_mileage']);
        }
        return $data['total_mileage'] ?? null;
    }
}
