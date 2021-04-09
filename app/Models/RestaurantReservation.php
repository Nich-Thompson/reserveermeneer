<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        "restaurant_id",
        "date",
        "time",
        "firstname",
        "lastname",
        "email",
        "address",
        "postal_code",
        "city",
        "waiting_list",
    ];
}
