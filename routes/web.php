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

Route::get('/', 'HomeController@index')->name('dashboard');
Route::group(['middleware' => 'auth', 'prefix' => 'oauth'], function () {
    Route::get('/clients', 'OAuthController@clients')->name('oauth.clients');
    Route::get('/personal-access-token', 'OAuthController@personalAccessToken')->name('oauth.personal');
    Route::get('/authorized-clients', 'OAuthController@authorizedClients')->name('oauth.authorized'); 
});
Route::group(['middleware' => 'auth', 'prefix' => 'devices'], function () {
    Route::get('/', 'DevicesController@index')->name('devices');
    Route::get('/jobs', 'DevicesController@jobs')->name('devices.jobs');
});
Route::group(['middleware' => 'auth', 'prefix' => 'news'], function () {
    Route::get('/', 'NewsController@index')->name('news');
   // Route::get('/jobs', 'DevicesController@jobs')->name('devices.jobs');
});

Route::group(['middleware' => 'auth', 'prefix' => 'settings'], function () {
    Route::get('/account', 'SettingsController@index')->name('settings.account');
   // Route::get('/jobs', 'DevicesController@jobs')->name('devices.jobs');
});

Route::group(['middleware' => 'auth', 'prefix' => 'shopping'], function () {
    Route::get('/categories', 'ShoppingCategoryController@index')->name('shopping.categories');
    Route::get('/categories/create', 'ShoppingCategoryController@create')->name('shopping.categories.create');
    Route::post('/categories/store', 'ShoppingCategoryController@store')->name('shopping.categories.store');
    Route::get('/categories/{categoryId}/edit', 'ShoppingCategoryController@edit')->name('shopping.categories.edit');
    Route::get('/categories/{categoryId}', 'ShoppingCategoryController@show')->name('shopping.categories.show');
    Route::post('/categories/update', 'ShoppingCategoryController@update')->name('shopping.categories.update');
    Route::get('/items', 'ShoppingItemController@index')->name('shopping.items');
    Route::get('/items/create', 'ShoppingItemController@create')->name('shopping.items.create');
    Route::post('/items/store', 'ShoppingItemController@store')->name('shopping.items.store');
    Route::get('/items/{itemId}/edit', 'ShoppingItemController@edit')->name('shopping.items.edit');
    Route::post('/items/update', 'ShoppingItemController@update')->name('shopping.items.update');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/device/{deviceId}/settings', 'DeviceSettingsController@show')->name('device.settings');    
});
