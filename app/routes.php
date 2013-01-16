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

Route::resource('users', 'users');

Route::resource('homes', 'homes');

Route::resource('teams', 'teams');

Route::resource('visits', 'visits');