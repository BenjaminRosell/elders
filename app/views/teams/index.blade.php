@extends('layouts.master')

@section('content')
	<h4>This is a list of teams</h4>
	
	<table class="table table-striped">
		<tr>	
			<td>Team number</td>
			<td>Leader</td>
			<td>Junior companion</td>
			<td>Steward</td>
		</tr>
	@foreach ($teams as $team)
    	<tr>
			<td>{{ HTML::to('teams/'.$team->id, $team->id, array('id' => 'register_link'));}}</td>
			<td>{{ User::name($team->lead) }}</td>
			<td>{{ User::name($team->companion) }}</td>
			<td>{{ $team->steward }}</td>
		</tr>
	@endforeach
	</table>

	{{ HTML::to('teams/create', 'Add a new team', array('id' => 'add_link', 'class' => 'btn'));}}

@stop