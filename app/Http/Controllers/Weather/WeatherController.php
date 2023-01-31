<?php

namespace App\Http\Controllers\Weather;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index(){
        return view('weather');
    }

    public function getWeather(){
        $url = env('OPEN_WEATHER_URL') . 'q=' . \request('venue') . '&appid=' . env('OPEN_WEATHER_MAP');
        $response = Http::get($url)->json();
        if ($response['main']['temp'] < 15) {
            File::copy(public_path('images/frio.jpg'), public_path('main.jpg'));
        }

        if ($response['main']['temp'] >= 15 && $response['main']['temp']<= 22)
        {
            File::copy(public_path('images/lluvia.jpg'), public_path('main.jpg'));
        }

        if ($response['main']['temp'] >= 23) {
            File::copy(public_path('images/soleado.jpg'), public_path('main.jpg'));
        }
        return $response;
    }
}
