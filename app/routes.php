<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return Redirect::route('posts.index');
});

Route::get('flights/by_airport', 'FlightsController@by_airport');
Route::resource('flights', 'FlightsController');
Route::resource('users', 'UsersController');
Route::resource('posts', 'PostsController');