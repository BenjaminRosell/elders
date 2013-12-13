<?php 

class EloquentVisitRepository implements VisitRepositoryInterface 
{
	public function all()
	{
		return Visit::all();
	}

	public function getYearlyStats($id, $startDate)
	{
		return Visit::where('team_id', $id)->where('month', '>=', $startDate)->get();
	}
}