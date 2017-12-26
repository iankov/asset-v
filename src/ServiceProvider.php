<?php

namespace Iankov\AssetV;

use Iankov\AssetV\Commands\AssetvUpdate;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/' => base_path('config/'),
        ], 'assetv_config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/assetv.php', 'assetv');

        include __DIR__.'/helpers.php';

        $this->app->singleton('command.assetv.update', function($app) {
            return new AssetvUpdate();
        });

        $this->commands('command.assetv.update');
    }
}
