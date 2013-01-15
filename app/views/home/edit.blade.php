<?php 

foreach ( $teams as $team ) {
	$teams_array[$team->id] = $team->senior->firstname . ' ' .$team->senior->lastname . ' and ' . $team->junior->firstname .' ' . $team->junior->lastname;
}

?>
@section('content')
	<h3>Edit the {{$home->name}}'s family record</h3>
	{{ Form::open('homes/'.$home->id, 'PUT', array('class' => 'form')) }}
		{{Form::label('name', 'Family name')}}
		{{Form::text('name', $home->name)}} <br>
		{{Form::label('email', 'E-Mail Address')}}
		{{Form::text('email', $home->email)}} <br>
		{{Form::label('phone_number', 'Your Phone number')}}
		{{Form::text('phone_number', $home->phone_number)}} <br>
		{{Form::label('address', 'The address')}}
		{{Form::text('address', $home->address)}} <br>
		{{Form::label('home_teachers', 'Home Teachers')}}
		{{Form::select('home_teachers', $teams_array, $home->team_id)}} <br><br>
		{{Form::submit('submit', array('class' =>'btn'))}}
	{{ Form::close() }}
@stop