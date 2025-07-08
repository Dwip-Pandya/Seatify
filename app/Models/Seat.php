<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $table = 'tbl_seats';
    protected $primaryKey = 'seat_id';

    protected $fillable = [
    'event_id',
    'row',
    'number',
    'category',
    'price'
];

}
