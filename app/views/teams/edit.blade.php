@extends('layouts.master')

<?php 
	
	$brothers[] = '';
	foreach ( $users as $user ) {
		$brothers[$user->id] = $user->first_name . ' ' . $user->last_name;
	}

	$stewards = array(
			''	=>	'',
			'1'	=>	'Benjamin Gonzalez', 
			'2'	=>	'Guillaume Plouffe', 
		);


 ?>
@section('content')
	<h2>Edit team number {{$team->id}} </h2>

	{{ Form::open('teams/'.$team->id, 'PUT', array('class' => 'form')) }}
		{{Form::select('lead', $brothers, $team->lead)}}
		{{Form::select('companion', $brothers, $team->companion)}}
		{{Form::select('steward', $stewards, $team->steward)}} <br>
		{{Form::submit('Submit', array('class' => 'btn'))}}
	{{ Form::close() }}
@stop