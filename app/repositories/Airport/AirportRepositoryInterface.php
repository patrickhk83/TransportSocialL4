<?php namespace Repositories\Airport;

interface AirportRepositoryInterface {

  public function all();

  public function find($id);

  public function findByIata($iata);

}