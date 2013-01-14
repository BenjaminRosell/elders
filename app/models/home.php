<?php

class Home extends Eloquent 
{
	
	protected $table = 'homes';

	public function team()
    {
        return $this->belongsTo('Team');
    }
}