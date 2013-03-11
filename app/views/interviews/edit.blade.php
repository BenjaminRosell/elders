@extends('layouts.master')

<?php 
	$districts_array[] = ' -- Choose -- ';
	foreach ( $districts as $district ) {
		$districts_array[$district->id] = $district->name;
	}

	for($i=7;$i<=20;$i++) {$hours[str_pad($i, 2, "0", STR_PAD_LEFT)]=$i;}
	for($i=00;$i<=55;$i=$i+5) {$minutes[str_pad($i, 2, "0", STR_PAD_LEFT)]=$i;}

 ?>

 @section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Edit an existing Interview Scheldule</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Interviews</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
	{{ Form::open(array('url' => 'interviews', 'method' => 'POST', 'class' => 'form')) }}
		<div class="control-group">
		    {{Form::label('district', 'District', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('district', $districts_array, '')}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('team', 'Teams', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('team')}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('time', 'Interview Time', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('hour', $hours, '', array('class' => 'span1'))}} : {{Form::select('minutes', $minutes, '', array('class' => 'span1'))}}
		    </div>
		</div>

		<div class="control-group">
		    <div class="controls">
		    	{{Form::submit('Save', array('class'=>'btn btn-inverse'))}}
		    </div>
		</div>
	{{ Form::close() }}
@stop

@section('javascript')
<script>
	
jQuery(document).ready(function($) {
	$('select[name=district]').change(function() {
		var TeamId = $('select[name=district]').val();
		$.post("district", { id: TeamId })
        	.done(function(data) {
    	   		
				obj = jQuery.parseJSON(data);

    	   		var $el = $("select[name=team]");
				$el.empty(); // remove old options
				
				//setting options from DB
				$(obj).each(function() {
					$el.append($("<option></option>")
					.attr("value", this.id).text(this.senior.first_name + ' ' + this.senior.last_name + ' and ' + this.junior.first_name + ' ' + this.junior.last_name));
				});
		});

	})
});
</script>
@stop