@extends('layouts.master')

@section('content')
	<h4>This is a list of our brethren</h4>
	
	<table class="table table-striped">
		<tr>	
			<td>Username</td>
			<td>User</td>
			<td>Name</td>
			<td>Email</td>
			<td>Phone</td>
			<td>Reminders</td>
		</tr>
	@foreach ($users as $user)
    	<tr>
			<td>{{ HTML::to('users/'.$user->username, $user->id, array('id' => 'register_link'));}}</td>
			<td>{{ $user->username }}</td>
			<td>{{ $user->first_name .' '. $user->last_name }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->phone }}</td>
			<td>{{ $user->reminders }}</td>
		</tr>
	@endforeach
	</table>

	{{ HTML::to('users/create', 'Add a new user', array('id' => 'add_link', 'class' => 'btn'));}}

@stop