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
            return response()->json($setting);
        }
        return response()->json([]);
       
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
        $fetch = Setting::where('setting','Email')->count();
        if($fetch >0)
        {
          Setting::where('setting','Email')->update(['value' => $request->timeout_token,'attr' => $request->date]);
        }else
        {
            $setting  = new Setting;
            $setting -> setting = "Email";
            $setting -> category = "";
            $setting -> value = $request->email_schedule;
            $setting -> attr = $request->date;
           //$setting -> component = "select";
            $setting->save();    
        }
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
