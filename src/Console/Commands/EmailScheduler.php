<?php

namespace Fligno\Auth\Console\Commands;

use Fligno\Auth\Models\Newsletter;
use Illuminate\Console\Command;
use Fligno\Auth\Mail\WebsiteLaunched;
use Illuminate\Support\Facades\Mail;
use Fligno\Auth\Models\Setting;
use Illuminate\Support\Carbon;
class EmailScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $emails = NewsLetter::all();
        $todaydate =Carbon::now()->format('l');
        $todaytime = Carbon::now()->format('H:i');
        $setting = Setting::where('setting','Email')->first();
        $days = json_decode($setting->value);
        $time = $setting->time;
        foreach($days as $day )
        {
            
           if($todaydate == $day && $time == $todaytime )
           {
               foreach($emails as $email)
               {
                 Mail::to($email)->send(new WebsiteLaunched());
                 info('email successfully send');
               }
            
           }
        }
        info('asdasd');
       
    }
   
}
