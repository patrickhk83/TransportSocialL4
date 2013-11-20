<?

class Message extends Eloquent {

	protected $table = 'messages';

	public function conversation() {
		return $this->belongsTo('Conversation');
	}

	public function user() {
		return $this->belongsTo('User');
	}

	
}