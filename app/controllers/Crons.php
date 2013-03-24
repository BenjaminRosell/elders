<?php

class Crons extends BaseController 
{
	
	protected $today;

	protected $monthYear;

	protected $nextMonthYear;

	public function __construct()
	{	
		$this->today = date('d'); 
		$this->monthYear = date('Y-m');
		$this->nextMonthYear = date('Y-m', strtotime('+1 month'));
	}

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
			$data = array();

			Mail::send('emails.report', $data, function($m) use ($team)
			{
			    $m->to($team->senior->email, $team->senior->first_name . ' '. $team->senior->last_name );
			    $m->cc($team->junior->email, $team->junior->first_name . ' '. $team->junior->last_name );
			    $m->subject('Monthly Home Teaching Report');
			    $m->from('info@elders.com', 'Elder\'s Quorum Presidency');
			});
		}
	}

	public function testing(){
		$dateTest = $this->sundayChecker('fifth');
		var_dump($dateTest);
	} 

	/**
	 * Verifies if the next sunday is the first
	 * @return date The first sunday of the month
	 */
	public function sundayChecker($number = 'first'){

		if ($this->today <= 4 and $number == 'first') {
			
			//Send emails cause next sunday will be 1st Sunday...
			 return $givenSunday = date('Y-m-d', strtotime("first sunday of $this->monthYear"));

		} 

		$nextSunday = date('Y-m-d', strtotime("next sunday"));

		if ($number == 'first') {
			
			$givenSunday = date('Y-m-d', strtotime("$number sunday of $this->nextMonthYear"));

		} else {
			$givenSunday = date('Y-m-d', strtotime("$number sunday of $this->monthYear"));
		}

		//Check if next sunday will be the first sunday of the month
		if ($givenSunday == $nextSunday) {
			//return a date :)
			return $givenSunday;

		} 

		return false;
	}
}