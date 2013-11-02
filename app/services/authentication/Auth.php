<?php namespace Services\Authentication;


class Auth {
	public function __construct() {

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

		\Mail::send('emails.auth.activateuser' , $data , function($message)
		{
			$message->to($user->email , 'Example')->subject('email signup');
		});	
	}

	public function registration_errors() {

	}
}