@extends('layouts.app')

@section('title', 'Vehicle Authorizations')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-file-signature"></i> Vehicle Authorizations</h2>
    <div>
        <a href="{{ route('vehicle-authorizations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Authorization
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <input name="search" class="form-control" placeholder="Search forms, destination, purpose" value="{{ request('search') }}" />
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Form No.</th>
                        <th>Date</th>
                        <th>Driver</th>
                        <th>Vehicle</th>
                        <th>Destination</th>
                        <th>Total Mileage</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($authorizations as $auth)
                        <tr>
                            <td>{{ $auth->id }}</td>
                            <td>{{ $auth->form_number }}</td>
                            <td>{{ optional($auth->form_date)->format('Y-m-d') }}</td>
                            <td>{{ optional($auth->driver)->full_name }}</td>
                            <td>{{ optional($auth->vehicle)->registration_number }}</td>
                            <td>{{ $auth->destination }}</td>
                            <td>{{ $auth->total_mileage }}</td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('vehicle-authorizations.show', $auth) }}"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('vehicle-authorizations.edit', $auth) }}"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('vehicle-authorizations.destroy', $auth) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this record?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $authorizations->links() }}
    </div>
</div>
@endsection
