<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\DeviceSettingsService;
use Illuminate\Http\Request;

class DeviceSettingsController extends Controller
{
    //
    public function show(DeviceSettingsService $settingsService, int $deviceId, string $settingsName)
    {
        return response()->json($settingsService->show($deviceId, $settingsName));
    }

    public function update(DeviceSettingsService $settingsService, Request $request, int $deviceId, string $settingsName)
    {
        $updated = $settingsService->update($request, $deviceId, $settingsName);
        if ($updated) {
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error']);
    }
}
