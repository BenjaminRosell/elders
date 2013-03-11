<?php 

foreach ( $teams as $team ) {
	$teams_array[$team->id] = $team->senior->first_name . ' ' .$team->senior->last_name . ' and ' . $team->junior->first_name .' ' . $team->junior->last_name;
}

?>
@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Edit the {{$home->name}}'s family record</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Users</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
	{{ Form::open(array('url' => 'homes/'.$home->id, 'method' => 'PUT', 'class' => 'form')) }}
		<div class="control-group">
		    {{Form::label('name', 'A name for the new family', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('name', $home->name)}}
		    </div>
		</div>
		<div class="control-group">
		    {{Form::label('email', "E-mail Address", array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('email', $home->email)}}
		    </div>
		</div>
		<div class="control-group">
		    {{Form::label('address', "What's their address ?", array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('address', $home->address)}}
		    </div>
		</div>
		<div class="control-group">
		    {{Form::label('phone', 'Their Phone number', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('phone_number', $home->phone_number, array('class'=>'phone'))}}
		    </div>
		</div>
		<div class="control-group">
		    {{Form::label('home_teachers', 'Home Teachers', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('home_teachers', $teams_array, $home->team_id)}}
		    </div>
		</div>
		{{Form::submit('submit', array('class' =>'btn-inverse btn'))}}
	{{ Form::close() }}
@stop