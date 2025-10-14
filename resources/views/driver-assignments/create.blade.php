@extends('layouts.app')

@section('title', 'New Assignment')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-plus"></i> New Driver Assignment</h2>
    <a href="{{ route('driver-assignments.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Assignments
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('driver-assignments.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="driver_id" class="form-label">Driver *</label>
                    <select class="form-select @error('driver_id') is-invalid @enderror" 
                            id="driver_id" name="driver_id" required>
                        <option value="">Select Driver</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                {{ $driver->full_name }} ({{ $driver->driver_id }}) - {{ $driver->license_number }}
                            </option>
                        @endforeach
                    </select>
                    @error('driver_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="vehicle_id" class="form-label">Vehicle *</label>
                    <select class="form-select @error('vehicle_id') is-invalid @enderror" 
                            id="vehicle_id" name="vehicle_id" required>
                        <option value="">Select Vehicle</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                {{ $vehicle->registration_number }} - {{ $vehicle->make_model }}
                            </option>
                        @endforeach
                    </select>
                    @error('vehicle_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="assignment_type" class="form-label">Assignment Type *</label>
                    <select class="form-select @error('assignment_type') is-invalid @enderror" 
                            id="assignment_type" name="assignment_type" required>
                        <option value="">Select Assignment Type</option>
                        <option value="Permanent" {{ old('assignment_type') == 'Permanent' ? 'selected' : '' }}>Permanent</option>
                        <option value="Temporary" {{ old('assignment_type') == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                    </select>
                    @error('assignment_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="start_date" class="form-label">Start Date *</label>
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                           id="start_date" name="start_date" 
                           value="{{ old('start_date', date('Y-m-d')) }}" required>
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                           id="end_date" name="end_date" 
                           value="{{ old('end_date') }}">
                    <div class="form-text">Leave empty for permanent assignments</div>
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea class="form-control @error('remarks') is-invalid @enderror" 
                              id="remarks" name="remarks" rows="3" 
                              placeholder="Additional notes about this assignment">{{ old('remarks') }}</textarea>
                    @error('remarks')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('driver-assignments.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Create Assignment
                </button>
            </div>
        </form>
    </div>
</div>

@section('scripts')
    <script>
        document.getElementById('assignment_type').addEventListener('change', function() {
            const endDateField = document.getElementById('end_date');
            if (this.value === 'Permanent') {
                endDateField.value = '';
                endDateField.disabled = true;
            } else {
                endDateField.disabled = false;
            }
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            const assignmentType = document.getElementById('assignment_type');
            const endDateField = document.getElementById('end_date');
            
            if (assignmentType.value === 'Permanent') {
                endDateField.disabled = true;
            }
        });
    </script>
@endsection
@endsection
