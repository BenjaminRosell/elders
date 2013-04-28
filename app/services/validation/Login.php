<?php namespace Services\Validation;

class Login extends Validation 
{
	public static $rules = array(
		'email' => 'required',
		'password' => 'required'
		);
}
