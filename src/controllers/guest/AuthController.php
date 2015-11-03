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
use App;
use Exception;
use Event;
use Log;
use Notification;

use Scienceguard\SG_Util;
use App_Util;
use Scienceguard\SglvLogin\FormRules;
use Facebook;

use User;
use Scienceguard\SglvLogin\ResetPass;
use Scienceguard\SglvLogin\GuestUser;


class AuthController extends BaseController {

	public function __construct()
	{
		\Lib\Template::setBaseDir(realpath(__DIR__.'/../../'));
	}

	public function getRegister()
	{
		if(Auth::check()){
			Notification::success(trans('notif.already_logged_in'));
			return Redirect::intended('admin');
		}

		$data = array(
			'values' => Input::old(),
			'content' => 'guest/auth/register',
			'subheader' => false,
			'template' => 'template_login',
		);

	   return View::make($this->template, $data);
	}

	public function getLogin()
	{
		if(Auth::check()){
			Notification::success(trans('notif.already_logged_in'));
			return Redirect::intended('admin');
		}

		$data = array(
			'values' => Input::old(),
			'content' => 'guest/auth/login',
			'subheader' => false,
			'template' => 'template_login',
		);

		return View::make($this->template, $data);
	}

	public function getForgot()
	{
		if(Auth::check()){
			Notification::success(trans('notif.already_logged_in'));
			return Redirect::intended('admin');
		}

		$data = array(
			'values' => Input::old(),
			'content' => 'guest/auth/forgot',
			'subheader' => false,
		);

		return View::make($this->template, $data);
	}

	public function getReset()
	{
		if(Auth::check()){
			Notification::success(trans('notif.already_logged_in'));
			return Redirect::intended('admin');
		}

		$values = (Input::old()) ? Input::old() : Input::all();

		$data = array(
			'values' => Input::old(),
			'content' => 'guest/auth/reset',
			'subheader' => false,
		);

		return View::make($this->template, $data);
	}

	public function postRegister()
	{
		$validator = FormRules::formRegister();
		if($validator->fails()){
			return Redirect::to('register')
			->withErrors($validator)->withInput();
		}

		$data = array(
			'username' => Input::get('username'),
			'password' => md5(Input::get('password')),
			'email' => Input::get('email'),
		);

		return GuestUser::processRegister($data);
	}


	public function postLogin()
	{
		$validator = FormRules::formLogin();
		if($validator->fails()){
			return Redirect::to('login')
			->withErrors($validator)->withInput();
		}

		$data = array(
			'username' => Input::get('username'),
			'password' => Input::get('password'),
		);

		$user = GuestUser::userLogin($data);

		return GuestUser::processLogin($user);
	}


	public function postForgot()
	{
		$validator = FormRules::formForgot();
		if($validator->fails()){
			return Redirect::to('forgot')
			->withErrors($validator)->withInput();
		}

		$email = Input::get('email');

		$user = User::whereRaw("(username = '$email' OR email = '$email')")->first();
		$user_id = SG_Util::val($user, 'id');

		if(!$user_id){
			Notification::error(trans('notif.username_email_not_exist'));
		   return Redirect::to('forgot');
		}

		$code = md5(time());

		$data = array(
			'user_id' => $user_id,
			'code' => $code,
			'request_time' => date(DATE_TIME_FORMAT)
		);

		try{
			ResetPass::create($data);

			//kirim email
			Event::fire('user.forgot', array($user, $code));

			Notification::success(trans('notif.email_reset_pass_success'));
			return Redirect::to('login');
		}
		catch(Exception $e){
			Log::error($e);
			Notification::error(trans('notif.email_reset_pass_failed'));
			return Redirect::to('forgot');
		}
	}

	public function postReset()
	{
		$validator = FormRules::formResetPass();
		if($validator->fails()){
			return Redirect::to('reset')
			->withErrors($validator)->withInput();
		}

		$username = Input::get('username');
		$code = Input::get('code');
		$password = Input::get('password');

		
		if(!GuestUser::validateUserResetPass($username, $code)){
			Notification::error('notif.reset_pass_validation_failed');
			return Redirect::to('login');
		}

		$data = array(
			'password' => md5($password),
		);

		try{
			User::where('username', '=', $username)->update($data);

			$user = User::where('username', '=', $username)->first();

			//kirim email
			Event::fire('user.reset_pass', array($user));

			Notification::success(trans('notif.reset_pass_success'));
			return Redirect::to('login');
		}
		catch(Exception $e){
			Log::error($e);
			Notification::error(trans('notif.reset_pass_failed'));
			return Redirect::to('login');
		}
	}

	public function getLogout()
	{
		Auth::logout();

		Notification::success(trans('notif.user_logout_success'));
		return Redirect::to('login');
	}
}