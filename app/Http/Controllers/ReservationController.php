<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventReservation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = EventReservation::all();
        return view('reservation.index', [
            'reservations' => $reservations,
        ]);
    }

    function exportCsv()
    {
        $array = EventReservation::all()->toArray();

        if (count($array) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("reservations.csv", 'w');
        fputcsv($df, array_keys(reset($array)));
        foreach ($array as $row) {
            fputcsv($df, $row);
        }
        fclose($df);

//        return ob_get_clean();
        return Response::download('reservations.csv');

//        $data = EventReservation::all()->toArray();
//        $file = fopen('reservations.csv', 'w');
//
//        fputcsv($file, array('id', 'event_id', 'name', 'email', 'img_path', 'start_date', 'end_date', 'ticket_number', 'total_price', 'created_at', 'updated_at'));
//
//        foreach ($data as $row) {
//            fputcsv($file, $row);
//        }
//        fclose($file);
//
//        return Response::download('reservations.csv');
    }
}
