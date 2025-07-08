<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('start_date', 'desc')->take(3)->get();
        return view('frontend.home', compact('events'));
    }
}
