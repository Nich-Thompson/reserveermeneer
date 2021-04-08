<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Film;
use App\Models\Hall;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function show($id)
    {
        $film = Film::find($id);
        $hall = Hall::find($film->hall_id);
        $cinema = Cinema::find($hall->cinema_id);

        if ($film == null) {
            return redirect()->route('getFilmIndex');
        }

        return view('film.details', ['film' => $film, 'cinema' => $cinema]);
    }

    public function create()
    {
        return view('film.create');
    }

    public function store(Request $request)
    {
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

        if ($event == null) {
            return redirect()->route('getEventIndex');
        }

        return view('event.edit', [
            'event' => $event,
            'id' => $id
        ]);
    }

    public function update($id, Request $request)
    {
        $event = Event::find($id);
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->price = $request->input('price');
        $event->max_tickets = $request->input('max_tickets');

        if($request->start_date != null || $request->end_date != null)
        {
            $event->start_date = $request->input('start_date');
            $event->end_date = $request->input('end_date');
        }

        $event->save();

        return redirect()->route('getEventIndex');
    }

    public function delete($id)
    {
        $event =Event::find($id);

        if ($event == null) {
            return redirect()->route('getEventIndex');
        }

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

        if ($event == null) {
            return redirect()->route('getEventIndex');
        }

        return view('event.reserve', [
            'event' => $event,
            'id' => $id
        ]);
    }

    public function reserve(Request $request, $id)
    {
        $event =Event::find($id); // Could also be $request->id

        $startDateTime = new DateTime($request->start_date);
        $endDateTime = new DateTime($request->start_date);
        switch ($request->days_count)
        {
            case '2':
                $endDateTime->modify('+1 day');
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
        EventReservation::create([
            'event_id' => $event->id,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'postal_code' => $request->input('postal_code'),
            'city' => $request->input('city'),
            'img_path' => $request->file->hashName(),
            'start_date' => $request->input('start_date'),
            'end_date' => $endDateTime,
            'ticket_number' => $request->input('ticket_number'),
            'total_price' => $event->price*$days*$request->ticket_number,
        ]);

        return redirect()->route('getEventIndex');
    }
}
