@extends('layouts.master')

@section('content')
	<h3>Edit {{$user->firstname . ' ' . $user->lastname}}</h3>
	{{ Form::open('users/'.$user->username, 'PUT', array('class' => 'form')) }}
		{{Form::label('email', 'E-Mail Address')}}
		{{Form::text('email', $user->email)}} <br>
		{{Form::label('username', 'Username')}}
		{{Form::text('username', $user->username)}} <br>
		{{Form::label('firstname', 'Your Firstname')}}
		{{Form::text('firstname', $user->first_name)}} <br>
		{{Form::label('lastname', 'Your Lastname')}}
		{{Form::text('lastname', $user->last_name)}} <br>
		{{Form::label('phone', 'Your Phone number')}}
		{{Form::text('phone', $user->phone)}} <br>
		{{Form::label('reminders', 'Want to get reminders ?')}}
		{{Form::checkbox('reminder', $user->reminder)}} <br><br>
		{{Form::submit('submit', array('class' =>'btn'))}}
	{{ Form::close() }}
@stop