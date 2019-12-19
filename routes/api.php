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

Route::middleware('auth:api')->get('/user', 'Api\AuthController@profile');

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::post('/logout', 'Api\AuthController@logout')->middleware('auth:api');

Route::group(['prefix' => 'control', 'middleware' => 'auth:api', 'namespace' => 'Api'], function () {
    Route::post('/stop-engine', 'TrackerSettingsController@stopEngine');
    Route::post('/resume-engine', 'TrackerSettingsController@resumeEngine');
});


Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function () {
    Route::apiResource('fleets', 'FleetController');
    
    Route::apiResource('trackers', 'TrackerController');

    Route::apiResource('tracker-models', 'TrackerModelController');

    Route::get('users', 'UserController@index')->name('users.index');
    Route::post('users', 'UserController@store')->name('users.store');
    Route::post('users/link', 'UserController@link')->name('users.link');
    Route::post('users/unlink', 'UserController@unlink')->name('users.unlink');
    Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');
});

Route::fallback(function(){
    return response()->json(['message' => 'Not Found.'], 404);
})->name('api.fallback.404');
