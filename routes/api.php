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
    Route::post('/notify/send', 'api\NotifyController@send')->name('api.notify.send');

    Route::get('/device/jobs', 'api\DeviceJobsController@index')->where('id', '[0-9]+')->name('api.device.jobs');
    Route::get('/device/{id}/jobs', 'api\DeviceJobsController@show')->where('id', '[0-9]+')->name('api.device.jobs');
    Route::post('/device/{id}/jobs/create', 'api\DeviceJobsController@store')->where('id', '[0-9]+')->name('api.device.jobs.create');
    Route::patch('/device/{id}/jobs/update', 'api\DeviceJobsController@update')->where('id', '[0-9]+')->name('api.device.jobs.update');

    Route::get('/devices', 'api\DevicesController@index')->name('api.devices');
    Route::get('/device/{id}', 'api\DevicesController@show')->name('api.device.single');
    Route::post('/device/delete', 'api\DevicesController@destroy')->name('api.device.destroy');
    Route::patch('/device/{id}/update', 'api\DevicesController@update')->name('api.device.update');
    Route::get('/device/{deviceId}/settings/{settingsName}', 'api\DeviceSettingsController@show')->name('api.device.settings');
    Route::post('/device/{deviceId}/settings/{settingsName}/update', 'api\DeviceSettingsController@update')->name('api.device.settings.update');

    Route::post('/files/store', 'api\FilesController@store')->name('api.files.store');

    Route::get('/weather/dashboard', 'api\WeatherController@dashboard')->name('api.weather.dashboard');

    Route::post('/shopping/category/update', 'api\ShoppingCategoryController@update')->name('api.shopping.update');

    // News
    Route::post('/news/favourites/update', 'api\NewsController@favourites')->name('api.news.favourites.update');


    Route::get('/settings/tags', 'api\settings\TagsController@index')->name('api.tags.index');
    Route::post('/settings/tags/store', 'api\settings\TagsController@store')->name('api.tags.index');
    Route::post('/settings/tags/delete', 'api\settings\TagsController@destroy')->name('api.tags.destroy');

    Route::get('/settings/sources', 'api\settings\SourcesController@index')->name('api.sources.index');
    Route::post('/settings/sources/update', 'api\settings\SourcesController@update')->name('api.sources.update');
});

Route::get('/weather/{city_id}', 'api\WeatherController@show')->where('city_id', '[0-9]+')->name('api.weather.show');
