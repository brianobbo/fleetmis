@extends('layouts.app')

@section('title', 'Trip Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-eye"></i> Trip {{ $trip->trip_id }}</h2>
    <a href="{{ route('trips.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Trips
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3"><strong>Trip ID:</strong> {{ $trip->trip_id }}</div>
            <div class="col-md-3"><strong>Driver:</strong> {{ optional($trip->driver)->full_name }}</div>
            <div class="col-md-3"><strong>Vehicle:</strong> {{ optional($trip->vehicle)->registration_number }}</div>
            <div class="col-md-3"><strong>Destination:</strong> {{ $trip->destination }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3"><strong>Time Out:</strong> {{ optional($trip->time_out)->format('Y-m-d H:i') }}</div>
            <div class="col-md-3"><strong>Odometer Start:</strong> {{ $trip->odometer_start }}</div>
            <div class="col-md-3"><strong>Time In:</strong> {{ optional($trip->time_in)->format('Y-m-d H:i') }}</div>
            <div class="col-md-3"><strong>Odometer End:</strong> {{ $trip->odometer_end }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3"><strong>Fuel Before Trip:</strong> {{ $trip->fuel_before_trip }}</div>
            <div class="col-md-3"><strong>Fuel After Trip:</strong> {{ $trip->fuel_after_trip }}</div>
            <div class="col-md-6"><strong>Purpose:</strong> {{ $trip->purpose_of_trip }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-8"><strong>Comments:</strong> {{ $trip->comments }}</div>
            <div class="col-md-4"><strong>Approved By:</strong> {{ $trip->approved_by }}</div>
        </div>

        <div class="d-flex justify-content-end">
            <a class="btn btn-outline-primary me-2" href="{{ route('trips.edit', $trip) }}"><i class="fas fa-edit"></i> Edit</a>
            <form action="{{ route('trips.destroy', $trip) }}" method="POST" onsubmit="return confirm('Delete this trip?')" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
