<?php

namespace Fligno\Auth\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Fligno\Auth\Models\Setting;
use Fligno\Auth\Traits\AuthenticatesUsers;
 use Fligno\Auth\Models\OauthToken;
class SettingController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$user = auth()->guard('api')->user();
      //  OauthToken::where('user_id',$user->id)->delete();
      $setting = Setting::where('setting','Session')->first();
        return response()->json($setting);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $f1 = Setting::where('setting','Session')->count();
        if($f1 >0)
        {
          Setting::where('setting','Session')->update(['value' => $r->timeout_token,'attr' => $r->date]);
        }else
        {
            $setting  = new Setting;
            $setting -> setting = "Session";
            $setting -> category = "";
            $setting -> value = $r->timeout_token;
            $setting -> attr = $r->date;
           //$setting -> component = "select";
            $setting->save();    
        }
        
       // return 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
