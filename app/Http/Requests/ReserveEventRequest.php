<?php

namespace App\Http\Requests;

use App\Models\Event;
use DateTime;
use Illuminate\Foundation\Http\FormRequest;

class ReserveEventRequest extends FormRequest
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
            'ticket_number' => 'required|gt:0',
            'start_date' => 'required',
            'days_count' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'file.mimes' => 'Dit bestandstype wordt niet ondersteund.',
            'ticket_number.gt' => 'Het aantal tickets moet positief zijn.'
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
                $validator->errors()->add('field', 'Je reservering kan niet eerder beginnen dan het evenement begint.');
            }
            if ($reservationEndDate > $eventEndDate) {
                $validator->errors()->add('field', 'Je reservering kan niet langer duren dan het evenement.');
            }

            if ($this->ticket_number > $event->max_tickets)
            {
                $validator->errors()->add('field', 'Je kunt niet meer tickets kopen dan het maximum.');
            }
        });
    }
}
