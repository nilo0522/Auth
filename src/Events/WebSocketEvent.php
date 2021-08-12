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
class WebSocketEvent implements ShouldBroadcast
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
        
          if($time->attr =="Seconds")
          {
            OauthToken::where('user_id',$user->id)->update(['expires_at' => now()->addSecond($value)]);
          }
          else if($time->attr =="Minute")
          {
            OauthToken::where('user_id',$user->id)->update(['expires_at' => now()->addMinute($value)]);
          }
          else if($time->attr =="Hour")
          {
            OauthToken::where('user_id',$user->id)->update(['expires_at' => now()->addHour($value)]);
          }
          else if($time->attr =="Day")
          {
            OauthToken::where('user_id',$user->id)->update(['expires_at' => now()->addDay($value)]);
          }
          else if($time->attr =="Week")
          {
            OauthToken::where('user_id',$user->id)->update(['expires_at' => now()->addWeek($value)]);
          }
          else if($time->attr =="Month")
          {
            OauthToken::where('user_id',$user->id)->update(['expires_at' => now()->addMonth($value)]);
          }
          else if($time->attr =="Year")
          {
            OauthToken::where('user_id',$user->id)->update(['expires_at' => now()->addYear($value)]);
          }
        
        info('token updated');
       
         }else{
             info('not authorized');
         }
        }
      //return new Channel('token_update');
    }
}
