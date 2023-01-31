<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenWeatherMapService
{
    private $url = 'https://api.openweathermap.org/data/2.5/weather?units=metric&';

    /**
     * @param string|null $city
     * @param string|null $lat
     * @param string|null $lng
     * @return array|mixed|string
     */
    public function getCurrentWeatherCity(?string $city = 'méxico', string $lat = null, string $lng = null)
    {
        if ($city) {
            $url = $this->url . 'q=' . $city . '&appid=' . config('services.open_weather_map.token');
        }

        if ($lat && $lng) {
            $url = $this->url . 'lat=' . $lat . '&lon=' . $lng . '&appid=' . config('services.open_weather_map.key');
        }

        $response = Http::get($url)->json();

        if ($response['cod'] == '200') {
            return [
                'temp' => $response['main']['temp'],
                'weather_condition' => $response['weather'][0]['main']
            ];
        }

        return null;
    }
}
