<?php

namespace App\Console\Commands;

use App\Models\DeviceSettings;
use App\Repositories\DeviceJobsRepository;
use App\Services\BackupService;
use App\Services\DeviceJobsService;
use Illuminate\Console\Command;

class QueueBackup extends Command
{
    private const JOB_TYPE = 'backup';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:backupCamera';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queue Backup for Devices';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(BackupService $backupService)
    {
        // Check what devices have backup enabled
        $settings = DeviceSettings::where([
            ['key', 'backup_feature'],
            ['value', 1],
        ])->get();


        $deviceJobsRepository = new DeviceJobsRepository();
        $deviceJobsService = new DeviceJobsService();
        foreach($settings as $setting) {
            // Check if the next backup is ready to go, and if it's already in the jobs queue
            if ($backupService->nextBackupCheck($setting->device_id) && !$deviceJobsRepository->isAlreadyQueued($setting->device_id, self::JOB_TYPE)) {
                // Add this to jobs
                $fields = [
                    "key" => 'backup',
                    "value" => 1,
                    "status" => "queue",
                ];
                $deviceJobsService->store($setting->device_id, $fields);
            }
        }
    }
}
