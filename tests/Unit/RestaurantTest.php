<?php

namespace Tests\Unit;

use App\Http\Requests\ReserveRestaurantRequest;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class RestaurantTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_valid_firstname(array $data)
    {
        $request = new ReserveRestaurantRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function provideValidData(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[
                "date" => "02-06-2021",
                "time" => '17:00',
                "firstname" => 'Wesley',
                "lastname" => 'salimans',
                "email" => 'wesley@gmail.com',
                "address" => 'Bloemerstraat 17',
                "postal_code" => '6031NV',
                "city" => 'Nederweert',
            ]],
            [[
                "date" => "02-06-2021",
                "time" => '17:00',
                "firstname" => $faker->firstName,
                "lastname" => $faker->lastName,
                "email" => $faker->email,
                "address" => $faker->address,
                "postal_code" => $faker->postcode,
                "city" => $faker->city,
            ]],
        ];
    }

}
