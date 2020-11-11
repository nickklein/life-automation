<?php

namespace App\Http\Controllers;

use App\Services\DeviceService;
use Illuminate\Http\Request;

class DevicesController extends Controller
{
    //
    public function index(DeviceService $deviceService)
    {
        return view('pages.devices.index', ['items' => $deviceService->list()]);
    }

    public function jobs()
    {
        return view('pages.devices.jobs');
    }
}
