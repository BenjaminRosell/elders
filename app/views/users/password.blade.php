@extends('layouts.master')

@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Update your password</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Users</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
	@if(Session::get('success_message'))
		<div class="alert alert-success">{{Session::get('success_message')}}</div>
	@endif

	@if(Session::get('error_message'))
		<div class="alert alert-error">{{Session::get('error_message')}}</div>
	@endif
	<br>

	{{ Form::open('password', 'POST', array('class' => 'form')) }}

		<div class="control-group">
		    {{Form::label('old', 'Please type your old password', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::password('old')}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('password', 'Your new password', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::password('password')}}
		    </div>
		</div>
		
		{{Form::submit('Change Password', array('class' => 'btn btn-inverse'))}}

	{{ Form::close() }}

	
@stop