<?php

class Carrier extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

  public function flights() {
    $this->belongsToMany('Flight');
  }
}
