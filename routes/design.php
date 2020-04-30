<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 子域名路由 design 
|--------------------------------------------------------------------------
|
| 设计模式
|
*/

Route::domain('design.' . env('APP_DOMAIN'))->group(function () {
    
    //测试
    Route::group(['prefix' => 'strategy'], function () {
        Route::get('part1', 'StrategyController@part1');
    });
    
});