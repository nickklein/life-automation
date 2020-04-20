<?php

namespace App\Repositories;

use App\Models\Devices;
use App\Models\DeviceSettings;
use Illuminate\Http\Request;

class DeviceSettingsRepository
{

    public function all(int $userId, int $deviceId)
    {
        return DeviceSettings::join('devices', 'devices.device_id', 'device_settings.device_id')
            ->where([
                'device_settings.device_id' => $deviceId,
                'user_id' => $userId,
            ])
            ->get();
    }

    public function find(int $deviceId, string $settingsName)
    {
        return DeviceSettings::select('device_settings.device_settings_id', 'device_settings.key', 'device_settings.value')
        ->where([
            'device_settings.device_id' => $deviceId,
            'key' => $settingsName,
        ])->first();
    }

    public function update(Request $request, int $userId, int $deviceId,string $settingsName): bool
    {
        $deviceSettings = $this->find($deviceId, $settingsName);

        $deviceSettings->value = $request->value;
        if ($deviceSettings->save()) {
            return 1;
        }

        return 0;
    }

    /**
     * Check to see if the owner is correct
     *
     **/
    public function isOwner(int $userId, int $deviceId): bool
    {

        $count = Devices::where([
            'user_id' => $userId,
            'device_id' => $deviceId
        ])->count();
        if ($count) {
            return true;
        }

        return false;
    }

}