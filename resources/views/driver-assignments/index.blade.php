@extends('layouts.app')

@section('title', 'Driver Assignments')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-clipboard-list"></i> Driver Assignments</h2>
    <a href="{{ route('driver-assignments.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> New Assignment
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($assignments->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Assignment ID</th>
                            <th>Driver</th>
                            <th>Vehicle</th>
                            <th>Assignment Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignments as $assignment)
                            <tr>
                                <td><strong>#{{ $assignment->id }}</strong></td>
                                <td>
                                    <div>
                                        <strong>{{ $assignment->driver->full_name }}</strong><br>
                                        <small class="text-muted">{{ $assignment->driver->driver_id }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $assignment->vehicle->registration_number }}</strong><br>
                                        <small class="text-muted">{{ $assignment->vehicle->make_model }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $assignment->assignment_type == 'Permanent' ? 'primary' : 'info' }}">
                                        {{ $assignment->assignment_type }}
                                    </span>
                                </td>
                                <td>{{ $assignment->start_date->format('d/m/Y') }}</td>
                                <td>
                                    @if($assignment->end_date)
                                        {{ $assignment->end_date->format('d/m/Y') }}
                                    @else
                                        <span class="text-muted">Ongoing</span>
                                    @endif
                                </td>
                                <td>
                                    @if($assignment->end_date && $assignment->end_date < now())
                                        <span class="badge bg-secondary">Expired</span>
                                    @elseif($assignment->start_date > now())
                                        <span class="badge bg-warning">Upcoming</span>
                                    @else
                                        <span class="badge bg-success">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('driver-assignments.show', $assignment) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('driver-assignments.edit', $assignment) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('driver-assignments.destroy', $assignment) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this assignment?')">
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
                {{ $assignments->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No assignments found</h4>
                <p class="text-muted">Start by creating your first driver assignment.</p>
                <a href="{{ route('driver-assignments.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> New Assignment
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
