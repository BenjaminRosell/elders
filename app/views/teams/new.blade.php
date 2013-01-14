@extends('layouts.master')

<?php 
	
	$brothers[] = '';
	foreach ( $users as $user ) {
		$brothers[$user->id] = $user->firstname . ' ' . $user->lastname;
	}

	$stewards = array(
			''	=>	'',
			'1'	=>	'Benjamin Gonzalez', 
			'2'	=>	'Guillaume Plouffe', 
		);


 ?>
@section('content')
	Create a new team

	{{ Form::open('teams') }}
		{{Form::select('lead', $brothers, '')}}
		{{Form::select('companion', $brothers, '')}}
		{{Form::select('steward', $stewards)}} <br>
		{{Form::submit('submit')}}
	{{ Form::close() }}
@stop