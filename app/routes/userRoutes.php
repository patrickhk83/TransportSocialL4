<?php

Route::get('login',  array('as' => 'users.login', 'uses' => 'UsersController@login'));
Route::post('login',  array('as' => 'users.auth', 'uses' => 'UsersController@auth'));

Route::get('logout',  array('as' => 'users.logout', 'uses' => 'UsersController@logout'));

Route::get('user/{id}/profile', array('as' => 'user.profile', 'uses' => 'UsersController@profile'))
		 ->where(array('id' => '[0-9]+'));

Route::post('register', array('as' => 'users.register', 'uses' => 'UsersController@create'));
Route::get('register', array('as' => 'users.registerForm', 'uses' => 'UsersController@register'));

Route::group(array('before' => 'auth'), function()
{
	Route::get('user/profile/edit' , array('as' => 'user.edit_profile' , 'uses' => 'UsersController@edit_profile'));
	Route::post('user/profile/edit' , array('as' => 'user.update' , 'uses' => 'UsersController@update'));
});

