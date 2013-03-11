@extends('layouts.master')

<?php 
	
	$brothers[] = ' -- Choose -- ';
	foreach ( $users as $user ) {
		$brothers[$user->id] = $user->first_name . ' ' . $user->last_name;
	}

 ?>

 @section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Create a new Home Teaching distric</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Teams / Districts</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
	{{ Form::open(array('url' => 'districts', 'method' => 'POST', 'class' => 'form')) }}
		<div class="control-group">
		    {{Form::label('lead', 'District Name', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('name')}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('steward', 'Steward', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('steward', $brothers, '')}}
		    </div>
		</div>

		<div class="control-group">
		    <div class="controls">
		    	{{Form::submit('Create District', array('class'=>'btn btn-inverse'))}}
		    </div>
		</div>
	{{ Form::close() }}
@stop