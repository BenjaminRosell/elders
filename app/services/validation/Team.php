<?php namespace Services\Validation;

class Team extends Vaidation
{	
	public static $rules = array(
		'username' => 'required',
		'companion' => 'required',
		'steward' => 'required'
		);
}