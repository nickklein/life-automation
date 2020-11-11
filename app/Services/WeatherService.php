<?php

namespace App\Services;

use App\Repositories\WeatherRepository;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class WeatherService 
{
    /**
     * Get weather for all listed cities
     *
     **/
    public function getWeather(int $id): object
    {
        $weather = WeatherRepository::findWeather($id);
        $modified = $weather->map(function($item, $key) {

            $item->timestamp = Carbon::parse($item->created_at)->format('F j, Y H:m');
            $item->weather_time = Carbon::parse($item->weather_time)->format('F j, Y H:m');

            return $item;
        })->groupBy('type');

        return $modified;
    }

   public function currated(int $id): array
   {
        $weather = WeatherRepository::forecast($id);
        if ($weather->isEmpty()) {
            return [];
        }

        return [
            'description' => Arr::get($weather, '0.description'),
            'temp' => $weather->avg('temp'),
            'rain' => $weather->sum('rain'),
            'rain3h' => $weather->sum('rain3h'),
            'snow' => $weather->sum('snow'),
            'snow3h' => $weather->sum('snow3h'),
        ];
   }
}