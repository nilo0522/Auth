<?php

namespace Fligno\Auth\Http\Controllers;

use Fligno\Auth\Http\Controllers\Controller;
use Fligno\Auth\Traits\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    use ThrottlesLogins;

    protected $maxAttempts = 2;
	/**
 	* Number of minutes to lock the login.
 	*/
	protected $decayMinutes = 1; 	

	public function login(Request $request)
    {
        $this->validateLogin($request);
       
        if (!$this->attemptLogin($request)) {    	
        	if ($this->hasTooManyLoginAttempts($request)) {
        		$this->fireLockoutEvent($request); //Fire the lockout event.
        		return $this->sendLockoutResponse($request); //redirect the user back after lockout.
    		}

    		$this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse();
        }

     	return $this->sendLoginResponse($request);
    }
	public function logout()
{ 
//	auth()->user()->token()->revoke();
    
	   return redirect('admin/login');
    
}
	
}
