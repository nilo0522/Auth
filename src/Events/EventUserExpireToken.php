<?php

namespace Fligno\Auth\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Fligno\Auth\Models\OauthToken;
use Fligno\Auth\Models\Setting;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Schema;
class EventUserExpireToken implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
      if (Schema::hasTable('settings')) {
        // Code to create table
    
      $setting = Setting::where('setting','Session')->get();
      if(count($setting)>0)
      {
        $setting = Setting::where('setting','Session')->first();
        $time = Setting::where('setting','Session')->first()->time;
        $user = auth()->guard('api')->user();
      
         if($user !=null)
         {
           $expire_in="";
           switch($setting->value)
           {
             case "Seconds":
                      $expire_in = now()->addSecond($time);
                      info('ok');
                      break;
             case "Minute":
                      $expire_in = now()->addMinute($time);
                      break;
             case "Hour":
                      $expire_in = now()->addHour($time);
                      break;
             case "Day":
                      $expire_in = now()->addDay($time);
                      break;
             case "Week":
                      $expire_in = now()->addWeek($time);
                      break;
            case "Month":
                      $expire_in = now()->addMonth($time);
                      break;
             case "Year":
                      $expire_in = now()->addYear($time);
                      break;
    
           }
           
           OauthToken::where('user_id',$user->id)->update(['expires_at' => $expire_in]);
          
        
        info('token updated');
       
         }
        }
      //return new Channel('token_update');
      }
    }
}
