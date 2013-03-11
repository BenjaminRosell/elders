@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Create a new group</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Groups</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')

	{{ Form::open(array('url' => 'groups', 'method' => 'POST', 'class' => 'form')) }}

		<div class="control-group">
		    {{Form::label('name', 'Group Name', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('name', '', array('placeholder' =>"Please enter the group's name"))}}
		    </div>
		</div>

		<div class="control-group">
		    <div class="controls">
		    	{{Form::label('users', 'User', array('class' => 'checkbox inline'))}}
		    	{{ Form::checkbox('users', true, true); }} 
		    	{{Form::label('admin', 'Admin', array('class' => 'checkbox inline'))}}
		    	{{ Form::checkbox('admin', true); }}
		    	{{Form::label('observer', 'Observer', array('class' => 'checkbox inline'))}}
		    	{{ Form::checkbox('observer', true); }}
		    </div>
		</div>
		
		{{Form::submit('Create group', array('class' => 'btn'))}}

	{{ Form::close() }}

@stop