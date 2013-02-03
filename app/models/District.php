<?php

class District extends Eloquent 
{
	
	protected $table = 'districts';

	public function team()
    {
        return $this->hasMany('Team', 'steward');
    }

    public function interviews()
    {
        return $this->hasMany('Master', 'district');
    }

    public function steward()
    {
        return $this->belongsTo('User', 'steward');
    }
}