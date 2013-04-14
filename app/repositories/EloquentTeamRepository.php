<?php 

class EloquentTeamRepository implements TeamRepositoryInterface 
{
	public function getAllTeamsWithData()
	{
		return Team::with('assignments', 'district', 'senior', 'junior')->get();
	}

	public function getTeamWithData($id)
	{
		return Team::with('assignments', 'district', 'senior', 'junior')->find($id);
	}

	public function newTeam()
	{
		return new Team;
	}
	public function save()
	{

	}
}