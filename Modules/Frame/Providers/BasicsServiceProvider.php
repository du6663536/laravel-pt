<?php

namespace Modules\Frame\Providers;

use Illuminate\Support\ServiceProvider;
// use Modules\Frame\Interfaces\Basics\Api;

use Modules\Frame\Interfaces\Basics\Mysql;
use \Modules\Frame\Services\Api;

class BasicsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Mysql', function($container) {
            return new Mysql;
        });

        $this->app->bind('Modules\Frame\Services\Api', function ($app, $moduleName = 'Mysql') {
            return new Api($app->make($moduleName));
        });
        // $this->app->bind('Modules\Frame\Services\Api', function ($app) {
        //     return new Api($app->make('Mysql'));
        // });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
