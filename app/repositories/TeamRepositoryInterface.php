<?php

interface TeamRepositoryInterface
{

	public function getAllTeamsWithData();
	public function getTeamWithData($id);
	public function newTeam();
	public function save();
}