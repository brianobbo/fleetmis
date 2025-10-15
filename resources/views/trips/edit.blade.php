@extends('layouts.app')

@section('title', 'Edit Trip')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-edit"></i> Edit Trip</h2>
    <a href="{{ route('trips.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Trips
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('trips.update', $trip) }}" method="POST">
            @csrf
            @method('PUT')
            @include('trips.partials.form-fields')
            <div class="d-flex justify-content-end">
                <a href="{{ route('trips.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
