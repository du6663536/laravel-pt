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
    
    //策略模式中，策略容器（上下文context）并不知道内部策略的详细信息，因为容器并没有实现与内部策略相同的接口，即容器与内部策略只是简单的组合关系，容器只是将内部策略的行为抽取出来，进行了统一的实现。
    //和代理还是很像的（如果 策略容器和内部策略实现相同接口，就和代理一样了）
    Route::group(['prefix' => 'strategy'], function () {
        Route::get('index', 'StrategyController@index');//http://design.lpt.dev/strategy/index
    });
    
    //抽象主题  真实主题   代理对象     （简单代理模式中，代理类知道被代理类的行为，因为代理类与被代理类实现的是同一个接口，因此代理类与被代理类的结构是相同的）
    //代理对象 依赖 抽象主题，即代理对象中调用抽象主题中的方法是由真实主题实现的。（网上有些写法是，代理对象 依赖 真实主题，这种写法不好。）
    Route::group(['prefix' => 'proxy'], function () {
        Route::get('index', 'ProxyController@index');
    });

    //策略模式，客户端调用，由客户自己决定使用哪种策略，即客户自行实例化算法类。区别于简单工厂模式
    //简单工厂模式是对象的创建模式，客户端不创建对象，只给出参数，由工厂方法来决定创建哪一个实例
    //也就是说，简单工厂模式客户端只传参数，策略模式客户端传算法实例
    Route::group(['prefix' => 'factory'], function () {
        Route::get('index', 'FactoryController@index');
    });
});