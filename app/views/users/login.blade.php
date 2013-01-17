@extends('layouts.master')

@section('content')
	
	{{ Form::open('login', 'POST', array('class' => 'form')) }}

		<div class="control-group">
		    {{Form::label('email', 'E-Mail Address', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('email', '', array('placeholder' =>'Your email address'))}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('password', 'Your Password', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::password('password')}}
		    </div>
		</div>
		
		{{Form::submit('Log-in', array('class' => 'btn'))}}
		{{ HTML::to('register', 'Create an account', array('id' => 'register_link', 'class' => 'btn'));}}

	{{ Form::close() }}

	
@stop