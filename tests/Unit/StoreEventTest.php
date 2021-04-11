<?php

namespace Tests\Unit;

use App\Http\Requests\StoreEventRequest;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;

class StoreEventTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }
    /**
     * @dataProvider provideValidData
     *
     */
    public function test_valid(array $data)
    {
        $request = new StoreEventRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function provideValidData(): array
    {
        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        return [
            [[
                "name" => "Feest",
                "description" => 'Een groot feest.',
                "price" => '5.75',
                "max_tickets" => '3',
                "start_date" => '02-06-2050',
                "end_date" => '12-06-2050',
                "address" => 'Straatnaamstraat 1',
                "city" => 'Stad',
            ]],
            [[
                "name" => $faker->title,
                "description" => $faker->sentence,
                "price" => '5',
                "max_tickets" => $faker->randomDigit,
                "start_date" => '02-06-2050',
                "end_date" => '12-06-2050',
                "address" => $faker->address,
                "city" => $faker->word,
            ]],
        ];
    }

    public function provideInvalidData()
    {
    }
}
