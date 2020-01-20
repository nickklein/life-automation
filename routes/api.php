<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::get('/devices', 'api\DevicesController@index')->name('devices');
    Route::get('/device/{id}', 'api\DevicesController@show')->name('device.single');
    Route::post('/device/delete', 'api\DevicesController@destroy')->name('device.destroy');
});