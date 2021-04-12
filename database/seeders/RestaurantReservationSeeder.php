<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RestaurantReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('restaurant_reservations')->insert([
            'restaurant_id' => 1,
            'date' => date("Y-m-d"),
            'time' => "18:00:00",
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10) . "@gmail.com",
            'address' => "Bloemerstraat 17",
            'postal_code' => "6031NV",
            'city' => "Nederweert",
            'waiting_list' => 0,
        ]);

        DB::table('restaurant_reservations')->insert([
            'restaurant_id' => 1,
            'date' => date("Y-m-d"),
            'time' => "18:00:00",
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10) . "@gmail.com",
            'address' => "Bloemerstraat 17",
            'postal_code' => "6031NV",
            'city' => "Nederweert",
            'waiting_list' => 0,
        ]);
        DB::table('restaurant_reservations')->insert([
            'restaurant_id' => 1,
            'date' => date("Y-m-d"),
            'time' => "17:00:00",
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10) . "@gmail.com",
            'address' => "Bloemerstraat 17",
            'postal_code' => "6031NV",
            'city' => "Nederweert",
            'waiting_list' => 0,
        ]);

        DB::table('restaurant_reservations')->insert([
            'restaurant_id' => 2,
            'date' => date("Y-m-d"),
            'time' => "18:00:00",
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10) . "@gmail.com",
            'address' => "Kerkstraat 1",
            'postal_code' => "5531XJ",
            'city' => "Weert",
            'waiting_list' => 0,
        ]);

        DB::table('restaurant_reservations')->insert([
            'restaurant_id' => 2,
            'date' => date("Y-m-d"),
            'time' => "18:00:00",
            'firstname' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10) . "@gmail.com",
            'address' => "Schoolstraat 5",
            'postal_code' => "6039NV",
            'city' => "Tilburg",
            'waiting_list' => 0,
        ]);
    }
}
