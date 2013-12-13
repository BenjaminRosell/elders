<?php 

class EloquentUserRepository implements UserRepositoryInterface 
{
	public function all()
	{
		return User::all();
	}

	public function findTeam($id)
	{
		return User::findTeam($id);
	}
}