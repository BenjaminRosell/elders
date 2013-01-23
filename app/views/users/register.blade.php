@extends('layouts.master')

@if(Session::get('success_message'))
	<div class="alert alert-success">{{Session::get('success_message')}}</div>
@endif

@if(Session::get('error_message'))
	<div class="alert alert-error">{{Session::get('error_message')}}</div>
@endif

<br>

@section('content')
	{{ Form::open() }}
		{{Form::label('email', 'E-Mail Address')}}
		{{Form::text('email')}} <br>
		{{Form::label('username', 'Username')}}
		{{Form::text('username')}} <br>
		{{Form::label('password', 'Password')}}
		{{Form::password('password')}} <br>
		{{Form::label('firstname', 'Your Firstname')}}
		{{Form::text('firstname')}} <br>
		{{Form::label('lastname', 'Your Lastname')}}
		{{Form::text('lastname')}} <br>
		{{Form::label('phone', 'Your Phone number')}}
		{{Form::text('phone')}} <br>
		{{Form::label('reminders', 'Want to get reminders ?')}}
		{{Form::checkbox('reminder')}} <br>
		{{Form::submit('submit')}}
	{{ Form::close() }}
	{{ HTML::to('register', 'Create an account', array('id' => 'register_link'));}}
@stop