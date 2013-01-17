<?php

class Groups extends BaseController {

	protected $layout = 'layouts.master';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['groups'] = Sentry::getGroupProvider()->findAll();

		$this->layout->content = View::make('groups.index', $data);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content = View::make('groups.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try
		{
		    $group = Sentry::getGroupProvider()->create(array(
		        'name'        => Input::get('name'),
		        'permissions' => array(
		            'admin' => Input::get('admin') ? 1 : 0,
		            'observer' => Input::get('observer') ? 1 : 0,
		            'users' => Input::get('users') ? 1 : 0
		        )
		    ));

		    if ($group) 
		    {
		    	return Redirect::to('groups');
		    }
		}
		catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
		    echo 'Name field required';
		}
		catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
		    echo 'Group already exists';
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		try
		{
		    $data['group'] = Sentry::getGroupProvider()->findById($id);
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    echo 'Group not found.';
		}

		$this->layout->content = View::make('groups.edit', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		try
		{
		    $data['group'] = Sentry::getGroupProvider()->findById($id);
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    echo 'Group not found.';
		}

		$this->layout->content = View::make('groups.edit', $data);	
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		try
		{
		    // Find the group
		    $group = Sentry::getGroupProvider()->findById($id);

			$group->name = Input::get('name');
	        $group->permissions = array(
	            'admin' => Input::get('admin') ? 1 : 0,
	            'observer' => Input::get('observer') ? 1 : 0,
	            'users' => Input::get('users') ? 1 : 0
	        );

		    // Save
		    if ($group->save())
		    {
		        return Redirect::to('groups/'.$id);
		    }
		    else
		    {
		        return 'Group not saved';
		    }
		}
		catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
		    echo 'Name field required.';
		}
		catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
		    echo 'Group already exists.';
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    echo 'Group not found.';
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		try
		{
		    // Find the group
		    $group = Sentry::getGroupProvider()->findById($id);

		    // Delete
		    if ($group->delete())
		    {
		       return Redirect::to('groups');
		    }
		}
		catch (Cartalyst\Sentry\Grousp\GroupNotFoundException $e)
		{
		    echo 'Group not found.';
		}
	}

}