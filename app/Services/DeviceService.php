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
     * single
     *
     **/
    public function single(int $id)
    {
        return (new DeviceRepository)->first(Auth::user()->id, $id);
    }

    /**
     * Update sync time for a device
     *
     **/
    public function updateLastSync(int $deviceId): void
    {
        $device = (new DeviceRepository)->first(Auth::user()->id, $deviceId);
        $device->last_sync = date('Y-m-d H:i:s');
        $device->save();
    }

    /**
     * Update sync time for a device
     *
     **/
    public function updateDeviceInformation(int $deviceId, string $ipAddress): array
    {
        $device = (new DeviceRepository)->first(Auth::user()->id, $deviceId);
        $device->last_online = date('Y-m-d H:i:s');
        $device->last_ip = $ipAddress;
        if ($device->save()) {
            return ['status' => 'success'];
        }
        return ['status' => 'error'];
    }
}