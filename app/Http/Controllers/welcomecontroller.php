<?php

namespace App\Http\Controllers;

use App\Models\Event;

class WelcomeController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('start_date', 'asc')->take(3)->get();
        return view('welcome', compact('events'));
    }
}
