<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cities;
use App\Models\Weather;
use App\Services\LogsService;
use App\Traits\WeatherTraits;
use GuzzleHttp\Client as GuzzleHttp;
use Illuminate\Support\Arr;

class GetCurrentWeather extends Command
{
    use WeatherTraits;

    const FORECAST_URL = "http://api.openweathermap.org/data/2.5/weather";
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:getCurrentWeather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collects current weather results';

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
     * @return mixed
     */
    public function handle(): void
    {
        $fill = [];
        $client = new GuzzleHttp();
        $cities = Cities::get();
        foreach ($cities as $city) {
            $response = $client->request('GET', self::FORECAST_URL . '?lat=' . $city->lat . '&lon=' . $city->lon . '&units=metric&APPID=' . env('OPENWEATHERMAP_API_KEY'));
            $current = json_decode($response->getBody()->getContents(), true);
            $fill[] = [
                'main' => Arr::get($current, 'weather.0.main'),
                'api_id' => Arr::get($current, 'weather.0.id'),
                'description' => Arr::get($current, 'weather.0.description'),
                'icon' => Arr::get($current, 'weather.0.icon'),
                'temp' => Arr::get($current, 'main.temp'),
                'temp_min' => Arr::get($current, 'main.temp_min'),
                'temp_max' => Arr::get($current, 'main.temp_max'),
                'cloudiness' => Arr::get($current, 'clouds.all'),
                'wind_speed' => Arr::get($current, 'wind.speed'),
                'cloudiness' => Arr::get($current, 'clouds.all'),
                'snow' => Arr::get($current, 'snow.1h', 0),
                'snow3h' => Arr::get($current, 'snow.3h', 0),
                'rain' => Arr::get($current, 'rain.1h', 0),
                'rain3h' => Arr::get($current, 'rain.3h', 0),
                'weather_time' => date('Y-m-d H:i:s'),
                'city_id' => $city->city_id,
                'type' => 'current',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            (new LogsService)->handle('cron.getCurrentWeather', 'Collected current weather results for ' . $city->city_name);
        }
        Weather::insert($fill);
    }
}
