<?php

namespace App\Http\Controllers\Weather;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index(){
        return view('weather');
    }

    public function getWeather(){
        $url = env('OPEN_WEATHER_URL') . 'q=' . \request('venue') . '&appid=' . env('OPEN_WEATHER_MAP');
        $response = Http::get($url)->json();
        return $response;
    }
}
