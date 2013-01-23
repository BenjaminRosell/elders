@extends('layouts.master')
@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Edit user's info</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Reports</h3>
    </section><!-- end #wrapper_slider -->
@stop

<?php 

foreach ($groups as $group) {
	$groups_array[$group->name] = $group->name;
} 

foreach ($user_group as $permission) {
	$permissions[$permission->name] = $permission->name;
}

if (isset($permissions['admin']) AND !isset($permissions['observer'])){
	$user_permission = 'admin';
} elseif (isset($permissions['observer'])){
	$user_permission = 'observer';
} else {
	$user_permission = 'users';
}

?>

@section('content')
	<h5>Edit {{$user->first_name . ' ' . $user->last_name}}</h5>
	{{ Form::open('users/'.$user->username, 'PUT', array('class' => 'form')) }}
		
		<div class="control-group">
		    {{Form::label('email', 'E-Mail Address', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('email', $user->email)}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('username', 'Username', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('username', $user->username)}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('firstname', 'Your Firstname', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('firstname', $user->first_name)}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('lastname', 'Your Lastname', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('lastname', $user->last_name)}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('phone', 'Your Phone number', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('phone', $user->phone, array('class'=>'phone'))}}
		    </div>
		</div>

		@if($admin)
		<div class="control-group">
		    {{Form::label('group', 'Permission Level', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::hidden('old_group', $user_permission)}}
		    	{{Form::select('group', $groups_array, $user_permission)}}
		    </div>
		</div>
		@endif

		<div class="control-group">
		    {{Form::label('reminders', 'Want to get reminders ?', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::checkbox('reminder', $user->reminder)}}
		    </div>
		</div>
		{{Form::submit('Edit user info', array('class' =>'btn btn-inverse'))}}
	{{ Form::close() }}
@stop