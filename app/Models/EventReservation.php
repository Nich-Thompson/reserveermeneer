<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        "event_id",
        "name",
        "email",
        "address",
        "postal_code",
        "city",
        "img_path",
        "start_date",
        "end_date",
        "ticket_number",
        "total_price",
        "created_at",
        "updated_at"
    ];
}
