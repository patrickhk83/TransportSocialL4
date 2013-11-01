<?php

Route::any('search/flights/by-airport', array('as' => 'flights.by_airport', 'uses' => 'FlightsController@by_airport'));
Route::any('search/flights/by-route', array('as' => 'flights.by_route', 'uses' => 'FlightsController@by_route'));
Route::any('search/flights/by-flight-num', array('as' => 'flights.by_flight_num', 'uses' => 'FlightsController@by_flight_num'));