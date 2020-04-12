<?php

namespace App\Http\Controllers;

use App\Services\DeviceSettingsService;
use Illuminate\Http\Request;

class DeviceSettingsController extends Controller
{
    public function show(DeviceSettingsService $settingsService, int $deviceId)
    {
        return view('pages.devices.settings', ['settings' => $settingsService->list($deviceId)]);
    }
}
