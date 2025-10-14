@extends('layouts.app')

@section('title', 'Vehicle Authorization Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-eye"></i> Vehicle Authorization #{{ $vehicleAuthorization->id }}</h2>
    <div>
        <a href="{{ route('vehicle-authorizations.edit', $vehicleAuthorization) }}" class="btn btn-primary me-2"><i class="fas fa-edit"></i> Edit</a>
        <a href="{{ route('vehicle-authorizations.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header fw-bold">General</div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Form No.</dt>
                    <dd class="col-sm-8">{{ $vehicleAuthorization->form_number }}</dd>

                    <dt class="col-sm-4">Date</dt>
                    <dd class="col-sm-8">{{ optional($vehicleAuthorization->form_date)->format('Y-m-d') }}</dd>

                    <dt class="col-sm-4">Driver</dt>
                    <dd class="col-sm-8">{{ optional($vehicleAuthorization->driver)->full_name }}</dd>

                    <dt class="col-sm-4">Travellers</dt>
                    <dd class="col-sm-8">{{ $vehicleAuthorization->travellers_names }}</dd>

                    <dt class="col-sm-4">Purpose</dt>
                    <dd class="col-sm-8">{{ $vehicleAuthorization->purpose_of_travel }}</dd>

                    <dt class="col-sm-4">Destination</dt>
                    <dd class="col-sm-8">{{ $vehicleAuthorization->destination }}</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header fw-bold">Vehicle & Trip</div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Vehicle</dt>
                    <dd class="col-sm-8">{{ optional($vehicleAuthorization->vehicle)->registration_number }}</dd>

                    <dt class="col-sm-4">Type</dt>
                    <dd class="col-sm-8">{{ $vehicleAuthorization->vehicle_type }}</dd>

                    <dt class="col-sm-4">Est. Kms</dt>
                    <dd class="col-sm-8">{{ $vehicleAuthorization->estimated_kms }}</dd>

                    <dt class="col-sm-4">Est. Fuel (L)</dt>
                    <dd class="col-sm-8">{{ $vehicleAuthorization->estimated_fuel_litres }}</dd>

                    <dt class="col-sm-4">Expected Back</dt>
                    <dd class="col-sm-8">{{ optional($vehicleAuthorization->date_expected_back)->format('Y-m-d') }}</dd>

                    <dt class="col-sm-4">Alternative drivers</dt>
                    <dd class="col-sm-8">{{ $vehicleAuthorization->alternative_drivers }}</dd>

                    <dt class="col-sm-4">Depart</dt>
                    <dd class="col-sm-8">{{ optional($vehicleAuthorization->depart_date)->format('Y-m-d') }} {{ $vehicleAuthorization->depart_time }}</dd>

                    <dt class="col-sm-4">Return</dt>
                    <dd class="col-sm-8">{{ optional($vehicleAuthorization->return_date)->format('Y-m-d') }} {{ $vehicleAuthorization->return_time }}</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header fw-bold">Permissions & Operations</div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-6">Carry non staff</dt>
                    <dd class="col-sm-6">{{ $vehicleAuthorization->permit_carry_non_staff ? 'Yes' : 'No' }}</dd>

                    <dt class="col-sm-6">Personal use</dt>
                    <dd class="col-sm-6">{{ $vehicleAuthorization->permit_personal_use ? 'Yes' : 'No' }}</dd>

                    <dt class="col-sm-6">Operations Time</dt>
                    <dd class="col-sm-6">{{ $vehicleAuthorization->operations_time_from }} - {{ $vehicleAuthorization->operations_time_to }}</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header fw-bold">Mileage</div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-6">Ending (A)</dt>
                    <dd class="col-sm-6">{{ $vehicleAuthorization->ending_mileage }}</dd>
                    <dt class="col-sm-6">Beginning (B)</dt>
                    <dd class="col-sm-6">{{ $vehicleAuthorization->beginning_mileage }}</dd>
                    <dt class="col-sm-6">Total (A - B)</dt>
                    <dd class="col-sm-6">{{ $vehicleAuthorization->total_mileage }}</dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card h-100">
            <div class="card-header fw-bold">Approvals & Comments</div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-3">Acknowledged By</dt>
                    <dd class="col-sm-9">{{ $vehicleAuthorization->ack_name }} ({{ $vehicleAuthorization->ack_signature }}) on {{ optional($vehicleAuthorization->ack_date)->format('Y-m-d') }}</dd>

                    <dt class="col-sm-3">Traveller's Supervisor</dt>
                    <dd class="col-sm-9">{{ $vehicleAuthorization->traveller_supervisor_signature }} on {{ optional($vehicleAuthorization->traveller_supervisor_date)->format('Y-m-d') }}</dd>

                    <dt class="col-sm-3">Fleet Supervisor</dt>
                    <dd class="col-sm-9">{{ $vehicleAuthorization->fleet_supervisor_signature }} on {{ optional($vehicleAuthorization->fleet_supervisor_date)->format('Y-m-d') }}</dd>

                    <dt class="col-sm-3">Supply Chain Manager / ED</dt>
                    <dd class="col-sm-9">{{ $vehicleAuthorization->supply_chain_manager_signature }} on {{ optional($vehicleAuthorization->supply_chain_manager_date)->format('Y-m-d') }}</dd>

                    <dt class="col-sm-3">Passenger Comments</dt>
                    <dd class="col-sm-9">{{ $vehicleAuthorization->passenger_comments }}</dd>

                    <dt class="col-sm-3">Picked / Dropped</dt>
                    <dd class="col-sm-9">{{ $vehicleAuthorization->picked_at }} — {{ $vehicleAuthorization->dropped_at }}</dd>

                    <dt class="col-sm-3">Driver's Conduct</dt>
                    <dd class="col-sm-9">{{ $vehicleAuthorization->drivers_conduct }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
