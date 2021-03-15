<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Restaurant::create([
            "name" => "Diverso",
            "opening_time" => "12:00",
            "closing_time" => "20:30",
            "amount_of_seats" => "123"]);

        Restaurant::create([
            "name" => "Denver",
            "opening_time" => "14:00",
            "closing_time" => "22:30",
            "amount_of_seats" => "50"]);

        Restaurant::create([
            "name" => "The Steak Company",
            "opening_time" => "17:00",
            "closing_time" => "23:30",
            "amount_of_seats" => "87"]);

        Restaurant::create([
            "name" => "ABC",
            "opening_time" => "10:00",
            "closing_time" => "22:30",
            "amount_of_seats" => "62"]);
    }
}
