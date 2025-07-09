<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Seat;
use App\Models\BlockedSeat;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    public function selectSeats($event_id)
    {
        $event = Event::findOrFail($event_id);

        // Blocked within last 5 minutes
        $blockedSeatIds = BlockedSeat::where('event_id', $event_id)
            ->where('blocked_at', '>', Carbon::now()->subMinutes(5))
            ->pluck('seat_id')->toArray();

        // Booked seats
        $bookedSeatIds = DB::table('tbl_booking_seats')
            ->join('tbl_bookings', 'tbl_booking_seats.booking_id', '=', 'tbl_bookings.booking_id')
            ->where('tbl_bookings.event_id', $event_id)
            ->pluck('seat_id')->toArray();

        $seats = Seat::where('event_id', $event_id)->get();

        return view('frontend.booking', [
            'event' => $event,
            'seats' => $seats,
            'bookedSeats' => $bookedSeatIds,
            'blockedSeats' => $blockedSeatIds
        ]);
    }

    public function confirmBooking(Request $request, $event_id)
    {
        $seatInput = $request->input('seats', '');
        $seatIds = array_filter(explode(',', $seatInput));
        $seats = Seat::whereIn('seat_id', $seatIds)->get();

        if (empty($seatIds)) {
            return redirect()->back()->with('error', 'No seats selected.');
        }

        $totalAmount = Seat::whereIn('seat_id', $seatIds)->sum('price');

        // fake payment simulation
        $paymentSuccess = rand(0, 1) == 1;

        if ($paymentSuccess) {
            return $this->finalizeBooking($seatIds, $event_id, $totalAmount, false);
        } else {
            // ❗ REMOVE old blocking-after-payment-fail logic

            return view('frontend.payment_failed', [
                'event_id' => $event_id,
                'selectedSeats' => implode(',', $seatIds),
                'totalAmount' => $totalAmount,
                'seats' => $seats
            ]);
        }
    }

    public function retryBooking(Request $request, $event_id)
    {
        $seatInput = $request->input('seats', '');
        $seatIds = array_filter(explode(',', $seatInput));

        if (empty($seatIds)) {
            return redirect()->back()->with('error', 'No seats selected.');
        }

        $totalAmount = Seat::whereIn('seat_id', $seatIds)->sum('price');

        // retry payment simulation
        $paymentSuccess = rand(0, 1) == 1;

        if ($paymentSuccess) {
            return $this->finalizeBooking($seatIds, $event_id, $totalAmount, true);
        } else {
            return redirect()->back()->with('error', 'Payment failed again. Please try later.');
        }
    }

    // finalize booking (reusable)
    private function finalizeBooking($seatIds, $event_id, $totalAmount, $isRetry = false)
    {
        $booking = Booking::create([
            'user_id' => Auth::id() ?? 0,
            'event_id' => $event_id,
            'booking_date' => now(),
            'total_amount' => $totalAmount,
            'payment_status' => 'success',
        ]);

        foreach ($seatIds as $seatId) {
            DB::table('tbl_booking_seats')->insert([
                'booking_id' => $booking->booking_id,
                'seat_id' => $seatId,
            ]);
        }

        $pdf = Pdf::loadView('frontend.pdf', compact('booking'));
        $pdfPath = 'pdf/bookings/booking_' . $booking->booking_id . '.pdf';
        $pdf->save(public_path($pdfPath));

        $booking->pdf_path = $pdfPath;
        $booking->save();

        return view('frontend.confirmation', [
            'booking' => $booking,
            'isRetry' => $isRetry
        ]);
    }

    // ✅ NEW: Block seat when selected (via AJAX)
    public function blockSeat(Request $request)
    {
        $seatId = $request->input('seat_id');
        $eventId = $request->input('event_id');

        BlockedSeat::updateOrInsert(
            ['seat_id' => $seatId, 'event_id' => $eventId],
            ['blocked_at' => now(), 'user_id' => Auth::id() ?? 0]
        );

        return response()->json(['status' => 'success']);
    }
}
