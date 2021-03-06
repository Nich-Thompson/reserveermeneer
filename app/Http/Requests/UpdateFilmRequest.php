<?php

namespace App\Http\Requests;

use App\Models\Hall;
use DateTime;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFilmRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Naam mag niet leeg zijn.',
            'description.required' => 'Beschrijving mag niet leeg zijn.',
            'hall_id.required' => 'Halnummer mag niet leeg zijn.',
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

            if($this->start_date != null || $this->end_date != null)
            {
                $validator->after(function ($validator) {
                    if($this->start_date == null || $this->end_date == null) {
                        $validator->errors()->add('field', 'Je moet beide data invullen als je deze wilt veranderen.');
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
        });
    }
}
