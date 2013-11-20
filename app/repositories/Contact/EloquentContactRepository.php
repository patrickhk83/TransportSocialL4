<?php namespace Repositories\Contact;

use Contact;

class EloquentContactRepository implements ContactRepositoryInterface {

  public function all()
  {
    return Contact::all();
  }

  public function find($id)
  {
    return Contact::find($id);
  }

  public function getContacts($userId)
  {
    return Contact::where('user_id' , '=' , $userId)->get();
  }

  public function create($fields)
  {
    $contact = new Contact;
    $contact->user_id = $fields['user_id'];
    $contact->contact_id = $fields['contact_id'];
    $contact->contact_name = $fields['contact_name'];
    $contact->status = $fields['contact_status'];
    $contact->save();
  }

}