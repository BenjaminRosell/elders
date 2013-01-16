<?php

class Users extends BaseController {

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
		    echo 'Login field required.';
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
		    echo 'User already exists.';
		}

		if ($user) {
     
            return 'A user has been created' . HTML::to('users', 'Check out the users', array('id' => 'visits_link'));
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$view['user'] = User::where('username',$id)->first();

        if ($view['user']) {
            return View::make('users.show', $view);
        }

        return 'No user recorded';
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$view['user'] = User::where('username',$id)->first();

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

}