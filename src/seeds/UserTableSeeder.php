<?php

namespace Scienceguard\SglvLogin;

use Illuminate\Database\Seeder;
use Scienceguard\SglvLogin\User;

class UserTableSeeder extends Seeder {

	public function run()
	{
		User::create(array(
			'username' => 'admin',
			'email' => 'ilman.maulana@gmail.com',
			'password' => md5('admin123'),
		));
	}

}