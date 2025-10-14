@extends('layouts.app')

@section('title', 'Add Vehicle')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-plus"></i> Add Vehicle</h2>
    <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Vehicles
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('vehicles.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="registration_number" class="form-label">Registration Number *</label>
                    <input type="text" class="form-control @error('registration_number') is-invalid @enderror" 
                           id="registration_number" name="registration_number" 
                           value="{{ old('registration_number') }}" required>
                    @error('registration_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="make_model" class="form-label">Make/Model *</label>
                    <input type="text" class="form-control @error('make_model') is-invalid @enderror" 
                           id="make_model" name="make_model" 
                           value="{{ old('make_model') }}" required>
                    @error('make_model')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="year_of_manufacture" class="form-label">Year of Manufacture *</label>
                    <input type="number" class="form-control @error('year_of_manufacture') is-invalid @enderror" 
                           id="year_of_manufacture" name="year_of_manufacture" 
                           value="{{ old('year_of_manufacture') }}" min="1900" max="{{ date('Y') }}" required>
                    @error('year_of_manufacture')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="fuel_type" class="form-label">Fuel Type *</label>
                    <select class="form-select @error('fuel_type') is-invalid @enderror" 
                            id="fuel_type" name="fuel_type" required>
                        <option value="">Select Fuel Type</option>
                        <option value="Petrol" {{ old('fuel_type') == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                        <option value="Diesel" {{ old('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="Hybrid" {{ old('fuel_type') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                        <option value="Electric" {{ old('fuel_type') == 'Electric' ? 'selected' : '' }}>Electric</option>
                    </select>
                    @error('fuel_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="odometer_reading" class="form-label">Odometer Reading (km) *</label>
                    <input type="number" class="form-control @error('odometer_reading') is-invalid @enderror" 
                           id="odometer_reading" name="odometer_reading" 
                           value="{{ old('odometer_reading', 0) }}" min="0" required>
                    @error('odometer_reading')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="engine_number" class="form-label">Engine Number</label>
                    <input type="text" class="form-control @error('engine_number') is-invalid @enderror" 
                           id="engine_number" name="engine_number" 
                           value="{{ old('engine_number') }}">
                    @error('engine_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="chassis_number" class="form-label">Chassis Number</label>
                    <input type="text" class="form-control @error('chassis_number') is-invalid @enderror" 
                           id="chassis_number" name="chassis_number" 
                           value="{{ old('chassis_number') }}">
                    @error('chassis_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="insurance_expiry_date" class="form-label">Insurance Expiry Date</label>
                    <input type="date" class="form-control @error('insurance_expiry_date') is-invalid @enderror" 
                           id="insurance_expiry_date" name="insurance_expiry_date" 
                           value="{{ old('insurance_expiry_date') }}">
                    @error('insurance_expiry_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="service_interval" class="form-label">Service Interval</label>
                    <input type="text" class="form-control @error('service_interval') is-invalid @enderror" 
                           id="service_interval" name="service_interval" 
                           value="{{ old('service_interval') }}" 
                           placeholder="e.g., 5,000 km or 3 months">
                    @error('service_interval')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="vehicle_status" class="form-label">Vehicle Status *</label>
                    <select class="form-select @error('vehicle_status') is-invalid @enderror" 
                            id="vehicle_status" name="vehicle_status" required>
                        <option value="">Select Status</option>
                        <option value="Active" {{ old('vehicle_status') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ old('vehicle_status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="Repair" {{ old('vehicle_status') == 'Repair' ? 'selected' : '' }}>Repair</option>
                    </select>
                    @error('vehicle_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('vehicles.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Vehicle
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
