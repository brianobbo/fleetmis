@php($tripVar = isset($trip) ? $trip : null)
<div class="row">
    <div class="col-md-6">
        <fieldset class="fieldset-card">
            <legend>Participants</legend>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Trip ID</label>
                    <input type="text" class="form-control" value="{{ old('trip_id', optional($tripVar)->trip_id) }}" disabled />
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Driver</label>
                    <select name="driver_id" class="form-select @error('driver_id') is-invalid @enderror">
                        <option value="">Select Driver</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" @selected(old('driver_id', optional($tripVar)->driver_id) == $driver->id)>
                                {{ $driver->full_name }} ({{ $driver->driver_id }})
                            </option>
                        @endforeach
                    </select>
                    @error('driver_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label required">Vehicle</label>
                    <select name="vehicle_id" class="form-select @error('vehicle_id') is-invalid @enderror">
                        <option value="">Select Vehicle</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" @selected(old('vehicle_id', optional($tripVar)->vehicle_id) == $vehicle->id)>
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
            <legend>Timing & Odometer</legend>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Date / Time Out</label>
                    <input type="datetime-local" name="time_out" class="form-control @error('time_out') is-invalid @enderror" value="{{ old('time_out', optional($tripVar?->time_out)->format('Y-m-d\\TH:i')) }}" />
                    @error('time_out')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Date / Time In</label>
                    <input type="datetime-local" name="time_in" class="form-control @error('time_in') is-invalid @enderror" value="{{ old('time_in', optional($tripVar?->time_in)->format('Y-m-d\\TH:i')) }}" />
                    @error('time_in')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Odometer Start</label>
                    <input type="number" name="odometer_start" class="form-control @error('odometer_start') is-invalid @enderror" value="{{ old('odometer_start', optional($tripVar)->odometer_start) }}" />
                    @error('odometer_start')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Odometer End</label>
                    <input type="number" name="odometer_end" class="form-control @error('odometer_end') is-invalid @enderror" value="{{ old('odometer_end', optional($tripVar)->odometer_end) }}" />
                    @error('odometer_end')
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
            <legend>Trip Details</legend>
            <div class="row">
                <div class="col-12 mb-3">
                    <label class="form-label">Destination</label>
                    <input type="text" name="destination" class="form-control @error('destination') is-invalid @enderror" value="{{ old('destination', optional($tripVar)->destination) }}" />
                    @error('destination')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Purpose of Trip</label>
                    <input type="text" name="purpose_of_trip" class="form-control @error('purpose_of_trip') is-invalid @enderror" value="{{ old('purpose_of_trip', optional($tripVar)->purpose_of_trip) }}" />
                    @error('purpose_of_trip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col-md-6">
        <fieldset class="fieldset-card">
            <legend>Fuel & Comments</legend>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fuel Before Trip (L)</label>
                    <input type="number" name="fuel_before_trip" class="form-control @error('fuel_before_trip') is-invalid @enderror" value="{{ old('fuel_before_trip', optional($tripVar)->fuel_before_trip) }}" />
                    @error('fuel_before_trip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fuel After Trip (L)</label>
                    <input type="number" name="fuel_after_trip" class="form-control @error('fuel_after_trip') is-invalid @enderror" value="{{ old('fuel_after_trip', optional($tripVar)->fuel_after_trip) }}" />
                    @error('fuel_after_trip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Comments</label>
                    <input type="text" name="comments" class="form-control @error('comments') is-invalid @enderror" value="{{ old('comments', optional($tripVar)->comments) }}" />
                    @error('comments')
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
            <legend>Approval</legend>
            <div class="row">
                <div class="col-12 mb-3">
                    <label class="form-label">Approved By</label>
                    <input type="text" name="approved_by" class="form-control @error('approved_by') is-invalid @enderror" value="{{ old('approved_by', optional($tripVar)->approved_by) }}" />
                    @error('approved_by')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </fieldset>
    </div>
</div>
