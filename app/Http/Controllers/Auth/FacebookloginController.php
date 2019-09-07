<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\User;
use Auth;
use Redirect;

class FacebookloginController extends Controller
{

    /**
	* Create a redirect method to facebook api.
	*
	* @return void
	*/
	public function redirectToFacebook()
	{
		return Socialite::driver('facebook')->redirect();
	}
	/**
	* Return a callback method from facebook api.
	*
	* @return callback URL from facebook
	*/
	public function callback()
	{
	  	$userSocial = Socialite::driver('facebook')->user();
  		//return $userSocial;
  		$finduser = User::where('email', $userSocial->email)->first();
  		if($finduser){
      		Auth::login($finduser);
      		return Redirect::to('/');
  		}else{
  			$new_user = $this->User->create([
		        'name'       => $userSocial->name,
		        'email'      => $userSocial->email,
		        'facebook_id'=> $userSocial->id,
		        'password'   => bcrypt($userSocial->id)
		    ]);
    		Auth::login($new_user);
    		return redirect()->back();
		}
	}
}
