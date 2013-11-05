<?php namespace Services\Authentication;


class Auth {
	public function __construct() {

	}

	public function getUserInfo()
	{
		if(!\Sentry::check()) return false;
		try
		{
			$user = \Sentry::getUser();
		}	
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			return false;
		}
		return $user;
	}

	public function login($fields)
	{
		$throttleProvider = \Sentry::getThrottleProvider();
		$throttleProvider->disable();		
		$user = \Sentry::authenticate(
			array(
				'email' => $fields['username'] ,
				'password' => $fields['passwords'] ,
			) , 
			false
		);

		return $user;
		
	}

	public function logout()
	{
		if(\Sentry::check())
			\Sentry::logout();
	}

	public function register($fields, $groupname) {
		$user = \Sentry::register(
			array(
				'email' => $fields['email'] ,
				'first_name' => $fields['first_name'] ,
				'last_name' => $fields['last_name'] ,
				'password' => $fields['passwords'] ,
			));

		$group = \Sentry::getGroupProvider()->findByName($groupname);
		$user->addGroup($group);

		return $user;
	}

	public function send_activation_email($user) {
		//Send activation code to the user so he can activate the account
		$data = array(
			'name'		 => $user->first_name.$user->last_name,
			'email'      => $user->email,
			'activation' => $user->getActivationCode(),
		);

		\Mail::send('emails.auth.activateuser' , $data , function($message) use ($data)
		{
			$message->to($data['email'] , 'Example')->subject('email signup');
		});	
	}

	public function registration_errors() {

	}
}