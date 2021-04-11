<?php

namespace Tests\Unit;

use App\Http\Requests\ReserveRestaurantRequest;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class UpdateEventTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_update_event()
    {
        $this->assertTrue(true);
    }

    public function provideValidData(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[
                'name' => 'Event naam',
                'description' => 'Een mooie beschrijving',
                'price' => '11',
                'max_tickets' => '58',
            ]],
            [[
                'name' => $faker->title,
                'description' => $faker->sentence,
                'price' => $faker->randomDigit + 1,
                "max_tickets" => $faker->randomDigit + 1,
            ]],
        ];
    }
}
