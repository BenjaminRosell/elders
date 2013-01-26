@extends('layouts.frame')

@section('content')
	@if(isset($goal))
		<h2 class="center">{{$goal->name}}</h2>
		<h6 class="center">To be accomplished by : {{$goal->date_due}}</h6>
		<h5>Action Plan</h5>
		<p>{{$goal->description}}</p>
		<br>
		@if($goal->completed)
		<h5>This goas was successfully completed on {{$goal->date_completed}}</h5>
		@endif
		<br>
		<div class="center">
			<a href="../../../goals/<?php echo $goal->id; ?>/edit" class="btn btn-inverse"><i class="icon-white icon-pencil"></i> Edit this goal</a>
		</div>

	@endif
@stop