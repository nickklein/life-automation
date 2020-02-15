<?php

namespace App\Services;

use App\Repositories\WeatherRepository;
use Illuminate\Support\Arr;

class WeatherService 
{
   public function currated(int $id): array
   {
       $weather = WeatherRepository::forecast($id, 1);
       if (!$weather->isEmpty()) {
            return [
                'description' => Arr::get($weather, '0.description'),
                'temp' => $weather->avg('temp'),
                'rain' => $weather->avg('rain'),
                'rain3h' => $weather->avg('rain3h'),
                'snow' => $weather->avg('snow'),
                'snow3h' => $weather->avg('snow3h'),
            ];
       }
       return [];
   }
}