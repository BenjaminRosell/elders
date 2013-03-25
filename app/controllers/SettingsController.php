<?php

class SettingsController extends BaseController {

	protected $layout = 'layouts.master';
	protected $user;
	protected $admin;
	protected $userTeam;

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
		
		$settings = Setting::all();

		$this->layout->contents = View::make('settings.index', compact('settings'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editSettings()
	{
		$settings['sunday'] = Setting::find(1);
		$settings['email'] = Setting::find(2);
		$this->layout->contents = View::make('settings.edit', $settings);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function saveSettings()
	{
		$sunday = Setting::find(1);
		$email = Setting::find(2);

		$sunday->value = Input::get('sunday');
		$email->value = Input::get('email');

		if($email->save() and $sunday->save()) {
			return Redirect::to('settings')->with('success_message', 'Your settings have been updated !');
		}
	}

}