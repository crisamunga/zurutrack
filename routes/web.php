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


Route::middleware('auth')->get('/webapi/user', 'Api\AuthController@profile');

// Authentication routes
Route::group(['namespace' => 'Web'], function () {
    Auth::routes();
});

// Web API Routes
Route::group(['prefix' => 'webapi', 'middleware' => 'auth', 'namespace' => 'Api'], function () {
    Route::apiResource('fleets', 'FleetController');

    Route::apiResource('trackers', 'TrackerController');

    Route::apiResource('tracker-models', 'TrackerModelController');

    Route::get('users', 'UserController@index')->name('users.index');
    Route::post('users', 'UserController@store')->name('users.store');
    Route::post('users/link', 'UserController@link')->name('users.link');
    Route::post('users/unlink', 'UserController@unlink')->name('users.unlink');
    Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');
});

// Standard page routes

Route::get('/', 'Web\HomeController@index')->name('home')->middleware("auth");
