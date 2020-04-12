<?php

namespace App\Services;

use App\Repositories\DeviceSettingsRepository;
use Illuminate\Http\Request;

class DeviceSettingsService
{
    private $settingsRepository;

    public function __construct(DeviceSettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    public function list(int $deviceId)
    {
        return $this->settingsRepository->all($deviceId);
    }

    public function show(int $deviceId, string $settingsName)
    {
        return $this->settingsRepository->find($deviceId, $settingsName);
    }

    public function update(Request $request, int $deviceId, string $settingsName)
    {
        return $this->settingsRepository->update($request, $deviceId, $settingsName);
    }
}