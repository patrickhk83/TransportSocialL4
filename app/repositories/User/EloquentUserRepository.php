<?php namespace Repositories\User;

use User;

class EloquentUserRepository implements UserRepositoryInterface {

  public function all()
  {
    return User::all();
  }

  public function find($id)
  {
    return User::find($id);
  }

  public function flights($id)
  {
  	return User::find($id)->flights()->get();
  }

  public function hasFlight($flightId, $userId)
  {
  	return User::find($userId)->flights()->where('flight_id', '=', $flightId)->first();
  }

  public function getPhotos($userId)
  {
    return User::find($userId)->photos()->get();
  }

  public function getProfilePic($userId) {
    $user = User::find($userId);
    return $user->photos()->where('id', '=', $user->profile_pic)->first();
  }

}