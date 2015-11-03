<?php

/*--- improve auth filter using sg style notification ---*/

Route::filter('auth', function()
{
	if (Auth::guest()){
		if (Request::ajax()){
			return Response::make('Unauthorized', 401);
		}
		else{
			Notification::error(trans('notif.need_login'));
			return Redirect::guest('login');
		}
	}
});


Route::filter('admin', function()
{
	$current_user = Auth::user();
	$current_user_group = array(Scienceguard\SG_Util::val($current_user, 'type'));

	if(!in_array('admin', $current_user_group)){
		Notification::error(trans('notif.access_denied'));
		return Redirect::to('admin');
	}
});