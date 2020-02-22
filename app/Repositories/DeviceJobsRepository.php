<?php

namespace App\Repositories;

use App\Models\DeviceJobs;

class DeviceJobsRepository
{

    /**
     * Get a list of jobs assosciated to a device and status
     *
     **/
    public function all(int $userId)
    {
        return DeviceJobs::select("device_jobs.*", 'devices.device_name')->where([
            ['devices.user_id', $userId],
        ])
        ->join('devices', 'devices.device_id', 'device_jobs.device_id')
        ->orderBy('device_jobs.device_job_id', 'desc')
        ->get();
    }

    /**
     * Get a list of jobs assosciated to a device and status
     *
     **/
    public function get(int $userId, int $deviceId, string $status)
    {
        return DeviceJobs::where([
            ['device_jobs.device_id', $deviceId],
            ['devices.user_id', $userId],
        ])
        ->join('devices', 'devices.device_id', 'device_jobs.device_id')
        ->when($status, function($query, $status) {
            return $query->where('status', $status);
        })
        ->get();
    }

    /**
     * Find specific device job record
     *
     **/
    public function find(int $userId, int $deviceJobId)
    {
        return DeviceJobs::join('devices', 'devices.device_id', 'device_jobs.device_id')
        ->where('devices.user_id', $userId)
        ->find($deviceJobId);
    }

    /**
     * Check to see if there's already something in the queue for it
     *
     **/
    public function isAlreadyQueued(int $userId, int $deviceId, string $key)
    {
        return DeviceJobs::join('devices', 'devices.device_id', 'device_jobs.device_id')
        ->where([
            ['devices.user_id', $userId],
            ['status', 'queue'],
            ['devices.device_id', $deviceId],
            ['key', $key],
            ['status', 'queue'],
        ])->count();
    }

}
