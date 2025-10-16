@extends('layouts.app')

@section('title', 'Edit Vehicle')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-edit"></i> Edit Vehicle</h2>
    <a href="{{ route('vehicles.show', $vehicle) }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Vehicle
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('vehicles.update', $vehicle) }}" method="POST">
            @csrf
            @method('PUT')
            @include('vehicles.partials.form-fields')
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('vehicles.show', $vehicle) }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Vehicle
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
