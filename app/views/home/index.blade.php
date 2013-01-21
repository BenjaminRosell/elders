@extends('layouts.master')

@section('content')
	<h4>This is a list of our families</h4>
	
	<table class="table table-striped">
		<tr>	
			<td>Family Name</td>
			<td>Email</td>
			<td>Phone Number</td>
			<td>Address</td>
			<td>Home Teachers</td>
		</tr>
		
	@foreach ($homes as $home)
    	<tr>
			<td>{{ HTML::to('homes/'.$home->id, $home->name, array('id' => 'register_link'));}}</td>
			<td>{{ $home->email }}</td>
			<td>{{ $home->phone_number }}</td>
			<td>{{ $home->address }}</td>
			<td>{{$home->team->senior->first_name}} {{$home->team->senior->last_name}} and {{$home->team->junior->first_name}} {{$home->team->senior->last_name}}</td>
		</tr>
	@endforeach
	</table>
	@if ($admin)
		{{ HTML::to('homes/create', 'Add a new home', array('id' => 'add_link', 'class' => 'btn'));}}
	@endif
@stop