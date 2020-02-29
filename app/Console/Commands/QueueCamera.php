<?php

namespace App\Console\Commands;

use App\Models\DeviceSettings;
use App\Repositories\DeviceJobsRepository;
use App\Services\DeviceJobsService;
use Illuminate\Console\Command;

class QueueCamera extends Command
{
    private const JOB_TYPE = 'camera';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:queueCamera';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queue Camera for Devices';

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
    public function handle()
    {
        //
        $settings = DeviceSettings::where([
            ['key', 'camera'],
            ['value', 1],
        ])->get();


        $repository = new DeviceJobsRepository();
        $service = new DeviceJobsService();
        foreach($settings as $setting) {
            // Check if already queued
            if (!$repository->isAlreadyQueued($setting->device_id, self::JOB_TYPE)) {
                $fields = [
                    "key" => 'camera',
                    "value" => 1,
                    "status" => "queue",
                ];
                $service->store($setting->device_id, $fields);
            }
        }
    }
}
