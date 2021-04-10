<?php

namespace App\Http\Requests;

use App\Models\Film;
use App\Models\FilmReservation;
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
            // check if seat is unoccupied
            $filmSeat = FilmSeat::query()->where([
                ['id', '=', $this->seat_id],
                ['occupied', '=', '1']
            ])->first();

            if ($filmSeat) {
                $validator->errors()->add('field', 'Deze stoel is al bezet.');
            }

            // check if user does not already have a film reservation for this time
            $previousReservations = FilmReservation::query()->where([
                ['name', '=', $this->name],
                ['email', '=', $this->email],
                ['address', '=', $this->address],
                ['postal_code', '=', $this->postal_code],
                ['city', '=', $this->city]
            ])->get();

            $previousFilms = Film::query()->whereIn('id', array_column($previousReservations->toArray(), 'film_id'))->get()->toArray();

            $newFilm = Film::where('id', $this->id)->first();

            foreach ($previousFilms as $film) {
                $oldStartDate = strtotime($film['start_date']);
                $oldEndDate = strtotime($film['end_date']);
                $newStartDate = strtotime($newFilm->start_date);
                $newEndDate = strtotime($newFilm->end_date);
                if (
                    ($newStartDate > $oldStartDate && $newStartDate < $oldEndDate) ||
                    ($newEndDate > $oldStartDate && $newStartDate < $oldEndDate) ||
                    ($newStartDate < $oldStartDate && $newEndDate > $oldEndDate))
                {
                    $validator->errors()->add('field', 'Je hebt al een reservatie binnen deze tijd.');
                }
            }
        });
    }
}
