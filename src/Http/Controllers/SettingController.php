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
     
      $setting = Setting::where('setting','Session')->count();
      if($setting >0)
      {
        $setting = Setting::where('setting','Session')->first();

        $option = json_decode($setting->attr);
          return response()->json(['setting'=> $setting,'option' => $option]);
      }else
      {
          $setting = new Setting;
          $setting -> setting ="Session";
          $setting -> value = "Hour";
          $setting -> attr = json_encode([
            "option" =>
            [
                ["value" => "Seconds","text" => "Seconds"],
                ["value" => "Minute","text" => "Minute"],
                ["value" => "Hour","text" => "Hour"],
                ["value" => "Day","text" => "Day"],
                ["value" => "Week","text" => "Week"],
                ["value" => "Month","text" => "Month"],
                ["value" => "Year","text" => "Year"],

            ]
            ]);
          $setting -> time = "2";
          $setting -> component = "checkbox";
          $setting->save();
          $option = json_decode($setting->attr);
          return response()->json(['setting'=> $setting,'option' => $option]);
      }
      
      
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
    public function store(Request $request)
    {
       $setting = Setting::where('setting','Session')->first();
       $setting = Setting::find($setting->id);
       $setting->value = $request -> time;
       $setting->time = $request -> timeout;
       $setting->save();
        
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
