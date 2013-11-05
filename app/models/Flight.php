<?php

class Flight extends Eloquent {
	protected $guarded = array();

  protected $fillable = array('*');

	public static $rules = array();

  public $incrementing = false;

  public function departureAirport() {
    return $this->belongsTo('Airport', 'departure_airport_id');
  }

  public function arrivalAirport() {
    return $this->belongsTo('Airport', 'arrival_airport_id');
  }

  public function airline() {
    return $this->belongsTo('Airline', 'carrier_id');
  }

  public function passengers() {
    return $this->belongsToMany('User')->withPivot('privacy');
  }
}
