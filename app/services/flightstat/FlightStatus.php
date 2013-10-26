<?php namespace Services\Flightstat;

class FlightStatus extends FlightstatApi {
	public function __construct() {
		parent::__contruct('flightstatus');
	}

	public function find($id) {
		return $this->api_call('airport/status/ABQ/dep/2013/10/26/10');
	}
}