<?php

namespace Hotash\BladeH\Providers;

use Hotash\BladeH\BladeH;
use Hotash\BladeH\Builders\FormBuilder;
use Hotash\BladeH\Builders\SelectBuilder;
use Hotash\BladeH\Compilers\BladeCompiler;
use Hotash\BladeH\Facades\BladeH as BladeHFacade;
use Hotash\BladeH\Facades\FormH as FormHFacade;
use Hotash\BladeH\Facades\SelectH as SelectHFacade;
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
            AliasLoader::getInstance()->alias('FormH', FormHFacade::class);
            AliasLoader::getInstance()->alias('SelectH', SelectHFacade::class);
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

        $this->bootHotashComponents();
    }

    /**
     * Register facades.
     */
    protected function registerFacades(): void
    {
        $this->app->singleton('blade-h', function ($app) {
            return new BladeH;
        });

        $this->app->singleton('blade-h.form', function ($app) {
            return new FormBuilder;
        });

        $this->app->singleton('blade-h.select', function ($app) {
            return new SelectBuilder;
        });
    }

    /**
     * Boot components.
     */
    protected function bootHotashComponents(): void
    {
        $this->callAfterResolving('blade.compiler', function ($blade) {
            $prefix = config('blade-h.prefix', '');

            foreach (config('blade-h.components', []) as $alias => $component) {
                $blade->hotash($component, $alias, $prefix);
            }
        });
    }
}
