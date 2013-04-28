<?php

class Visits extends BaseController 
{

	protected $layout = 'layouts.master';
	protected $user;
	protected $admin;
	protected $userTeam;

	public function __construct()
    {

     	$this->user = Sentry::getUser();
     	if (!$this->user) return Redirect::to('login');
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
	        $data['stats'] = $this->getOverallStats();
	        $data['percentages'] = $this->getOverallPercentages();

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
	
	/**
	 * Generates a set of reports for a specific month
	 * @return redirect Redirec to the visits
	 */
	public function generateVisits()
	{ 
		$teams = Team::with('assignments', 'junior', 'senior')->get();

		// Create a visit for each assignment
		foreach ($teams as $team){

			foreach ($team->assignments as $assignment) {
				$data = array(
		            'family_id' => $assignment->id,
		            'team_id' => $assignment->team_id,
		            'visited' => 0,
		            'month' => date('Y-m-01', strtotime(Input::get('month'))),
		            'lead_id' => $team->senior->id,
		            'lead_id' => $team->junior->id
		            );

				$visit = Visit::create($data);
			}
		}

		return Redirect::to('visits')->with('success_message', 'The reports have succesfully been generated for the following month : ' . date('Y-m-01', strtotime(Input::get('month'))));
	}

	/**
	 * Calculates all stats for over 1 year of visits
	 * @return array A collection of stats
	 */
	public function getOverallStats()
	{
		$oneYearAgo = date("Y-m-01", strtotime( date( 'Y-m-01' )." -12 months") );
		
		//Gets an array of Months
		for ($i = 1; $i <= 12; $i++) {
		    $monthsDates[] = date("Y-m-01", strtotime( $oneYearAgo." +$i months"));
		}

		//Querries the DB for visits...
		$visits = Visit::where('month', '>=', $oneYearAgo)->get();

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

	/**
	 * Calculates all percentages for over 1 year of visits
	 * @return array A collection of stats
	 */
	public function getOverallPercentages()
	{
		$oneYearAgo = date("Y-m-01", strtotime( date( 'Y-m-01' )." -12 months") );
		
		//Gets an array of Months
		for ($i = 1; $i <= 12; $i++) {
		    $monthsDates[] = date("Y-m-01", strtotime( $oneYearAgo." +$i months"));
		}

		//Querries the DB for visits...
		$visits = Visit::where('month', '>=', $oneYearAgo)->get();

		//Set's the default visit number to 0
		foreach($monthsDates as $month){
			$stats[$month]['assigned'] = 0;
			$stats[$month]['visited'] = 0;
		}

		//Adds a visit to the corresponding month.
		foreach ($visits as $visit) {
 			if ($visit->visited == true){
				$stats[$visit->month]['assigned']++;
				$stats[$visit->month]['visited']++;
			} else {
				$stats[$visit->month]['assigned']++;
			}
		}

		foreach($stats as $month => $data){
			if ($data['assigned'] > 0) {
				$percentages[$month] = (int) round($data['visited'] / $data['assigned'] * 100);
			} else {
				$percentages[$month] = 0;
			}
				
		}
		
		return $percentages;
	}
}