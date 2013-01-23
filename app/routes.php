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

Route::get('login', 'users@login');
Route::post('login', 'users@post_login');
Route::get('register', 'users@register');
Route::post('register', 'users@post_register');
Route::get('logout', 'users@logout');

Route::group(array('before' => 'authorise'), function()
{
	Route::resource('homes', 'homes');

	Route::resource('teams', 'teams');

	Route::resource('visits', 'visits');

	Route::resource('users', 'users');

	Route::resource('groups', 'Groups');
});

Route::get('/crons/visits', 'crons@visitsCron');


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