<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth', 'prefix' => 'oauth'], function () {
    Route::get('/clients', 'OAuthController@clients')->name('oauth.clients');
    Route::get('/personal-access-token', 'OAuthController@personalAccessToken')->name('oauth.personal');
    Route::get('/authorized-clients', 'OAuthController@authorizedClients')->name('oauth.authorized'); 
});
Route::group(['middleware' => 'auth', 'prefix' => 'devices'], function () {
    Route::get('/', 'DevicesController@index')->name('devices');
    Route::get('/jobs', 'DevicesController@jobs')->name('devices.jobs');
});

Route::group(['middleware' => 'auth', 'prefix' => 'shopping'], function () {
    Route::get('/', 'ShoppingController@index')->name('shopping');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/device/{deviceId}/settings', 'DeviceSettingsController@show')->name('device.settings');    
});
