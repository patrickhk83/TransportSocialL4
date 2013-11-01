<?php

class FlightsController extends BaseController {

	public function by_airport() {
		if(Request::getMethod() == 'POST') {
			$validation = new Services\Validators\FlightsByAirport;
			return self::getFlightResults($validation, 'by_airport');
		}
		return View::make('flights.by_airport');
	}

	public function by_route() {
		if(Request::getMethod() == 'POST') {
			$validation = new Services\Validators\FlightsByAirport;
			return self::getFlightResults($validation, 'by_route');
		}
		return View::make('flights.by_route');
	}

	public function by_flight_num() {
		if(Request::getMethod() == 'POST') {
			$validation = new Services\Validators\FlightsByAirport;
			return self::getFlightResults($validation, 'by_flight_num');
		}
		return View::make('flights.by_flight_num');
	}

	public function getFlightResults($validation, $function_name) {
		if($validation->passes()) {
			$flightStatAPI = new Services\Flightstat\FlightStatus;
			$flights = $flightStatAPI->{$function_name}(Input::all());
			$data['flights'] = $flights->flightStatuses;
			return View::make('flights.index', $data);
		}
		return Redirect::back()->withInput()->withErrors($validation->errors);
	}
}
