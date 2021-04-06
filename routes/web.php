<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::prefix('evenementen-films')->group(function (){
    Route::get('/', 'EventController@index')->name('getEventIndex');
    Route::get('/evenement-aanmaken', 'EventController@create')->middleware(['auth'])->name('getEventCreate');
    Route::post('/evenement-aanmaken', 'EventController@store')->middleware(['auth'])->name('postEventCreate');
    Route::get('/{id}/evenement-details', 'EventController@show')->name('getEventDetails');
    Route::get('/{id}/evenement-edit', 'EventController@edit')->middleware(['auth'])->name('getEventUpdate');
    Route::post('/{id}/evenement-edit', 'EventController@update')->middleware(['auth'])->name('postEventUpdate');
    Route::get('/{id}/evenement-delete', 'EventController@delete')->middleware(['auth'])->name('getEventDelete');
    Route::post('/{id}/evenement-delete', 'EventController@destroy')->middleware(['auth'])->name('postEventDelete');
    Route::get('/{id}/evenement-reserveer', 'EventController@showReserve')->name('getEventReserve');
    Route::post('/{id}/evenement-reserveer', 'EventController@reserve')->name('postEventReserve');
    Route::get('/{id}/event-reserve', 'EventController@showReserveEnglish')->name('getEventReserveEnglish');
    Route::post('/{id}/event-reserve', 'EventController@reserveEnglish')->name('postEventReserveEnglish');
    Route::resource('reservations', 'App\Http\Controllers\EventController');

    Route::get('/film-aanmaken', 'CinemaController@create')->middleware(['auth'])->name('getFilmCreate');
    Route::post('/film-aanmaken', 'CinemaController@store')->middleware(['auth'])->name('postFilmCreate');
    Route::get('/{id}/film-details', 'CinemaController@show')->name('getFilmDetails');
    Route::get('/{id}/film-edit', 'CinemaController@edit')->middleware(['auth'])->name('getFilmUpdate');
    Route::post('/{id}/film-edit', 'CinemaController@update')->middleware(['auth'])->name('postFilmUpdate');
    Route::get('/{id}/film-delete', 'CinemaController@delete')->middleware(['auth'])->name('getFilmDelete');
    Route::post('/{id}/film-delete', 'CinemaController@destroy')->middleware(['auth'])->name('postFilmDelete');
    Route::get('/{id}/film-reserveer', 'CinemaController@showReserve')->name('getFilmReserve');
    Route::post('/{id}/film-reserveer', 'CinemaController@reserve')->name('postFilmReserve');
});

Route::prefix('evenementreservaties')->group(function (){
    Route::get('/', 'ReservationController@index')->middleware(['auth'])->name('getReservationIndex');
});
