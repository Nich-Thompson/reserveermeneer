<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("type");
            $table->time("monday_opening_time", $precision = 0);
            $table->time("monday_closing_time", $precision = 0);
            $table->time("tuesday_opening_time", $precision = 0);
            $table->time("tuesday_closing_time", $precision = 0);
            $table->time("wednesday_opening_time", $precision = 0);
            $table->time("wednesday_closing_time", $precision = 0);
            $table->time("thursday_opening_time", $precision = 0);
            $table->time("thursday_closing_time", $precision = 0);
            $table->time("friday_opening_time", $precision = 0);
            $table->time("friday_closing_time", $precision = 0);
            $table->time("saturday_opening_time", $precision = 0);
            $table->time("saturday_closing_time", $precision = 0);
            $table->time("sunday_opening_time", $precision = 0);
            $table->time("sunday_closing_time", $precision = 0);
            $table->integer("amount_of_seats");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
