<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    public function index()
    {
        $events =Event::all();
        return view('event.index', [
            'events' => $events
        ]);
    }

    public function show($id)
    {
        $event =Event::find($id);
        return view('event.details', ['event' => $event]);
    }

    public function create()
    {
        return view('event.create');
    }

    public function store()
    {

        return redirect()->route('getEventIndex');
    }
}
