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

        Event::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'max_tickets' => $request->input('max_tickets'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        return redirect()->route('getEventIndex');
    }

    public function edit($id)
    {
        $event =Event::find($id);
        return view('event.edit', [
            'event' => $event,
            'id' => $id
        ]);
    }

    public function update($id, Request $request)
    {
        $request -> validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'max_tickets' => 'required|min:1',
        ]);

        $event = Event::find($id);
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->price = $request->input('price');
        $event->max_tickets = $request->input('max_tickets');

        if($request->start_date != null || $request->end_date != null)
        {
            $request -> validate([
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            $event->start_date = $request->input('start_date');
            $event->end_date = $request->input('end_date');
        }

        $event->save();

        return redirect()->route('getEventIndex');
    }

    public function delete($id)
    {
        $event =Event::find($id);
        return view('event.delete', [
            'event' => $event,
            'id' => $id
        ]);
    }

    public function destroy($id)
    {
        $event =Event::find($id);

        $event->delete();

        return redirect()->route('getEventIndex');
    }

    public function showReserve()
    {
        //
    }

    public function reserve()
    {
        //
    }
}
