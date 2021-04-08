<?php

namespace App\Http\Requests;

use App\Models\Restaurant;
use Illuminate\Foundation\Http\FormRequest;

class ReserveRestaurantRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "date" => "required|date|after_or_equal:today",
            "time" => 'required|date_format:H:i',
            "firstname" => 'required',
            "lastname" => 'required',
            "email" => 'required|email:rfc,dns',
            "address" => 'required',
            "postal_code" => 'required',
            "city" => 'required',
        ];
    }

    public function messages()
    {
        return [
            'date.after_or_equal' => 'De datum van de reservering moet vandaag of later zijn.',
            'email.email' => 'Er moet een valide emailadres ingevuld worden.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $unixtime = strtotime($this->time);
            $minutes = date("i", $unixtime);

            if (strcmp($minutes, "00") != 0 && strcmp($minutes, "30") != 0) {
                $validator->errors()->add('field', 'De tijd van een reservering kan alleen vallen op hele of halve uren (00 of 30).');
            }

            $restaurant = Restaurant::find($this->id);

            $day_of_week = date('w', strtotime($unixtime));

            $open_time = null;
            $close_time = null;

            switch ($day_of_week) {
                case 0:
                    $open_time = strtotime($restaurant->sunday_opening_time);
                    $close_time = strtotime($restaurant->sunday_closing_time);
                    break;
                case 1:
                    $open_time = strtotime($restaurant->monday_opening_time);
                    $close_time = strtotime($restaurant->monday_closing_time);
                    break;
                case 2:
                    $open_time = strtotime($restaurant->tuesday_opening_time);
                    $close_time = strtotime($restaurant->tuesday_closing_time);
                    break;
                case 3:
                    $open_time = strtotime($restaurant->wednesday_opening_time);
                    $close_time = strtotime($restaurant->wednesday_closing_time);
                    break;
                case 4:
                    $open_time = strtotime($restaurant->thursday_opening_time);
                    $close_time = strtotime($restaurant->thursday_closing_time);
                    break;
                case 5:
                    $open_time = strtotime($restaurant->friday_opening_time);
                    $close_time = strtotime($restaurant->friday_closing_time);
                    break;
                case 6:
                    $open_time = strtotime($restaurant->saturday_opening_time);
                    $close_time = strtotime($restaurant->saturday_closing_time);
                    break;
                default:
                    $open_time = strtotime("00:00");
                    $close_time = strtotime("00:00");
                    break;
            }

            if ($unixtime < $open_time) {
                $validator->errors()->add('field', 'Het restaurant opent pas om ' . date("H:i", $open_time) . ", dit ligt na het gekozen tijdstip.");
            }

            if ($unixtime > $close_time) {
                $validator->errors()->add('field', 'Het restaurant sluit om ' . date("H:i", $close_time) . ", dit is eerder dan het gekozen tijdstip.");
            }
        });
    }
}
