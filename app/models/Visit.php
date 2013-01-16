<?php

class Visit extends Eloquent 
{
	protected $table = 'visits';

	public function team()
	{
	  return $this->belongsTo('Team', 'id');
	}

	public function home()
	{
	  return $this->belongsTo('Home', 'id');
	}

}