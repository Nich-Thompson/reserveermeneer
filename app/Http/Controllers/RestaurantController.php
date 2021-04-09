<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveRestaurantRequest;
use App\Models\Restaurant;
use App\Models\RestaurantReservation;
use Illuminate\Http\Request;

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

        $reservations = \App\Models\RestaurantReservation::where("restaurant_id", "=", $restaurant->id)->where("date", "=", $date)->get();

        return view('dashboard', ["restaurants" => $restaurants, "reservations" => $reservations,
            "restaurant" => $restaurant, "date" => $date]);
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
