<?php

class Goal extends Eloquent 
{
	
  protected $table = 'goals';

  public function Home()
  {
    return $this->belongsTo('Home');
  }
}