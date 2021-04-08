<?php

namespace App\Http\Requests;

use App\Models\FilmSeat;
use Illuminate\Foundation\Http\FormRequest;

class ReserveFilmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'seat_id' => 'required|gt:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Naam mag niet leeg zijn.',
            'email.required' => 'E-mail mag niet leeg zijn.',
            'address.required' => 'Adres mag niet leeg zijn.',
            'postal_code.required' => 'Postcode mag niet leeg zijn.',
            'city.required' => 'Stad mag niet leeg zijn.',
            'seat_id.required' => 'Kies een stoel.',
            'seat_id.gt' => 'Kies een stoel.'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $filmSeat = FilmSeat::find($this->seat_id);
            if ($filmSeat) {
                $validator->errors()->add('field', 'Deze stoel is al bezet.');
            }
        });
    }
}
