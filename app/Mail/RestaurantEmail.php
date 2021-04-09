<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RestaurantEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $addressFrom = 'restaurant@pilshuisje.nl';
        $addressTo = $this->data['email'];
        $subject = $this->data['subject'];
        $name = 'Restaurant';

        return $this->view('emails.restaurant_reserve')
            ->from($addressFrom, $name)
            ->replyTo($addressTo, $name)
            ->subject($subject)
            ->with(['subject' => $this->data['subject'], "restaurant" => $this->data["restaurant"],
                "firstname" => $this->data['firstname'], "lastname" => $this->data['lastname'],
                "date" => $this->data['date'], "time" => $this->data['time'],
                "waiting_list" => $this->data['waiting_list']]);
    }
}
