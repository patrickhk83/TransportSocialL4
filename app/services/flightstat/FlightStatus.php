<?php namespace Services\Flightstat;

class FlightStatus extends FlightstatApi {
	public function __construct() {
		parent::__contruct('flightstatus');
	}

	public function by_flight_id($id) {
		return $this->api_call('flight/status/'.$id);
	}

	public function by_airport($request) {
		return $this->api_call('airport/status/'.
      $request['arrivalAirportCode'].'/'.
      $request['direction'].'/'.
      $this->date($request['date']).'/'.
      $request['hour']
    );
	}

	public function by_route($request) {
		return $this->api_call('route/status'.
      $request['departureAirportCode'].'/'.
      $request['arrivalAirportCode'].
      '/dep/'.
      $this->date($request['date'])
    );
	}

	public function by_flight_num($request) {
		return $this->api_call('flight/status/'.
      $request['carrierCode'].'/'.
      $request['flightNo'].'/dep/'.
      $this->date($request['date'])
    );
	}

	public function date($date) {
    return
      $date['year'].'/'.
      $date['month'].'/'.
      $date['day'];
  }
}