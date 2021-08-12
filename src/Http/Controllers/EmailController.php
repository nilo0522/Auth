<?php

namespace Fligno\Auth\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Fligno\Auth\Models\Setting;
class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fetch = Setting::where('setting','Email')->count();
        if($fetch >0 )
        {
            $setting  = Setting::where('setting','Email')->first();
           $attr =  json_decode($setting->attr);
          
            return response()->json(['attr'=>$attr,'setting' => $setting]);
        }
        else{
            $setting = new Setting;
            $setting -> setting = "Email";
            $setting->attr = json_encode([
              
                    ['name' => 'Monday','checked' => false],
                    ['name' => 'Tuesday','checked' => false],
                    ['name' => 'Wednesday','checked' => false],
                    ['name' => 'Thursday','checked' => false],
                    ['name' => 'Friday','checked' => false],
                    ['name' => 'Saturday','checked' => false],
                    ['name' => 'Sunday','checked' => false],
                    ['name' => 'Everyday','checked' => false]
                    
                ]);
            $setting -> component ="checkbox";
            $setting -> time = "12:00";
            $setting -> value =json_encode(["Monday"]);
            $setting->save();
            $attr =  json_decode($setting->attr);
          
            return response()->json(['attr'=>$attr,'setting' => $setting]);
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
        $request->validate([
           'email_time' => 'required'
            

            
        ]);
        
       $setting = Setting::where('setting','Email')->first();
       $setting = Setting::find($setting->id);
       $setting -> value = $request-> days;
       $setting -> time = $request-> email_time;
       $setting ->save();
       return response()->json($setting);
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
