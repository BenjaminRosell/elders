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
			
			$view['teams'] = Team::with('assignments', 'district', 'senior', 'junior')->get();
			$users = User::all();

			if ($users) {
				foreach ($users as $user) {
					$user_team = User::findTeam($user->id);

					if ($user_team == NULL) {
						$view['unassignedUsers'][$user->id] = $user->first_name . ' ' . $user->last_name; 
					}
				}
			}

		} else {
			
			$view['teams'] = Team::with('assignments', 'district', 'senior', 'junior')->where('id', $this->userTeam->id)->get();

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
        $view['districts'] = District::all();
        $view['homes'] = Home::all();

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

        foreach (Input::get('assignments') as $assignment)
        {
        	$home = Home::find($assignment);

        	$home->team_id = $team->id;

        	$home->save();
        }

        if ($team) {
            return Redirect::to('teams')->with('success_message', 'A new team has benn added.');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		
		$view['stats'] = $this->getTeamStats($id);
		$view['team'] = Team::with('district', 'assignments')->find($id);

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
        $view['team'] = Team::with('assignments')->find($id);
        $view['districts'] = District::all();
        $view['homes'] = Home::all();

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

        $team->interview->district = Input::get('steward');

        $team->interview->save();

        if (Input::get('assignments')) {

        	foreach (Input::get('assignments') as $assignment) {
	        	$home = Home::find($assignment);

	        	$home->team_id = $team->id;

	        	$home->save();
	        }
	        
        }

        return Redirect::to('teams')->with('success_message', 'You changes have been saved');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$team = Team::with('assignments')->find($id);

		foreach ($team->assignments as $assignment) {

			$home = Home::find($assignment->id);

       		$home->team_id = 1;

       		$home->save();
       	}

        $team->delete();

        return Redirect::to('teams');
	}


	/**
	 * Get a specific team stats for the last 12 months
	 * @param  int $id A specific team id
	 * @return Array     A tems stats in array
	 */
	public function getTeamStats($id){
		
		$oneYearAgo = date("Y-m-01", strtotime( date( 'Y-m-01' )." -12 months") );
		
		//Gets an array of Months
		for ($i = 1; $i <= 12; $i++) {
		    $monthsDates[] = date("Y-m-01", strtotime( $oneYearAgo." +$i months"));
		}

		//Querries the DB for visits...
		$visits = Visit::where('team_id', $id)->where('month', '>=', $oneYearAgo)->get();

		//Set's the default visit number to 0
		foreach($monthsDates as $month){
			$stats[$month] = 0;
		}

		//Adds a visit to the corresponding month.
		foreach ($visits as $visit) {
			if ($visit->visited == true){
				$stats[$visit->month]++;
			}
		}

		return $stats;
	}

}