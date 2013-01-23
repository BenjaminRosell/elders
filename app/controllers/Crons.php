<?php

class Crons extends BaseController 
{
	/**
	 * Creates the visits reports for every team and sends an email to 
	 * remind them to fill them out in preparation to stewarship interview
	 *
	 * @return  Response
	 */
	public function visitsCron()
	{

		// Select all teams, and their assignments... This is a joke with eloquent...
		$teams = Team::with('assignments', 'junior', 'senior')->get();

		// Create a visit for each assignment
		foreach ($teams as $team){

			foreach ($team->assignments as $assignment) {
				
				$data = array(
		            'family_id' => $assignment->id,
		            'team_id' => $assignment->team_id,
		            'visited' => 0,
		            'month' => date('Y-m-01'),
		            'lead_id' => $team->senior->id,
		            'lead_id' => $team->junior->id
		            );

				$visit = Visit::create($data);
			}

			// Send email with links to their reports

			Mail::send('emails.report', $data, function($m) use ($team)
			{
			    $m->to($team->senior->email, $team->senior->first_name . ' '. $team->senior->last_name );
			    $m->cc($team->junior->email, $team->junior->first_name . ' '. $team->junior->last_name );
			    $m->subject('Monthly Home Teaching Report');
			    $m->from('info@elders.com', 'Elder\'s Quorum Presidency');
			});
		}
	}
}