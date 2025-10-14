@extends('layouts.app')

@section('title', 'Edit Vehicle Authorization')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-edit"></i> Edit Vehicle Authorization</h2>
    <a href="{{ route('vehicle-authorizations.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to List
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('vehicle-authorizations.update', $vehicleAuthorization) }}" method="POST">
            @csrf
            @method('PUT')

            @include('vehicle-authorizations.partials.form-fields')

            <div class="d-flex justify-content-end">
                <a href="{{ route('vehicle-authorizations.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
