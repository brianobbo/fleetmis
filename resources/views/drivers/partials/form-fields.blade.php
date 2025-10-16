@php($driverVar = isset($driver) ? $driver : null)
<div class="row">
    <div class="col-md-6">
        <fieldset class="fieldset-card">
            <legend>Identity</legend>
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="full_name" class="form-label required">Full Name</label>
                    <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                           id="full_name" name="full_name"
                           value="{{ old('full_name', optional($driverVar)->full_name) }}" required>
                    @error('full_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label for="national_id_no" class="form-label required">National ID Number</label>
                    <input type="text" class="form-control @error('national_id_no') is-invalid @enderror"
                           id="national_id_no" name="national_id_no"
                           value="{{ old('national_id_no', optional($driverVar)->national_id_no) }}" required>
                    @error('national_id_no')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </fieldset>
    </div>

    <div class="col-md-6">
        <fieldset class="fieldset-card">
            <legend>License</legend>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="license_number" class="form-label required">License Number</label>
                    <input type="text" class="form-control @error('license_number') is-invalid @enderror"
                           id="license_number" name="license_number"
                           value="{{ old('license_number', optional($driverVar)->license_number) }}" required>
                    @error('license_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="license_class" class="form-label required">License Class</label>
                    @php($class = old('license_class', optional($driverVar)->license_class))
                    <select class="form-select @error('license_class') is-invalid @enderror" id="license_class" name="license_class" required>
                        <option value="">Select License Class</option>
                        <option value="B" @selected($class==='B')>B</option>
                        <option value="CM" @selected($class==='CM')>CM</option>
                        <option value="DL" @selected($class==='DL')>DL</option>
                    </select>
                    @error('license_class')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="license_expiry" class="form-label required">License Expiry Date</label>
                    <input type="date" class="form-control @error('license_expiry') is-invalid @enderror"
                           id="license_expiry" name="license_expiry"
                           value="{{ old('license_expiry', optional(optional($driverVar)->license_expiry)->format('Y-m-d')) }}" required>
                    @error('license_expiry')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="contact_number" class="form-label required">Contact Number</label>
                    <input type="text" class="form-control @error('contact_number') is-invalid @enderror"
                           id="contact_number" name="contact_number"
                           value="{{ old('contact_number', optional($driverVar)->contact_number) }}" required>
                    @error('contact_number')
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
            <legend>Assignment</legend>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="assigned_vehicle_id" class="form-label">Assigned Vehicle</label>
                    <select class="form-select @error('assigned_vehicle_id') is-invalid @enderror" id="assigned_vehicle_id" name="assigned_vehicle_id">
                        <option value="">Select Vehicle (Optional)</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" @selected(old('assigned_vehicle_id', optional($driverVar)->assigned_vehicle_id) == $vehicle->id)>
                                {{ $vehicle->registration_number }} - {{ $vehicle->make_model }}
                            </option>
                        @endforeach
                    </select>
                    @error('assigned_vehicle_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col-md-6">
        <fieldset class="fieldset-card">
            <legend>Status</legend>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="status" class="form-label required">Status</label>
                    @php($status = old('status', optional($driverVar)->status))
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="">Select Status</option>
                        <option value="Active" @selected($status==='Active')>Active</option>
                        <option value="Inactive" @selected($status==='Inactive')>Inactive</option>
                        <option value="On Leave" @selected($status==='On Leave')>On Leave</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </fieldset>
    </div>
</div>
