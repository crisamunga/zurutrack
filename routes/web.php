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

// Authentication routes
Route::group(['namespace' => 'Web'], function () {
    Auth::routes();
});

// Web API Routes
Route::group(['prefix' => 'webapi', 'middleware' => 'auth', 'namespace' => 'Api'], function () {
    Route::apiResource('fleets', 'FleetController');
    Route::apiResource('trackers', 'TrackerController');
    Route::apiResource('tracker-models', 'TrackerModelController');
});

// Standard page routes

Route::get('/', 'Web\HomeController@index')->name('home')->middleware("auth");
