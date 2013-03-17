<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('pages.home');
});

Route::get('/test', function()
{

$today = date('d');
$monthYear = date('Y-m');
$nextMonthYear = date('Y-m', strtotime('+1 month'));

if ($today <= 4) {
	
	//Send emails cause next sunday will be 1st Sunday...
	$firstSunday = date('Y-m-d', strtotime("first sunday of $monthYear"));

} else {
	
	//Check of we'll be next sunday
	$firstSunday = date('Y-m-d', strtotime("first sunday of $nextMonthYear"));
	$nextSunday = date('Y-m-d', strtotime("next sunday"));

	if ($firstSunday == $nextSunday) {

		//Send emails to all teams :)
		echo 'test';

	} else{

		echo 'false';
	}

}
});




Route::get('/error', function()
{
	return View::make('errors.index');
});

Route::get('login', 'Users@login');
Route::post('login', 'Users@post_login');
Route::get('register', 'Users@register');
Route::post('register', 'Users@post_register');
Route::get('logout', 'Users@logout');

Route::group(array('before' => 'authorise'), function()
{
	Route::get('password', 'Users@password');
	Route::post('password', 'Users@post_password');
	Route::get('assignments', 'Assignments@index');
	Route::post('assignments', 'Assignments@assign');
	Route::post('interviews/district', 'Interviews@getDistrictTeams');
	Route::post('interviews/teams', 'Interviews@getCompleteTeams');
	Route::post('visits/generate', 'Visits@generateVisits');

	Route::resource('homes', 'Homes');

	Route::resource('interviews', 'Interviews');

	Route::resource('teams', 'Teams');

	Route::resource('visits', 'Visits');

	Route::resource('users', 'Users');

	Route::resource('groups', 'Groups');

	Route::resource('districts', 'Districts');
	
	Route::get('goals/create/{id}', 'Goals@create');

	Route::resource('goals', 'Goals', array('only' => array('index', 'show', 'store', 'edit', 'update', 'destroy')));
});

Route::get('/crons/visits', 'Crons@visitsCron');


Route::filter('authorise', function()
{
	if ( ! Sentry::check()) return Redirect::to('login');
});

Route::filter('isAdmin', function()
{
	$user = Sentry::getUser();

	if ( ! $user->hasAccess('admin')) return 'Job 38:11' ;
});

// Event::listen('laravel.query', function($sql)
// {
// 	return var_dump($sql);
// });
