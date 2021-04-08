<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveEventRequest;
use App\Http\Requests\ReserveEventRequestEnglish;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\Film;
use App\Models\EventReservation;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        if ($event == null) {
            return redirect()->route('getEventIndex');
        }

        return view('event.details', ['event' => $event]);
    }

    public function create()
    {
        return view('event.create');
    }

    public function store(StoreEventRequest $request)
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

    public function update($id, UpdateEventRequest $request)
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

    public function reserve(ReserveEventRequest $request, $id)
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

    public function showReserveEnglish($id)
    {
        $event =Event::find($id);
        return view('event.reserve-english', [
            'event' => $event,
            'id' => $id
        ]);
    }

    public function reserveEnglish(ReserveEventRequestEnglish $request, $id)
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
//        Log::info($request->input('address'));

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
