<?php
use Repositories\Conversation\ConversationRepositoryInterface as Conversation;

class ConversationController extends BaseController {

	protected $conversations;

	public function __construct(Conversation $conversations) {
		$this->conversations = $conversations;
	}

	public function create($userIds) {
		$auth = new Services\Auth;
		$user = $auth->GetUserInfo();
		$userIds = array((int)$userIds, $user->id);

		$conversation = $this->conversations->exists($userIds);
		if($conversation == null) {
			$conversation = $this->conversations->create();
			$conversation = $this->conversations->addUsers($userIds, $conversation->id);
		}
		return Redirect::route('conversation.view', array('id' => $conversation->id));
	}

	public function addUser($userIds, $conversationId) {
		$this->conversations->addUsers($userIds, $conversationId);
	}

	public function view($id) {
		$data['conversation'] = $this->conversations->find($id);
		return View::make('conversations.view')->with($data);
	}

}
