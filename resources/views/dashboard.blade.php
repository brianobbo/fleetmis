@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@php
    use App\Models\DriverAssignment;
    $recent_activity = DriverAssignment::latest()->take(5)->get();

    
@endphp
    
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-tachometer-alt"></i> Fleet Management Dashboard</h2>
    <div class="text-muted">
        <i class="fas fa-calendar"></i> {{ now()->format('l, F j, Y') }}
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">{{ $stats['total_vehicles'] ?? 0 }}</h4>
                        <p class="card-text">Total Vehicles</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-car fa-2x"></i>
                    </div>
                </div>
                <a href="{{ route('vehicles.index') }}" class="text-white text-decoration-none">
                    <small>View all vehicles <i class="fas fa-arrow-right"></i></small>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">{{ $stats['total_drivers'] ?? 0 }}</h4>
                        <p class="card-text">Total Drivers</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-user fa-2x"></i>
                    </div>
                </div>
                <a href="{{ route('drivers.index') }}" class="text-white text-decoration-none">
                    <small>View all drivers <i class="fas fa-arrow-right"></i></small>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">{{ $stats['active_assignments'] ?? 0 }}</h4>
                        <p class="card-text">Active Assignments</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-clipboard-list fa-2x"></i>
                    </div>
                </div>
                <a href="{{ route('driver-assignments.index') }}" class="text-white text-decoration-none">
                    <small>View all assignments <i class="fas fa-arrow-right"></i></small>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">{{ $stats['vehicles_in_repair'] ?? 0 }}</h4>
                        <p class="card-text">Vehicles in Repair</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-wrench fa-2x"></i>
                    </div>
                </div>
                <a href="{{ route('vehicles.index') }}?status=Repair" class="text-white text-decoration-none">
                    <small>View repair vehicles <i class="fas fa-arrow-right"></i></small>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <!-- <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Recent Activity</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">New Vehicle Added</h6>
                            <p class="mb-1 text-muted">Toyota Hilux - UBA 345T</p>
                            <small class="text-muted">2 hours ago</small>
                        </div>
                        <span class="badge bg-primary rounded-pill">Vehicle</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Driver Assignment Created</h6>
                            <p class="mb-1 text-muted">John Okello assigned to UBA 345T</p>
                            <small class="text-muted">4 hours ago</small>
                        </div>
                        <span class="badge bg-info rounded-pill">Assignment</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Driver Profile Updated</h6>
                            <p class="mb-1 text-muted">Peter Lolem - License renewed</p>
                            <small class="text-muted">1 day ago</small>
                        </div>
                        <span class="badge bg-success rounded-pill">Driver</span>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- make above code dynamic, the above commented code is static -->
        
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('vehicles.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Vehicle
                    </a>
                    <a href="{{ route('drivers.create') }}" class="btn btn-success">
                        <i class="fas fa-user-plus"></i> Add Driver
                    </a>
                    <a href="{{ route('driver-assignments.create') }}" class="btn btn-info">
                        <i class="fas fa-clipboard-list"></i> New Assignment
                    </a>
                </div>
            </div>
        </div>
        
        <!-- <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">System Status</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Database</span>
                    <span class="badge bg-success">Connected</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Application</span>
                    <span class="badge bg-success">Running</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span>Last Backup</span>
                    <small class="text-muted">Today</small>
                </div>
            </div>
        </div> -->
    </div>
</div>
@endsection
