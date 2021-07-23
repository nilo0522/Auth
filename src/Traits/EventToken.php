<?php

namespace Fligno\Auth\Traits;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Passport\Passport;
use Fligno\Auth\Models\Setting;
use  Fligno\Auth\Models\OauthToken;
trait EventToken
{
    public function getEvent()
    {
     Passport::personalAccessTokensExpireIn(now()->addSeconds(10));
    }
 
    public function setTokenExpire()
    {
        $time = Setting::where('setting','Session')->first()->value;
        $user = auth()->guard('api')->user();
        
        $oauth = OauthToken::where('user_id',$user->id)->update(['expires_at' => now()->addSecond($time)]);
    }
}