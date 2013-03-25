 @section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Settings</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Settings</h3>
    </section><!-- end #wrapper_slider -->
@stop

<?php 
$sundays = array(
	'first' => 'First',
	'second' => 'Second',
	'third' => 'Third',
	'fourth' => 'Fourth'
	);
?>

@section('content')
	{{ Form::open(array('url' => 'settings/edit', 'class' => 'form')) }}
		<div class="control-group">
		    {{Form::label('lead', 'When would you like to send the interviews email ?', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::select('sunday', $sundays, $sunday->value)}}
		    </div>
		</div>

		<div class="control-group">
		    {{Form::label('steward', 'What is the content of the email ?', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::textarea('email', $email->value, array('class' =>'textarea'))}}
		    </div>
		</div>

		<div class="control-group">
		    <div class="controls">
		    	{{Form::submit('Save Settings', array('class'=>'btn btn-inverse'))}}
		    </div>
		</div>
	{{ Form::close() }}
@stop

@section('javascript')
<script src="../../../../js/wysihtml5-0.3.0.min.js"></script>
<script src="../../../../js/bootstrap-wysihtml5.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('.textarea').wysihtml5({
    toolbar: { speech: '<li><a data-wysihtml5-command="insertSpeech" class="btn"><i class="icon-magic"></i> Dictate</a></li>' }
});
});
</script>
@stop