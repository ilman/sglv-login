<?php

namespace Scienceguard\SglvLogin;

use Eloquent;

class User extends Eloquent {

	protected $table = 'users';
	protected $guarded = array('id');
	protected $protected = array('password', 'remember_token');

}
