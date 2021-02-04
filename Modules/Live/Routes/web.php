<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('live')->group(function() {
    Route::get('/', 'LiveController@index');
});

Route::domain('live.' . env('APP_DOMAIN'))->group(function () {
    Route::group(['prefix' => 'room'], function () {
        Route::get('index', 'RoomController@index');//http://live.lpt.kf/room/index
    });

    Route::group(['prefix' => 'video'], function () {
        Route::get('index', 'VideoController@index');
        Route::get('clef', 'VideoController@clef');
    });

});