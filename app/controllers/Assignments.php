<?php

class Assignments extends BaseController {

	protected $layout = 'layouts.master';

	public function __construct()
    {
        $this->user = Sentry::getUser();

        if ($this->user) {

        	$this->admin =  $this->user->hasAccess('admin');

        	$this->userTeam = User::findTeam($this->user->id);
        }
    }

    /**
     * Generates a view where teams are managed with Ajax
     * 
     * @return response
     */
    
    public function index()
	{		
		if ( ! $this->admin ) return Redirect::to('error')->with('error_message', 'You don\'t have permission to see this page !');

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
    
        $this->layout->content = View::Make('home.assignments', $view);
	}

	public function assign()
	{

		$home = Home::find(Input::get('family'));

		$home->team_id = Input::get('team');

		if ($home->save()){
			return "The $home->name family was succesfully reassigned";
		} 

		return 'Something went wrong...';
	}
}