@php($va = isset($vehicleAuthorization) ? $vehicleAuthorization : null)
<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label">Form No.</label>
        <input type="text" name="form_number" class="form-control" value="{{ old('form_number', optional($va)->form_number) }}" />
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Date</label>
        <input type="date" name="form_date" class="form-control" value="{{ old('form_date', optional(optional($va)->form_date)->format('Y-m-d')) }}" />
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Driver</label>
        <select name="driver_id" class="form-select">
            <option value="">Select Driver</option>
            @foreach($drivers as $driver)
                <option value="{{ $driver->id }}" @selected(old('driver_id', optional($va)->driver_id) == $driver->id)>
                    {{ $driver->full_name }} ({{ $driver->driver_id }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Travellers' Names</label>
        <input type="text" name="travellers_names" class="form-control" value="{{ old('travellers_names', optional($va)->travellers_names) }}" />
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Purpose of travel</label>
        <textarea name="purpose_of_travel" class="form-control" rows="2">{{ old('purpose_of_travel', optional($va)->purpose_of_travel) }}</textarea>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Destination</label>
        <input type="text" name="destination" class="form-control" value="{{ old('destination', optional($va)->destination) }}" />
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Vehicle</label>
        <select name="vehicle_id" class="form-select">
            <option value="">Select Vehicle</option>
            @foreach($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}" @selected(old('vehicle_id', optional($va)->vehicle_id) == $vehicle->id)>
                    {{ $vehicle->registration_number }} - {{ $vehicle->make_model }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Vehicle Type</label>
        <input type="text" name="vehicle_type" class="form-control" value="{{ old('vehicle_type', optional($va)->vehicle_type) }}" />
    </div>
    <div class="col-md-2 mb-3">
        <label class="form-label">Estimated kms</label>
        <input type="number" name="estimated_kms" class="form-control" value="{{ old('estimated_kms', optional($va)->estimated_kms) }}" />
    </div>
    <div class="col-md-2 mb-3">
        <label class="form-label">Estimated fuel (L)</label>
        <input type="number" name="estimated_fuel_litres" class="form-control" value="{{ old('estimated_fuel_litres', optional($va)->estimated_fuel_litres) }}" />
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Date Expected back</label>
        <input type="date" name="date_expected_back" class="form-control" value="{{ old('date_expected_back', optional(optional($va)->date_expected_back)->format('Y-m-d')) }}" />
    </div>
    <div class="col-md-8 mb-3">
        <label class="form-label">Alternative driver/s</label>
        <input type="text" name="alternative_drivers" class="form-control" value="{{ old('alternative_drivers', optional($va)->alternative_drivers) }}" />
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label">Depart Date</label>
        <input type="date" name="depart_date" class="form-control" value="{{ old('depart_date', optional(optional($va)->depart_date)->format('Y-m-d')) }}" />
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Time-out</label>
        <input type="time" name="depart_time" class="form-control" value="{{ old('depart_time', optional($va)->depart_time) }}" />
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Return Date</label>
        <input type="date" name="return_date" class="form-control" value="{{ old('return_date', optional(optional($va)->return_date)->format('Y-m-d')) }}" />
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Time-in</label>
        <input type="time" name="return_time" class="form-control" value="{{ old('return_time', optional($va)->return_time) }}" />
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permit_carry_non_staff" value="1" @checked(old('permit_carry_non_staff', optional($va)->permit_carry_non_staff)) />
            <label class="form-check-label">Permitted to carry non staff</label>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permit_personal_use" value="1" @checked(old('permit_personal_use', optional($va)->permit_personal_use)) />
            <label class="form-check-label">Permitted for personal use</label>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="row">
            <div class="col-6">
                <label class="form-label">From</label>
                <input type="time" name="operations_time_from" class="form-control" value="{{ old('operations_time_from', optional($va)->operations_time_from) }}" />
            </div>
            <div class="col-6">
                <label class="form-label">To</label>
                <input type="time" name="operations_time_to" class="form-control" value="{{ old('operations_time_to', optional($va)->operations_time_to) }}" />
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Ending Mileage (A)</label>
        <input type="number" name="ending_mileage" class="form-control" value="{{ old('ending_mileage', optional($va)->ending_mileage) }}" />
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Beginning Mileage (B)</label>
        <input type="number" name="beginning_mileage" class="form-control" value="{{ old('beginning_mileage', optional($va)->beginning_mileage) }}" />
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Total (A - B)</label>
        <input type="number" name="total_mileage" class="form-control" value="{{ old('total_mileage', optional($va)->total_mileage) }}" />
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Name (Acknowledgement)</label>
        <input type="text" name="ack_name" class="form-control" value="{{ old('ack_name', optional($va)->ack_name) }}" />
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Signature</label>
        <input type="text" name="ack_signature" class="form-control" value="{{ old('ack_signature', optional($va)->ack_signature) }}" />
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Date</label>
        <input type="date" name="ack_date" class="form-control" value="{{ old('ack_date', optional(optional($va)->ack_date)->format('Y-m-d')) }}" />
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Traveller's Supervisor Signature</label>
        <input type="text" name="traveller_supervisor_signature" class="form-control" value="{{ old('traveller_supervisor_signature', optional($va)->traveller_supervisor_signature) }}" />
    </div>
    <div class="col-md-2 mb-3">
        <label class="form-label">Date</label>
        <input type="date" name="traveller_supervisor_date" class="form-control" value="{{ old('traveller_supervisor_date', optional(optional($va)->traveller_supervisor_date)->format('Y-m-d')) }}" />
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Fleet Supervisor Signature</label>
        <input type="text" name="fleet_supervisor_signature" class="form-control" value="{{ old('fleet_supervisor_signature', optional($va)->fleet_supervisor_signature) }}" />
    </div>
    <div class="col-md-2 mb-3">
        <label class="form-label">Date</label>
        <input type="date" name="fleet_supervisor_date" class="form-control" value="{{ old('fleet_supervisor_date', optional(optional($va)->fleet_supervisor_date)->format('Y-m-d')) }}" />
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Supply Chain Manager / Executive Director Signature</label>
        <input type="text" name="supply_chain_manager_signature" class="form-control" value="{{ old('supply_chain_manager_signature', optional($va)->supply_chain_manager_signature) }}" />
    </div>
    <div class="col-md-2 mb-3">
        <label class="form-label">Date</label>
        <input type="date" name="supply_chain_manager_date" class="form-control" value="{{ old('supply_chain_manager_date', optional(optional($va)->supply_chain_manager_date)->format('Y-m-d')) }}" />
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Passenger Comments</label>
        <input type="text" name="passenger_comments" class="form-control" value="{{ old('passenger_comments', optional($va)->passenger_comments) }}" />
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Time / Date Picked</label>
        <input type="datetime-local" name="picked_at" class="form-control" value="{{ old('picked_at', optional($va)->picked_at) }}" />
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Time / Date Dropped</label>
        <input type="datetime-local" name="dropped_at" class="form-control" value="{{ old('dropped_at', optional($va)->dropped_at) }}" />
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Driver's Conduct</label>
    <textarea name="drivers_conduct" class="form-control" rows="2">{{ old('drivers_conduct', optional($va)->drivers_conduct) }}</textarea>
</div>
