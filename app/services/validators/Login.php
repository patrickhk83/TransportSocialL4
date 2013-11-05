<?php namespace Services\Validators;

class Login extends Validator {
	public static $rules = array (
		'username' => 'required|email',
		'passwords' => 'required',
	);
}
