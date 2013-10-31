<?php

Route::get('search/flights/by_airport', array('as' => 'flights.by_airport', 'uses' => 'FlightsController@by_airport'));
Route::get('search/flights/by_route', array('as' => 'flights.by_route', 'uses' => 'FlightsController@by_route'));
Route::get('search/flights/by_flight_num', array('as' => 'flights.by_flight_num', 'uses' => 'FlightsController@by_flight_num'));