@php $event = $event ?? null; @endphp

<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $event->title ?? '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Type <span class="text-danger">*</span></label>
        <select name="type" class="form-select" required>
            @foreach ($types as $type)
                <option value="{{ $type }}" @selected(old('type', $event->type ?? '') == $type)>{{ $type }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Event Date <span class="text-danger">*</span></label>
        <input type="date" name="event_date" class="form-control"
               value="{{ old('event_date', isset($event) ? $event->event_date->format('Y-m-d') : '') }}" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Event Time</label>
        <input type="time" name="event_time" class="form-control"
               value="{{ old('event_time', $event->event_time ?? '') }}">
    </div>

    <div class="col-md-4">
        <label class="form-label">Status <span class="text-danger">*</span></label>
        <select name="status" class="form-select" required>
            @foreach ($statuses as $status)
                <option value="{{ $status }}" @selected(old('status', $event->status ?? 'Upcoming') == $status)>{{ $status }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Venue</label>
        <input type="text" name="venue" class="form-control" value="{{ old('venue', $event->venue ?? '') }}" placeholder="e.g. BMB Seminar Room, SUST">
    </div>

    <div class="col-md-6">
        <label class="form-label">Speaker / Guest</label>
        <input type="text" name="speaker" class="form-control" value="{{ old('speaker', $event->speaker ?? '') }}" placeholder="e.g. Dr. Ajit Ghosh">
    </div>

    <div class="col-md-12">
        <label class="form-label">Description <span class="text-danger">*</span></label>
        <textarea name="description" class="form-control" rows="4" required>{{ old('description', $event->description ?? '') }}</textarea>
    </div>

    <div class="col-md-12">
        <label class="form-label">Event Image</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        <small class="text-muted">JPG, PNG or WEBP. Max 2MB.</small>

        @if (isset($event) && $event->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $event->image) }}" style="max-height:120px; border-radius:8px;" alt="Current image">
                <p class="text-muted small mt-1">Current image (uploading a new one will replace it)</p>
            </div>
        @endif
    </div>
</div>
