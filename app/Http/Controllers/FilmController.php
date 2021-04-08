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
}
