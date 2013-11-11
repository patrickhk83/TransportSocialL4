<?php namespace Services\Validators;

class FlightByNumber extends Validator {
	public static $rules = array (
		'carrierCode' => 'required',
		'flightNumber' => 'required|numeric',
		'date' => 'required|date_format:j-n-Y|date'
	);
}
