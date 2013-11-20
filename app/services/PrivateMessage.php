<?php namespace Services;

class PrivateMessage {

	public $errors = array();

	public function __construct() {

	}

	public function suggest_user($field)
	{
		$group = \Sentry::findGroupByName('Users');
		$users = \Sentry::findAllUsersInGroup($group);

		//$users = \Sentry::findAllUsers();
		$str = $field;
		$output = array();		
		foreach($users as $user)
		{

			$value = $user['first_name']." ".$user['last_name'];

			$value = strtolower($value);

			$isExists = preg_match("/$str/", $value);
			if($isExists)
			{
				if(!empty($user['country']))
				{
					$country = \Country::where('code' , '=' , $user['country'])->first();
					$output[] = $user['first_name']." ".$user['last_name']."(".$country['name'].")";
				}
				else
					$output[] = $user['first_name']." ".$user['last_name'];
			}
		}

		return json_encode($output);	
	}

	public function getContactData($fields)
	{
		$user_name = $fields['user_name'];

		$contact_name = $fields['contact_name'];
		$contact_status = $fields['contact_status'];

		$tmp_str = explode('(' , $user_name);
		$array_name = explode(" ", $tmp_str[0]);
		$first_name = $array_name[0];
		$last_name = $array_name[1];
		if(!empty($tmp_str[1]))
		{
			$array_country = explode(')' , $tmp_str[1]);
			$str_country = $array_country[0];	
			$country_code = \Country::where('name' , '=' , $str_country)->first();
			$country = $country_code['code'];

		}
		else
			$country = "";

		$group = \Sentry::findGroupByName('Users');
		$users = \Sentry::findAllUsersInGroup($group);
		$me = \Sentry::getUser();
		if(strcmp($me->first_name , $first_name) == 0 &&
			strcmp($me->last_name , $last_name) == 0 &&
			strcmp($me->country , $country) == 0)
		{
			$this->errors[] = 'This contact is your\'s.';
			return false;
		}
		$isFindUser = false;
		foreach($users as $user)
		{
			if(strcmp($user['first_name'] , $first_name) == 0 &&
				strcmp($user['last_name'] , $last_name) == 0 &&
				strcmp($user['country'] , $country) == 0)
			{
				$contact_user = $user;
				$isFindUser = true;
				break;
			}
		}

		if(!$isFindUser) {
			$this->errors[] = 'User not found.';
			return false;
		}	

		return $save_data = array(
			'user_id' 			=>	$me->id,
			'contact_id'		=>	$contact_user->id,
			'contact_name'		=>	$contact_name,
			'contact_status'	=>	$contact_status,
		);

		
	}
}	
