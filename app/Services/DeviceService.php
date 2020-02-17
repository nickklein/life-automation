<?php

namespace App\Services;

use App\Models\Devices;
use App\Repositories\DeviceRepository;
use Illuminate\Support\Facades\Auth;

class DeviceService
{
    /**
     * Get a list of all devices assosciated to a user id
     *
    **/
    public function list(): object
    {
        return (new DeviceRepository)->all(Auth::user()->id);
    }

    /**
     * Update sync time for a device
     *
     **/
    public function updateLastSync(int $deviceId): void
    {
        $device = Devices::find($deviceId);
        $device->last_sync = date('Y-m-d H:i:s');
        $device->save();
    }
}