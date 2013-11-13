<?php namespace Repositories\User;

interface UserRepositoryInterface {

  public function all();

  public function find($id);

  public function flights($id);

  public function hasFlight($flightId, $userId);

}