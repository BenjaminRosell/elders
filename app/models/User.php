<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
	/**
	 * Get the correct name for the user.
	 *
	 * @return string
	 */

	public static function name($id){
		
		$user =  Static::find($id);

		if($user){
			return $user->first_name . ' ' . $user->last_name;
		}	

		return $id;	
	}

	public static function findTeam($id){

		$user = DB::table('users')
        	->where('users.id', '=', $id)
        	->join('teams', function($join)
			{
			    $join->on('users.id', '=', 'teams.lead')
			    ->orOn('users.id', '=', 'teams.companion');
			})
			->first();

		return $user;
	}

}