@extends('layouts.master')

<?php 
	var_dump($district);	
	$brothers[] = ' -- Choose -- ';
	foreach ( $users as $user ) {
		$brothers[$user->id] = $user->first_name . ' ' . $user->last_name;
	}

 ?>

 @section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Editing the <?php echo $district->name ?> district</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Teams / Districts</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
	{{ Form::open('districts/'.$district->id, 'PUT', array('class' => 'form')) }}
		<div class="control-group">
		    {{Form::label('lead', 'District Name', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('name', $district->name)}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('steward', 'Steward', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('steward', $brothers, $district->steward)}}
		    </div>
		</div>

		<div class="control-group">
		    <div class="controls">
		    	{{Form::submit('Update District', array('class'=>'btn btn-inverse'))}}
		    </div>
		</div>
	{{ Form::close() }}

	@if (count($district->team) > 0)
	<div class="heading center m2">
        <div class="separation"></div>
        <h2>Teams belonging to this district</h2>
    </div>
	<ul>
	<?php foreach ($district->team as $team) { ?>
		<li><a href="../../../teams/<?php echo $team->id ?>">{{$team->senior->first_name}} {{$team->senior->last_name}} and {{$team->junior->first_name}} {{$team->junior->last_name}}</a></li>
	<?php } ?>
	<ul>


	@endif
@stop