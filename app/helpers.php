<?php
function render_opening_time($open, $close)
{
    if (strtotime($close) - strtotime($open) == 0)
        return "Gesloten";
    else {
        $open_time = strtotime($open);
        $closing_time = strtotime($close);
        return date("H:i", $open_time) . " - " . date("H:i", $closing_time);
    }
}
