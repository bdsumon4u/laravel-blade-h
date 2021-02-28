<?php

namespace Hotash\BladeH\Providers;

use Hotash\BladeH\BladeH;
use Hotash\BladeH\Compilers\BladeCompiler;
use Hotash\BladeH\Facades\BladeH as BladeHFacade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

/**
 * Class BladeHServiceProvider
 * @package Hotash\BladeH\Providers
 */
class BladeHServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/blade-h.php', 'blade-h');

        $this->registerFacades();

        $this->app->singleton('blade.compiler', function ($app) {
            return new BladeCompiler($app['files'], $app['config']['view.compiled']);
        });

        $this->app->booting(function () {
            AliasLoader::getInstance()->alias('BladeH', BladeHFacade::class);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/blade-h.php' => config_path('blade-h.php'),
            ], 'config');

            // Registering package commands.
            $this->commands([]);
        }

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'blade-h');
    }

    /**
     * Register facades.
     */
    protected function registerFacades(): void
    {
        $this->app->singleton('blade-h', function ($app) {
            return new BladeH;
        });
    }
}
