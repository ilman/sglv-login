<?php 

namespace Scienceguard\SglvLogin;

use Input;
use Validator;

class FormRules{

	public static function formLogin()
    {
        $input = Input::all();

        $rules = array(
            'username' => 'required',
            'password' => 'required',
        );

        $validator = Validator::make($input, $rules);

        return $validator;
    }

	public static function formRegister()
    {
        $input = Input::all();

        $rules = array(
            'username' => 'required|alpha_num|min:5',
            'password' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        );
        $validator = Validator::make($input, $rules);

        return $validator;
    }

    public static function formForgot()
    {
        $input = Input::all();

        $rules = array(
            'email' => 'required',
        );
        $validator = Validator::make($input, $rules);

        return $validator;
    }

    public static function formResetPass()
    {
        $input = Input::all();

        $rules = array(
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        );
        $validator = Validator::make($input, $rules);

        return $validator;
    }

    public static function formAdminUser()
    {
        $input = Input::all();

        $rules = array(
            'username' => 'required',
            'email' => 'required',
        );
        $validator = Validator::make($input, $rules);

        return $validator;
    }

    public static function formPassword()
    {
        $input = Input::all();

        $rules = array(
            // 'old_password' => 'required',
            'new_password' => 'required',
            'confirm_new_password' => 'required|same:new_password',
        );

        if(\Config::get('sglv_login.complex_password')){
            $rules['new_password'] = 'required|min:5|case_diff|numbers|letters|symbols';
        }

        $validator = Validator::make($input, $rules);

        return $validator;
    }

}