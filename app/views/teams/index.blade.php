@extends('layouts.master')

@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Home Teaching teams</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Teams</h3>
    </section><!-- end #wrapper_slider -->
@stop



@section('content')
	@if(Session::get('success_message'))
		<div class="alert alert-success">{{Session::get('success_message')}}</div>
	@endif

	@if(Session::get('error_message'))
		<div class="alert alert-error">{{Session::get('error_message')}}</div>
	@endif
	<table class="table table-striped">
		<tr>	
			<td>Team number</td>
			<td>Leader</td>
			<td>Junior companion</td>
			<td>Assignments</td>
			<td>District (Steward)</td>
			@if ($admin)
			<td>Edit</td>
			@endif
		</tr>
	@foreach ($teams as $team)
    	<tr>
			<td>{{ HTML::to('teams/'.$team->id, $team->id, array('id' => 'register_link'));}}</td>
			<td>{{ $team->senior->first_name . ' ' . $team->senior->last_name }}</td>
			<td>{{ $team->junior->first_name . ' ' . $team->junior->last_name }}</td>
			<td><?php 
				if ($team->assignments) {
					foreach ($team->assignments as $assignment ){
						echo '<a href="../../../homes/'.$assignment->id.'">'.$assignment->name . '</a><br />';
					}
				}
			    ?>
			</td>
			<td>{{ isset($team->district->name) ? $team->district->name : 'Not assigned yet'; }} <br> ({{ isset($team->district->name) ? User::name($team->district->steward) : 'Not assigned yet'; }})</td>
			@if ($admin)
			<td><a href="../../teams/<?php echo $team->id ?>/edit" class="btn btn-inverse"><i class="icon-pencil icon-white"></i></a></td>
			@endif
		</tr>
	@endforeach
	</table>
	
	@if ($admin)
	<a href="../../teams/create" class="btn btn-inverse"><i class="icon-plus icon-white"></i> Add a new team</a>

	<div class="heading center m2">
        <div class="separation"></div>
        <h2>Unasigned Bretheren</h2>
    </div>
    @foreach ($unassignedUsers as $key => $value)
    <li><?php echo $value ?></li>
    @endforeach
	@endif
@stop