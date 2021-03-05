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

    public function store(Request $request)
    {
        $request -> validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'max_tickets' => 'required|min:1',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        return redirect()->route('getEventIndex');
    }
}
