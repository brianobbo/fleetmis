@extends('layouts.app')

@section('title', 'Add Driver')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-plus"></i> Add Driver</h2>
    <a href="{{ route('drivers.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Drivers
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('drivers.store') }}" method="POST">
            @csrf
            @include('drivers.partials.form-fields')
            <div class="d-flex justify-content-end">
                <a href="{{ route('drivers.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Driver
                </button>
            </div>
        </form>
    </div>
</div>
@endsection