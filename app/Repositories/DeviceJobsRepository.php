<?php

namespace App\Repositories;

use App\Models\DeviceJobs;

class DeviceJobsRepository
{
    /**
     * Get a list of jobs assosciated to a device and status
     *
     **/
    public function get(int $deviceId, string $status)
    {
        return DeviceJobs::where([
            ['device_id', $deviceId],
            ['status', $status]
        ])->get();
    }

    /**
     * Find specific device job record
     *
     **/
    public function find(int $deviceJobId)
    {
        return DeviceJobs::find($deviceJobId);
    }

    public function isAlreadyQueued(int $deviceId, string $key)
    {
        return DeviceJobs::where([
            ['device_id', $deviceId],
            ['key', $key],
            ['status', 'queue'],
        ])->count();
    }

}
