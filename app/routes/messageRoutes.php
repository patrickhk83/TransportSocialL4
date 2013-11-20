<?php

Route::get('messages/inbox' , array('as' => 'messages.inbox', 'uses' => 'MessagesController@inbox'));

Route::get('messages/contacts' , array('as' => 'messages.contacts' , 'uses' => 'MessagesController@contacts'));

Route::post('messages/add_contact' , array('as' => 'messages.add_contact' , 'uses' => 'MessagesController@add_contact'));

Route::post('messages/suggest_user' , array('as' => 'messages.suggest_user' , 'uses' => 'MessagesController@suggest_user'));
//Route::post('login',  array('as' => 'users.auth', 'uses' => 'UsersController@auth'));