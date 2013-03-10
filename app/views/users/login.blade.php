@extends('layouts.master')

@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Log in to your account</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Users</h3>
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
	{{{ Form::open('login', 'POST', array('class' => 'form')) }}}

		<div class="control-group">
		    {{{Form::label('email', 'E-Mail Address', array('class' => 'control-label'))}}}
		    <div class="controls">
		    	{{{Form::text('email', '', array('placeholder' =>'Your email address'))}}}
		    </div>
		</div>

		<div class="control-group">
		    {{{Form::label('password', 'Your Password', array('class' => 'control-label'))}}}
		    <div class="controls">
		    	{{{Form::password('password')}}}
		    </div>
		</div>
		
		{{{Form::submit('Log-in', array('class' => 'btn btn-inverse'))}}}

	{{{ Form::close() }}}

	
@stop