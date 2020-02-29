<?php

namespace App\Repositories;

use App\Models\DeviceJobs;
use App\Models\Devices;

class DeviceJobsRepository
{

    /**
     * Get a list of jobs assosciated to a device and status
     *
     **/
    public function all(int $userId, int $limit)
    {
        return DeviceJobs::select("device_jobs.*", 'devices.device_name')->where([
            ['devices.user_id', $userId],
        ])
        ->join('devices', 'devices.device_id', 'device_jobs.device_id')
        ->orderBy('device_jobs.device_job_id', 'desc')
        ->limit($limit)
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
    public function isAlreadyQueued(int $deviceId, string $key)
    {
        return DeviceJobs::join('devices', 'devices.device_id', 'device_jobs.device_id')
        ->where([
            ['status', 'queue'],
            ['devices.device_id', $deviceId],
            ['key', $key],
            ['status', 'queue'],
        ])->count();
    }

    /**
     * Check to see if the owner is correct
     *
     **/
    public function isOwner(int $userId, int $deviceId): bool
    {
        $count = Devices::where([
            'user_id' => $userId,
            'device_id' => $deviceId
        ])->count();
        if ($count) {
            return true;
        }

        return false;
    }

}
