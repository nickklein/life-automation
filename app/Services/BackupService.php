<?php

namespace App\Services;

use App\Models\DeviceSettings;
use App\Repositories\DeviceSettingsRepository;
use Carbon\Carbon;

class BackupService
{
    private $settingsRepository;

    public function __construct(DeviceSettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    /**
     * Checks if the next back up is ready for device
     *
     * @return bool
     */
    public function nextBackupCheck(int $deviceId): bool
    {
        $backupLastSynced = $this->settingsRepository->find($deviceId, 'backup_last_synced')->value;
        $backupFrequency = (int)$this->settingsRepository->find($deviceId, 'backup_frequency')->value;

        $backupLastSynced = Carbon::parse($backupLastSynced);
        if ($backupLastSynced->diffInMinutes(Carbon::now()) > $backupFrequency) {
            return true;
        }

        return false;
    }
}