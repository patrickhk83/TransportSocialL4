<?php namespace Repositories\Carrier;

use Carrier;

class EloquentCarrierRepository implements CarrierRepositoryInterface {

  public function all()
  {
    return Carrier::all();
  }

  public function find($id)
  {
    return Carrier::find($id);
  }

  public function findByIata($iata)
  {
  	return Carrier::where('airline_code', '=', $iata)->first();
  }

}