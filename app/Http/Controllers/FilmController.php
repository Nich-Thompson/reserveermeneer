<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveFilmRequest;
use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
use App\Models\Cinema;
use App\Models\Film;
use App\Models\FilmReservation;
use App\Models\FilmSeat;
use App\Models\Hall;
use App\Models\Seat;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function show($id)
    {
        $film = Film::find($id);
        $hall = Hall::find($film->hall_id);
        $cinema = Cinema::find($hall->cinema_id);

        if ($film == null) {
            return redirect()->route('getEventIndex');
        }

        return view('film.details', ['film' => $film, 'cinema' => $cinema]);
    }

    public function create()
    {
        return view('film.create');
    }

    public function store(StoreFilmRequest $request)
    {
        $film = Film::create([
            'hall_id' => $request->input('hall_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        $seats = Seat::where('hall_id', $film->hall_id)->get();
        foreach ($seats as $seat) {
            FilmSeat::create([
                'film_id' => $film->id,
                'seat_id' => $seat->id,
                'x' => $seat->x,
                'y' => $seat->y,
                'occupied' => '0'
            ]);
        }

        return redirect()->route('getEventIndex');
    }

    public function edit($id)
    {
        $film = Film::find($id);

        if ($film == null) {
            return redirect()->route('getEventIndex');
        }

        return view('film.edit', [
            'film' => $film,
            'id' => $id
        ]);
    }

    public function update($id, UpdateFilmRequest $request)
    {
        $film = Film::find($id);
        $film->name = $request->input('name');
        $film->description = $request->input('description');
        $film->hall_id = $request->input('hall_id');

        if($request->start_date != null || $request->end_date != null)
        {
            $film->start_date = $request->input('start_date');
            $film->end_date = $request->input('end_date');
        }

        $film->save();

        return redirect()->route('getEventIndex');
    }

    public function delete($id)
    {
        $film = Film::find($id);

        if ($film == null) {
            return redirect()->route('getEventIndex');
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

        return redirect()->route('getEventIndex');
    }

    public function showReserve($id)
    {
        $film = Film::find($id);
        $seats = FilmSeat::where('film_id', $film->id)->get();
        $maxX = $seats->max('x');
        $maxY = $seats->max('y');

        if ($film == null) {
            return redirect()->route('getEventIndex');
        }

        return view('film.reserve', [
            'film' => $film,
            'seats' => $seats,
            'maxX' => $maxX,
            'maxY' => $maxY,
            'id' => $id
        ]);
    }

    public function reserve(ReserveFilmRequest $request, $id)
    {
        FilmReservation::create([
            'film_id' => $id,
            'seat_id' => $request->input('seat_id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'postal_code' => $request->input('postal_code'),
            'city' => $request->input('city'),
        ]);

        // occupy the selected seat
        $filmSeat = FilmSeat::find($request->input('seat_id'));
        $filmSeat->occupied = 1;
        $filmSeat->save();
        // occupy the seat left to the selected one
        $x = $filmSeat->x;
        $y = $filmSeat->y;
        $leftSeat = FilmSeat::query()->where([
            ['film_id', '=', $id],
            ['x', '=', $x - 1],
            ['y', '=', $y]
        ])->first();
        if ($leftSeat) {
            $leftSeat->occupied = 1;
            $leftSeat->save();
        }
        // occupy the right seat
        $rightSeat = FilmSeat::query()->where([
            ['film_id', '=', $id],
            ['x', '=', $x + 1],
            ['y', '=', $y]
        ])->first();
        if ($rightSeat) {
            $rightSeat->occupied = 1;
            $rightSeat->save();
        }

        return redirect()->route('getEventIndex');
    }
}
