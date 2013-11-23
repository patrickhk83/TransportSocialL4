<?php namespace Repositories\User;

interface UserRepositoryInterface {

  public function all();

  public function find($id);

  public function flights($id);

  public function hasFlight($flightId, $userId);

  public function getPhotos($userId);

  public function getProfilePic($userId);

  public function add_contact($fields);

  public function get_contacts($userId);

  public function saveProfilePic($photo, $userId);

}