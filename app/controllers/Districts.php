<?php

class Districts extends BaseController {

	protected $layout = 'layouts.master';

	public function __construct()
    {
        $this->beforeFilter('isAdmin');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		//Gets all users and districs from the database
		$view['districts'] = District::all();
		$view['users'] = User::all();

		//Sends the data to the view.
		$this->layout->content = View::make('district.index', $view);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//Gets all users and districs from the database
		$view['users'] = User::all();

		//Sends the data to the view.
		$this->layout->content = View::make('district.new', $view);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//Getting all the data from the Input fields
		$data = array(
			'name' => Input::get('name'),
			'steward' => Input::get('steward')
			);

		//Saving through eloquent
		$district = District::create($data);

		//Redirecting if succcesfully created the user...
		if ($district)
		{
			return Redirect::to('districts')->with('success_message', 'A new Home Teaching District has been created');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$view['district'] = District::with('team', 'team.senior', 'team.junior')->find($id);

		$this->layout->content = View::make('district.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		//Gets all users and districs from the database
		$view['users'] = User::all();
		$view['district'] = District::find($id);

		//Sends the data to the view.
		$this->layout->content = View::make('district.edit', $view);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		//Getting the district from the DB
		
		$district = District::find($id);

		$district->name = Input::get('name');
		$district->steward = Input::get('steward');

		//Update to db
		$district->save();

		//Redirecting if succcesfully created the user...
		if ($district)
		{
			return Redirect::to('districts')->with('success_message', 'The Home Teaching District has been succesfully updated');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$district = District::find($id);

        $district->delete();

        return Redirect::to('districts')->with('success_message', 'The Home teaching district was deleted succesfully');
	}

}