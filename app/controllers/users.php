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
            'password' => Hash::make(Input::get('password')),
            'phone' => Input::get('phone'),
            'firstname' => Input::get('firstname'),
            'lastname' => Input::get('lastname'),
            'reminder' => Input::get('reminder')
        	);
        $user = User::create($data);

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
        $user->firstname = Input::get('firstname');
        $user->lastname = Input::get('lastname');
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