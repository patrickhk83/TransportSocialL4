<?php

Route::get('/', array('as' => 'site.home', 'uses' => 'UsersController@login'));