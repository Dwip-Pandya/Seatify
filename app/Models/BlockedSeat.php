<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockedSeat extends Model
{
    use HasFactory;

    protected $table = 'tbl_blocked_seats';
    protected $primaryKey = 'blocked_seat_id';
    public $timestamps = false; // no created_at / updated_at
}
