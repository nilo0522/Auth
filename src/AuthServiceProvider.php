<?php

namespace Fligno\Auth;

use Illuminate\Support\ServiceProvider;
use Fligno\Auth\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class AuthServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot()
    {
        // Load view
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'Auth');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // Load factories
       // $this->registerEloquentFactoriesFrom(__DIR__ . '/database/factories');

        $this->publishes([
            __DIR__ . '/resources/js' => resource_path('/js'),
            __DIR__ . '/config/frontend.php' => config_path('frontend.php'),
            __DIR__ . '/tests/Feature' => base_path('tests/Feature'),
            __DIR__ . '/resources/img' => public_path('/img'),
            __DIR__ . '/database/seeds' => base_path('database/seeds'),
            __DIR__ . '/ResourceModels' => app_path('ResourceModels')
        ], 'auth');

        $this->commands([
            Commands\CreateResource::class
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

}
