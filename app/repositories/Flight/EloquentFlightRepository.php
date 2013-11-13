<?php namespace Repositories\Flight;

use Flight;

class EloquentFlightRepository implements FlightRepositoryInterface {

  public function all()
  {
    return Flight::all();
  }

  public function find($id)
  {
    return Flight::find($id);
  }

  public function getPassengers($id)
  {
  	return Flight::find($id)->passengers()->get();
  }

  public function addPassenger($flightId, $userId, $privacy)
  {
  	$passenger = $this->find($flightId)->passengers()->where('user_id', '=', $userId)->first();
    if(is_null($passenger)) {
      $this->find($flightId)->passengers()->sync(array($userId => array('privacy' => $privacy)));
    }
  }

  public function create($fields, $relationships)
  {
		$flight = new Flight;
		$flight->id = $fields['id'];
		$flight->number = $fields['number'];
		$flight->arrivalTime = $fields['arrivalTime'];
		$flight->departureTime = $fields['departureTime'];
		$flight->carrier()->associate($relationships['carrier']);
		$flight->arrivalAirport()->associate($relationships['arrivalAirport']);
		$flight->departureAirport()->associate($relationships['departureAirport']);
		$flight->save();
		return $flight;
  }
}