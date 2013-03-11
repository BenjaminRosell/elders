<?php

class Interviews extends BaseController {


	protected $layout = 'layouts.master';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$view['districts'] = District::with(array('interviews' => function($query)
		{
		    $query->orderBy('time', 'asc');
		}), 'team', 'team.junior', 'team.senior')->get();

		$this->layout->content = View::make('interviews.index', $view);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$view['districts'] = District::all();

		$this->layout->content = View::make('interviews.new', $view);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = array(
            'team_id' => Input::get('team'),
            'district' => Input::get('district'),
            'time' => Input::get('hour').':'.Input::get('minutes').':00'
            );
        
        $master = Master::create($data);

        if ($master) {
        	return Redirect::to('interviews')->with('success_message', 'The interview time has been fixed');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$view['districts'] = District::all();
		$view['interview'] = Master::find($id);

		$this->layout->content = View::make('interviews.edit', $view);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$master = Master::find($id);

		$master->delete();

		return Redirect::to('interviews')->with('success_message', 'The interview was deleted correctly');
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function getDistrictTeams()
	{
		$data = Team::with('senior', 'junior')->where('steward', '=', Input::get('id'))->get();
		//$data = Team::with('senior', 'junior')->where('steward', '=', 1)->get();

		$teams = '[';

		foreach( $data as $team ) {

			$hasAppointment = Master::where('team_id', '=', $team->id)->first();
			
			if (!$hasAppointment) {
				$teams .= (string) $team.',';
			}
		}

		$teams = substr($teams, 0, -1);

		$teams .= ']';

		return (string) $teams;
				
	}
}