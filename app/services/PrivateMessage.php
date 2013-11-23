<?php namespace Services;

class PrivateMessage {

	public $errors = array();

	public function __construct() {

	}

	public function suggest_user($field)
	{
		$users = \Sentry::findAllUsers();

		$username = strtolower($field);
		$suggested_users = array();
		foreach($users as $user)
		{
			$value = $user['first_name']." ".$user['last_name'];
			$value = strtolower($value);

			if(preg_match("/$username/", $value))
			{
				$suggested_users[] = $user['first_name']." ".$user['last_name'];
			}
		}

		return json_encode($suggested_users);
	}

	public function getContactData($fields)
	{
		$user_name = $fields['user_name'];

		$contact_name = $fields['contact_name'];
		$contact_status = $fields['contact_status'];

		$full_name = explode(' ', $user_name);
		$first_name = $full_name[0];

		$user = \Sentry::getUser();
		$contact = \User::where('first_name', '=', $first_name)->first();

		if(is_null($contact)) {
			$this->errors[] = 'User not found';
			return;
		}

		return $save_data = array(
			'user_id' 			=>	$user->id,
			'contact_id'		=>	$contact->id,
			'contact_name'		=>	$contact_name,
			'contact_status'	=>	$contact_status,
		);


	}
}
