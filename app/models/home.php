<?php

class Home extends Eloquent 
{
	
	protected $table = 'homes';

    protected $guarded = array();

	public function team()
    {
        return $this->belongsTo('Team');
    }

    public function goal()
    {
        return $this->hasMany('Goal');
    }
}