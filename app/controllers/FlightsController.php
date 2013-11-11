<?php

class FlightsController extends BaseController {

	protected $flights;

	public function __construct() {
	}

	public function by_airport() {
		if(Request::getMethod() == 'POST') {
			$validation = new Services\Validators\FlightsByAirport;
			return self::get_flight_results($validation, 'by_airport');
		}
		return View::make('flights.by_airport');
	}

	public function by_route() {
		if(Request::getMethod() == 'POST') {
			$validation = new Services\Validators\FlightsByRoute;
			return self::get_flight_results($validation, 'by_route');
		}
		return View::make('flights.by_route');
	}

	public function by_flight_num() {
		if(Request::getMethod() == 'POST') {
			$validation = new Services\Validators\FlightByNumber;
			return self::get_flight_results($validation, 'by_flight_num');
		}
		return View::make('flights.by_flight_num');
	}

	public function get_flight_results($validation, $function_name) {
		if($validation->passes()) {
			$flightStatAPI = new Services\Flightstat\FlightStatus;
			$flights = $flightStatAPI->{$function_name}(Input::all())->flightStatuses;
			$flights = $this->add_variables($flights);
			if(Sentry::check()) {
				$this->saved($flights);
			}
			$this->getPassengers($flights);
			$data['flights'] = $flights;
			return View::make('flights.index', $data);
		}
		return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	public function add_variables($flights) {
		foreach($flights as $flight) {
			$flight->departureDate = $flight->departureDate->dateLocal;
			$flight->arrivalDate = $flight->arrivalDate->dateLocal;
			$flight->id = $flight->flightId;
		}
		return $flights;
	}

	public function saved($flights) {
		foreach($flights as $flight) {
			$savedFlight = User::find(Sentry::getUser()->id)->flights()->where('flight_id', '=', $flight->flightId)->first();
			$flight->saved = (!is_null($savedFlight) ? true : false);
		}
		return $flights;
	}

	public function getPassengers($flights) {
		foreach($flights as $flight) {
			$flight->passengers = array();
			if(Flight::find($flight->flightId) != null) {
				$flight->passengers = Flight::find($flight->flightId)->passengers()->get();
			}
		}
		return $flights;
	}

	public function privacy($id) {
		$data['flightId'] = $id;
		return View::make('flights.privacy', $data);
	}

	public function saved_flights($id) {
		$flights = User::find($id)->flights()->get();
		$this->saved($flights);
		$this->getPassengers($flights);
		$data['flights'] = $flights;
		return View::make('flights.index', $data);
	}

	public function save($id) {
		$flight = Flight::find($id);
		if(is_null($flight)) {
			$flightStatAPI = new Services\Flightstat\FlightStatus;
			$result = $flightStatAPI->by_flight_id($id)->flightStatus;
			$flight = new Flight;
			$flight->id = $result->flightId;
			$flight->number = $result->flightNumber;
			$flight->arrivalTime = $result->departureDate->dateLocal;
			$flight->departureTime = $result->arrivalDate->dateLocal;
			$flight->carrier()->associate(Carrier::findByIata($result->carrier->iata)->first());
			$flight->departureAirport()->associate(Airport::findByIata($result->departureAirport->iata)->first());
			$flight->arrivalAirport()->associate(Airport::findByIata($result->arrivalAirport->iata)->first());
			$flight->save();
		}
		$flight->addPassenger(Sentry::getUser()->id, Input::get('privacy'));
		return Redirect::route('user.flights', array(Sentry::getUser()->id));
	}

	public function delete($id) {
		$user = User::find(Sentry::getUser()->id);
		$flight = $user->flights()->find($id);
		if(!is_null($flight)) {
			$user->flights()->detach($flight->id);
			Session::flash('message', 'You have successfully deleted the flight');
		}
		else {
			Session::flash('message', 'The flight you are trying to delete was either not saved or deleted already');
		}

		return Redirect::route('user.flights');
	}
}
