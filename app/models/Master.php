<?php

class Master extends Eloquent 
{
	
  protected $table = 'master';

  public function Team()
  {
    return $this->belongsTo('Team');
  }
}