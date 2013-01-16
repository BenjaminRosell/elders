<?php 

$visited_array = array('1' => 'Yes', '0' => 'No');

?>

@section('content')
	<h3>Monthly Home teaching report</h3>
	{{ Form::open('visits', 'POST', array('class'=>'form')) }}
		{{Form::label('family', 'Family Name')}}
		{{Form::select('family')}} <br>
		{{Form::label('team', "Home Teaching team")}}
		{{Form::select('home_teachers')}}
		{{Form::label('visited', "Did you visit this family during this month ?")}}
		{{Form::select('visited', $visited_array)}} <br>
		{{Form::label('status', 'How are they doing ?')}}
		{{Form::text('status')}} <br>
		{{Form::label('message', 'What was the message you tought ?')}}
		{{Form::textarea('message')}} <br>
		{{Form::label('issues', 'What are the main issues the family is facing ?')}}
		{{Form::textarea('issues')}} <br>
		{{Form::label('visit_date', 'What was the exact date of your visit ?')}}
		{{Form::text('visit_date', '', array('class' => 'datepicker'))}} <br>
		{{Form::submit('Create new family', array('class'=>'btn'))}}
	{{ Form::close() }}
@stop