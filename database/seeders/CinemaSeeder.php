<?php

namespace Database\Seeders;

use App\Models\Cinema;
use App\Models\Film;
use App\Models\FilmSeat;
use App\Models\Hall;
use App\Models\Seat;
use Illuminate\Database\Seeder;

class CinemaSeeder extends Seeder
{
    private const minWidth = 5;
    private const minHeight = 7;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Cinema::create([
            'name' => 'Pastei'
        ]);
        Cinema::create([
            'name' => 'Filmorama'
        ]);

        Hall::create([
            'cinema_id' => '1'
        ]);
        Hall::create([
            'cinema_id' => '1'
        ]);
        Hall::create([
            'cinema_id' => '1'
        ]);
        Hall::create([
            'cinema_id' => '2'
        ]);
        Hall::create([
            'cinema_id' => '2'
        ]);
        Hall::create([
            'cinema_id' => '2'
        ]);

        // for each hall, create an increasing number of seats
        for ($i = 0; $i < 6; $i++) {
            for ($y = 0; $y < (self::minHeight + $i); $y++) {
                for ($x = 0; $x < (self::minWidth + $i); $x++) {
                    Seat::create([
                        'hall_id' => ($i + 1),
                        'x' => $x,
                        'y' => $y,
                    ]);
                }
            }
        }

        Film::create([
            'hall_id' => '1',
            'name' => 'The Best Movie Ever',
            'description' => 'Twee filmgekken gaan op zoektocht naar de beste film ooit. Zullen ze hem vinden?',
            'start_time' => '2021-06-01 10:00:00',
            'end_time' => '2021-06-01 11:40:00'
        ]);
        Film::create([
            'hall_id' => '1',
            'name' => 'Volledig Metalen Jas',
            'description' => 'Deze klassieke oorlogsfilm toont de nasleep van de oorlog in Vietnam.',
            'start_time' => '2021-06-01 12:00:00',
            'end_time' => '2021-06-01 13:40:00'
        ]);
        Film::create([
            'hall_id' => '2',
            'name' => 'Pop Fiction',
            'description' => 'Een anthologie van recente pop culture scenarios.',
            'start_time' => '2021-06-01 14:00:00',
            'end_time' => '2021-06-01 15:40:00'
        ]);
        Film::create([
            'hall_id' => '2',
            'name' => 'Space Wars',
            'description' => 'De balans van het universum komt in gevaar wanneer er een rebellengroep opduikt.',
            'start_time' => '2021-06-01 16:00:00',
            'end_time' => '2021-06-01 17:40:00'
        ]);
        Film::create([
            'hall_id' => '3',
            'name' => 'The Untouchables',
            'description' => 'Een man met een smetallergie zorgt ervoor dat niemand hem kan aanraken.',
            'start_time' => '2021-06-01 18:00:00',
            'end_time' => '2021-06-01 19:40:00'
        ]);
        Film::create([
            'hall_id' => '3',
            'name' => 'Leon Chameleon',
            'description' => 'Een Fransman verdwijnt in het niets op wereldwijde televisie. Wat is er gebeurt?',
            'start_time' => '2021-06-02 10:00:00',
            'end_time' => '2021-06-02 11:40:00'
        ]);
        Film::create([
            'hall_id' => '4',
            'name' => 'Psycho in Oeterwaal',
            'description' => 'Deze film van Nederlandse bodem toont het echte verhaal van Laurens G. uit 1972.',
            'start_time' => '2021-06-02 12:00:00',
            'end_time' => '2021-06-02 13:40:00'
        ]);
        Film::create([
            'hall_id' => '4',
            'name' => 'The Arachnoid',
            'description' => 'Wanneer een man wordt gebeten door een spin zal zijn leven nooit meer hetzelfde zijn.',
            'start_time' => '2021-06-02 14:00:00',
            'end_time' => '2021-06-02 15:40:00'
        ]);
        Film::create([
            'hall_id' => '5',
            'name' => 'Keepsake',
            'description' => 'Een man wordt wakker en weet niets meer, niet eens zijn eigen naam. De enige aanwijzing die hij heeft is een aandenken van een mysterieuze vrouw.',
            'start_time' => '2021-06-02 16:00:00',
            'end_time' => '2021-06-02 17:40:00'
        ]);
        Film::create([
            'hall_id' => '5',
            'name' => 'The Lighting',
            'description' => 'Wanneer dit gezin naar hun zomerhuis gaat had niemand kunnen verwachten wat daar zou gebeuren...',
            'start_time' => '2021-06-02 18:00:00',
            'end_time' => '2021-06-02 19:40:00'
        ]);
        Film::create([
            'hall_id' => '6',
            'name' => 'De Marsman',
            'description' => 'Deze anthologie laat echt gefilmde footage van aliens in Nederland zien.',
            'start_time' => '2021-06-01 20:00:00',
            'end_time' => '2021-06-01 21:40:00'
        ]);
        Film::create([
            'hall_id' => '6',
            'name' => 'Scary Movie 472',
            'description' => 'Ooooooooohhhh scaryyyyyyyy...',
            'start_time' => '2021-06-02 20:00:00',
            'end_time' => '2021-06-02 21:40:00'
        ]);

        // for each film, create seats
        $films = Film::all();
        foreach ($films as $film) {
//            $hall = Hall::query()->where('id', equalTo($film->hall_id))->first();
//            $seats = Seat::query()->where('hall_id', equalTo($film->hall_id))->get();
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
        }
    }
}
