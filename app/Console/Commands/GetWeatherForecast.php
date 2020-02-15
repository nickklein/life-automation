<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cities;
use App\Models\Weather;
use App\Traits\WeatherTraits;
use GuzzleHttp\Client as GuzzleHttp;
use Illuminate\Support\Arr;

class GetWeatherForecast extends Command
{
    use WeatherTraits;

    const FORECAST_URL = "http://api.openweathermap.org/data/2.5/forecast";
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:getWeatherForecast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collects the weather forecast';

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
            $forecasts = json_decode($response->getBody()->getContents(), true);
            foreach ($forecasts['list'] as $hour) {
                $weatherDT = $this->convertDateTime($hour['dt_txt']);

                if ($this->isToday($hour['dt_txt'])) {
                    $fill[] = [
                        'main' => Arr::get($hour, 'weather.0.main'),
                        'api_id' => Arr::get($hour, 'weather.0.id'),
                        'description' => Arr::get($hour, 'weather.0.description'),
                        'temp' => Arr::get($hour, 'main.temp'),
                        'temp_min' => Arr::get($hour, 'main.temp_min'),
                        'temp_max' => Arr::get($hour, 'main.temp_max'),
                        'cloudiness' => Arr::get($hour, 'clouds.all'),
                        'wind_speed' => Arr::get($hour, 'wind.speed'),
                        'cloudiness' => Arr::get($hour, 'clouds.all'),
                        'snow' => Arr::get($hour, 'snow.1h', 0),
                        'snow3h' => Arr::get($hour, 'snow.3h', 0),
                        'rain' => Arr::get($hour, 'rain.1h', 0),
                        'rain3h' => Arr::get($hour, 'rain.3h', 0),
                        'weather_time' => $weatherDT->format('Y-m-d H:i:s'),
                        'city_id' => $city->city_id,
                        'type' => 'forecast',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                }
            }
        }
        Weather::insert($fill);
    }
}
