@extends('layouts.app')

@section('title', 'Trips')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-road"></i> Trips</h2>
    <div>
        <a href="{{ route('trips.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Trip
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <input name="search" class="form-control" placeholder="Search trips" value="{{ request('search') }}" />
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
                        <th>Trip ID</th>
                        <th>Driver</th>
                        <th>Vehicle</th>
                        <th>Destination</th>
                        <th>Out</th>
                        <th>In</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($trips as $t)
                        <tr>
                            <td>{{ $t->id }}</td>
                            <td>{{ $t->trip_id }}</td>
                            <td>{{ optional($t->driver)->full_name }}</td>
                            <td>{{ optional($t->vehicle)->registration_number }}</td>
                            <td>{{ $t->destination }}</td>
                            <td>{{ optional($t->time_out)->format('Y-m-d H:i') }}</td>
                            <td>{{ optional($t->time_in)->format('Y-m-d H:i') }}</td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('trips.show', $t) }}"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('trips.edit', $t) }}"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('trips.destroy', $t) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this trip?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No trips found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $trips->links() }}
    </div>
</div>
@endsection
