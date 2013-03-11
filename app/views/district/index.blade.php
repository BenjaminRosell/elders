@extends('layouts.master')

 @section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Home Teaching Districts</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Teams  / Districts</h3>
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
			<td>District Name</td>
			<td>Steward</td>
			<td>Edit</td>
			<td>Delete</td>
		</tr>
	@foreach ($districts as $district)
    	<tr>
			<td><a href="districts/{{$district->id}}/edit"> {{$district->name}}</a></td>
			<td>{{ User::name($district->steward) }}</td>
			<td><a href="../../../districts/{{$district->id}}/edit" class="btn btn-inverse"><i class="icon-white icon-pencil"></i></a></td>
			<td>{{ Form::open(array('url' => 'districts/'.$district->id, 'method' => 'DELETE')) }} <button type="Submit" value="submit" class="btn btn-danger"><i class="icon-white icon-trash"></i></button>{{ Form::close()}}</td>
		</tr>
	@endforeach
	</table>
	<br>
	<a href="../../districts/create" class="btn btn-inverse"><i class="icon-plus icon-white"></i> Add a new district</a>

@stop