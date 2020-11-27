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

Route::prefix('member')->group(function() {
    Route::get('/', 'MemberController@index');
});

Route::domain('member.' . env('APP_DOMAIN'))->group(function () {

    Route::group(['prefix' => 'member'], function () {
        Route::get('index', 'MemberController@index');//http://member.lpt.kf/member/index
    });

});