<?php

class Goals extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$view['goals'] = Goal::all();

		return View::make('goals.index', $view);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		
		$view['id'] = $id;
		return View::make('goals.new', $view);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$view = array(
			'home_id' => Input::get('home_id'),
			'date_due' => Input::get('date_due'),
			'name' => Input::get('name'),
			'description' => Input::get('description'), 
		 );
		
		$goal = Goal::create($view);

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
		$view['goal'] = Goal::find($id);

		return View::make('goals.show', $view);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$view['goal'] = Goal::find($id);

		return View::make('goals.edit', $view);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		
		$goal = Goal::find($id);

		$goal->date_due = Input::get('date_due');
		$goal->name = Input::get('name');
		$goal->description = Input::get('description');
		$goal->completed = Input::get('completed');
		$goal->date_completed = Input::get('date_completed');
		
		$goal->save();

		echo "<script language=javascript>parent.window.location.reload()</script>";
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