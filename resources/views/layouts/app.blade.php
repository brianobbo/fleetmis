<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fleet Management System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Fieldset-as-card styling for production-ready form sections */
        fieldset.fieldset-card {
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: .5rem;
            padding: 1rem 1.25rem 1.25rem;
            margin-bottom: 1rem;
            background-color: #fff;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        }
        fieldset.fieldset-card > legend {
            font-size: 1rem;
            font-weight: 600;
            padding: 0 .5rem;
            width: auto;
            margin: 0;
            transform: translateY(-0.75rem);
            background: #fff;
            color: #212529;
        }
        /* Tighter, consistent spacing within fieldsets */
        .fieldset-card .row + .row { margin-top: .25rem; }
        .form-section-grid { row-gap: .5rem; }
        /* Consistent help text size */
        .fieldset-card .form-text { font-size: .875rem; }
        /* Mark required labels with an asterisk when using .required on label */
        label.required::after { content: ' *'; color: var(--bs-danger); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-truck"></i> Fleet Management
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vehicles.index') }}">
                            <i class="fas fa-car"></i> Vehicles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('drivers.index') }}">
                            <i class="fas fa-user"></i> Drivers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('driver-assignments.index') }}">
                            <i class="fas fa-clipboard-list"></i> Assignments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vehicle-authorizations.index') }}">
                            <i class="fas fa-file-signature"></i> Authorizations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('trips.index') }}">
                            <i class="fas fa-road"></i> Trips
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
