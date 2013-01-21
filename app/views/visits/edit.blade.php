<?php 

$visited_array = array('1' => 'Yes', '0' => 'No');

foreach ( $teams as $team ) {
	$teams_array[$team->id] = $team->senior->first_name . ' ' .$team->senior->last_name . ' and ' . $team->junior->first_name .' ' . $team->junior->last_name;
}

foreach ($homes as $home) {
	$home_array[$home->id] = $home->name; 
}

?>

@section('content')
	<h3>Monthly Home teaching report</h3>
	{{ Form::open('visits/'.$visit->id, 'PUT', array('class'=>'form')) }}
		{{Form::label('family', 'Family Name')}}
		{{Form::select('family', $home_array, $visit->family_id)}} <br>
		{{Form::label('team', "Home Teaching team")}}
		{{Form::select('team', $teams_array, $visit->team_id)}}
		{{Form::label('visited', "Did you visit this family during this month ?")}}
		{{Form::select('visited', $visited_array, $visit->visited)}} <br>
		{{Form::label('status', 'How are they doing ?')}}
		{{Form::text('status', $visit->status)}} <br>
		{{Form::label('message', 'What was the message you tought ?')}}
		{{Form::textarea('message', $visit->message)}} <br>
		{{Form::label('issues', 'What are the main issues the family is facing ?')}}
		{{Form::textarea('issues', $visit->issues)}} <br>
		{{Form::label('visit_date', 'What was the exact date of your visit ?')}}
		{{Form::text('visit_date', $visit->visit_date, array('class' => 'datepicker'))}} <br>
		{{Form::submit('Save changes', array('class'=>'btn'))}}
	{{ Form::close() }}
@stop