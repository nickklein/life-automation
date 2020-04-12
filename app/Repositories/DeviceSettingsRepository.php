<?php

namespace App\Repositories;

use App\Models\DeviceSettings;

class DeviceSettingsRepository
{

    public function all(int $deviceId)
    {
        return DeviceSettings::where('device_id', $deviceId)->get();
    }

    public function find(int $deviceId, string $settingsName)
    {
        return DeviceSettings::where([
            'device_id' => $deviceId,
            'key' => $settingsName,
        ])->first();
    }

    public function update($request, $deviceId, $settingsName): bool
    {
        $deviceSettings = $this->find($deviceId, $settingsName);

        $deviceSettings->value = $request->value;
        if ($deviceSettings->save()) {
            return 1;
        }

        return 0;
    }
}