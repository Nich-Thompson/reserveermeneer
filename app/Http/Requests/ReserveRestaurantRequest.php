<?php

namespace App\Http\Requests;

use App\Helper\Helper;
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

            $open_time = strtotime((new \App\Helper\Helper)->get_restaurant_opening_time($this->date, $restaurant));
            $close_time = strtotime((new \App\Helper\Helper)->get_restaurant_closing_time($this->date, $restaurant));

            if ($unixtime < $open_time) {
                $validator->errors()->add('field', 'Het restaurant opent pas om ' . date("H:i", $open_time) . ", dit ligt na het gekozen tijdstip.");
            }

            if ($unixtime > $close_time) {
                $validator->errors()->add('field', 'Het restaurant sluit om ' . date("H:i", $close_time) . ", dit is eerder dan het gekozen tijdstip.");
            }
            if ($unixtime < strtotime(date("H:i"))) {
                $validator->errors()->add('field', "De combinatie van het tijdstip en de datum ligt in het verleden.");
            }
        });
    }
}
