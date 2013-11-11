<?php namespace Services\Validators;

class FlightsByRoute extends Validator {
	public static $rules = array (
		'arrivalAirportCode' => 'required',
		'departureAirportCode' => 'required',
		'date' => 'required|date_format:j-n-Y|date'
	);
}
