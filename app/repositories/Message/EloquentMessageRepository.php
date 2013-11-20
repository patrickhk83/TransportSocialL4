<?php namespace Repositories\Message;

use Message;

class EloquentMessageRepository implements MessageRepositoryInterface {
	public function all()
	{
		return Message::all();
	}

	public function find($id)
	{
		return Message::find($id);
	}

	public function create($fields)
	{
		$msg = new Message;
		
	}
}
