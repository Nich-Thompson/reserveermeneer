<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('restaurant_reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurant_id');
            $table->foreign("restaurant_id")->references("id")->on("restaurants")->onDelete('cascade');
            $table->date("date");
            $table->time("time");
            $table->string("firstname");
            $table->string("lastname");
            $table->string("email");
            $table->string("address");
            $table->string("postal_code");
            $table->string("city");
            $table->boolean("waiting_list");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('restaurant_reservations');
    }
}
