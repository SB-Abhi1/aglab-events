<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Events & Activities') | AG-Lab SUST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --ag-primary: #1e5631;
            --ag-secondary: #4c9a5a;
            --ag-light: #f4f9f4;
        }
        body {
            background-color: var(--ag-light);
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        .navbar-ag {
            background-color: var(--ag-primary);
        }
        .navbar-ag .navbar-brand, .navbar-ag .nav-link {
            color: #fff !important;
            font-weight: 500;
        }
        .btn-ag {
            background-color: var(--ag-primary);
            border-color: var(--ag-primary);
            color: #fff;
        }
        .btn-ag:hover {
            background-color: var(--ag-secondary);
            border-color: var(--ag-secondary);
            color: #fff;
        }
        .card-event {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: transform 0.15s ease;
            height: 100%;
        }
        .card-event:hover {
            transform: translateY(-4px);
        }
        .badge-type {
            background-color: var(--ag-secondary);
        }
        .badge-status-Upcoming { background-color: #0d6efd; }
        .badge-status-Ongoing { background-color: #fd7e14; }
        .badge-status-Completed { background-color: #198754; }
        .badge-status-Cancelled { background-color: #dc3545; }
        footer {
            background-color: var(--ag-primary);
            color: #fff;
            padding: 1.5rem 0;
            margin-top: 3rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-ag">
    <div class="container">
        <a class="navbar-brand" href="{{ route('events.index') }}">
            <i class="fa-solid fa-flask"></i> AG-Lab &mdash; Events & Activities
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('events.index') }}">All Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('events.create') }}">
                        <i class="fa-solid fa-plus"></i> Add Event
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please fix the following:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<footer class="text-center">
    <div class="container">
        <small>&copy; {{ date('Y') }} Laboratory of Genomics and Transcriptomics (AG-Lab) &mdash; Dept. of Biochemistry and Molecular Biology, SUST</small><br>
        <small>Events &amp; Activities Module &mdash; Member 2 Task</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
