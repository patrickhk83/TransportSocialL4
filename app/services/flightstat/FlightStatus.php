<?php namespace Services\Flightstat;

class FlightStatus extends FlightstatApi {

  private $queries;

  public function __construct() {
		parent::__contruct('flightstatus');
    $this->queries['extendedOptions'] = 'useInlinedReferences';
	}

	public function by_flight_id($id) {
		return $this->api_call('flight/status/'.$id);
	}

	public function by_airport($request) {
		$date = $this->split_date($request['date']);
    $function = 'airport/status/'.$request['arrivalAirportCode'].'/'.
                $request['direction'].'/'.$this->format_date($date).'/'.$request['hour'];
    return $this->api_call($function, $this->queries);
	}

	public function by_route($request) {
		$date = $this->split_date($request['date']);
    $function = 'route/status/'.$request['departureAirportCode'].'/'.
                $request['arrivalAirportCode'].'/dep/'.$this->format_date($date);

    return $this->api_call($function, $this->queries);
	}

	public function by_flight_num($request) {
		$date = $this->split_date($request['date']);
    $function = 'flight/status/'.$request['carrierCode'].'/'.
                 $request['flightNumber'].'/dep/'.$this->format_date($date);
    return $this->api_call($function, $this->queries);
	}

	public function format_date($date) {
    return
      $date['year'].'/'.
      $date['month'].'/'.
      $date['day'];
  }

  public function split_date($date) {
    $date = explode('-', $date);
    $date = array(
      'day' => $date[0],
      'month' => $date[1],
      'year' => $date[2]
    );
    return $date;
  }
}