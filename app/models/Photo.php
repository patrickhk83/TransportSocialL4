<?php

class Photo extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public $timestamps = false;

	public function user() {
		return $this->belongsTo('User');
	}

	public function profile_user() {
		return $this->hasOne('user', 'profile_pic');
	}
}
