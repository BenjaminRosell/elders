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

Route::get('login', 'Users@login');
Route::post('login', 'Users@post_login');
Route::get('register', 'Users@register');
Route::post('register', 'Users@post_register');
Route::get('logout', 'Users@logout');

Route::group(array('before' => 'authorise'), function()
{
	Route::resource('homes', 'Homes');

	Route::resource('teams', 'Teams');

	Route::resource('visits', 'Tisits');

	Route::resource('users', 'Users');

	Route::resource('groups', 'Groups');
	
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