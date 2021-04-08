<?php

namespace App\Http\Requests;

use App\Models\Event;
use DateTime;
use Illuminate\Foundation\Http\FormRequest;

class ReserveEventRequestEnglish extends FormRequest
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
            'file' => 'required|mimes:jpeg,png',
            'email' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'ticket_number' => 'required|gt:0',
            'start_date' => 'required',
            'days_count' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'file.mimes' => 'This file type is not supported.',
            'ticket_number.gt' => 'The ticket amount must be positive.'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            //$date = new DateTime(date("Y-m-d"));
            //date_modify($date, "+1 day");
            $event = Event::find($this->id);
            $eventStartDate = new DateTime($event->start_date);
            $eventStartDate->setTime(0, 0);
            $eventEndDate = new DateTime($event->end_date);

            $reservationStartDate = new DateTime($this->start_date);
            $reservationEndDate = new DateTime($this->start_date);
            switch ($this->days_count)
            {
                case '2':
                    $reservationEndDate->modify('+1 day');
                    break;
                case '3':
                    $reservationEndDate = new DateTime($event->end_date);
                    $reservationEndDate->setTime(0, 0);
                default:
                    break;
            }
            //var_dump($event);
            if ($reservationStartDate < $eventStartDate) {
                $validator->errors()->add('field', 'Your reservation cannot start before the event does.');
            }
            if ($reservationEndDate > $eventEndDate) {
                $validator->errors()->add('field', 'Your reservation cannot last longer than the event.');
            }

            if ($this->ticket_number > $event->max_tickets)
            {
                $validator->errors()->add('field', 'You cannot purchase more tickets than the maximum.');
            }
        });
    }
}
