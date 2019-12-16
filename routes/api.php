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

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::post('/logout', 'Api\AuthController@logout')->middleware('auth:api');

Route::group(['prefix' => 'control', 'middleware' => 'auth:api', 'namespace' => 'Api'], function () {
    Route::post('/stop-engine', 'TrackerSettingsController@stopEngine');
    Route::post('/resume-engine', 'TrackerSettingsController@resumeEngine');
});

Route::apiResource('fleets', 'Api\FleetController')->middleware('auth:api');
Route::apiResource('trackers', 'Api\TrackerController')->middleware('auth:api');
Route::apiResource('tracker-models', 'Api\TrackerModelController')->middleware('auth:api');


Route::fallback(function(){
    return response()->json(['message' => 'Not Found.'], 404);
})->name('api.fallback.404');
