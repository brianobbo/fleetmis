@extends('layouts.app')

@section('title', 'New Trip')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-plus"></i> New Trip</h2>
    <a href="{{ route('trips.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Trips
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('trips.store') }}" method="POST">
            @csrf
            @include('trips.partials.form-fields')
            <div class="d-flex justify-content-end">
                <a href="{{ route('trips.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Create
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
