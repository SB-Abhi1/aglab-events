@extends('layouts.app')

@section('title', 'Add New Event')

@section('content')
    <div class="card p-4 shadow-sm">
        <h3 class="mb-4"><i class="fa-solid fa-plus"></i> Add New Event / Activity</h3>

        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('events._form')

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-ag"><i class="fa-solid fa-save"></i> Save Event</button>
                <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
