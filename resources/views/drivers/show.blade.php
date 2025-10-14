@extends('layouts.app')

@section('title', 'Driver Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-user"></i> Driver Details</h2>
    <div>
        <a href="{{ route('drivers.edit', $driver) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('drivers.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Drivers
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ $driver->full_name }} ({{ $driver->driver_id }})</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Driver ID:</strong></td>
                                <td>{{ $driver->driver_id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Full Name:</strong></td>
                                <td>{{ $driver->full_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>National ID:</strong></td>
                                <td>{{ $driver->national_id_no }}</td>
                            </tr>
                            <tr>
                                <td><strong>License Number:</strong></td>
                                <td>{{ $driver->license_number }}</td>
                            </tr>
                            <tr>
                                <td><strong>License Class:</strong></td>
                                <td><span class="badge bg-info">{{ $driver->license_class }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>License Expiry:</strong></td>
                                <td>
                                    @if($driver->license_expiry < now()->addDays(30))
                                        <span class="text-danger">{{ $driver->license_expiry->format('d/m/Y') }} (Expires Soon!)</span>
                                    @else
                                        {{ $driver->license_expiry->format('d/m/Y') }}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Contact Number:</strong></td>
                                <td>{{ $driver->contact_number }}</td>
                            </tr>
                            <tr>
                                <td><strong>Assigned Vehicle:</strong></td>
                                <td>
                                    @if($driver->assignedVehicle)
                                        <a href="{{ route('vehicles.show', $driver->assignedVehicle) }}" class="text-decoration-none">
                                            <span class="badge bg-success">{{ $driver->assignedVehicle->registration_number }}</span>
                                        </a>
                                    @else
                                        <span class="text-muted">Not assigned</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    @if($driver->status == 'Active')
                                        <span class="badge bg-success">{{ $driver->status }}</span>
                                    @elseif($driver->status == 'Inactive')
                                        <span class="badge bg-secondary">{{ $driver->status }}</span>
                                    @else
                                        <span class="badge bg-warning">{{ $driver->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Created:</strong></td>
                                <td>{{ $driver->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Updated:</strong></td>
                                <td>{{ $driver->updated_at->format('d/m/Y H:i') }}</td>
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
                <h5 class="card-title mb-0">Assignment History</h5>
            </div>
            <div class="card-body">
                @if($driver->assignments->count() > 0)
                    @foreach($driver->assignments->take(5) as $assignment)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <strong>{{ $assignment->vehicle->registration_number }}</strong><br>
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
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('driver-assignments.create') }}?driver_id={{ $driver->id }}" 
                       class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> New Assignment
                    </a>
                    @if($driver->assignedVehicle)
                        <a href="{{ route('vehicles.show', $driver->assignedVehicle) }}" 
                           class="btn btn-outline-info btn-sm">
                            <i class="fas fa-car"></i> View Vehicle
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
