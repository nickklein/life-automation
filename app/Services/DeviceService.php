<?php

namespace App\Services;

use App\Models\Devices;
use App\Repositories\DeviceRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceService
{
    /**
     * Get a list of all devices assosciated to a user id
     *
    **/
    public function list(): object
    {
        $now = Carbon::now();
        $devices = (new DeviceRepository)->all(Auth::user()->id);
        $formatedDevices = $devices->map(function($device) {
            $device->last_online = Carbon::parse($device->last_online)->diffForHumans();

            return $device;
        });

        return $formatedDevices;
    }

    /**
     * single
     *
     **/
    public function single(int $id, Request $request): array
    {
        // Update device information
        $this->updateDeviceInformation($id, $request->ip());
        
        $response = [];
        $repository = (new DeviceRepository)->first(Auth::user()->id, $id)->toArray();
        // Process get settings
        $settings = $this->getSettings($repository['device_settings']);
        $response = $repository;
        $response['device_settings'] = $settings;

        return $response;
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

    private function getSettings(array $settings): array
    {
        $response = [];
        foreach($settings as $setting) {
            $response[$setting["key"]] = $setting["value"];

            // Boolean
            if (is_numeric($setting["value"])) {
                $response[$setting["key"]] = (int)$setting["value"];
            }
        }
        
        return $response;
    }
}