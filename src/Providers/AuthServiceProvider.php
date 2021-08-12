<?php

namespace Fligno\Auth\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Fligno\Auth\Setting;
use Fligno\Auth\Models\OauthToken;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //$setting = Setting::where('setting','Session')->first();
        $this->registerPolicies();
        Passport::routes();
        //Passport::personalAccessTokensExpireIn(now()->addSeconds($setting->value));
        
       
    }
}
