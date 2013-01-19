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
		
		$user = Sentry::getUser();

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

	    } else {

	    	$view['teams'] = Team::with(array('senior', 'junior'))->where('id', '=', $this->userTeam->id)->get();
			$view['homes'] = Home::where('team_id', '=', $this->userTeam->id)->get();
	    }

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
            'month' => Input::get('visit_date'),
            'status'  => Input::get('status'),
            'message' => Input::get('message'),
            'issues' => Input::get('issues'),
            'visit_date' => Input::get('visit_date'),
            'report_date' => date('Y-m-d')
            );
        $visit = Visit::create($data);

        if ($visit) {
     
            return Redirect::to('visits');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$view['teams'] = Team::with(array('senior', 'junior'))->get();
		$view['homes'] = Home::all();
		$view['visit'] = Visit::find($id);

		$this->layout->content = View::Make('visits.show', $view);
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
        $visit->month = Input::get('visit_date');
        $visit->status  = Input::get('status');
        $visit->message = Input::get('message');
        $visit->issues = Input::get('issues');
        $visit->visit_date = Input::get('visit_date');
        
        $visit->save();

        if ($visit) {
     
            return Redirect::to('visits/'.$id);
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