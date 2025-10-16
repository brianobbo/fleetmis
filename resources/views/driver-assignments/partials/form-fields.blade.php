@php($assignmentVar = isset($driverAssignment) ? $driverAssignment : null)
<div class="row">
    <div class="col-md-6">
        <fieldset class="fieldset-card">
            <legend>Participants</legend>
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="driver_id" class="form-label required">Driver</label>
                    <select class="form-select @error('driver_id') is-invalid @enderror" id="driver_id" name="driver_id" required>
                        <option value="">Select Driver</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" @selected(old('driver_id', optional($assignmentVar)->driver_id) == $driver->id)>
                                {{ $driver->full_name }} ({{ $driver->driver_id }}) - {{ $driver->license_number }}
                            </option>
                        @endforeach
                    </select>
                    @error('driver_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label for="vehicle_id" class="form-label required">Vehicle</label>
                    <select class="form-select @error('vehicle_id') is-invalid @enderror" id="vehicle_id" name="vehicle_id" required>
                        <option value="">Select Vehicle</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" @selected(old('vehicle_id', optional($assignmentVar)->vehicle_id) == $vehicle->id)>
                                {{ $vehicle->registration_number }} - {{ $vehicle->make_model }}
                            </option>
                        @endforeach
                    </select>
                    @error('vehicle_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col-md-6">
        <fieldset class="fieldset-card">
            <legend>Assignment</legend>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="assignment_type" class="form-label required">Assignment Type</label>
                    @php($atype = old('assignment_type', optional($assignmentVar)->assignment_type))
                    <select class="form-select @error('assignment_type') is-invalid @enderror" id="assignment_type" name="assignment_type" required>
                        <option value="">Select Assignment Type</option>
                        <option value="Permanent" @selected($atype==='Permanent')>Permanent</option>
                        <option value="Temporary" @selected($atype==='Temporary')>Temporary</option>
                    </select>
                    @error('assignment_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="start_date" class="form-label required">Start Date</label>
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', optional(optional($assignmentVar)->start_date)->format('Y-m-d') ?? date('Y-m-d')) }}" required>
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', optional(optional($assignmentVar)->end_date)->format('Y-m-d')) }}">
                    <div class="form-text">Leave empty for permanent assignments</div>
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </fieldset>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <fieldset class="fieldset-card">
            <legend>Remarks</legend>
            <textarea class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks" rows="3" placeholder="Additional notes about this assignment">{{ old('remarks', optional($assignmentVar)->remarks) }}</textarea>
            @error('remarks')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </fieldset>
    </div>
</div>
