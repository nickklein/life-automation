<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateJobsRequest;
use App\Http\Requests\JobsRequest;
use App\Services\DeviceJobsService;
use Illuminate\Http\Request;

class DeviceJobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JobsRequest $request, DeviceJobsService $deviceJobs)
    {
        //
        $jobs = $deviceJobs->jobs($request->route('id'), $request->validated());
        return response()->json($jobs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateJobsRequest $request, DeviceJobsService $deviceJobs)
    {
        $response = $deviceJobs->create($request->route('id'), $request->validated());
        if ($response) {
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobsRequest $request, DeviceJobsService $deviceJobs, $id)
    {
        //
        $response = $deviceJobs->update($id, $request->validated());
        if ($response) {
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
