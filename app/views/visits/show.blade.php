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
		{{'<h5>Family Name : </h3>'. $visit->family_id}}
		<br>
		{{"Home Teaching team : ".$visit->team_id}}
		<br>
		{{"Did you visit this family during this month ? : ". $visit->visited == 1 ? 'Yes' : 'No'}} 
		<br>
		{{ 'How are they doing ? : '.$visit->status}}
		<br>
		{{ 'What was the message you tought ?'}}<br>
		{{$visit->message}}
		 <br>
		{{'What are the main issues the family is facing ?'}} <br>
		{{ $visit->issues}} 
		<br>
		{{ 'What was the exact date of your visit ?' }} <br>
		{{ $visit->visit_date }} <br>

		{{HTML::to('visits/'.$visit->id.'/edit', 'Edit my report', array('class'=>'btn'))}}
@stop