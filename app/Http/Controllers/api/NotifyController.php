<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NotifyRequest;
use App\Services\NotifyService;
use Illuminate\Support\Facades\Auth;

class NotifyController extends Controller
{
    public function send(NotifyRequest $request, NotifyService $service)
    {
        $fields = $request->validated();
        // Run only if it's me
        if (Auth::user()->id !== 1) {
            return 'Invalid User';
        }

        return $service->sendToUser($fields, Auth::user()->id);
    }
}
