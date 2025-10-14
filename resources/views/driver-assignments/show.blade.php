@extends('layouts.app')

@section('title', 'Assignment Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-clipboard-list"></i> Assignment Details</h2>
    <div>
        <a href="{{ route('driver-assignments.edit', $driverAssignment) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('driver-assignments.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Assignments
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Assignment #{{ $driverAssignment->id }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Assignment ID:</strong></td>
                                <td>#{{ $driverAssignment->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Driver:</strong></td>
                                <td>
                                    <a href="{{ route('drivers.show', $driverAssignment->driver) }}" class="text-decoration-none">
                                        {{ $driverAssignment->driver->full_name }} ({{ $driverAssignment->driver->driver_id }})
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Vehicle:</strong></td>
                                <td>
                                    <a href="{{ route('vehicles.show', $driverAssignment->vehicle) }}" class="text-decoration-none">
                                        {{ $driverAssignment->vehicle->registration_number }} - {{ $driverAssignment->vehicle->make_model }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Assignment Type:</strong></td>
                                <td>
                                    <span class="badge bg-{{ $driverAssignment->assignment_type == 'Permanent' ? 'primary' : 'info' }}">
                                        {{ $driverAssignment->assignment_type }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Start Date:</strong></td>
                                <td>{{ $driverAssignment->start_date->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>End Date:</strong></td>
                                <td>
                                    @if($driverAssignment->end_date)
                                        {{ $driverAssignment->end_date->format('d/m/Y') }}
                                    @else
                                        <span class="text-muted">Ongoing</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    @if($driverAssignment->end_date && $driverAssignment->end_date < now())
                                        <span class="badge bg-secondary">Expired</span>
                                    @elseif($driverAssignment->start_date > now())
                                        <span class="badge bg-warning">Upcoming</span>
                                    @else
                                        <span class="badge bg-success">Active</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Created:</strong></td>
                                <td>{{ $driverAssignment->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                @if($driverAssignment->remarks)
                    <div class="mt-3">
                        <h6><strong>Remarks:</strong></h6>
                        <p class="text-muted">{{ $driverAssignment->remarks }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Driver Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td>{{ $driverAssignment->driver->full_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Driver ID:</strong></td>
                        <td>{{ $driverAssignment->driver->driver_id }}</td>
                    </tr>
                    <tr>
                        <td><strong>License:</strong></td>
                        <td>{{ $driverAssignment->driver->license_number }}</td>
                    </tr>
                    <tr>
                        <td><strong>License Class:</strong></td>
                        <td><span class="badge bg-info">{{ $driverAssignment->driver->license_class }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>License Expiry:</strong></td>
                        <td>
                            @if($driverAssignment->driver->license_expiry < now()->addDays(30))
                                <span class="text-danger">{{ $driverAssignment->driver->license_expiry->format('d/m/Y') }}</span>
                            @else
                                {{ $driverAssignment->driver->license_expiry->format('d/m/Y') }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Contact:</strong></td>
                        <td>{{ $driverAssignment->driver->contact_number }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            @if($driverAssignment->driver->status == 'Active')
                                <span class="badge bg-success">{{ $driverAssignment->driver->status }}</span>
                            @elseif($driverAssignment->driver->status == 'Inactive')
                                <span class="badge bg-secondary">{{ $driverAssignment->driver->status }}</span>
                            @else
                                <span class="badge bg-warning">{{ $driverAssignment->driver->status }}</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Vehicle Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td><strong>Registration:</strong></td>
                        <td>{{ $driverAssignment->vehicle->registration_number }}</td>
                    </tr>
                    <tr>
                        <td><strong>Make/Model:</strong></td>
                        <td>{{ $driverAssignment->vehicle->make_model }}</td>
                    </tr>
                    <tr>
                        <td><strong>Year:</strong></td>
                        <td>{{ $driverAssignment->vehicle->year_of_manufacture }}</td>
                    </tr>
                    <tr>
                        <td><strong>Fuel Type:</strong></td>
                        <td><span class="badge bg-info">{{ $driverAssignment->vehicle->fuel_type }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Odometer:</strong></td>
                        <td>{{ number_format($driverAssignment->vehicle->odometer_reading) }} km</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            @if($driverAssignment->vehicle->vehicle_status == 'Active')
                                <span class="badge bg-success">{{ $driverAssignment->vehicle->vehicle_status }}</span>
                            @elseif($driverAssignment->vehicle->vehicle_status == 'Inactive')
                                <span class="badge bg-secondary">{{ $driverAssignment->vehicle->vehicle_status }}</span>
                            @else
                                <span class="badge bg-warning">{{ $driverAssignment->vehicle->vehicle_status }}</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
