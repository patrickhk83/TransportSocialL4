<?php

Route::get('login',  array('as' => 'users.login', 'uses' => 'UsersController@login'));
Route::get('logout',  array('as' => 'users.logout', 'uses' => 'UsersController@logout'));

Route::get('user/{id}/flights', array('as' => 'user.flights', 'uses' => 'UserController@saved_flights'))
		 ->where(array('id' => '[0-9]+'));

Route::get('user/{id}/profile', array('as' => 'user.profile', 'uses' => 'UserController@profile'))
		 ->where(array('id' => '[0-9]+'));

Route::post('register', array('as' => 'users.register', 'uses' => 'UsersController@create'));

Route::get('register', array('as' => 'users.registerForm', 'uses' => 'UsersController@register'));
