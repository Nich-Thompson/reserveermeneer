<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cinemas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->timestamps();
        });

        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cinema_id');

            $table->foreign('cinema_id')
                ->references('id')
                ->on('cinemas')
                ->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hall_id');

            $table->foreign('hall_id')
                ->references('id')
                ->on('halls')
                ->onDelete('cascade');

            $table->integer('x');
            $table->integer('y');
            $table->timestamps();
        });

        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hall_id');

            $table->foreign('hall_id')
                ->references('id')
                ->on('halls')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps();
        });

        Schema::create('film_seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('film_id');
            $table->unsignedBigInteger('seat_id');

            $table->foreign('film_id')
                ->references('id')
                ->on('films')
                ->onDelete('cascade');
            $table->foreign('seat_id')
                ->references('id')
                ->on('seats')
                ->onDelete('cascade');

            $table->integer('x');
            $table->integer('y');
            $table->tinyInteger('occupied');
            $table->timestamps();
        });

        Schema::create('film_reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('film_id');
            $table->unsignedBigInteger('seat_id');

            $table->foreign('film_id')
                ->references('id')
                ->on('films')
                ->onDelete('cascade');
            $table->foreign('seat_id')
                ->references('id')
                ->on('film_seats')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('postal_code');
            $table->string('city');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cinemas');
        Schema::dropIfExists('halls');
        Schema::dropIfExists('seats');
        Schema::dropIfExists('films');
        Schema::dropIfExists('film_reservations');
    }
}
