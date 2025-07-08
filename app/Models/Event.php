<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'tbl_events';
    protected $primaryKey = 'event_id';

    protected $fillable = [
        'name',
        'description',
        'image',
        'start_date',
        'end_date',
        'price'
    ];
    public function seats()
{
    return $this->hasMany(\App\Models\Seat::class, 'event_id', 'event_id');
}

}
