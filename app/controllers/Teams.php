<?php

class Teams extends BaseController {

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
		$view['admin'] = ($this->admin) ? true : false;

		if( ! $this->admin and ! $this->userTeam ) return Redirect::to('error')->with('error_message', 'Unfortunatly, you have no companion yet. Please come back soon !');

		if ($this->admin) {
			
			$view['teams'] = Team::with('assignments')->get();

		} else {
			
			$view['teams'] = Team::with('assignments')->where('id', $this->userTeam->id)->get();

		}

        return View::Make('teams.index', $view);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $view['users'] = User::all();

        return View::Make('teams.new', $view);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = array(
            'lead' => Input::get('lead'),
            'companion' => Input::get('companion'),
            'steward' => Input::get('steward')
            );
        
        $team = Team::create($data);

        if ($team) {
            return Redirect::to('teams');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$view['team'] = Team::find($id);

		if ( !$this->admin AND $this->userTeam->id !== $view['team']->id ) return Redirect::to('teams')->with('error_message', 'You are not allowed to see this page, friend !');

		$view['admin'] = $this->admin ? true : false;

        if ($view['team']) {
            return View::make('teams.show', $view);
        }

        return 'No teams recorded';
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$view['users'] = User::all();
        $view['team'] = Team::find($id);

        return View::Make('teams.edit', $view);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		$team = Team::find($id);

        $team->lead = Input::get('lead');
        $team->companion = Input::get('companion');
        $team->steward = Input::get('steward');

        $team->save();

        return Redirect::to('teams/'.$id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$team = Team::find($id);

        $team->delete();

        return Redirect::to('teams');
	}

}