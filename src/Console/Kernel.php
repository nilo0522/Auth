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
       $schedule->command('token:update')->everyMinute();
       $email_schedule = Setting::where('setting','Email')->first();
       switch($email_schedule->attr)
       {
           case 'Minute':
               $schedule ->command('email:schedule')->everyMinute();
               info('schedule set to every '.$email_schedule->attr);
               break;
           case 'Hour' :
               $schedule ->command('email:schedule')->everyHour();
               info('schedule set to every '.$email_schedule->attr);
               break;
           case 'Day' :
               $schedule ->command('email:schedule')->everyDay();
               info('schedule set to every '.$email_schedule->attr);
               break;
           case 'Week' :
               $schedule ->command('email:schedule')->everyWeek();
               info('schedule set to every '.$email_schedule->attr);
               break;
           case 'Month':
               $schedule ->command('email:schedule')->everyMonth();
               info('schedule set to every '.$email_schedule->attr);
               break;
           case 'Year' :
               $schedule ->command('email:schedule')->everyYear();
               info('schedule set to every '.$email_schedule->attr);
               break;
         
       }
        
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
