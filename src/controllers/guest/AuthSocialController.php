<?php
namespace Scienceguard\SglvLogin\Controllers\Guest;

use Scienceguard\SglvCore\Controllers\BaseController;
use Auth;
use View;
use Input;
use Redirect;
use Response;
use Validator;
use Hash;
use use Exception;
use Event;
use Log;
use Notification;

use Scienceguard\SG_Util;
use App_Util;
use FormRules;
use Facebook;

use User;
use Model\NesiaResetPass;
use Guest\NesiaGuestUser;

class AuthSocialController extends BaseController {

	public function getLoginFacebook()
	{
		return Facebook::authenticate();
	}

	public function getFacebookCallback()
	{
		$fb_callback = Facebook::getCallback();

		if(!$fb_callback){ 
				Notification::error(trans('notif.facebook_login_failed'));
				return Redirect::to('login');
		}

		$fb_user = (object) Facebook::getProfile()->asArray();
		$fb_uid = $fb_user->id;
		$fb_name = $fb_user->name;
		$fb_email = $fb_user->email;

		// check if the email already been registered before
		$params = array('email'=>$fb_email);
		$user = NesiaGuestUser::userLoginFacebook($params);
		
		if($user){
			// if it has been registered check if its already have facebook id
			$user_fb_uid = SG_Util::val($user, 'fb_uid');

			if(!$user_fb_uid){
				// if match user doesnt have fb_uid then update

				$data = array(
						'fb_uid' => 'fb:'.$fb_uid,
						'full_name' => $fb_name,
						'fb_connect' => 'enabled'
					);
				try{
					User::where('id','=',$user->id)->update($data);
					Notification::error(trans('notif.facebook_login_success'));
					return Redirect::intended('member');
				}
				catch(Exception $e){
					Notification::error(trans('notif.facebook_login_failed'));
					Log::error($e);
					return Redirect::to('login');
				}
			}

			// then login
			return NesiaGuestUser::processLogin($user);
		}
		else{
			// else automatically create user
			$data = array(
				'fb_uid' => 'fb:'.$fb_uid,
				'full_name' => $fb_name,
				'username' => SG_Util::slug($fb_name,'_'),
				'email' => $fb_email,
				'created_at' => date(DATE_TIME_FORMAT),
				'password' => '',
				'fb_connect' => 'enabled'
			);

			return NesiaGuestUser::processRegister($data);
		}
	}
}