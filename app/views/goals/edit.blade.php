@extends('layouts.frame')

@section('content')
		{{ Form::open(array('url' => 'goals/'.$goal->id, 'method' => 'PUT', 'class'=>'form')) }}
		<div class="control-group">
		    {{Form::label('name', 'What is their goal ?', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('name', $goal->name)}} 
		    </div>
		</div>
		<div class="control-group">
		    {{Form::label('description', "What is the action plan ?", array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::textarea('description', $goal->description)}} 
		    </div>
		</div>
		<div class="control-group">
		    {{Form::label('date_due', "When do you want to achieve it ?", array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('date_due', $goal->date_due, array('class' => 'datepicker'))}}
		    </div>
		</div>

		<div class="control-group" id="complete">
		    {{Form::label('completed', "Was this goal completed ?", array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::checkbox('completed', true , $goal->completed)}}
		    </div>
		</div>

		<div class="control-group date_completed">
		    {{Form::label('date_completed', "When was this goal completed ?", array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('date_completed', $goal->date_completed, array('class' => 'datepicker'))}}
		    </div>
		</div>
		<br>
		<br>

		<button type="submit" value="submit" class="btn btn-inverse"><i class="icon-white icon-pencil"></i> Edit this Goal</button>
	{{ Form::close() }}
@stop
@section('javascript')
<script type="text/javascript">
		jQuery(document).ready(function($) {
            
            $('#complete').change(function() {
				toggleDateCompleted();
			});

			function toggleDateCompleted(speed) {
				if($('input[name=completed]:checked').val()==null) {
					$(".date_completed").slideUp(speed);
				} else {
					$(".date_completed").slideDown(speed);
				}
			}
			toggleDateCompleted('fast');
        });
	</script>
@stop