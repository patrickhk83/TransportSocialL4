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


	public function auth()
	{
		
		$validation = new Services\Validators\Login;
		$auth = new Services\Authentication\Auth;

		if($validation->passes())
		{
			
			try
			{
				$user = $auth->login(Input::all());
				
			}
			catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
			{
			    Session::flash('error', 'User not activated.');
			    return Redirect::back()->withInput()->withErrors('User not activated.');
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
				Session::flash('error', 'User not found.');
				return Redirect::back()->withInput()->withErrors('User not found.');
				//return "33333333";
			}
			return Redirect::route('user.profile', array('id' => $user->id));
			//return "1111111111111";
					
		}
		return Redirect::back()->withInput()->withErrors($validation->errors);
		

	}

	public function login() {
		return View::make('users.login');
	}

	public function register() {
		if(Auth::user()) return Redirect::route('site.home');
		return View::make('users.register');
	}

/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
    $validation = new Services\Validators\Register;

		if($validation->passes()) {
			try
			{
				//Register a user.
				$auth = new Services\Authentication\Auth;
				$user = $auth->register(Input::all(), 'Users');
				$auth->send_activation_email($user);

			}
			catch(Cartalyst\Sentry\Users\UserExistsException $e)
			{
				Session::flash('error', 'User with this login already exists.');
				return Redirect::back()->withInput()->withErrors('User with this login already exists.');
			}
			return Redirect::route('user.profile', array('id' => $user->id));
		}

		return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	public function logout() {
		$auth = new Services\Authentication\Auth;
		$auth->logout();
		return Redirect::route('site.home');
	}

	public function saved_flights($id) {

	}

	public function profile($id) {
		$auth = new Services\Authentication\Auth;
		$user = $auth->getUserInfo();
		if(!$user)
			return View::make('users.login');
		return View::make('users.profile')->with(array('user' => $user));
	}

}
