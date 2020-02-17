<?php

namespace App\Repositories;

use App\Models\Devices;

class DeviceRepository 
{
    public function all(int $userId)
    {
        return Devices::where('user_id', $userId)->get();
    }

    public function find(int $userId, int $deviceId)
    {
        return Devices::where([
            ['user_id', $userId],
            ['device_id' => $deviceId],
        ])->get();
    }
}