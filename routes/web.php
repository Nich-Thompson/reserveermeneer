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

//Route::get('/dashboard', function () {
//    $restaurants = \App\Models\Restaurant::all();
//    $restaurant = \App\Models\Restaurant::first();
//    $reservations = \App\Models\RestaurantReservation::where("restaurant_id", "=", $restaurant->id)->where("date", "=", date("Y-m-d", "today"))->get();
//
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/dashboard', 'RestaurantController@dashboard')->middleware(['auth'])->name('dashboard');

Route::prefix('evenementen-films')->group(function () {
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

    Route::get('/film-aanmaken', 'FilmController@create')->middleware(['auth'])->name('getFilmCreate');
    Route::post('/film-aanmaken', 'FilmController@store')->middleware(['auth'])->name('postFilmCreate');
    Route::get('/{id}/film-details', 'FilmController@show')->name('getFilmDetails');
    Route::get('/{id}/film-edit', 'FilmController@edit')->middleware(['auth'])->name('getFilmUpdate');
    Route::post('/{id}/film-edit', 'FilmController@update')->middleware(['auth'])->name('postFilmUpdate');
    Route::get('/{id}/film-delete', 'FilmController@delete')->middleware(['auth'])->name('getFilmDelete');
    Route::post('/{id}/film-delete', 'FilmController@destroy')->middleware(['auth'])->name('postFilmDelete');
    Route::get('/{id}/film-reserveer', 'FilmController@showReserve')->name('getFilmReserve');
    Route::post('/{id}/film-reserveer', 'FilmController@reserve')->name('postFilmReserve');
});

Route::prefix('evenementreservaties')->group(function (){
    Route::get('/', 'ReservationController@index')->middleware(['auth'])->name('getReservationIndex');
    Route::get('/csv', 'ReservationController@exportCsv')->middleware(['auth'])->name('exportCsv');
    Route::get('/json', 'ReservationController@exportJson')->middleware(['auth'])->name('exportJson');
});

Route::prefix('restaurants')->group(function () {
    Route::get('/', 'RestaurantController@index')->name('getRestaurantIndex');
    Route::get('/{id}/reserveren', 'RestaurantController@showReserve')->name('getRestaurantReserve');
    Route::post('/{id}/reserveren', 'RestaurantController@reserve')->name('postRestaurantReserve');
});
