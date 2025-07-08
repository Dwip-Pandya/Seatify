<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function dashboard()
    {
        // Get the total number of events
        $totalEvents = Event::count();

        // Get the last 4 events with their details
        $latestEvents = Event::withCount('seats')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('admin.dashboard', compact('totalEvents', 'latestEvents'));
    }
    
    // List all events
    public function index()
    {
        $events = Event::orderBy('start_date', 'desc')->get();
        return view('admin.events.index', compact('events'));
    }

    // Show create form
    public function create()
    {
        return view('admin.events.create');
    }

    // Store new event
    public function store(Request $request)
    {
        // Validation rules with custom error messages
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price' => 'required|numeric|min:0',
        ], [
            'name.required' => 'Event name is required.',
            'name.string' => 'Event name must be a valid string.',
            'name.max' => 'Event name should not exceed 255 characters.',
            'description.string' => 'Event description must be a valid string.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'Image must be a file of type: jpg, jpeg, png.',
            'image.max' => 'The image size must not exceed 2MB.',
            'start_date.required' => 'Event start date is required.',
            'start_date.date' => 'Please provide a valid start date.',
            'end_date.required' => 'Event end date is required.',
            'end_date.date' => 'Please provide a valid end date.',
            'end_date.after_or_equal' => 'End date must be after or equal to the start date.',
            'price.required' => 'Event price is required.',
            'price.numeric' => 'Event price must be a valid number.',
            'price.min' => 'Event price must be at least 0.',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('events'), $filename);
            $validated['image'] = 'events/' . $filename;
        }

        // Store the new event
        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    // Update event
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        // Validation rules with custom error messages
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price' => 'required|numeric|min:0',
        ], [
            'name.required' => 'Event name is required.',
            'name.string' => 'Event name must be a valid string.',
            'name.max' => 'Event name should not exceed 255 characters.',
            'description.string' => 'Event description must be a valid string.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'Image must be a file of type: jpg, jpeg, png.',
            'image.max' => 'The image size must not exceed 2MB.',
            'start_date.required' => 'Event start date is required.',
            'start_date.date' => 'Please provide a valid start date.',
            'end_date.required' => 'Event end date is required.',
            'end_date.date' => 'Please provide a valid end date.',
            'end_date.after_or_equal' => 'End date must be after or equal to the start date.',
            'price.required' => 'Event price is required.',
            'price.numeric' => 'Event price must be a valid number.',
            'price.min' => 'Event price must be at least 0.',
        ]);

        // Handle image upload (if exists)
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('events'), $filename);
            $validated['image'] = 'events/' . $filename;
        }

        // Update the event
        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully!');
    }

    // Delete event
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully!');
    }
}
