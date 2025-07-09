<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\Frontend\UserEventController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Define routes for admin panel, frontend (user side), and homepage.
| Clear grouping & naming make it easier to maintain.
|--------------------------------------------------------------------------
*/

// Homepage (welcome page showing featured events)
Route::get('/', [WelcomeController::class, 'index'])->name('home');


// Admin panel routes (prefix: /admin)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [EventController::class, 'dashboard'])->name('dashboard'); // Admin dashboard

    // Event CRUD (index, create, store, edit, update, delete)
    Route::resource('events', EventController::class);

    // Seat CRUD (index, create, store, edit, update, delete)
    Route::resource('seats', SeatController::class);
});


// Frontend user routes (prefix: /frontend)
Route::prefix('frontend')->name('frontend.')->group(function () {

    // List all events (e.g., /frontend/)
    Route::get('/', [UserEventController::class, 'index'])->name('events.index');

    // Show single event details (e.g., /frontend/events/5)
    Route::get('/events/{event_id}', [UserEventController::class, 'show'])->name('events.show');

    // Seat selection page for booking
    Route::get('/booking/{event_id}', [BookingController::class, 'selectSeats'])->name('booking.select');

    // Confirm booking & payment
    Route::post('/booking/{event_id}/confirm', [BookingController::class, 'confirmBooking'])->name('booking.confirm');

    // Retry payment after failure
    Route::post('/booking/{event_id}/retry', [BookingController::class, 'retryBooking'])->name('booking.retry');

    // New: block seat during selection (AJAX)
    Route::post('/booking/block-seat', [BookingController::class, 'blockSeat'])->name('booking.block');
});
