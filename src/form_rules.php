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

}