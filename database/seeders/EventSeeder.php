<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::create([
            'title' => 'Ballonnenbrigade',
            'description' => 'Dit jaarlijkse feest is 1 dag vol pret in het thema van ballonnen.',
            'price' => '5.00',
            'max_tickets' => '100',
            'start_date' => '2021-07-01 09:00:00',
            'end_date' => '2021-07-01 19:00:00',
            'address' => 'Hildebrandstraat 12',
            'city' => 'Den Bosch',
        ]);

        Event::create([
            'title' => 'Optreden van de Beatles (coverband)',
            'description' => 'Luister 2 dagen naar deze mannen hun geweldige performance.',
            'price' => '10.00',
            'max_tickets' => '100',
            'start_date' => '2021-06-01 16:00:00',
            'end_date' => '2021-06-03 22:00:00',
            'address' => 'Titaniumstraat 14',
            'city' => 'Nederweert',
        ]);

        Event::create([
            'title' => 'Paarspop',
            'description' => 'Dit festival is een week vol met geweldige muziek.',
            'price' => '15.00',
            'max_tickets' => '100',
            'start_date' => '2021-05-02 12:00:00',
            'end_date' => '2021-05-09 18:00:00',
            'address' => 'Hoefstraat 6',
            'city' => 'Tilburg',
        ]);


    }
}
