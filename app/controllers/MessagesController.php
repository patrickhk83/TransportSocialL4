<?php

use Repositories\User\UserRepositoryInterface as User;

class MessagesController extends BaseController {

	protected $users;

	public function __construct(User $users) {
		$this->users = $users;
	}

	public function inbox()
	{
		$auth = new Services\Auth;
		$data['user'] = $auth->GetUserInfo();

		return View::make('messages.inbox')->with($data);
	}

	public function contacts()
	{
		$auth = new Services\Auth;
		$data['user'] = $auth->GetUserInfo();
		$data['contacts'] = $this->users->get_contacts($data['user']->id);

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

			$this->users->add_contact($save_data);
			return Redirect::route('messages.contacts');
		}

		return Redirect::back()->withInput()->withErrors($validation->errors);
	}

}