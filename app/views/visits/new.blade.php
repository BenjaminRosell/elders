@extends('layouts.master')

<?php 

$visited_array = array('1' => 'Yes', '0' => 'No');

foreach ( $teams as $team ) {
	$teams_array[$team->id] = $team->senior->first_name . ' ' .$team->senior->last_name . ' and ' . $team->junior->first_name .' ' . $team->junior->last_name;
}

foreach ($homes as $home) {
	$home_array[$home->id] = $home->name; 
}

?>
@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Monthly Home teaching report</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Reports</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
	{{ Form::open('visits', 'POST', array('class'=>'form')) }}
		<div class="control-group">
		    {{Form::label('family', 'Family Name', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('family', $home_array)}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('team', "Home Teaching team", array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('team', $teams_array)}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('visited', "Did you visit this family during this month ?", array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('visited', $visited_array)}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('status', 'How are they doing ?', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('status')}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('message', 'What was the message you tought ?', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::textarea('message')}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('issues', 'What are the main issues the family is facing ?', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::textarea('issues')}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('visit_date', 'What was the exact date of your visit ?', array('class' => 'control-label'))}}
			 <div class="controls">
		    	{{Form::text('visit_date', '', array('class' => 'span2 datepicker', 'size' => '16'))}}

		    </div>
		</div>

		<div class="control-group">
		    <div class="controls">
		    	{{Form::submit('Submit Report', array('class'=>'btn btn-inverse'))}}
		    </div>
		</div>
		
	{{ Form::close() }}
@stop