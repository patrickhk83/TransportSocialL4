<?php

class UsersController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    return View::make('users.index');
	}

	public function login() {
		return View::make('users.login');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
    return View::make('users.create');
	}

	public function logout() {
		if(!Auth::guest()) {
			Auth::logout();
		}
		return Redirect::route('site.home');
	}

	public function saved_flights($id) {

	}

	public function profile($id) {

	}

}
