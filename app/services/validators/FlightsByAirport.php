<?php namespace Services\Validators;

class FlightsByAirport extends Validator {
	public static $rules = array (
		'arrivalAirportCode' => 'required',
		'hour' => 'required|numeric',
		'date' => 'required|date_format:j-n-Y|date',
		'direction' => 'required|max:3'
	);
}
