<?php namespace Services\Flightstat;

class FlightStatus extends FlightstatApi {

  private $queries;

  public function __construct() {
		parent::__contruct('flightstatus');
    $this->queries['extendedOptions'] = 'useInlinedReferences';
	}

	public function by_flight_id($id) {
		return $this->api_call('flight/status/'.$id, $this->queries);
	}

	public function by_airport($request) {
    $function = 'airport/status/'.$request['arrivalAirportCode'].'/'.
                $request['direction'].'/'.$this->format_date($request['date']).'/'.$request['hour'];
    return $this->api_call($function, $this->queries);
	}

	public function by_route($request) {
    $function = 'route/status/'.$request['departureAirportCode'].'/'.
                $request['arrivalAirportCode'].'/dep/'.$this->format_date($request['date']);

    return $this->api_call($function, $this->queries);
	}

	public function by_flight_num($request) {
    $function = 'flight/status/'.$request['carrierCode'].'/'.
                 $request['flightNumber'].'/dep/'.$this->format_date($request['date']);
    return $this->api_call($function, $this->queries);
	}

	public function format_date($date) {
    return date("Y/n/j", strtotime($date));
  }
}