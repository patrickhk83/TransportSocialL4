<?php

use Repositories\User\UserRepositoryInterface as User;
use Repositories\Contact\ContactRepositoryInterface as Contact;

class MessagesController extends BaseController {

	protected $users;
	protected $contacts;

	public function __construct(User $users, Contact $contacts) {
		$this->users = $users;
		$this->contacts = $contacts;
	}

	public function inbox()
	{
		$auth = new Services\Authentication\Auth;
		$data['user'] = $auth->GetUserInfo();

		return View::make('messages.inbox')->with($data);
	}

	public function contacts()
	{
		$auth = new Services\Authentication\Auth;
		$data['user'] = $auth->GetUserInfo();
		$data['contacts'] = $this->contacts->getContacts($data['user']->id);

		return View::make('messages.contacts')->with($data);
	}

	public function suggest_user()
	{
		$msg = new Services\PrivateMessage;
		return $msg->suggest_user(Input::get('term'));

	}

	public function add_contact()
	{
		$msg = new Services\PrivateMessage;
		$validation = new Services\Validators\Contact;

		if($validation->passes())
		{
			$save_data = $msg->getContactData(Input::all());	

			if(count($msg->errors) > 0)
			{
				return Redirect::back()->withInput()->withErrors($msg->errors);
			}

			$this->contacts->create($save_data);
			return Redirect::route('messages.contacts');
		}

		return Redirect::back()->withInput()->withErrors($validation->errors);
	}

}