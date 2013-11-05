<?php

class Airline extends Eloquent {
	protected $guarded = array();

	protected $fillable = array('*');

	public static $rules = array();

  public function flights() {
    return $this->hasMany('Flight');
  }
}
