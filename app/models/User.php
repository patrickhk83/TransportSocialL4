<?php

use Cartalyst\Sentry\Users\Eloquent\User as CartalystUser;

class User extends CartalystUser {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	protected $appends = array('name');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	public function getNameAttribute()
  {
    return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
  }

	public function flights()
	{
		return $this->belongsToMany('Flight')->withPivot('privacy');
	}

	public function photos() {
		return $this->morphMany('Photo', 'imageable')->where('type', 'photo');
	}

	public function profilePicture() {
		return $this->morphOne('Photo', 'imageable')->where('type', 'profile');
	}

  public function contacts() {
  	return $this->belongsToMany('User', 'contacts', 'user_id', 'contact_id')->withPivot('status', 'contact_name');
  }

  public function pendingContacts() {
  	return $this->belongsToMany('User', 'contacts', 'user_id', 'contact_id')->withPivot('status', 'contact_name')->where('status', '2');
  }

  public function messages() {
		return $this->hasMany('Message');
	}

	public function conversations() {
		return $this->belongsToMany('Conversation');
	}

}