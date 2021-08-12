<?php

namespace Fligno\Auth\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use \Spatie\ShortSchedule\ShortSchedule;
use Fligno\Auth\Models\Setting;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \Fligno\Auth\Console\Commands\UserExpireToken::class,
        \Fligno\Auth\Console\Commands\EmailScheduler::class,
        //\App\Console\Commands\UserExpireToken::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        info(auth()->user());
        $schedule->command('token:update')->everyMinute();
        $schedule ->command('email:schedule')->everyMinute();
       
        
    }
    protected function shortSchedule(ShortSchedule $shortSchedule)
    {
        //$shortSchedule->command('token')->everySecond();
        
    }
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
