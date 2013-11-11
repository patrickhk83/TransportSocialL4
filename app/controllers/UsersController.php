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
			$user = $auth->login(Input::all());
			if(count($auth->errors) > 0) {
				return Redirect::back()->withInput()->withErrors($auth->errors);
			}
			return Redirect::route('user.profile', array('id' => $user->id));
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
			$auth = new Services\Authentication\Auth;
			$user = $auth->register(Input::all(), 'Users');
			if(count($auth->errors) > 0) {
				return Redirect::back()->withInput()->withErrors($auth->errors);
			}
			$auth->send_activation_email($user);
			return Redirect::route('site.home');
		}
		return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	public function update()
	{
		$validation = new Services\Validators\UpdateProfile;

		if($validation->passes())
		{
			$auth = new Services\Authentication\Auth;
			$user = $auth->update(Input::all());
			if(count($auth->errors) > 0) {
				return Redirect::back()->withInput->withErrors($auth->errors);
			}	
			return Redirect::route('user.profile' , array('id' => $user->id));	
		}
		return Redirect::back()->withInput->withErrors($validation->errors);
	}

	public function logout() {
		$auth = new Services\Authentication\Auth;
		$auth->logout();
		return Redirect::route('site.home');
	}

	public function profile($id) {
		$auth = new Services\Authentication\Auth;
		$data['user'] = $auth->getUserInfo();
		$data['photos'] = $auth->getUserPhotos($data['user']->id);
		if(isset($data['user']->country)) {
			$country = $auth->getCountries($data['user']->country);
			$data['country'] = $country;
		}
		if(count($data['photos']) == 0)
		{
			$data['profile_pic'] = "images/default-profile-pic.png";
			return View::make('users.profile')->with($data);
		}
		else
		{
			$data['profile_pic'] = $auth->getUserPhotos($data['user']->id , $data['user']->profile_pic)->path;
			return View::make('users.profile')->with($data);
		}
	}

	public function edit_profile()
	{
		$auth = new Services\Authentication\Auth;
		$data['user'] = $auth->getUserInfo();
		$data['countries'] = $auth->getCountries();
		return View::make('users.edit_profile')->with($data);
	}

	public function activate($id, $activation_code) {
		$auth = new Services\Authentication\Auth;
		$auth->activate($activation_code, $id);
		if(count($auth->errors) > 0) {
			return View::make('users.activate')->with(array('error' => 'Your account could not be activated'));
		}
		return View::make('users.activate')->with(array('success' => 'Your account has been activated'));
	}

	public function edit_profile_pic()
	{
		if(Input::hasFile('profile_pic'))
		{
			$auth = new Services\Authentication\Auth;
			$image = new Services\Image;
			$user = $auth->getUserInfo();
			$image->upload(Input::file('profile_pic') , $user->id , 'profile');
			if(count($image->errors) > 0) {
				Redirect::back()->withErrors($image->errors);
			}
			$user = User::find($user->id);
			$user->profilePicture()->save($image->create($image->path, $user->id));	
			$user->save();
		}
		
	}

}
