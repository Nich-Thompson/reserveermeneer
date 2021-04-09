<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveRestaurantRequest;
use App\Mail\RestaurantEmail;
use App\Models\Restaurant;
use App\Models\RestaurantReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $restaurants = null;
        $category = $request->category;

        if ($category != null) {
            $restaurants = Restaurant::where("type", $category)->get();
        } else {
            $restaurants = Restaurant::all();
        }

        $categories = Restaurant::select("type")->distinct()->get();
        return view('restaurants.index', ['restaurants' => $restaurants, "categories" => $categories]);
    }

    public function showReserve($id)
    {
        $restaurant = Restaurant::find($id);

        if ($restaurant == null) {
            return redirect("/restaurants");
        }

        return view('restaurants.reserve', [
            'restaurant' => $restaurant,
            'id' => $id
        ]);
    }

    public function reserve(ReserveRestaurantRequest $request, $id)
    {
        $count = RestaurantReservation::where("date", "=", $request->date)->where("time", "=", $request->time)->count();
        $add_to_waiting_list = false;

        if ($count >= 10) {
            $add_to_waiting_list = true;
        }

        RestaurantReservation::create([
            "restaurant_id" => $id,
            "date" => $request->date,
            "time" => $request->time,
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "email" => $request->email,
            "address" => $request->address,
            "postal_code" => $request->postal_code,
            "city" => $request->city,
            "waiting_list" => $add_to_waiting_list,
        ]);

        $restaurant = Restaurant::find($id);

        $data = ['subject' => 'Reservering ontvangen', "restaurant" => $restaurant,
            "firstname" => $request->firstname, "lastname" => $request->lastname, "email" => $request->email,
            "date" => $request->date, "time" => $request->time,
            "waiting_list" => $add_to_waiting_list];

        Mail::to($request->email)->send(new RestaurantEmail($data));

        return redirect('/restaurants')->with('status', "Bedankt voor je reservering op " . $request->date . " om " . $request->time . "!");
    }

    public function dashboard(Request $request)
    {
        $date = date("Y-m-d");
        $restaurant = null;

        if ($request->restaurant != null) {
            $restaurant = Restaurant::find($request->restaurant);
            if ($restaurant == null) {
                return redirect('/dashboard')->with('status', "Het gekozen restaurant bestaat niet!");
            }
        } else {
            $restaurant = \App\Models\Restaurant::first();
        }

        if ($request->date != null) {
            $date = $request->date;
        }

        $restaurants = \App\Models\Restaurant::all();

        $open_time = (new \App\Helper\Helper)->get_restaurant_opening_time($date, $restaurant);
        $close_time = (new \App\Helper\Helper)->get_restaurant_closing_time($date, $restaurant);

        $reservations = \App\Models\RestaurantReservation::where("restaurant_id", "=", $restaurant->id)->where("date", "=", $date)->get();

        return view('dashboard', ["restaurants" => $restaurants, "reservations" => $reservations,
            "restaurant" => $restaurant, "date" => $date, "open_time" => $open_time, "close_time" => $close_time]);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Restaurant $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Restaurant $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Restaurant $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Restaurant $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
