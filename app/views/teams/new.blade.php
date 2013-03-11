@extends('layouts.master')

<?php 
	
	$brothers[] = ' -- Choose -- ';
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

 ?>

 @section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Create a new Home Teaching team</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Teams</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
	{{ Form::open(array('action' => 'teams', 'method' => 'POST', 'class' => 'form')) }}
		<div class="control-group">
		    {{Form::label('lead', 'Senior Companion', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('lead', $brothers, '')}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('companion', 'Junior Companion', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('companion', $brothers, '')}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('steward', 'Steward', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('steward', $districts_array)}} <br>
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('assignments', 'Assigned homes (Press Ctrl or cmd for multiple selection)', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('assignments[]', $homes_array, '', array('multiple' => 'multiple', 'style' => 'height:300px;'))}} <br>
		    </div>
		</div>

		<div class="control-group">
		    <div class="controls">
		    	{{Form::submit('Create team', array('class'=>'btn btn-inverse'))}}
		    </div>
		</div>
	{{ Form::close() }}
@stop