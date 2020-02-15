<?php

namespace App\Repositories;

use App\Models\Weather;
use Carbon\Carbon;

class WeatherRepository
{
    public static function current(int $id)
    {
        // TODO: Latest Current, not just any current, also first
        return Weather::where([
                    ['city_id', $id],
                    ['type', 'current'],
                ])->orderBy('weather_id', 'DESC')->first();
    }

    public static function forecast(int $id, int $currated = 0)
    {
        return Weather::where([
            ['city_id', $id],
            ['type', 'forecast'],
        ])
        ->whereDate('weather_time', Carbon::today())
        ->where(function($query) use ($currated) {
            if ($currated) {
                $query->where('snow', '>', 0)
                        ->orWhere('rain', '>', 0)
                        ->orWhere('temp', '<', 14);
            }
        })
        ->get();    
    }
 

}