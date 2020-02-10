<?php

namespace App\Traits;

use DateTime;
use DateTimeZone;

trait WeatherTraits 
{

    /* Checks if the date was today */
    private function isToday(String $weatherDateTime): bool
    {
        $weatherDateTime = $this->convertDateTime($weatherDateTime);
        $today = new DateTime();

        // This sets the time for the object outside of the method as well
        $weatherDateTime->setTime(0, 0, 0);
        $today->setTime(0, 0, 0);

        $interval = $today->diff($weatherDateTime);
        if ($interval->days === 0) {
            return 1;
        }
        return 0;
    }

    /* Converts a string date to the correct timezone */
    private function convertDateTime(String $date): object
    {
        $dt = new DateTime($date, new DateTimeZone('UTC'));
        $dt->setTimezone(new DateTimeZone(config('app.timezone')));
        return $dt;
    }
}