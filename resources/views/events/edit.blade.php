@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
    <div class="card p-4 shadow-sm">
        <h3 class="mb-4"><i class="fa-solid fa-pen"></i> Edit Event / Activity</h3>

        <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('events._form')

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-ag"><i class="fa-solid fa-save"></i> Update Event</button>
                <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
