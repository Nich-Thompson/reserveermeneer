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

Route::prefix('evenementen')->group(function (){
    Route::get('/', 'EventController@index')->name('getEventIndex');
    Route::get('/create', 'EventController@create')->middleware(['auth'])->name('getEventCreate');
    Route::post('/create', 'EventController@store')->middleware(['auth'])->name('postEventCreate');
    Route::get('/{id}/details', 'EventController@show')->name('getEventDetails');
    Route::get('/{id}/edit', 'EventController@edit')->middleware(['auth'])->name('getEventUpdate');
    Route::post('/{id}/edit', 'EventController@update')->middleware(['auth'])->name('postEventUpdate');
    Route::get('/{id}/delete', 'EventController@delete')->middleware(['auth'])->name('getEventDelete');
    Route::post('/{id}/delete', 'EventController@destroy')->middleware(['auth'])->name('postEventDelete');
});
