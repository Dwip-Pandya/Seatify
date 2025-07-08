<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class UserEventController extends Controller
{
    public function index(Request $request)
    {
        // Start query builder
        $query = Event::query();

        // Filter by name
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        // Filter by start_date
        if ($request->filled('start_date')) {
            $query->whereDate('start_date', '=', $request->start_date);
        }

        // Filter by end_date
        if ($request->filled('end_date')) {
            $query->whereDate('end_date', '=', $request->end_date);
        }

        // Fetch filtered & sorted events
        $events = $query->orderBy('start_date', 'desc')->get();

        return view('frontend.events', compact('events'));
    }

    public function show($event_id)
    {
        $event = Event::findOrFail($event_id);

        $otherEvents = Event::where('event_id', '!=', $event_id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('frontend.event_details', compact('event', 'otherEvents'));
    }
}
