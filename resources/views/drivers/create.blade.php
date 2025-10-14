@extends('layouts.app')

@section('title', 'Add Driver')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-plus"></i> Add Driver</h2>
    <a href="{{ route('drivers.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Drivers
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('drivers.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="full_name" class="form-label">Full Name *</label>
                    <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                           id="full_name" name="full_name" 
                           value="{{ old('full_name') }}" required>
                    @error('full_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="national_id_no" class="form-label">National ID Number *</label>
                    <input type="text" class="form-control @error('national_id_no') is-invalid @enderror" 
                           id="national_id_no" name="national_id_no" 
                           value="{{ old('national_id_no') }}" required>
                    @error('national_id_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="license_number" class="form-label">License Number *</label>
                    <input type="text" class="form-control @error('license_number') is-invalid @enderror" 
                           id="license_number" name="license_number" 
                           value="{{ old('license_number') }}" required>
                    @error('license_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="license_class" class="form-label">License Class *</label>
                    <select class="form-select @error('license_class') is-invalid @enderror" 
                            id="license_class" name="license_class" required>
                        <option value="">Select License Class</option>
                        <option value="B" {{ old('license_class') == 'B' ? 'selected' : '' }}>B</option>
                        <option value="CM" {{ old('license_class') == 'CM' ? 'selected' : '' }}>CM</option>
                        <option value="DL" {{ old('license_class') == 'DL' ? 'selected' : '' }}>DL</option>
                    </select>
                    @error('license_class')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="license_expiry" class="form-label">License Expiry Date *</label>
                    <input type="date" class="form-control @error('license_expiry') is-invalid @enderror" 
                           id="license_expiry" name="license_expiry" 
                           value="{{ old('license_expiry') }}" required>
                    @error('license_expiry')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="contact_number" class="form-label">Contact Number *</label>
                    <input type="text" class="form-control @error('contact_number') is-invalid @enderror" 
                           id="contact_number" name="contact_number" 
                           value="{{ old('contact_number') }}" required>
                    @error('contact_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="assigned_vehicle_id" class="form-label">Assigned Vehicle</label>
                    <select class="form-select @error('assigned_vehicle_id') is-invalid @enderror" 
                            id="assigned_vehicle_id" name="assigned_vehicle_id">
                        <option value="">Select Vehicle (Optional)</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" {{ old('assigned_vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                {{ $vehicle->registration_number }} - {{ $vehicle->make_model }}
                            </option>
                        @endforeach
                    </select>
                    @error('assigned_vehicle_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status *</label>
                    <select class="form-select @error('status') is-invalid @enderror" 
                            id="status" name="status" required>
                        <option value="">Select Status</option>
                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="On Leave" {{ old('status') == 'On Leave' ? 'selected' : '' }}>On Leave</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('drivers.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Driver
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
