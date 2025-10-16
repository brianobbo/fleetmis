@extends('layouts.app')

@section('title', 'Edit Driver')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-edit"></i> Edit Driver</h2>
    <a href="{{ route('drivers.show', $driver) }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Driver
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('drivers.update', $driver) }}" method="POST">
            @csrf
            @method('PUT')
            @include('drivers.partials.form-fields')
            <div class="d-flex justify-content-end">
                <a href="{{ route('drivers.show', $driver) }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Driver
                </button>
            </div>
        </form>
    </div>
</div>
@endsection