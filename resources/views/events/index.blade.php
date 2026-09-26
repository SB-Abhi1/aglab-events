@extends('layouts.app')

@section('title', 'All Events & Activities')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="fa-solid fa-calendar-days"></i> Events & Activities</h2>
        <a href="{{ route('events.create') }}" class="btn btn-ag">
            <i class="fa-solid fa-plus"></i> Add New Event
        </a>
    </div>

    <form method="GET" action="{{ route('events.index') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="q" value="{{ request('q') }}" class="form-control"
                   placeholder="Search by title, venue, or speaker...">
        </div>
        <div class="col-md-3">
            <select name="type" class="form-select">
                <option value="">All Types</option>
                @foreach ($types as $type)
                    <option value="{{ $type }}" @selected(request('type') == $type)>{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">All Statuses</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" @selected(request('status') == $status)>{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-ag"><i class="fa-solid fa-filter"></i> Filter</button>
        </div>
    </form>

    @if ($events->isEmpty())
        <div class="alert alert-info">No events found. Try adjusting your filters or add a new event.</div>
    @else
        <div class="row g-4">
            @foreach ($events as $event)
                <div class="col-md-4">
                    <div class="card card-event">
                        @if ($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" style="height:180px; object-fit:cover; border-radius:12px 12px 0 0;" alt="{{ $event->title }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light" style="height:180px; border-radius:12px 12px 0 0;">
                                <i class="fa-solid fa-image fa-2x text-muted"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="mb-2">
                                <span class="badge badge-type">{{ $event->type }}</span>
                                <span class="badge badge-status-{{ $event->status }}">{{ $event->status }}</span>
                            </div>
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="text-muted mb-1">
                                <i class="fa-regular fa-calendar"></i> {{ $event->event_date->format('d M, Y') }}
                                @if ($event->event_time)
                                    &middot; <i class="fa-regular fa-clock"></i> {{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }}
                                @endif
                            </p>
                            @if ($event->venue)
                                <p class="text-muted mb-2"><i class="fa-solid fa-location-dot"></i> {{ $event->venue }}</p>
                            @endif
                            <p class="card-text">{{ Str::limit($event->description, 80) }}</p>
                        </div>
                        <div class="card-footer bg-white border-0 d-flex justify-content-between">
                            <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-eye"></i> View
                            </a>
                            <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-pen"></i> Edit
                            </a>
                            <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $events->links() }}
        </div>
    @endif
@endsection
