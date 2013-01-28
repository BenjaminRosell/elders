@extends('layouts.master')

<?php 
	
	$brothers[] = '';
	foreach ( $users as $user ) {
		$brothers[$user->id] = $user->first_name . ' ' . $user->last_name;
	}

	$districts_array[] = ' -- Choose -- ';
	foreach ( $districts as $district ) {
		$districts_array[$district->id] = $district->name . ' (' . User::name($district->steward). ')';
	}

	$homes_array[] = ' -- Choose -- ';
	foreach ( $homes as $home ) {
		$homes_array[$home->id] = $home->name;
	}

	if ($team->assignments)
	{
		foreach ($team->assignments as $assignment){
			$assigned_families[] = $assignment->id;
		}
	}
 ?>

 @section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Edit team # {{$team->id}} </h2>
        <h3 class="breadcrumb text_shadow">Home  /  Teams</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
	{{ Form::open('teams/'.$team->id, 'PUT', array('class' => 'form')) }}
		<div class="control-group">
		    {{Form::label('lead', 'Senior Companion', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('lead', $brothers, $team->lead)}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('lead', 'Junior Companion', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('companion', $brothers, $team->companion)}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('lead', 'Steward', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('steward', $districts_array, $team->steward)}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('assignments', 'Assigned homes (Press Ctrl or cmd for multiple selection)', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('assignments[]', $homes_array, isset($assigned_families) ? $assigned_families : '', array('multiple' => 'multiple', 'style' => 'height:300px;'))}} <br>
		    </div>
		</div>

		<div class="control-group">
		    
		    <div class="controls">
		    	{{Form::submit('Edit team', array('class'=>'btn btn-inverse'))}}
		    </div>
		</div>
	{{ Form::close() }}
@stop