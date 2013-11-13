<?php namespace Repositories\Carrier;

interface CarrierRepositoryInterface {

  public function all();

  public function find($id);

  public function findByIata($iata);
}