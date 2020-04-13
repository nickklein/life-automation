<?php

namespace App\Services;

use App\Repositories\DeviceSettingsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceSettingsService
{
    private $settingsRepository;

    public function __construct(DeviceSettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    public function list(int $deviceId)
    {
        return $this->settingsRepository->all(Auth::user()->id, $deviceId);
    }

    public function show(int $deviceId, string $settingsName)
    {
        return $this->settingsRepository->find(Auth::user()->id, $deviceId, $settingsName);
    }

    public function update(Request $request, int $deviceId, string $settingsName)
    {
        if ($this->settingsRepository->isOwner(Auth::user()->id, $deviceId)) {
            return $this->settingsRepository->update($request, Auth::user()->id, $deviceId, $settingsName);
        }
        return 0;
    }
}