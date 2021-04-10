<?php

namespace App\Http\Requests;

use App\Models\Film;
use App\Models\Hall;
use DateTime;
use Illuminate\Foundation\Http\FormRequest;

class StoreFilmRequest extends FormRequest
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
            'description' => 'required',
            'hall_id' => 'required|gt:0',
            'start_date' => 'required',
            'end_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Naam mag niet leeg zijn.',
            'description.required' => 'Beschrijving mag niet leeg zijn.',
            'hall_id.required' => 'Halnummer mag niet leeg zijn.',
            'start_date.required' => 'Starttijd mag niet leeg zijn.',
            'end_date.required' => 'Eindtijd mag niet leeg zijn.',
            'hall_id.gt' => 'Halnummer moet positief zijn.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // check if hall exists
            $hall = Hall::find($this->hall_id);
            if (!$hall) {
                $validator->errors()->add('field', 'Deze hal bestaat niet.');
            }

            // check if hall doesnt have 3 films for this date already
            $filmDate = Date('Y-m-d', strtotime($this->start_date));
            $filmsOnDate = Film::query()->where([
                ['hall_id', '=', $this->hall_id]
            ])->whereDate('start_date', '=', $filmDate)->get()->count();
            if ($filmsOnDate >= 3) {
                $validator->errors()->add('field', 'Er mogen maar 3 films per dag in 1 zaal gespeeld worden.');
            }

            if ($this->start_date > $this->end_date) {
                $validator->errors()->add('field', 'De eindtijd moet na de startdatum vallen.');
            }
            $date = new DateTime(date("Y-m-d"));
            date_modify($date, "+1 day");
            $startDate = new DateTime($this->start_date);
            if ($date >= $startDate) {
                $validator->errors()->add('field', 'De starttijd moet na vandaag vallen.');
            }
        });
    }
}
