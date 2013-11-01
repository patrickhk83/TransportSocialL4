<?php

class Flight extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

  public function departureAirport() {
    return $this->hasOne('Airport');
  }

  public function arrivalAirport() {
    return $this->hasOne('Airport');
  }

  public function carrier() {
    return $this->hasOne('Carrier');
  }

  public function passengers() {
    return $this->belongsToMany('User')->withPivot('privacy');
  }
}
