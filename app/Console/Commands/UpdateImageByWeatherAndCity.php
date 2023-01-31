<?php

namespace App\Console\Commands;

use App\Services\OpenWeatherMapService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UpdateImageByWeatherAndCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'open-weather:update-image {city=mexico}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(OpenWeatherMapService $openWeatherMapService)
    {
        $weather = $openWeatherMapService->getCurrentWeatherCity($this->argument('city'));

        $cold = ['thunderstorm', 'drizzle', 'rain', 'snow', 'mist', 'smoke', 'haze', 'dust', 'fog', 'sand', 'dust', 'ash', 'squall', 'tornado'];
        $hot = ['clear', 'clouds'];
        $rain = ['thunderstorm', 'drizzle', 'rain', 'squall'];

        if (in_array(strtolower($weather['weather_condition']), $rain)) {
            File::copy(public_path('images/lluvia.jpg'), public_path('main.jpg'));
        }

        if (in_array(strtolower($weather['weather_condition']), $cold) && $weather['temp'] <= 15)
        {
            File::copy(public_path('images/frio.jpg'), public_path('main.jpg'));
        }

        if (in_array(strtolower($weather['weather_condition']), $hot)) {
            File::copy(public_path('images/soleado.jpg'), public_path('main.jpg'));
        }

        $txt = json_encode($weather);
        Storage::append('file-records-time.txt', $txt);

        return 1;
    }
}
