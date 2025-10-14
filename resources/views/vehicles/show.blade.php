@extends('layouts.app')

@section('title', 'Vehicle Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-car"></i> Vehicle Details</h2>
    <div>
        <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Vehicles
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ $vehicle->registration_number }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Make/Model:</strong></td>
                                <td>{{ $vehicle->make_model }}</td>
                            </tr>
                            <tr>
                                <td><strong>Year:</strong></td>
                                <td>{{ $vehicle->year_of_manufacture }}</td>
                            </tr>
                            <tr>
                                <td><strong>Fuel Type:</strong></td>
                                <td><span class="badge bg-info">{{ $vehicle->fuel_type }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Odometer:</strong></td>
                                <td>{{ number_format($vehicle->odometer_reading) }} km</td>
                            </tr>
                            <tr>
                                <td><strong>Engine Number:</strong></td>
                                <td>{{ $vehicle->engine_number ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Chassis Number:</strong></td>
                                <td>{{ $vehicle->chassis_number ?: 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    @if($vehicle->vehicle_status == 'Active')
                                        <span class="badge bg-success">{{ $vehicle->vehicle_status }}</span>
                                    @elseif($vehicle->vehicle_status == 'Inactive')
                                        <span class="badge bg-secondary">{{ $vehicle->vehicle_status }}</span>
                                    @else
                                        <span class="badge bg-warning">{{ $vehicle->vehicle_status }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Insurance Expiry:</strong></td>
                                <td>{{ $vehicle->insurance_expiry_date ? $vehicle->insurance_expiry_date->format('d/m/Y') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Service Interval:</strong></td>
                                <td>{{ $vehicle->service_interval ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Created:</strong></td>
                                <td>{{ $vehicle->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Updated:</strong></td>
                                <td>{{ $vehicle->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Assigned Drivers</h5>
            </div>
            <div class="card-body">
                @if($vehicle->drivers->count() > 0)
                    @foreach($vehicle->drivers as $driver)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <strong>{{ $driver->full_name }}</strong><br>
                                <small class="text-muted">{{ $driver->driver_id }}</small>
                            </div>
                            <span class="badge bg-{{ $driver->status == 'Active' ? 'success' : 'secondary' }}">
                                {{ $driver->status }}
                            </span>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No drivers assigned to this vehicle.</p>
                @endif
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Assignment History</h5>
            </div>
            <div class="card-body">
                @if($vehicle->assignments->count() > 0)
                    @foreach($vehicle->assignments->take(5) as $assignment)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <strong>{{ $assignment->driver->full_name }}</strong><br>
                                <small class="text-muted">
                                    {{ $assignment->start_date->format('d/m/Y') }} - 
                                    {{ $assignment->end_date ? $assignment->end_date->format('d/m/Y') : 'Ongoing' }}
                                </small>
                            </div>
                            <span class="badge bg-{{ $assignment->assignment_type == 'Permanent' ? 'primary' : 'info' }}">
                                {{ $assignment->assignment_type }}
                            </span>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No assignment history.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
