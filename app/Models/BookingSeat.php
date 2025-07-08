<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSeat extends Model
{
    use HasFactory;

    protected $table = 'tbl_booking_seats';
    protected $primaryKey = 'booking_seat_id';
    public $timestamps = false; // no created_at / updated_at
}
