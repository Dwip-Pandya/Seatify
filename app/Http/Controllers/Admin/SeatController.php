<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeatController extends Controller
{
    // index: show all events + their seats
    public function index()
    {
        $events = Event::with('seats')->get();
        return view('admin.seats.index', compact('events'));
    }

    // create: show form to add seats to an event
    public function create()
    {
        // Fetch all events
        $events = Event::all();

        // Pass events data to the view
        return view('admin.seats.create', compact('events'));
    }

    // store: save multiple seats for the selected event
    public function store(Request $request)
    {
        // Validate inputs
        $validated = $request->validate([
            'event_id' => 'required|exists:tbl_events,event_id',
            'row' => 'required|string|max:10',
            'category' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'number_of_seats' => 'required|integer|min:1',
        ]);

        $eventId = $validated['event_id'];
        $row = $validated['row'];
        $category = $validated['category'];
        $price = $validated['price'];
        $numberOfSeats = $validated['number_of_seats'];

        // Prepare an array to hold seat data for bulk insert
        $seats = [];
        for ($i = 1; $i <= $numberOfSeats; $i++) {
            $seats[] = [
                'event_id' => $eventId,
                'row' => $row,
                'number' => $i,  // Seat number will be from 1 to N
                'category' => $category,
                'price' => $price,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert all seats in one query
        Seat::insert($seats);

        return redirect()->route('admin.seats.index')->with('success', 'Seats added successfully!');
    }

    // edit: edit existing seat
    public function edit($id)
    {
        $seat = Seat::findOrFail($id);
        $events = Event::all();
        return view('admin.seats.edit', compact('seat', 'events'));
    }

    // update: save updated seat
    public function update(Request $request, $id)
    {
        // Validate inputs
        $validated = $request->validate([
            'event_id' => 'required|exists:tbl_events,event_id',
            'row' => 'required|string|max:10',
            'category' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'number' => 'required|string|max:10',
        ]);

        $seat = Seat::findOrFail($id);
        $seat->update([
            'event_id' => $validated['event_id'],
            'row' => $validated['row'],
            'number' => $validated['number'],
            'category' => $validated['category'],
            'price' => $validated['price'],
        ]);

        return redirect()->route('admin.seats.index')->with('success', 'Seat updated successfully!');
    }

    // destroy: delete seat
    public function destroy($id)
    {
        $seat = Seat::findOrFail($id);

        // Check if seat is booked
        $isBooked = DB::table('tbl_booking_seats')
            ->where('seat_id', $id)
            ->exists();

        // Check if seat is currently blocked (in tbl_blocked_seats, and within last 5 minutes)
        $isBlocked = DB::table('tbl_blocked_seats')
            ->where('seat_id', $id)
            ->where('blocked_at', '>', now()->subMinutes(5))
            ->exists();

        if ($isBooked || $isBlocked) {
            return redirect()->back()->with('error', 'Cannot delete this seat: it is booked or currently blocked.');
        }

        $seat->delete();

        return redirect()->route('admin.seats.index')->with('success', 'Seat deleted successfully!');
    }
}
