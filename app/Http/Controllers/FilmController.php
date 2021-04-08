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
        Film::create([
            'hall_id' => $request->input('hall_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
        ]);

        return redirect()->route('getFilmIndex');
    }

    public function edit($id)
    {
        $film = Film::find($id);

        if ($film == null) {
            return redirect()->route('getFilmIndex');
        }

        return view('film.edit', [
            'film' => $film,
            'id' => $id
        ]);
    }

    public function update($id, Request $request)
    {
        $film = Film::find($id);
        $film->title = $request->input('title');
        $film->description = $request->input('description');
        $film->price = $request->input('price');
        $film->max_tickets = $request->input('max_tickets');

        if($request->start_time != null || $request->end_time != null)
        {
            $film->start_time = $request->input('start_time');
            $film->end_time = $request->input('end_time');
        }

        $film->save();

        return redirect()->route('getFilmIndex');
    }

    public function delete($id)
    {
        $film = Film::find($id);

        if ($film == null) {
            return redirect()->route('getFilmIndex');
        }

        return view('film.delete', [
            'film' => $film,
            'id' => $id
        ]);
    }

    public function destroy($id)
    {
        $film = Film::find($id);

        $film->delete();

        return redirect()->route('getFilmIndex');
    }

    public function showReserve($id)
    {
        $film = Film::find($id);

        if ($film == null) {
            return redirect()->route('getFilmIndex');
        }

        return view('film.reserve', [
            'film' => $film,
            'id' => $id
        ]);
    }

    public function reserve(Request $request, $id)
    {
//        $event =Event::find($id); // Could also be $request->id
//
//        $startDateTime = new DateTime($request->start_date);
//        $endDateTime = new DateTime($request->start_date);
//        switch ($request->days_count)
//        {
//            case '2':
//                $endDateTime->modify('+1 day');
//                break;
//            case '3':
//                $endDateTime = new DateTime($event->end_date);
//            default:
//                break;
//        }
//        $interval = $startDateTime->diff($endDateTime);
//        $days = 1 + $interval->format('%a');
//
//        // Save the file locally in storage/public/reservation
//        $request->file->store('reservation', 'public');
//
//        // Save hash to db
//        EventReservation::create([
//            'event_id' => $event->id,
//            'name' => $request->input('name'),
//            'email' => $request->input('email'),
//            'address' => $request->input('address'),
//            'postal_code' => $request->input('postal_code'),
//            'city' => $request->input('city'),
//            'img_path' => $request->file->hashName(),
//            'start_date' => $request->input('start_date'),
//            'end_date' => $endDateTime,
//            'ticket_number' => $request->input('ticket_number'),
//            'total_price' => $event->price*$days*$request->ticket_number,
//        ]);

        return redirect()->route('getFilmIndex');
    }
}
