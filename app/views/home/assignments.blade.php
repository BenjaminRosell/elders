@extends('layouts.master')

 @section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Home Teaching Assignments</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Teams  / Assignments</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
	@if(Session::get('success_message'))
		<div class="alert alert-success">{{Session::get('success_message')}}</div>
	@endif

	@if(Session::get('error_message'))
		<div class="alert alert-error">{{Session::get('error_message')}}</div>
	@endif

	<blockquote>Drag and drop any families to assign them to a team</blockquote>
	<div class="row" id="familyContainer">
		@foreach ($teams as $team)
			<div class="team-container span3" id="{{$team->id}}">
				<div class="team-margin">
					<div class="team-header">
						<strong>{{$team->senior->first_name .' '. $team->senior->last_name}} and {{$team->junior->first_name .' '. $team->junior->last_name}}</strong>
					</div>
					<div class="families droppable">
						<ul class="icons">
							@foreach ($team->assignments as $assignment)
							<li class="draggable" id="{{$assignment->id}}"><i class="icon-user"></i>{{$assignment->name}}</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		@endforeach
	</div>
@stop

@section('javascript')
<script>
	jQuery(document).ready(function($) {

		$( ".draggable" ).draggable({ containment: "#familyContainer",  snap: ".families", revert: "invalid" });
	    $( ".droppable" ).droppable({
	      drop: function( event, ui ) {
	        var teamId = $( this ) .parents( "div.span3" ).attr( "id" );
	        var familyId = ui.draggable.attr('id');

	        $.post("assignments", { family: familyId, team: teamId })
	        	.done(function(data) {
	        	  $('#alert').remove();
				  $('<div class="alert alert-success" id="alert"><div>').text(data).prependTo('#main_container')
				});
		    }
	    });
	});
</script>
@stop