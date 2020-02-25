<?php

namespace App\Services;

use App\Models\DeviceJobs;
use App\Repositories\DeviceJobsRepository;
use App\Repositories\DeviceRepository;
use Illuminate\Support\Facades\Auth;

class DeviceJobsService
{
    const ACTIONS_KEYS = ["reboot" => "reboot", "shutdown" => "shutdown", "update" => "update"];

    public function allJobs()
    {
        return (new DeviceJobsRepository)->all(Auth::user()->id, 25);
    }

    /**
     * Get device jobs for a specific device and status
     *
     **/
    public function jobs(int $deviceId, array $fields): object
    {
        $status = (isset($fields['status'])) ? $fields['status'] : '';
        return (new DeviceJobsRepository)->get(Auth::user()->id, $deviceId, $status);
    }

    /**
     * Update device job status
     *
     **/
    public function update(int $deviceJobId, array $fields)
    {
        $deviceJobs = (new DeviceJobsRepository)->find(Auth::user()->id, $deviceJobId);
        if ($deviceJobs) {
            $deviceJobs->status = $fields['status'];
            $deviceJobs->updated_at = date('Y-m-d H:i:s');
            if ($deviceJobs->save()) {
                // Update last sync update, and log
                (new DeviceService)->updateLastSync($deviceJobs->device_id);
                (new LogsService)->handle('deviceLog.update', 'Updated job status: ' . $fields['status']);
                return true;
            }
        }
        return false;
    }

    /**
     * Create new device job
     *
     **/
    public function create(int $deviceId, array $fields): array
    {
        $repository = new DeviceJobsRepository();
        // Only run if it doesn't exist already
        if (!$repository->isAlreadyQueued(Auth::user()->id, $deviceId, self::ACTIONS_KEYS[$fields["type"]])) {
            return $this->store($deviceId, ["key" => self::ACTIONS_KEYS[$fields["type"]], "value" => 1, "status" => "queue"]);
        }
        return ['status' => 'error', 'message' => 'There is already a job in the queue for this'];
    }

    /**
     * Create new device job
     *
     **/
    private function store(int $deviceId, array $fields): array
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
            return ['status' => 'success', 'message' => 'Job has been successfully created'];
        }
        return ['status' => 'error', 'message' => 'Something went wrong with saving'];
    }

}