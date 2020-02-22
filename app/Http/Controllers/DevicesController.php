<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DevicesController extends Controller
{
    //
    public function index()
    {
        return view('pages.devices.index');
    }

    public function jobs()
    {
        return view('pages.devices.jobs');
    }
}
