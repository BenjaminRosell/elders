@extends('layouts.master')

@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Families and Assignments</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Families</h3>
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

	<table class="table table-striped">
		<tr>	
			<td>Family Name</td>
			<td>Home Teachers</td>
			<td>Email</td>
			<td>Phone Number</td>
			@if ($admin)
			<td>Edit</td>
			@endif
		</tr>
		
	@foreach ($homes as $home)
    	<tr>
			<td>{{ HTML::to('homes/'.$home->id, $home->name, array('id' => 'register_link'));}}</td>
			<td>{{$home->team->senior->first_name}} {{$home->team->senior->last_name}} and {{$home->team->junior->first_name}} {{$home->team->senior->last_name}}</td>
			<td><a href="mailto:{{ $home->email }}"> {{ $home->email }}</a></td>
			<td>{{ $home->phone_number }}</td>
			@if ($admin)
			<td><a href="../../homes/<?php echo $home->id ?>/edit" class="btn btn-inverse"><i class="icon-pencil icon-white"></i></a></td>
			@endif
		</tr>
	@endforeach
	</table>
	@if ($admin)
		<a href="../../homes/create" class="btn btn-inverse"><i class="icon-plus icon-white"></i> Add a new home</a>
	@endif
@stop