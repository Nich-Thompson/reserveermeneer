<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveRestaurantRequest;
use App\Models\Restaurant;
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
        dd("nog maken");
    }

    public function create()
    {
        //
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
