@extends('layouts.app')

@section('title', 'Vehicles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-car"></i> Vehicles</h2>
    <a href="{{ route('vehicles.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Vehicle
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('vehicles.index') }}" class="row g-3">
            <div class="col-md-4">
                <input type="text" class="form-control" name="search" placeholder="Search by registration, make/model..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select class="form-select" name="status">
                    <option value="">All Status</option>
                    <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="Repair" {{ request('status') == 'Repair' ? 'selected' : '' }}>Repair</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="fuel_type">
                    <option value="">All Fuel Types</option>
                    <option value="Petrol" {{ request('fuel_type') == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                    <option value="Diesel" {{ request('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                    <option value="Hybrid" {{ request('fuel_type') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                    <option value="Electric" {{ request('fuel_type') == 'Electric' ? 'selected' : '' }}>Electric</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-primary w-100">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($vehicles->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Registration</th>
                            <th>Make/Model</th>
                            <th>Year</th>
                            <th>Fuel Type</th>
                            <th>Status</th>
                            <th>Odometer</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehicles as $vehicle)
                            <tr>
                                <td>{{ $vehicle->id }}</td>
                                <td><strong>{{ $vehicle->registration_number }}</strong></td>
                                <td>{{ $vehicle->make_model }}</td>
                                <td>{{ $vehicle->year_of_manufacture }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $vehicle->fuel_type }}</span>
                                </td>
                                <td>
                                    @if($vehicle->vehicle_status == 'Active')
                                        <span class="badge bg-success">{{ $vehicle->vehicle_status }}</span>
                                    @elseif($vehicle->vehicle_status == 'Inactive')
                                        <span class="badge bg-secondary">{{ $vehicle->vehicle_status }}</span>
                                    @else
                                        <span class="badge bg-warning">{{ $vehicle->vehicle_status }}</span>
                                    @endif
                                </td>
                                <td>{{ number_format($vehicle->odometer_reading) }} km</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('vehicles.show', $vehicle) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this vehicle?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center">
                {{ $vehicles->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-car fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No vehicles found</h4>
                <p class="text-muted">Start by adding your first vehicle to the fleet.</p>
                <a href="{{ route('vehicles.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Vehicle
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
