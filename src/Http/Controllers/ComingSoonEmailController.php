<?php

namespace Fligno\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
//use Fligno\Auth\Mail\WebsiteLaunched;
use App\Mail\WebsiteLaunched;
//use Fligno\Auth\Models\AppSetting;
use Fligno\Auth\Models\Newsletter;
use Illuminate\Support\Facades\Mail;
use Fligno\Auth\Models\AppSetting;
use Illuminate\Http\Request;
use Fligno\Auth\Models\User;
class ComingSoonEmailController extends Controller
{
    /**
     * Get app setting for coming_soon value.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //$subject = AppSetting::where('subject', 'subject')->first();
       // $content = AppSetting::where('key', 'content')->first();

        /*return response()->json([
            'coming_soon_email_subject' => $subject->value,
            'coming_soon_email_content' => $content->value,
        ]);*/
        $fetch = AppSetting::all()->count();
        if($fetch >0 )
        {
            $comingsoon = AppSetting::first()->get();
            return response()->json($comingsoon);
        }
       


    }

    /**
     * Toggle coming_soon value in app setting.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        request()->validate([
            'subject' => 'required',
           // 'content' => 'required',
        ]);

       /* AppSetting::where('coming_soon_email_subject', )->update([
            'value' => request()->coming_soon_email_subject
        ]);

        AppSetting::where('key', 'coming_soon_email_content')->update([
            'value' => request()->coming_soon_email_content
        ]);*/
        $app_setting = new AppSetting;
        $app_setting ->subject = $request -> subject;
        $app_setting ->content = $request -> content;
        $app_setting -> save();

        return response()->json($app_setting, 204);
    }

    /**
     * Send launched email
     */
    public function send()
    {
       /* $emails = Newsletter::all()->pluck('email')->toArray();

        foreach ($emails as $email) {
            Mail::to($email)->send(new WebsiteLaunched());
        }

        return response()->json([], 204);*/

        $emails = NewsLetter::all();
        foreach($emails as $email)
        {
            Mail::to($email)->send(new WebsiteLaunched());
        }
    }
}
