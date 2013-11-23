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
    return $user->profilePicture()->first();
  }

  public function saveProfilePic($photo, $userId) {
    $photo->type = $photo::PROFILE;
    $photo->save();
    $user = $this->find($userId);
    $user->profilePicture()->save($photo);

  }

  public function add_contact($fields) {
    $user = User::find($fields['user_id']);
    $user->contacts()->attach($fields['contact_id'],
      array(
        'contact_name' => $fields['contact_name'],
        'status' => $fields['contact_status']
      )
    );
  }

  public function get_contacts($userId) {
    $user = User::find($userId);
    return $user->contacts()->select('user_id', 'contact_id', 'contact_name', 'status')->get();
  }
}