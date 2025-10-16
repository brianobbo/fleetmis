@extends('layouts.app')

@section('title', 'New Assignment')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-plus"></i> New Driver Assignment</h2>
    <a href="{{ route('driver-assignments.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Assignments
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('driver-assignments.store') }}" method="POST">
            @csrf
            @include('driver-assignments.partials.form-fields')
            <div class="d-flex justify-content-end">
                <a href="{{ route('driver-assignments.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Create Assignment
                </button>
            </div>
        </form>
    </div>
</div>

@section('scripts')
    <script>
        document.getElementById('assignment_type').addEventListener('change', function() {
            const endDateField = document.getElementById('end_date');
            if (this.value === 'Permanent') {
                endDateField.value = '';
                endDateField.disabled = true;
            } else {
                endDateField.disabled = false;
            }
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            const assignmentType = document.getElementById('assignment_type');
            const endDateField = document.getElementById('end_date');
            if (assignmentType && endDateField && assignmentType.value === 'Permanent') {
                endDateField.disabled = true;
            }
        });
    </script>
@endsection
@endsection