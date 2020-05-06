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

Route::prefix('design')->group(function() {
    Route::get('/', 'DesignController@index');//http://www.lpt.dev/design
});


//设计模式
Route::domain('design.' . env('APP_DOMAIN'))->group(function () {
    
    //测试
    Route::group(['prefix' => 'strategy'], function () {
        Route::get('index', 'StrategyController@index');//http://design.lpt.dev/strategy/index
    });
    
});