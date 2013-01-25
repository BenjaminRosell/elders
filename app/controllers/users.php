<?php

class Users extends BaseController {

	public function __construct()
    {
        $this->user = Sentry::getUser();

        if ($this->user) {

        	$this->admin =  $this->user->hasAccess('admin');

        	$this->userTeam = User::findTeam($this->user->id);
        }
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$view['users'] = User::all();
    
        return View::Make('users.index', $view);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$view['users'] = User::all();
		$view['groups'] = Sentry::getGroupProvider()->findAll();

		if ($this->$admin) {
			$view['admin'] = true;
		} else {
			$view['admin'] = false;
		}

        return View::Make('users.new', $view);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = array(
            'email' => Input::get('email'),
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'phone' => Input::get('phone'),
            'first_name' => Input::get('firstname'),
            'last_name' => Input::get('lastname'),
            'reminder' => Input::get('reminder')
        	);

        try
		{
		    // Let's register a user.
		    $user = Sentry::register( $data, true);
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    return Redirect::to('users')->with('error_message', 'Login field required.');
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
		    return Redirect::to('users')->with('error_message', 'User already exists.');
		}

        if (Input::get('group')){

	        try
			{
			    // Find the user
			    $user_data = Sentry::getUserProvider()->findByLogin(Input::get('email'));

			    $group = Sentry::getGroupProvider()->findByName(Input::get('group'));

			    $user_data->addGroup($group);
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
			    return Redirect::to('users')->with('error_message', 'User does not exist.');
			}
			catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
			{
			    return Redirect::to('users')->with('error_message', 'Group does not exist.');
			}
        }
        if ($user)
        {
	        return Redirect::to('users')->with('success_message', 'The user has been created with success');
	    }
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$view['admin'] = ($this->admin) ? true : false;

		$view['user'] = User::where('username',$id)->first();

        if ($view['user']) {
            return View::make('users.show', $view);
        }

        return Redirect::to('users')->with('error_message', 'No users were found');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$view['user'] = User::where('username',$id)->first();
		$view['groups'] = Sentry::getGroupProvider()->findAll();

		$user = Sentry::getUser();

        $admin = $user->hasAccess('admin');

		if ($admin) {
			$view['admin'] = true;
		} else {
			$view['admin'] = false;
		}

		try
		{
		    // Find the user
		    $user  = Sentry::getUserProvider()->findById($view['user']->id);

		    // Get the user groups
		    $view['user_group'] = $user->getGroups();
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::to('users')->with('error_message', 'User does not exist');
		}

        return View::Make('users.edit', $view);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::where('username',$id)->first();

        $user->email = Input::get('email');
        $user->username = Input::get('username');
        $user->phone = Input::get('phone');
        $user->first_name = Input::get('firstname');
        $user->last_name = Input::get('lastname');
        $user->reminder = Input::get('reminder');

        $user->save();

        if (Input::get('group') !== Input::get('old_group') ){

	        try
			{
			    // Find the user
			    $user_data = Sentry::getUserProvider()->findByLogin($user->email);

			    // Find the group
			    $old_group = Sentry::getGroupProvider()->findByName(Input::get('old_group'));

			    $group = Sentry::getGroupProvider()->findByName(Input::get('group'));

			    $user_data->removeGroup($old_group);

			    $user_data->addGroup($group);
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
			    return Redirect::to('users')->with('error_message', 'User does not exist.');
			}
			catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
			{
			    return Redirect::to('users')->with('error_message', 'User does not exist.');
			}
        }

        return Redirect::to('users/'.$user->username);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::where('username',$id)->first();

        $user->delete();

        return Redirect::to('users');
	}
	/**
	 * logs in a user :)
	 * @return Response
	 */
	public function login()
	{
		return View::Make('users.login');
	}

	public function post_login()
	{   
	    try
		{
		    // Set login credentials
		    $credentials = array(
		        'email' => Input::get('email'),
	    		'password' => Input::get('password'),
	    	);

		    if ($user = Sentry::authenticate($credentials))
		    {
		        return Redirect::to('visits');
		    }
		    else
		    {
		        echo 'You shall not pass';
		    }
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{

		    return Redirect::to('login')->with('error_message', 'User not found. Maybe your pasword is wrong.');
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    return Redirect::to('login')->with('error_message', 'Login field is required..');
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
		    return Redirect::to('login')->with('error_message', 'User not activated.');
		}
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
		    return Redirect::to('login')->with('error_message', 'User suspended.');
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
		    return Redirect::to('login')->with('error_message', 'User banned.');
		}
	}

	public function register()
    {
    	return View::make('users.register');
    }

    public function post_register()
    {
    	try
		{
		    // Let's register a user. 
		    $user = Sentry::register(array(
		        'email' => Input::get('email'),
	    		'username' => Input::get('username'),
	    		'password' => Input::get('password'),
	    		'phone' => Input::get('phone'),
	    		'first_name' => Input::get('firstname'),
	    		'last_name' => Input::get('lastname'),
	    		'reminder' => Input::get('reminder')
		    ), true);

		    // Let's get an activation code
		    $activationCode = $user->getActivationCode();

		    $group = Sentry::getGroupProvider()->findByName('users');

			$user->addGroup($group);

		    // Send activation code to user to activate their account
		    if ($user) {
			    return Redirect::to('login')->with('success_message', 'Your user has been created succesfully, why not logging in now ?');
	    	}
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    return Redirect::to('register')->with('error_message', 'Login field required.');
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
		    return Redirect::to('register')->with('error_message', 'User already exists.');
		}
    }
    
    public function logout()
    {
	    Sentry::logout();
	    return Redirect::to('/');
    }

}