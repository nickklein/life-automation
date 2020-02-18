<?php

namespace App\Services;

use App\Models\DeviceJobs;
use App\Repositories\DeviceJobsRepository;
use App\Repositories\DeviceRepository;

class DeviceJobsService
{
    /**
     * Get device jobs for a specific device and status
     *
     **/
    public function jobs(int $deviceId, array $fields): object
    {
        return (new DeviceJobsRepository)->get($deviceId, $fields['status']);
    }

    /**
     * Update device job status
     *
     **/
    public function update(int $deviceJobId, array $fields)
    {
        $deviceJobs = (new DeviceJobsRepository)->find($deviceJobId);
        $deviceJobs->status = $fields['status'];
        $deviceJobs->updated_at = date('Y-m-d H:i:s');
        if ($deviceJobs->save()) {
            // Update last sync update, and log
            (new DeviceService)->updateLastSync($deviceJobs->device_id);
            (new LogsService)->handle('deviceLog.update', 'Updated job status: ' . $fields['status']);
            return true;
        }
        return false;
    }

    /**
     * Create new device job
     *
     **/
    public function create(int $deviceId, array $fields)
    {
        $keys = ["reboot" => "reboot", "shutdown" => "shutdown"];
        $repository = new DeviceJobsRepository();
        // Only run if it doesn't exist already
        if (!$repository->isAlreadyQueued($deviceId, $keys[$fields["type"]])) {
            return $this->store($deviceId, ["key" => $keys[$fields["type"]], "value" => 1, "status" => "queue"]);
        }
    }

    /**
     * Create new device job
     *
     **/
    private function store(int $deviceId, array $fields)
    {
        $deviceJobs = new DeviceJobs;
        $deviceJobs->device_id = $deviceId;
        $deviceJobs->key = $fields['key'];
        $deviceJobs->value = $fields['value'];
        $deviceJobs->status = $fields['status'];
        $deviceJobs->created_at = date('Y-m-d H:i:s');
        $deviceJobs->updated_at = date('Y-m-d H:i:s');
        if ($deviceJobs->save()) {
            (new LogsService)->handle('deviceLogs.create.' . $fields['key'], 'Created job (' . $fields['key'] . ') with the value: ' . $fields['value']);
            return true;
        }
        return false;
    }

}