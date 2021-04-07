<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "type",
        "monday_opening_time",
        "monday_closing_time",
        "tuesday_opening_time",
        "tuesday_closing_time",
        "wednesday_opening_time",
        "wednesday_closing_time",
        "thursday_opening_time",
        "thursday_closing_time",
        "friday_opening_time",
        "friday_closing_time",
        "saturday_opening_time",
        "saturday_closing_time",
        "sunday_opening_time",
        "sunday_closing_time",
        "amount_of_seats",
    ];
}
