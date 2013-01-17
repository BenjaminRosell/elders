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
	return 'We are the champions';
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


Route::filter('authorise', function()
{
	if ( ! Sentry::check()) return Redirect::to('login');
});