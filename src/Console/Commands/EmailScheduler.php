<?php

namespace App\Console\Commands;

use Fligno\Auth\Models\Newsletter;
use Illuminate\Console\Command;
use Fligno\Auth\Mail\WebsiteLaunched;
use Illuminate\Support\Facades\Mail;
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
        foreach($emails as $email)
        {
            Mail::to($email)->send(new WebsiteLaunched());
        }
        info('email successfully send');
    }
}
