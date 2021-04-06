<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventReservation;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations =EventReservation::all();
        return view('reservation.index', [
            'reservations' => $reservations,
        ]);
    }
}
