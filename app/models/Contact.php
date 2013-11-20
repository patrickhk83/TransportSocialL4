<?php

class Contact extends Eloquent {
	protected $quarded = array();

	public static $rules = array();

	public $timestamps = false;

	public function user() {
		return $this->belongsTo('User');
	}

	public function messages() {
		return $this->hasMany('Message');
	}

	public function conversations() {
		return $this->belongsToMany('Conversation');
	}
	
}