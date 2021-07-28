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
      $time = Setting::where('setting','Session')->get();
      if(count($time)>0)
      {
        $time = Setting::where('setting','Session')->first();
        $value = Setting::where('setting','Session')->first()->value;
        $user = auth()->guard('api')->user();
      
         if($user !=null)
         {
           $expire_in="";
           switch($time->attr)
           {
             case "Seconds":
                      $expire_in = now()->addSecond($value);
                      break;
             case "Minute":
                      $expire_in = now()->addMinute($value);
                      break;
             case "Hour":
                      $expire_in = now()->addHour($value);
                      break;
             case "Day":
                      $expire_in = now()->addDay($value);
                      break;
             case "Week":
                      $expire_in = now()->addWeek($value);
                      break;
            case "Month":
                      $expire_in = now()->addMonth($value);
                      break;
             case "Year":
                      $expire_in = now()->addYear($value);
                      break;
    
           }
           
           OauthToken::where('user_id',$user->id)->update(['expires_at' => $expire_in]);
          
        
        info('token updated');
       
         }
        }
      //return new Channel('token_update');
    }
}
