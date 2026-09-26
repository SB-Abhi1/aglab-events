@extends('layouts.app')

@section('title', $event->title)

@section('content')
    <div class="card shadow-sm">
        @if ($event->image)
            <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" style="max-height:350px; object-fit:cover;" alt="{{ $event->title }}">
        @endif
        <div class="card-body p-4">
            <div class="mb-2">
                <span class="badge badge-type">{{ $event->type }}</span>
                <span class="badge badge-status-{{ $event->status }}">{{ $event->status }}</span>
            </div>
            <h2>{{ $event->title }}</h2>

            <ul class="list-unstyled mt-3">
                <li class="mb-2"><i class="fa-regular fa-calendar text-muted"></i>
                    <strong>Date:</strong> {{ $event->event_date->format('d M, Y (l)') }}
                </li>
                @if ($event->event_time)
                    <li class="mb-2"><i class="fa-regular fa-clock text-muted"></i>
                        <strong>Time:</strong> {{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }}
                    </li>
                @endif
                @if ($event->venue)
                    <li class="mb-2"><i class="fa-solid fa-location-dot text-muted"></i>
                        <strong>Venue:</strong> {{ $event->venue }}
                    </li>
                @endif
                @if ($event->speaker)
                    <li class="mb-2"><i class="fa-solid fa-user text-muted"></i>
                        <strong>Speaker/Guest:</strong> {{ $event->speaker }}
                    </li>
                @endif
            </ul>

            <hr>
            <h5>Description</h5>
            <p style="white-space: pre-line;">{{ $event->description }}</p>

            <div class="mt-4 d-flex gap-2">
                <a href="{{ route('events.edit', $event) }}" class="btn btn-outline-primary">
                    <i class="fa-solid fa-pen"></i> Edit
                </a>
                <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                </form>
                <a href="{{ route('events.index') }}" class="btn btn-outline-secondary ms-auto">
                    <i class="fa-solid fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
@endsection
