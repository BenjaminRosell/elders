<?php

class Visits extends BaseController 
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
		$data['admin'] = ($this->admin) ? true : false;

		if( ! $this->userTeam ) return Redirect::to('error')->with('error_message', 'You have no assigned families yet. Please come back soon !');

		if ( $this->admin )
	    {
	        $data['visits'] = Visit::with(array('home', 'team.senior', 'team.junior'))->get();

	    } else {
	    	
	    	$data['visits'] = Visit::with(array('home', 'team.senior', 'team.junior'))->where('team_id', '=', $this->userTeam->id)->get();

 		}

        $this->layout->content = View::Make('visits.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		if ( $this->admin )
	    {
	        
	        $view['teams'] = Team::with(array('senior', 'junior'))->get();
			$view['homes'] = Home::all();
			$view['admin'] = true;

	    } else {

	    	$view['teams'] = Team::with(array('senior', 'junior'))->where('id', '=', $this->userTeam->id)->get();
			$view['homes'] = Home::where('team_id', '=', $this->userTeam->id)->get();
			$view['admin'] = false;
	    }

	    if (count($view['homes']) == 0) return Redirect::to('error')->with('error_message', 'There are no famillies to report on yet !'); 

		$this->layout->content = View::Make('visits.new', $view);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = array(
            'family_id' => Input::get('family'),
            'team_id' => Input::get('team'),
            'visited' => Input::get('visited'),
            'month' => date('Y-m-01', strtotime(Input::get('visit_date'))),
            'status'  => Input::get('status'),
            'message' => Input::get('message'),
            'issues' => Input::get('issues'),
            'visit_date' => Input::get('visit_date'),
            'report_date' => date('Y-m-d')
            );

		$team = Team::with('senior', 'junior')->find(Input::get('team'));

		$data['lead_id'] = $team->senior->id;
		$data['companion_id'] = $team->junior->id;

        $visit = Visit::create($data);

        if ($visit) {
            return Redirect::to('visits')->with('success_message', 'A new report has been created successfully');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{

		$view['visit'] = Visit::with('home', 'team', 'team.senior', 'team.junior')->find($id);

		if ($view['visit']) {

			if ( ! $this->admin AND $this->userTeam->id !== $view['visit']->team_id ) {
				
				$data['error'] = 'You are not allowed to see this page, friend !';
				$this->layout->content =  View::Make('errors.permissions', $data);
			
			} else {

			$this->layout->content = View::Make('visits.show', $view);

			}

		} else {
			return Redirect::to('visits')->with('error_message', 'Noting was found.');
		}
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{

		if ( $this->admin )
	    {
	        
	        $view['teams'] = Team::with(array('senior', 'junior'))->get();
			$view['homes'] = Home::all();

	    } else {

	    	$view['teams'] = Team::with(array('senior', 'junior'))->where('id', '=', $this->userTeam->id)->get();
			$view['homes'] = Home::where('team_id', '=', $this->userTeam->id)->get();
	    }

		$view['visit'] = Visit::find($id);

		$this->layout->content = View::Make('visits.edit', $view);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		$visit = Visit::find($id);

        $visit->family_id = Input::get('family');
        $visit->team_id = Input::get('team');
        $visit->visited = Input::get('visited');
        $visit->month = date('Y-m-01', strtotime(Input::get('visit_date')));
        $visit->status  = Input::get('status');
        $visit->message = Input::get('message');
        $visit->issues = Input::get('issues');
        $visit->visit_date = Input::get('visit_date');
        
        $visit->save();

        if ($visit) {
     
            return Redirect::to('visits/'.$id)->with('success_message', 'Your report has been updated successfully');
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}