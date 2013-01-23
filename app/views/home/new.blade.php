<?php 
	$teams_array[0] = '-- Select --';
foreach ( $teams as $team ) {
	$teams_array[$team->id] = $team->senior->first_name . ' ' .$team->senior->last_name . ' and ' . $team->junior->first_name .' ' . $team->junior->last_name;
}
?>

@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Create a new family</h2>
        <h3 class="breadcrumb text_shadow">Home  /  teams</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
	{{ Form::open('homes', 'POST', array('class'=>'form')) }}
		<div class="control-group">
		    {{Form::label('name', 'A name for the new family', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('name')}} 
		    </div>
		</div>
		<div class="control-group">
		    {{Form::label('email', "E-mail Address", array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('email')}} 
		    </div>
		</div>
		<div class="control-group">
		    {{Form::label('address', "What's their address ?", array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('address')}}
		    </div>
		</div>
		<div class="control-group">
		    {{Form::label('phone', 'Their Phone number', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('phone', '', array('class'=>'phone'))}}
		    </div>
		</div>
		<div class="control-group">
		    {{Form::label('home_teachers', 'Home Teachers', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('home_teachers', $teams_array)}}
		    </div>
		</div>

		{{Form::submit('Create new family', array('class'=>'btn btn-inverse'))}}
	{{ Form::close() }}

@stop