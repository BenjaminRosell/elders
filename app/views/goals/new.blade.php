@extends('layouts.frame')

@section('content')
	{{ Form::open('homes', 'POST', array('class'=>'form')) }}
		
		<div class="control-group">
		    {{Form::label('name', 'What is their goal ?', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('name')}} 
		    </div>
		</div>
		<div class="control-group">
		    {{Form::label('description', "What is the action plan ?", array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('description')}} 
		    </div>
		</div>
		<div class="control-group">
		    {{Form::label('date_due', "When do you want to achieve it ?", array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('date_due', '', array('class' => 'datepicker'))}}
		    </div>
		</div>

		{{Form::submit('Create new goal', array('class'=>'btn btn-inverse'))}}
	{{ Form::close() }}
@stop