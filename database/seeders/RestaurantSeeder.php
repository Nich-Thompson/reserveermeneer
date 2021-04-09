<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    public function run()
    {
        Restaurant::create([
            "name" => "Diverso",
            "type" => "Italiaans",
            "monday_opening_time" => "14:00",
            "monday_closing_time" => "20:30",
            "tuesday_opening_time" => "12:00",
            "tuesday_closing_time" => "22:30",
            "wednesday_opening_time" => "12:00",
            "wednesday_closing_time" => "20:30",
            "thursday_opening_time" => "12:00",
            "thursday_closing_time" => "20:30",
            "friday_opening_time" => "12:00",
            "friday_closing_time" => "20:30",
            "saturday_opening_time" => "12:00",
            "saturday_closing_time" => "23:30",
            "sunday_opening_time" => "12:00",
            "sunday_closing_time" => "23:30",
            "amount_of_seats" => "123"]);

        Restaurant::create([
            "name" => "Denver",
            "type" => "Amerikaans",
            "monday_opening_time" => "17:00",
            "monday_closing_time" => "22:30",
            "tuesday_opening_time" => "17:00",
            "tuesday_closing_time" => "22:30",
            "wednesday_opening_time" => "17:00",
            "wednesday_closing_time" => "22:30",
            "thursday_opening_time" => "17:00",
            "thursday_closing_time" => "22:30",
            "friday_opening_time" => "17:00",
            "friday_closing_time" => "22:30",
            "saturday_opening_time" => "17:00",
            "saturday_closing_time" => "23:30",
            "sunday_opening_time" => "17:00",
            "sunday_closing_time" => "23:30",
            "amount_of_seats" => "225"]);
    }
}
