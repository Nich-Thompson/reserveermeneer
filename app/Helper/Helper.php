<?php

namespace App\Helper;

class Helper
{

    public function get_restaurant_opening_time($date, $restaurant)
    {
        $day_of_week = date('w', strtotime($date));

        switch ($day_of_week) {
            case 0:
                return $restaurant->sunday_opening_time;
            case 1:
                return $restaurant->monday_opening_time;
            case 2:
                return $restaurant->tuesday_opening_time;
            case 3:
                return $restaurant->wednesday_opening_time;
            case 4:
                return $restaurant->thursday_opening_time;
            case 5:
                return $restaurant->friday_opening_time;
            case 6:
                return $restaurant->saturday_opening_time;
            default:
                return "00:00";
        }
    }

    public function get_restaurant_closing_time($date, $restaurant)
    {
        $day_of_week = date('w', strtotime($date));

        switch ($day_of_week) {
            case 0:
                return $restaurant->sunday_closing_time;
            case 1:
                return $restaurant->monday_closing_time;
            case 2:
                return $restaurant->tuesday_closing_time;
            case 3:
                return $restaurant->wednesday_closing_time;
            case 4:
                return $restaurant->thursday_closing_time;
            case 5:
                return $restaurant->friday_closing_time;
            case 6:
                return $restaurant->saturday_closing_time;
            default:
                return "00:00";
        }
    }

}
