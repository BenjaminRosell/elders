@extends('layouts.master')

@section('content')
	<h3>Here is {{$user->first_name}}'s data</h3>
    <p>The user username is {{ $user->user_name }} </p>
    <p>The user name is {{$user->first_name .' '. $user->last_name }} </p>
    <p>The user email is {{ $user->email }}</p>
    <p>The user's phone number is {{ $user->phone }}</p>
    <p>The user's reminders are set to <?=$user->phone ? 'on' : 'off'; ?></p>
    {{ Form::open('users/'.$user->username, 'DELETE', array('class' => 'form')) }}
	    {{ HTML::to('users/' . $user->username .'/edit', 'Edit this user', array('id' => 'edit_link', 'class' => 'btn'));}}
		{{ HTML::to('users', 'Back to users', array('id' => 'back_link', 'class' => 'btn'));}}
		
		{{Form::submit('Delete user', array('class' => 'btn btn-danger pull-right'))}}
	{{Form::close()}}

@stop