<?php

class Master extends Eloquent 
{
  protected $table = 'master';

  protected $guarded = array();

  public function Team()
  {
    return $this->belongsTo('Team');
  }
}