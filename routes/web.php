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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth', 'prefix' => 'oauth'], function () {
    Route::get('/clients', 'OAuthController@clients')->name('oauth.clients');
    Route::get('/personal-access-token', 'OAuthController@personalAccessToken')->name('oauth.personal');
    Route::get('/authorized-clients', 'OAuthController@authorizedClients')->name('oauth.authorized'); 
});
Route::group(['middleware' => 'auth', 'prefix' => 'devices'], function () {
    Route::get('/', 'DevicesController@index')->name('devices');
    Route::get('/jobs', 'DevicesController@jobs')->name('devices.jobs');
});