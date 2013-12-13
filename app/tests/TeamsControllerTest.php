<?php

class TeamsControllerTest extends TestCase {

	public function testIndexAsAdmin()
	{
		$auth = Mockery::mock('AuthInterface');
		$team = Mockery::mock('TeamRepositoryInterface');
		$user = Mockery::mock('UserRepositoryInterface');

		App::instance('TeamRepositoryInterface', $team);
		App::instance('UserRepositoryInterface', $user);
		App::instance('AuthInterface', $auth);

		$auth->shouldReceive('getUser')->once()->andReturn($currentUser = Mockery::mock('Cartalyst\Sentry\Users\ProviderInterface'));
		$currentUser->shouldReceive('hasAccess')->once()->andReturn(true);
		$user->shouldReceive('findTeam')->once()->andReturn(Mockery::self());
		$team->shouldReceive('getAllTeamsWithData')->once()->andReturn($team);
		$currentUser->id = 1;
		$user->shouldReceive('all')->once()->andReturn(array($firstUser = Mockery::self()));
		$user->shouldReceive('findTeam')->once()->andReturn(Mockery::self());
		
		$response = $this->call('GET', 'teams');
		$this->assertTrue($response->isOk());
	}

	public function testIndexAsUser()
	{
		$auth = Mockery::mock('AuthInterface');
		$team = Mockery::mock('TeamRepositoryInterface');
		$user = Mockery::mock('UserRepositoryInterface');

		App::instance('TeamRepositoryInterface', $team);
		App::instance('UserRepositoryInterface', $user);
		App::instance('AuthInterface', $auth);

		$auth->shouldReceive('getUser')->once()->andReturn($currentUser = Mockery::mock('Cartalyst\Sentry\Users\ProviderInterface'));
		$currentUser->shouldReceive('hasAccess')->once()->andReturn(false);
		$currentUser->id = 1;
		$user->shouldReceive('findTeam')->once()->andReturn(Mockery::self());
		$team->shouldReceive('getTeamWithData')->with(1)->once()->andReturn($team);
		
		$response = $this->call('GET', 'teams');
		$this->assertTrue($response->isOk());
	}

	public function testShow()
	{
		
		$auth = Mockery::mock('AuthInterface');
		$user = Mockery::mock('UserRepositoryInterface');
		$team = Mockery::mock('TeamRepositoryInterface');
		$visit = Mockery::mock('VisitRepositoryInterface');

		App::instance('AuthInterface', $auth);
		App::instance('UserRepositoryInterface', $user);
		App::instance('TeamRepositoryInterface', $team);
		App::instance('VisitRepositoryInterface', $visit);

		$auth->shouldReceive('getUser')->once()->andReturn($currentUser = Mockery::mock('Cartalyst\Sentry\Users\ProviderInterface'));
		$currentUser->id = 1;
		$currentUser->shouldReceive('hasAccess')->once()->andReturn(false);
		$user->shouldReceive('findTeam')->once()->andReturn(Mockery::self());
		$team->shouldReceive('getTeamWithData')->with(1)->once()->andReturn($team);
		$team->id = 1;
		$visit->shouldReceive('getYearlyStats')
		->with(1, date("Y-m-01", strtotime( date( 'Y-m-01' )." -12 months") ))
		->once()
		->andReturn($visit);
		$team->assignments = array();


		$response = $this->call('GET', 'teams/1');
		$this->assertTrue($response->isOk());
	}

	// public function testCreate()
	// {
	// 	$response = $this->call('GET', 'teams/create');
	// 	$this->assertTrue($response->isOk());
	// }

	// public function testEdit()
	// {
	// 	$response = $this->call('GET', 'teams/1/edit');
	// 	$this->assertTrue($response->isOk());
	// }
}
