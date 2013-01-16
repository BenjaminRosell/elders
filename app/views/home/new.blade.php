<?php 
	$teams_array[0] = '-- Select --';
foreach ( $teams as $team ) {
	$teams_array[$team->id] = $team->senior->first_name . ' ' .$team->senior->last_name . ' and ' . $team->junior->first_name .' ' . $team->junior->last_name;
}
?>

@section('content')
	<h3>Create new family</h3>
	{{ Form::open('homes', 'POST', array('class'=>'form')) }}
		{{Form::label('name', 'A name for the new family')}}
		{{Form::text('name')}} <br>
		{{Form::label('email', "E-mail Address")}}
		{{Form::text('email')}} <br>
		{{Form::label('address', "What's the address ?")}}
		{{Form::text('address')}} <br>
		{{Form::label('phone', 'Their Phone number')}}
		{{Form::text('phone')}} <br>
		{{Form::label('home_teachers', 'Home Teachers')}}
		{{Form::select('home_teachers', $teams_array)}} <br>
		{{Form::submit('Create new family', array('class'=>'btn'))}}
	{{ Form::close() }}
	{{ HTML::to('register', 'Create an account', array('id' => 'register_link'));}}
@stop