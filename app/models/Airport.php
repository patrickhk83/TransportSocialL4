<?php

class Airport extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

  public function flights() {
    return $this->belongsToMany('Flight');
  }
}
