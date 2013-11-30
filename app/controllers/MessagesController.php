<?php

use Repositories\User\UserRepositoryInterface as User;
use Repositories\Message\MessageRepositoryInterface as Message;
use Repositories\Conversation\ConversationRepositoryInterface as Conversation;

class MessagesController extends BaseController {

	protected $users;
	protected $messages;
	protected $conversations;

	public function __construct(User $users, Message $messages, Conversation $conversations) {
		$this->users = $users;
		$this->messages = $messages;
		$this->conversations = $conversations;
	}

	public function inbox()
	{
		$auth = new Services\Auth;
		$user = $auth->GetUserInfo();

		$data['conversations'] = $this->users->get_conversations($user->id);
		$data['user'] = $user;

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

	public function send($conversationId) {
		$auth = new Services\Auth;
		$user = $auth->GetUserInfo();
		$user = $this->users->find($user->id);
		$conversation = $this->conversations->find($conversationId);
		$message = $this->messages->create(Input::all(), $conversation, $user);
		return Redirect::route('conversation.view', array('id' => $conversationId));
	}

}