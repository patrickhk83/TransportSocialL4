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
/*		
		$group = Sentry::createGroup(array(
			'name' => 'Admins' ,
			'permissions' => array('admin' => 1, 'users' => 1,),
		));

		$group1 = Sentry::createGroup(array(
			'name' => 'Users' ,
			'permissions' => array('admin' => 0, 'users' => 1,),
		));
*/		
		
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
				return Redirect::back()->withInput()->withErrors($validation->errors);
			}
			return Redirect::route('user.profile', array('id' => $user->id));
		}

		return Redirect::back()->withInput()->withErrors($validation->errors);
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
