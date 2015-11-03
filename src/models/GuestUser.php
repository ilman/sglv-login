<?php 

namespace Scienceguard\SglvLogin;

use Eloquent;
use DB;
use Auth;
use Event;
use Log;
use Notification;
use Redirect;

use Scienceguard\SglvLogin\User;


class GuestUser extends Eloquent{

	public static function userLogin($params=array()){
		extract((array)$params);

		$username = (isset($username)) ? $username : '';
		$password = (isset($password)) ? $password : '';

		$model = DB::connection('mysql')
		->table('users as u')
		->where(function($query) use ($username){
			$query->where('username', '=', $username)
        	->orWhere('email', '=', $username);
		})        
      ->where('password', '=', md5($password));

		return $model->first();
	}

	public static function userLoginFacebook($params=array()){
		extract((array)$params);

		$model = DB::connection('mysql')
		->table('users as u')
        ->where('email', '=', $email);

		return $model->first();
	}

	public static function validateUserResetPass($username, $code)
	{
		$model = DB::connection('mysql')
		->table('user_reset_pass as urp')
		->join('users as u', 'u.id', '=', 'urp.user_id')
		->whereRaw("(username = '$username' AND code = '$code')");

		return $model->count();
	}

	public static function processLogin($user){
		if($user){
			Auth::loginUsingId($user->id);

			Event::fire('user.login', array($user));

			Notification::success(trans('notif.user_login_success'));
			return Redirect::intended('admin');
		}
		else{
			Event::fire('user.login_failed');

			Notification::error(trans('notif.user_login_failed'));
			return Redirect::to('login');
		}
	}

	public static function processRegister($data){
		try{
			$user = User::create($data);
			Auth::loginUsingId($user->id);

			Event::fire('user.register', array($user));

			Notification::success(trans('notif.user_register_success'));
			return Redirect::intended('admin');
		}
		catch(Exception $e){
			Notification::error(trans('notif.user_register_failed'));
			Log::error($e);
			return Redirect::to('register');
		}
	}
}