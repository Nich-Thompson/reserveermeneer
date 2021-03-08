<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use App\Models\Film;
use App\Models\Reservation;
use DateTime;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    public function index()
    {
        $events =Event::all();
        $films = Film::all();
        return view('event.index', [
            'events' => $events,
            'films' => $films
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

    public function store(StoreEventRequest $request)
    {
        $request -> validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'max_tickets' => 'required|gt:1',
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
            'max_tickets' => 'required|gt:0',
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

    public function showReserve($id)
    {
        $event =Event::find($id);
        return view('event.reserve', [
            'event' => $event,
            'id' => $id
        ]);
    }

    public function reserve(Request $request, $id)
    {
        $event =Event::find($id);

        $request->validate([
            'name' => 'required',
            'file' => 'required|mimes:jpeg,png',
            'email' => 'required',
            'start_date' => 'required',
            'days_count' => 'required',
        ]);

        $startDateTime = new DateTime($request->start_date);
        $endDateTime = new DateTime($request->start_date);
        switch ($request->days_count)
        {
            case '1':
                $endDateTime->modify('+1 day');
                break;
            case '2':
                $endDateTime->modify('+2 day');
                break;
            case '3':
                $endDateTime = new DateTime($event->end_date);
            default:
                break;
        }
        $interval = $startDateTime->diff($endDateTime);
        $days = 1 + $interval->format('%a');

        // Save the file locally in storage/public/reservation
        $request->file->store('reservation', 'public');

        // Save hash to db
        Reservation::create([
            'event_id' => $event->id,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'img_path' => $request->file->hashName(),
            'start_date' => $request->input('start_date'),
            'end_date' => $endDateTime,
            'total_price' => $event->price*$days,
        ]);
        /*$reservation = new Reservation([
            "name" => $request->get('name'),
            "img_path" => $request->file->hashName()
        ]);
        $reservation->save();*/

        return redirect()->route('getEventIndex');
    }
}
