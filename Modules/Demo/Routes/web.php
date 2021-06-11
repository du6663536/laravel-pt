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

Route::prefix('demo')->group(function() {
    Route::get('/', 'DemoController@index');
});

Route::domain('demo.' . env('APP_DOMAIN'))->group(function () {
    Route::group(['prefix' => 'basics'], function () {
        Route::get('index', 'BasicsController@index');//http://demo.lpt.kf/basics/index
    });

    Route::group(['prefix' => 'property'], function () {
        Route::get('yield/{is_yield}', 'PropertyController@yield');//http://demo.lpt.kf/property/yield
    });

    Route::group(['prefix' => 'property'], function () {
        Route::get('multiYield', 'PropertyController@multiYield');
    });

    Route::group(['prefix' => 'orm'], function () {
        Route::get('favorites', 'OrmController@favorites');
        Route::get('favorites/member', 'OrmController@favoritesMember');
        Route::get('samples', 'OrmController@samples');
        Route::get('extractions', 'OrmController@extractions');
        Route::get('data', 'OrmController@data');
        Route::get('user_identity_cards', 'OrmController@userIdentityCards')->name('users.identity_cards');
        Route::get('article_comments', 'OrmController@articleComments')->name('article.comments');
        Route::get('role_users', 'OrmController@roleUsers')->name('role.users');
        Route::get('author_famous_books', 'OrmController@authorFamousBooks')->name('author.famous_books');
        Route::get('author_books', 'OrmController@authorBooks')->name('author.books');
        Route::get('morph', 'OrmController@morph');
    });


    Route::group(['prefix' => 'query'], function () {
        Route::get('getList', 'QueryController@getList');//http://demo.lpt.kf/query/getList
    });
    
});