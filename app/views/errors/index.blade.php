@extends('layouts.master')

@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Something went wrong !</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Error</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
	@if(Session::get('success_message'))
		<div class="alert alert-success">{{Session::get('success_message')}}</div>
	@endif

	@if(Session::get('error_message'))
		<div class="alert alert-error">{{Session::get('error_message')}}</div>
	@endif
	@if(isset($error_message))
		<div class="alert alert-error">{{$error_message}}</div>
	@endif
@stop