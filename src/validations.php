<?php 


Validator::extend('verify_password', function($attribute, $value, $parameters)
{
	$verify = DB::connection('mysql')
		->table('users')
		->where('password', '=', md5(trim($value)))
		->count();

	if(!$verify){
		return false;
	}

	return true;
});