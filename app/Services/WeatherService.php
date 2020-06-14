<?php

namespace App\Services;

use App\Repositories\WeatherRepository;
use Illuminate\Support\Arr;

class WeatherService 
{
   public function currated(int $id): array
   {
       $weather = WeatherRepository::forecast($id);
       if (!$weather->isEmpty()) {
            return [
                'description' => Arr::get($weather, '0.description'),
                'temp' => $weather->avg('temp'),
                'rain' => $weather->sum('rain'),
                'rain3h' => $weather->sum('rain3h'),
                'snow' => $weather->sum('snow'),
                'snow3h' => $weather->sum('snow3h'),
            ];
       }
       return [];
   }
}