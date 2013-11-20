<?php namespace Repositories\Contact;

interface ContactRepositoryInterface {

  public function all();

  public function find($id);

  public function getContacts($userId);

  
}