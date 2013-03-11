@extends('layouts.master')

@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">{{$user->first_name}} {{$user->last_name}}</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Users</h3>
    </section><!-- end #wrapper_slider -->
@stop
@section('content')
	<h5>Here is {{$user->first_name}}'s data</h5>
    <p>The user username is {{ $user->user_name }} </p>
    <p>The user name is {{$user->first_name .' '. $user->last_name }} </p>
    <p>The user email is {{ $user->email }}</p>
    <p>The user's phone number is {{ $user->phone }}</p>
    <p>The user's reminders are set to <?=$user->phone ? 'on' : 'off'; ?></p>
    {{ Form::open(array('url' => 'users/'.$user->username,'method' => 'DELETE', 'class' => 'form')) }}
	    
        <a href="../users/{{$user->username}}/edit" class="btn">Edit this user</a>
        @if( $admin )
		  <a href="users" class="btn">Back to users</a>
		  {{Form::submit('Delete user', array('class' => 'btn btn-danger pull-right'))}}
        @endif
	{{Form::close()}}

@stop