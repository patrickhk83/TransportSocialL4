<?php

Route::get('/', function()
{
	return Redirect::route('posts.index');
});

Route::get('login', 'UsersController@login');
Route::get('flights/by_airport', 'FlightsController@by_airport');
Route::get('flights/by_route', 'FlightsController@by_route');
Route::get('flights/by_flight_num', 'FlightsController@by_flight_num');

Route::resource('flights', 'FlightsController');
Route::resource('users', 'UsersController');
Route::resource('posts', 'PostsController');