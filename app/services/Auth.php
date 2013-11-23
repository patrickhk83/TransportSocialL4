<?php namespace Services;


class Auth {

	public $errors = array();

	public function __construct() {

	}

	public function getUserInfo()
	{
		try
		{
			$user = \Sentry::getUser();
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$this->errors[] = "User not found";
		}
		return $user;
	}

	public function getUserPhotos($user_id , $photo_id = null)
	{
		$photos = \User::find($user_id)->photos();
		if(!is_null($photo_id)) {
			return $photos = $photos->where('id', '=', $photo_id)->first();
		}
		return $photos->get();

	}

	public function getCountries($country_code = null)
	{
		if(is_null($country_code))
		{
			$countries = \Country::lists('name', 'code');
			return $countries;
		}
		else
		{
			$country = \Country::where('code' , '=', $country_code)->first();
			return $country;
		}

	}

	public function login($fields)
	{
		try {
			$throttleProvider = \Sentry::getThrottleProvider();
			$throttleProvider->disable();
			$user = \Sentry::authenticate(
				array(
					'email' => $fields['username'] ,
					'password' => $fields['passwords'] ,
				) ,
				false
			);
		}
		catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
		    $this->errors[] = 'User not activated.';
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$this->errors[] = 'User not found.';
		}
		return $user;

	}

	public function activate($activation_code, $id) {
		try
		{
		    $user = \Sentry::findUserById($id);
		    if (!$user->attemptActivation($activation_code))
		    {
		        $this->errors[] = "Your account was not activated";
				}
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    $this->errors[] = 'User was not found.';
		}
		catch (\Cartalyst\Sentry\Users\UserAlreadyActivatedException $e)
		{
		    $this->errors[] = 'User is already activated.';
		}
	}

	public function logout()
	{
		\Sentry::logout();
	}

	public function register($fields, $groupname) {
		try {
			$user = \Sentry::register(
			array(
				'email' => $fields['email'] ,
				'first_name' => $fields['first_name'] ,
				'last_name' => $fields['last_name'] ,
				'password' => $fields['passwords'] ,
			));
		}
		catch(\Cartalyst\Sentry\Users\UserExistsException $e)
		{
			$this->errors[] = 'User with this login already exists.';
		}

		$group = \Sentry::getGroupProvider()->findByName($groupname);
		$user->addGroup($group);

		return $user;
	}

	public function update($fields)
	{
		try {
			$user = \Sentry::getUser();

			$user->first_name = $fields['first_name'];
			$user->last_name = $fields['last_name'];
			$user->email = $fields['email'];
			$user->company = $fields['occupation'];
			$user->country = $fields['country'];
			$user->birthday = $fields['birthday'];
			$user->about_me = $fields['about_me'];
			$user->hobbies = $fields['hobbies'];
			$user->musics = $fields['musics'];
			$user->movies = $fields['movies'];
			$user->books = $fields['books'];

			$user->save();
		}
		catch (\Cartalyst\Sentry\Users\UserExistsException $e)
		{
			$this->errors[] = 'User with this login already exists.';
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$this->errors[] = 'User was not found.';
		}

		return $user;
	}

	public function send_activation_email($user) {
		//Send activation code to the user so he can activate the account
		$data = array(
			'name'		 => $user->first_name.$user->last_name,
			'email'      => $user->email,
			'activation' => $user->getActivationCode(),
			'id'		 => $user->id,
		);

		\Mail::send('emails.auth.activateuser' , $data , function($message) use ($data)
		{
			$message->to($data['email'] , 'Example')->subject('email signup');
		});
	}

}