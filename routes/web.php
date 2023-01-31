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
});


Route::namespace('App\Http\Controllers\Weather')->group(function() {
    Route::get('/clima','WeatherController@index')->name('weather');
    Route::post('/getWeather','WeatherController@getWeather')->name('getWeather');
});
