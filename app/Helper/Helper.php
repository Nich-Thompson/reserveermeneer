<?php

namespace App\Helper;

class Helper
{

    public function get_restaurant_opening_time($date, $restaurant)
    {
        $day_of_week = date('w', strtotime($date));

        switch ($day_of_week) {
            case 0:
                return strtotime($restaurant->sunday_opening_time);
            case 1:
                return strtotime($restaurant->monday_opening_time);
            case 2:
                return strtotime($restaurant->tuesday_opening_time);
            case 3:
                return strtotime($restaurant->wednesday_opening_time);
            case 4:
                return strtotime($restaurant->thursday_opening_time);
            case 5:
                return strtotime($restaurant->friday_opening_time);
            case 6:
                return strtotime($restaurant->saturday_opening_time);
            default:
                return strtotime("00:00");
        }
    }

    public function get_restaurant_closing_time($date, $restaurant)
    {
        $day_of_week = date('w', strtotime($date));

        switch ($day_of_week) {
            case 0:
                return strtotime($restaurant->sunday_closing_time);
            case 1:
                return strtotime($restaurant->monday_closing_time);
            case 2:
                return strtotime($restaurant->tuesday_closing_time);
            case 3:
                return strtotime($restaurant->wednesday_closing_time);
            case 4:
                return strtotime($restaurant->thursday_closing_time);
            case 5:
                return strtotime($restaurant->friday_closing_time);
            case 6:
                return strtotime($restaurant->saturday_closing_time);
            default:
                return strtotime("00:00");
        }
    }

}
