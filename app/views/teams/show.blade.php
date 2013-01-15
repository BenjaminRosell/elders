@extends('layouts.master')

@section('content')
	<h3>Here is the team data</h3>

    <p>The team number is {{ $team->id }} </p>
    <p>The team leader is {{ User::name($team->lead) }} </p>
    <p>The team junior companion is {{ User::name($team->companion) }}</p>
    <p>The steward is {{ $team->steward }}</p>
    {{ Form::open('teams/'.$team->id, 'DELETE', array('class' => 'form')) }}
	    {{ HTML::to('teams/' . $team->id .'/edit', 'Edit this team', array('id' => 'edit_link', 'class' => 'btn'));}}
		{{ HTML::to('teams', 'Back to teams', array('id' => 'back_link', 'class' => 'btn'));}}
		
		{{Form::submit('Delete team', array('class' => 'btn btn-danger pull-right'))}}
	{{Form::close()}}

@stop