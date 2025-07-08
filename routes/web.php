<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserEventController;
use App\Http\Controllers\Frontend\BookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Welcome page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Admin area
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [EventController::class, 'dashboard'])->name('dashboard');  // For admin dashboard
    Route::resource('events', EventController::class); // Event management
    Route::resource('seats', SeatController::class); // Seat management
});

// Frontend user area
Route::prefix('frontend')->name('frontend.')->group(function () {

    // Events listing page
    Route::get('/', [UserEventController::class, 'index'])->name('events.index');

    // Single event detail page
    Route::get('/events/{event_id}', [UserEventController::class, 'show'])->name('events.show');

    // Booking: seat selection page
    Route::get('/booking/{event_id}', [BookingController::class, 'selectSeats'])->name('booking.select');

    // Booking confirmation (after selecting and paying)
    Route::post('/booking/{event_id}/confirm', [BookingController::class, 'confirmBooking'])->name('booking.confirm');
    // if payment fails
    Route::post('/booking/{event_id}/retry', [BookingController::class, 'retryBooking'])->name('booking.retry');
});
