<?php

namespace App\Services;

use App\Models\Logs;
use Illuminate\Support\Facades\Auth;

class LogsService
{
    public function handle(string $type, string $description): bool
    {
        $userId = (isset(Auth::user()->id)) ? Auth::user()->id : 0;

        $logs = new Logs;
        $logs->type = $type;
        $logs->description = $description;
        $logs->user_id = $userId;
        if ($logs->save()) {
            return 1;
        }
        return 0;
    }
}