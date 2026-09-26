<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the events.
     */
    public function index(Request $request)
    {
        $query = Event::query()->search($request->get('q'));

        if ($request->filled('type')) {
            $query->where('type', $request->get('type'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $events = $query->orderBy('event_date', 'desc')->paginate(9)->withQueryString();

        $types = ['Seminar', 'Workshop', 'Event', 'Conference', 'Training'];
        $statuses = ['Upcoming', 'Ongoing', 'Completed', 'Cancelled'];

        return view('events.index', compact('events', 'types', 'statuses'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        $types = ['Seminar', 'Workshop', 'Event', 'Conference', 'Training'];
        $statuses = ['Upcoming', 'Ongoing', 'Completed', 'Cancelled'];

        return view('events.create', compact('types', 'statuses'));
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateEvent($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($validated);

        return redirect()->route('events.index')
                          ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        $types = ['Seminar', 'Workshop', 'Event', 'Conference', 'Training'];
        $statuses = ['Upcoming', 'Ongoing', 'Completed', 'Cancelled'];

        return view('events.edit', compact('event', 'types', 'statuses'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $this->validateEvent($request, $event->id);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($validated);

        return redirect()->route('events.index')
                          ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('events.index')
                          ->with('success', 'Event deleted successfully.');
    }

    /**
     * Shared validation rules for store & update.
     */
    private function validateEvent(Request $request, $eventId = null): array
    {
        return $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|in:Seminar,Workshop,Event,Conference,Training',
            'event_date'  => 'required|date',
            'event_time'  => 'nullable|date_format:H:i',
            'venue'       => 'nullable|string|max:255',
            'speaker'     => 'nullable|string|max:255',
            'description' => 'required|string',
            'status'      => 'required|in:Upcoming,Ongoing,Completed,Cancelled',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    }
}
