@extends('layouts.master')

@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">User Management</h2>
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

	<h4>This is a list of our brethren</h4>
	
	<table class="table table-striped">
		<tr>	
			<td>Username</td>
			<td>Name</td>
			<td>Email</td>
			<td>Phone</td>
			<td>Reminders</td>
		</tr>
	@foreach ($users as $user)
    	<tr>
			<td>{{ HTML::to('users/'.$user->username, $user->username, array('id' => 'register_link'));}}</td>
			<td>{{ $user->first_name .' '. $user->last_name }}</td>
			<td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
			<td>{{ $user->phone }}</td>
			<td>{{ $user->reminders == 1 ? 'Yes' : 'No' }}</td>
		</tr>
	@endforeach
	</table>

	<a href="../../users/create" class="btn btn-inverse"><i class="icon-plus icon-white"></i> Add a new user</a>
@stop