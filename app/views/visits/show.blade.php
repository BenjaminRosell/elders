@extends('layouts.master')

@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Monthly Home teaching report for {{$visit->home->name}}</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Visit</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
	@if(Session::get('success_message'))
		<div class="alert alert-success">{{Session::get('success_message')}}</div>
	@endif

	@if(Session::get('error_message'))
		<div class="alert alert-error">{{Session::get('error_message')}}</div>
	@endif
	
	<h5>Home Teaching team : </h5>	
	<div>
		{{ User::name($visit->lead_id) . ' and ' . User::name($visit->companion_id)}}
	</div>
	<h5>Did you visit this family during this month ?</h5>

	{{$visit->visited == 1 ? 'Yes' : 'No'}} 

	<h5>How are they doing ?</h5>
	{{$visit->status}}

	<h5>What are the main issues the family is facing ?</h5>
	<div class="well">
		{{ $visit->issues}} 
	</div>
	
	<h5>What was the message tought ?</h5>
	<div class="well">
		{{$visit->message}}
	</div>

	<h5>What was the date of your visit ?</h5>
	{{ $visit->visit_date }}

	<br>
	<br>

	<a href="../visits/<?=$visit->id?>/edit" class="btn btn-inverse"> <i class="icon-pencil icon-white"></i> Edit my report </a>
@stop