@extends('layouts.master')

<?php 
if($admin) {
	foreach ($groups as $group) {
		$groups_array[$group->name] = $group->name;
	} 
}
?>

@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Create a new user</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Users</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
	{{ Form::open(array('url' => 'users')) }}
		<div class="control-group">
		    {{Form::label('email', 'E-Mail Address', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('email')}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('username', 'Username', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('username')}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('password', 'Your Password', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::password('password')}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('firstname', 'Your Firstname', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('firstname')}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('lastname', 'Your Lastname', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('lastname')}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('phone', 'Your Phone number', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('phone', '', array('class'=>'phone'))}}
		    </div>
		</div>

		@if($admin)
		<div class="control-group">
		    {{Form::label('group', 'Permission Level', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('group', $groups_array)}}
		    </div>
		</div>
		@endif

		<div class="control-group">
		    {{Form::label('reminders', 'Want to get reminders ?', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::checkbox('reminder')}}
		    </div>
		</div>
		
		<p><br>{{Form::submit('Create new user', array('class' => 'btn btn-inverse'))}}</p>
	{{ Form::close() }}
@stop