<?php 

use Scienceguard\SG_Util;

Event::listen('user.register', function($user){
   // sent welcome email
}, 10);

Event::listen('user.login', function($user){
   // sent notif email
}, 10);

Event::listen('user.change_password', function($user){
   // sent notif email
}, 10);

Event::listen('user.forgot', function($user, $code){
   // sent notif email
   $subject = trans('email.auth_forgot_password');
	$to = SG_Util::val($user, 'email');
	$content = 'auth_forgot_password';

	$username = SG_Util::val($user, 'username');
	$data = array(
		'username' => $username,
		'code' => $code,
	);

	// App_Util::sendMail($subject, $to, $content, $data);
}, 10);