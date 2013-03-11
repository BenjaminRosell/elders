@extends('layouts.master')

@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Home Teaching team profile</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Teams</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
	<h4>Home Teaching # {{ $team->id }}</h4>

    <p>The team senior companion is {{ User::name($team->lead) }} </p>
    <p>The team junior companion is {{ User::name($team->companion) }}</p>
    <p>Their district is {{ $team->district->name }}</p>
    <p>The steward is {{ User::name($team->district->steward) }}</p>
    <br>

    @if ($admin)
    {{ Form::open(array('url' => 'teams/'.$team->id, 'method' => 'DELETE', 'class' => 'form')) }}

		<a href="../../teams" class="btn btn-inverse"><i class="icon-chevron-left icon-white"></i> Back to teams</a>
		<a href="../../teams/<?php echo $team->id ?>/edit" class="btn btn-inverse"><i class="icon-pencil icon-white"></i> Edit this team</a>

		<button class="btn btn-danger pull-right"><i class="icon-trash  icon-white"></i> Delete team</button>

	{{Form::close()}}
    @endif

@stop