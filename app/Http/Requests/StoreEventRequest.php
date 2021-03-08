<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|gt:1',
            'max_tickets' => 'required|gt:1',
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->start_date > $this->end_date) {
                $validator->errors()->add('field', 'De einddatum moet na de startdatum vallen.');
            }
        });
    }

    public function messages()
    {
        return [
            'price.gt' => 'De prijs moet positief zijn.',
            'max_tickets.gt' => 'Het maximum aantal tickets moet positief zijn.'
        ];
    }
}
