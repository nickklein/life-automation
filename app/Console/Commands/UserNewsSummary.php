<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UserNewsSummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:userNewsSummary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Users News Feed Summary';

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
        // Loop through all user tags
            //
    }
}
