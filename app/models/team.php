<?php

class Team extends Eloquent 
{
	
  protected $table = 'teams';

  public function assignments()
  {
    return $this->hasMany('Home');
  }

  public function senior()
  {
    return $this->belongsTo('User', 'lead');
  }

  public function junior()
  {
    return $this->belongsTo('User', 'companion');
  }

  public function district()
  {
    return $this->belongsTo('District', 'steward');
  }

  public function interview()
  {
    return $this->hasOne('Master');
  }
}