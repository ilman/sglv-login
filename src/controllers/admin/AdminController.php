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


}
