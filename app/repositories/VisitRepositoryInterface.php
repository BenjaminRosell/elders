<?php

interface VisitRepositoryInterface
{
	public function all();
	public function getYearlyStats($id, $startDate);
}