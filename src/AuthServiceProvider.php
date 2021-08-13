<?php

namespace Fligno\Auth;

use Illuminate\Support\ServiceProvider;
use Fligno\Auth\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Event;
use Fligno\Auth\Listeners\UpdateUsersTimezone;
use Illuminate\Support\Str;
use Illuminate\Console\Scheduling\Schedule;
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
        
       
       AliasLoader::getInstance()->alias('Timezone', \Fligno\Auth\Facades\Timezone::class);
        
       $this->publishes([
            __DIR__ . '/resources/js' => resource_path('/js'),
            __DIR__ . '/config/timezone.php' => config_path('timezone.php'),
            __DIR__ . '/config/frontend.php' => config_path('frontend.php'),
            __DIR__ . '/config/permission.php' => config_path('permisson.php'),
            __DIR__ . '/tests/Feature' => base_path('tests/Feature'),
            __DIR__ . '/resources/img' => public_path('/admin'),
            __DIR__ . '/resources/img' => public_path('/img'),
            __DIR__ . '/database/seeds' => base_path('database/seeders'),
            __DIR__ . '/database/migrations' => base_path('database/migrations'),
            __DIR__ . '/ResourceModels' => app_path('ResourceModels'),
           // __DIR__ . '/resources/views' => resource_path('/views'),
            //__DIR__ . '/Models' => app_path('/Models')
        ], 'auth');
      
        $this->commands([
            Commands\CreateResource::class,
            Console\Commands\EmailScheduler::class,
            Console\Commands\UserExpireToken::class

        ]);
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('token:update')->everyMinute();
            $schedule ->command('email:schedule')->everyMinute();
        });
        $this->registerEventListener();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
      
     

    
        $this->app->bind('timezone', Timezone::class);

        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register factories.
     *
     * @param string $path
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected static function newFactory(): Factory
    {
        return FactoryClass::new();
    }
    private function registerEventListener(): void
    {
        $events = [
            \Illuminate\Auth\Events\Login::class,
            \Laravel\Passport\Events\AccessTokenCreated::class,
        ];

        Event::listen($events, UpdateUsersTimezone::class);
    }
  
   
  
  
}
