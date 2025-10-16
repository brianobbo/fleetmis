@php($vehicleVar = isset($vehicle) ? $vehicle : null)
<div class="row">
    <div class="col-md-6">
        <fieldset class="fieldset-card">
            <legend>Identity</legend>
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="registration_number" class="form-label required">Registration Number</label>
                    <input type="text" class="form-control @error('registration_number') is-invalid @enderror"
                           id="registration_number" name="registration_number"
                           value="{{ old('registration_number', optional($vehicleVar)->registration_number) }}" required>
                    @error('registration_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label for="make_model" class="form-label required">Make/Model</label>
                    <input type="text" class="form-control @error('make_model') is-invalid @enderror"
                           id="make_model" name="make_model"
                           value="{{ old('make_model', optional($vehicleVar)->make_model) }}" required>
                    @error('make_model')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </fieldset>
    </div>

    <div class="col-md-6">
        <fieldset class="fieldset-card">
            <legend>Specs</legend>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="year_of_manufacture" class="form-label required">Year of Manufacture</label>
                    <input type="number" class="form-control @error('year_of_manufacture') is-invalid @enderror"
                           id="year_of_manufacture" name="year_of_manufacture"
                           value="{{ old('year_of_manufacture', optional($vehicleVar)->year_of_manufacture) }}"
                           min="1900" max="{{ date('Y') }}" required>
                    @error('year_of_manufacture')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fuel_type" class="form-label required">Fuel Type</label>
                    <select class="form-select @error('fuel_type') is-invalid @enderror"
                            id="fuel_type" name="fuel_type" required>
                        <option value="">Select Fuel Type</option>
                        @php($fuel = old('fuel_type', optional($vehicleVar)->fuel_type))
                        <option value="Petrol" @selected($fuel === 'Petrol')>Petrol</option>
                        <option value="Diesel" @selected($fuel === 'Diesel')>Diesel</option>
                        <option value="Hybrid" @selected($fuel === 'Hybrid')>Hybrid</option>
                        <option value="Electric" @selected($fuel === 'Electric')>Electric</option>
                    </select>
                    @error('fuel_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="odometer_reading" class="form-label required">Odometer Reading (km)</label>
                    <input type="number" class="form-control @error('odometer_reading') is-invalid @enderror"
                           id="odometer_reading" name="odometer_reading"
                           value="{{ old('odometer_reading', optional($vehicleVar)->odometer_reading ?? 0) }}" min="0" required>
                    @error('odometer_reading')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </fieldset>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <fieldset class="fieldset-card">
            <legend>Identification Numbers</legend>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="engine_number" class="form-label">Engine Number</label>
                    <input type="text" class="form-control @error('engine_number') is-invalid @enderror"
                           id="engine_number" name="engine_number"
                           value="{{ old('engine_number', optional($vehicleVar)->engine_number) }}">
                    @error('engine_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="chassis_number" class="form-label">Chassis Number</label>
                    <input type="text" class="form-control @error('chassis_number') is-invalid @enderror"
                           id="chassis_number" name="chassis_number"
                           value="{{ old('chassis_number', optional($vehicleVar)->chassis_number) }}">
                    @error('chassis_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </fieldset>
    </div>

    <div class="col-md-6">
        <fieldset class="fieldset-card">
            <legend>Maintenance</legend>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="insurance_expiry_date" class="form-label">Insurance Expiry Date</label>
                    <input type="date" class="form-control @error('insurance_expiry_date') is-invalid @enderror"
                           id="insurance_expiry_date" name="insurance_expiry_date"
                           value="{{ old('insurance_expiry_date', optional(optional($vehicleVar)->insurance_expiry_date)->format('Y-m-d')) }}">
                    @error('insurance_expiry_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="service_interval" class="form-label">Service Interval</label>
                    <input type="text" class="form-control @error('service_interval') is-invalid @enderror"
                           id="service_interval" name="service_interval"
                           value="{{ old('service_interval', optional($vehicleVar)->service_interval) }}"
                           placeholder="e.g., 5,000 km or 3 months">
                    @error('service_interval')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label for="vehicle_status" class="form-label required">Vehicle Status</label>
                    @php($status = old('vehicle_status', optional($vehicleVar)->vehicle_status))
                    <select class="form-select @error('vehicle_status') is-invalid @enderror"
                            id="vehicle_status" name="vehicle_status" required>
                        <option value="">Select Status</option>
                        <option value="Active" @selected($status === 'Active')>Active</option>
                        <option value="Inactive" @selected($status === 'Inactive')>Inactive</option>
                        <option value="Repair" @selected($status === 'Repair')>Repair</option>
                    </select>
                    @error('vehicle_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </fieldset>
    </div>
</div>
