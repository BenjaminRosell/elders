<?php

class Goals extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['goals'] = Goal::all();

		return View::make('goals.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		
		$data['id'] = $id;
		return View::make('goals.new', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$data = array(
			'home_id' => Input::get('home_id'),
			'date_due' => Input::get('date_due'),
			'name' => Input::get('name'),
			'description' => Input::get('description'), 
		 );
		
		$goal = Goal::create($data);

		if ( $goal )
		{
			echo "<script language=javascript>parent.window.location.reload()</script>";
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$data['goal'] = Goal::find($id);

		return View::make('goals.show');

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
		//
	}

}