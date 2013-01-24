<?php

class Homes extends BaseController 
{

	protected $layout = 'layouts.master';
	
	public function __construct()
    {
        $this->user = Sentry::getUser();

        $this->admin =  $this->user->hasAccess('admin');

        $this->userTeam = User::findTeam($this->user->id);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{		

		if ( $this->admin )
	    {
	        $view['homes'] = Home::with(array('team', 'team.senior', 'team.junior'))->get();

	        $view['admin'] = true;
	    }
	    else
	    {
	    	$user_team = User::findTeam($this->user->id);

	    	$view['homes'] = Home::where('team_id', '=', $user_team->id)->get();

	    	$view['admin'] = false;

	    }
    
        $this->layout->content = View::Make('home.index', $view);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$view['teams'] = Team::with(array('senior', 'junior'))->get();
        $this->layout->content = View::Make('home.new', $view);
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
            'name' => Input::get('name'),
            'phone_number' => Input::get('phone'),
            'team_id'  => Input::get('home_teachers') ? Input::get('home_teachers') : 0 ,
            'address' => Input::get('address')
            );
        $home = Home::create($data);

        if ($home) {
     
           return Redirect::to('homes')->with('success_message', 'A new family has been created');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{

		$view['home'] = Home::with(array('team', 'team.senior', 'team.junior'))->find($id);
		$view['visits'] = Visit::where('family_id', '=', $id)->get();

		if ( !$this->admin AND $this->userTeam->id !== $view['home']->team_id ) return Redirect::to('homes')->with('error_message', 'You are not allowed to see this page, friend !');

		$view['admin'] = $this->admin ? true : false;

        if ($view['home']) {
            $this->layout->content = View::make('home.show', $view);
        } else {
        	return Redirect::to('homes')->with('error_message', 'Nothing was found');
        }
	}

	/**
	 * Edits the home information
	 * @param  int $id Which is the related home ID
	 * @return Response
	 */
	public function edit($id)
	{
		$view['home'] = Home::with(array('team', 'team.senior', 'team.junior'))->find($id);
        $view['teams'] = Team::with(array('senior', 'junior'))->get();

        $this->layout->content = View::Make('home.edit', $view);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
	    $home = Home::find($id);

        $home->email = Input::get('email');
        $home->name = Input::get('name');
        $home->phone_number = Input::get('phone_number');
        $home->address = Input::get('address');
        $home->team_id = Input::get('home_teachers');

        $home->save();

        return Redirect::to('homes/'.$id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$home = Home::find($id);

        $home->delete();

        return Redirect::to('homes');
	}

}