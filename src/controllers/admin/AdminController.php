<?php

namespace Scienceguard\SglvLogin\Controllers\Admin;

use Scienceguard\SglvCore\Controllers\BaseController;
use View;
use Input;
use Redirect;
use Exception;
use Event;
use Log;
use Notification;

use Model\User;

use Scienceguard\SG_Util;
use Scienceguard\SglvLogin\FormRules;

class AdminController extends BaseController {

	public function __construct()
	{
		\Lib\Template::setBaseDir(realpath(__DIR__.'/../../'));
	}

	public function getIndex()
	{
		$data = array(
			'content' => 'admin/user/dashboard',
			'values' => Input::old(),
		);

		return View::make($this->template, $data);
	}

	public function getPassword()
	{
		$data = array(
			'content' => 'admin/admin/password',
			'values' => Input::old(),
		);

		return View::make($this->template, $data);
	}

	public function postPassword()
	{
		$current_user = \CurrentUser::getUser();
		$user_id = $current_user->id;
		
		$validator = FormRules::formPassword();
		if($validator->fails()){
			return Redirect::to('admin/password')
			->withErrors($validator)->withInput();
		}

		try{
			$data = array(
				'password' => md5(Input::get('new_password'))
			);
			\User::where('id', '=', $user_id)->update($data);

			Notification::success(trans('notif.change_password_success'));
			return Redirect::to('admin/password');
		}
		catch(Exception $e){
			Log::error($e);
			Notification::error(trans('notif.change_password_failed'));
			return Redirect::to('admin/password');
		}
	}

}
