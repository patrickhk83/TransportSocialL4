<?php

use Repositories\Flight\FlightRepositoryInterface as Flight;
use Repositories\Carrier\CarrierRepositoryInterface as Carrier;
use Repositories\Airport\AirportRepositoryInterface as Airport;
use Repositories\User\UserRepositoryInterface as User;

class FlightsController extends BaseController {

	protected $flights;
	protected $carriers;
	protected $airports;
	protected $users;

	public function __construct(Flight $flights, Carrier $carriers, Airport $airports, User $users) {
		$this->flights = $flights;
		$this->carriers = $carriers;
		$this->airports = $airports;
		$this->users = $users;
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
			$flightStatAPI = new Services\Flightstat\FlightStatus($this->carriers, $this->airports);
			$flights = $flightStatAPI->{$function_name}(Input::all())->flightStatuses;
			$flights = $this->add_variables($flights);
			if(Sentry::check()) {
				$this->saved($flights, false);
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

	public function saved($flights, $databaseCall) {
		foreach($flights as $flight) {
			if(!$databaseCall) {
				$savedFlight = $this->users->hasFlight($flight->flightId, Sentry::getUser()->id);
				$flight->saved = (!is_null($savedFlight) ? true : false);
			}
			else {
				$flight->saved = true;
			}
		}
		return $flights;
	}

	public function getPassengers($flights) {
		foreach($flights as $flight) {
			$flight->passengers = array();
			if($this->flights->find($flight->flightId) != null) {
				$flight->passengers = $this->flights->getPassengers($flight->flightId);
			}
		}
		return $flights;
	}

	public function privacy($id) {
		$data['flightId'] = $id;
		return View::make('flights.privacy', $data);
	}

	public function saved_flights($id) {
		$flights = $this->users->flights($id);
		$this->saved($flights, true);
		$this->getPassengers($flights);
		$data['flights'] = $flights;
		return View::make('flights.index', $data);
	}

	public function save($id) {
		$flight = $this->flights->find($id);
		if(is_null($flight)) {
			$flightStatAPI = new Services\Flightstat\FlightStatus($this->carriers, $this->airports);
			$result = $flightStatAPI->by_flight_id($id)->flightStatus;
			$flightData = array(
				'id' => $result->flightId,
				'number' => $result->flightNumber,
				'arrivalTime' => $result->arrivalDate->dateLocal,
				'departureTime' => $result->departureDate->dateLocal,
			);
			$relationships = array(
				'carrier' => $this->carriers->findByIata($result->carrier->iata),
				'arrivalAirport' => $this->airports->findByIata($result->arrivalAirport->iata),
				'departureAirport' => $this->airports->findByIata($result->departureAirport->iata)
			);
			$flight = $this->flights->create($flightData, $relationships);
		}
		$this->flights->addPassenger($flight->id, Sentry::getUser()->id, Input::get('privacy'));
		return Redirect::route('user.flights', array(Sentry::getUser()->id));
	}

	public function view($id) {
		$flightStatAPI = new Services\Flightstat\FlightStatus($this->carriers, $this->airports);
		$flights = array($flightStatAPI->by_flight_id($id)->flightStatus);
		$flight = $this->getPassengers($flights);
		$flight = $this->saved($flights, true);
		$flight = $this->add_variables($flights);
		$data['flight'] = head($flights);
		if(!count($data['flight']) > 0) {
			return Redirect::back()->withErrors(array('Flight was not found'));
		}
		return View::make('flights.view', $data);
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
