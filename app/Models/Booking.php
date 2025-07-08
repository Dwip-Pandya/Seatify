<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'tbl_bookings';
    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'user_id',
        'event_id',
        'booking_date',
        'total_amount',
        'pdf_path',
        'payment_status',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    public function seats()
    {
        return $this->belongsToMany(Seat::class, 'tbl_booking_seats', 'booking_id', 'seat_id');
    }
}
