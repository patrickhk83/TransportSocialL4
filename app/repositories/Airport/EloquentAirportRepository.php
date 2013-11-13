<?php namespace Repositories\Airport;

use Airport;

class EloquentAirportRepository implements AirportRepositoryInterface {

  public function all()
  {
    return Airport::all();
  }

  public function find($id)
  {
    return Airport::find($id);
  }

  public function findByIata($iata)
  {
  	return Airport::where('airport_code', '=', $iata)->first();
  }

}