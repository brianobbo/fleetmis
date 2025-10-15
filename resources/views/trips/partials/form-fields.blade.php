@php($tripVar = isset($trip) ? $trip : null)
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Trip ID</label>
        <input type="text" class="form-control" value="{{ old('trip_id', optional($tripVar)->trip_id) }}" disabled />
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Driver</label>
        <select name="driver_id" class="form-select">
            <option value="">Select Driver</option>
            @foreach($drivers as $driver)
                <option value="{{ $driver->id }}" @selected(old('driver_id', optional($tripVar)->driver_id) == $driver->id)>
                    {{ $driver->full_name }} ({{ $driver->driver_id }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Vehicle</label>
        <select name="vehicle_id" class="form-select">
            <option value="">Select Vehicle</option>
            @foreach($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}" @selected(old('vehicle_id', optional($tripVar)->vehicle_id) == $vehicle->id)>
                    {{ $vehicle->registration_number }} - {{ $vehicle->make_model }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label">Date / Time Out</label>
        <input type="datetime-local" name="time_out" class="form-control" value="{{ old('time_out', optional($tripVar?->time_out)->format('Y-m-d\TH:i')) }}" />
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Odometer Start</label>
        <input type="number" name="odometer_start" class="form-control" value="{{ old('odometer_start', optional($tripVar)->odometer_start) }}" />
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Date / Time In</label>
        <input type="datetime-local" name="time_in" class="form-control" value="{{ old('time_in', optional($tripVar?->time_in)->format('Y-m-d\TH:i')) }}" />
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Odometer End</label>
        <input type="number" name="odometer_end" class="form-control" value="{{ old('odometer_end', optional($tripVar)->odometer_end) }}" />
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Destination</label>
        <input type="text" name="destination" class="form-control" value="{{ old('destination', optional($tripVar)->destination) }}" />
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Purpose of Trip</label>
        <input type="text" name="purpose_of_trip" class="form-control" value="{{ old('purpose_of_trip', optional($tripVar)->purpose_of_trip) }}" />
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label">Fuel Before Trip (L)</label>
        <input type="number" name="fuel_before_trip" class="form-control" value="{{ old('fuel_before_trip', optional($tripVar)->fuel_before_trip) }}" />
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Fuel After Trip (L)</label>
        <input type="number" name="fuel_after_trip" class="form-control" value="{{ old('fuel_after_trip', optional($tripVar)->fuel_after_trip) }}" />
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Comments</label>
        <input type="text" name="comments" class="form-control" value="{{ old('comments', optional($tripVar)->comments) }}" />
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Approved By</label>
        <input type="text" name="approved_by" class="form-control" value="{{ old('approved_by', optional($tripVar)->approved_by) }}" />
    </div>
</div>
