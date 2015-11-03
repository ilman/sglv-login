<?php

/*--- basic login root ---*/

Route::group(
	array(
		'prefix'=>'',
		'namespace' => 'Scienceguard\SglvLogin\Controllers\Guest'
	),
	function(){
		Route::get('login', 'AuthController@getLogin');
		Route::post('login', 'AuthController@postLogin');

		Route::get('register', 'AuthController@getRegister');
		Route::post('register', 'AuthController@postRegister');

		Route::get('login-facebook', 'AuthSocialController@getLoginFacebook');
		Route::get('facebook/callback', 'AuthSocialController@getFacebookCallback');
		
		Route::get('logout', 'AuthController@getLogout');
		
		Route::get('forgot', 'AuthController@getForgot');
		Route::post('forgot', 'AuthController@postForgot');

		Route::get('reset', 'AuthController@getReset');
		Route::post('reset', 'AuthController@postReset');
	}
);

Route::group(
	array(
		'prefix' => 'admin',
		'namespace' => 'Scienceguard\SglvLogin\Controllers\Admin',
		'before' => 'auth'
	),
	function(){
		Route::get('', 'AdminController@getIndex');
	}
);