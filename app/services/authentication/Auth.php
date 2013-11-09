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

	public function getUserPhotos($user_id , $photo_id)
	{
		if($photo_id == null)
			$photos = \DB::table('users_photos')->where('user_id' , $user_id)->get();
		else
			$photos = \DB::table('users_photos')->where('user_id' , $user_id)->where('id' , $photo_id)->first();
		return $photos;

	}



	public function countUserPhotos($user_id , $photo_id)
	{
		if($photo_id == null)
			$photos_counter = \DB::table('users_photos')->where('user_id' , $user_id)->count();
		else
			$photos_counter = \DB::table('users_photos')->where('user_id' , $user_id)->where('id' , $photo_id)->count();
		return $photos_counter;

	}


	public function getCountries($country_code)
	{
		if($country_code == null)
		{
			$countries = \DB::table('countries')->get();
			$getCountries = array();
			foreach($countries as $country)
			{
				$getCountries[$country->code] = $country->name;
			}
			return $getCountries;
		}
		else
		{
			$countries = \DB::table('countries')->where('code' , $country_code)->first();
			$getCountries = $countries->name;
			return $getCountries;
		}
		
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

	public function update($fields)
	{
		if(!\Sentry::check()) return false;
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

		if($user->save())
		{
			return $user;
		}
		else
		{
			return false;
		}
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

	public function registration_errors() {

	}
}