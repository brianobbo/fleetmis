@extends('layouts.app')

@section('title', 'Drivers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-user"></i> Drivers</h2>
    <a href="{{ route('drivers.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Driver
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($drivers->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Driver ID</th>
                            <th>Name</th>
                            <th>License Number</th>
                            <th>License Class</th>
                            <th>License Expiry</th>
                            <th>Contact</th>
                            <th>Assigned Vehicle</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($drivers as $driver)
                            <tr>
                                <td><strong>{{ $driver->driver_id }}</strong></td>
                                <td>{{ $driver->full_name }}</td>
                                <td>{{ $driver->license_number }}</td>
                                <td><span class="badge bg-info">{{ $driver->license_class }}</span></td>
                                <td>
                                    @if($driver->license_expiry < now()->addDays(30))
                                        <span class="text-danger">{{ $driver->license_expiry->format('d/m/Y') }}</span>
                                    @else
                                        {{ $driver->license_expiry->format('d/m/Y') }}
                                    @endif
                                </td>
                                <td>{{ $driver->contact_number }}</td>
                                <td>
                                    @if($driver->assignedVehicle)
                                        <span class="badge bg-success">{{ $driver->assignedVehicle->registration_number }}</span>
                                    @else
                                        <span class="text-muted">Not assigned</span>
                                    @endif
                                </td>
                                <td>
                                    @if($driver->status == 'Active')
                                        <span class="badge bg-success">{{ $driver->status }}</span>
                                    @elseif($driver->status == 'Inactive')
                                        <span class="badge bg-secondary">{{ $driver->status }}</span>
                                    @else
                                        <span class="badge bg-warning">{{ $driver->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('drivers.show', $driver) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('drivers.edit', $driver) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('drivers.destroy', $driver) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this driver?')">
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
                {{ $drivers->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-user fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No drivers found</h4>
                <p class="text-muted">Start by adding your first driver to the system.</p>
                <a href="{{ route('drivers.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Driver
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
