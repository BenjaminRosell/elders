@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Editing group</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Groups</h3>
    </section><!-- end #wrapper_slider -->
@stop
@section('content')

	{{ Form::open('groups/'.$group->id, 'PUT', array('class' => 'form')) }}

		<div class="control-group">
		    {{Form::label('name', 'Group Name', array('class' => 'control-label'))}}
		    <div class="controls">
		    	{{Form::text('name', $group->name, array('placeholder' =>"Please enter the group's name"))}}
		    </div>
		</div>

		<div class="control-group">
		    <div class="controls">
		    	{{Form::label('users', 'User', array('class' => 'checkbox inline'))}}
		    	{{ Form::checkbox('users', true, $group->permissions['users']); }} 
		    	{{Form::label('admin', 'Admin', array('class' => 'checkbox inline'))}}
		    	{{ Form::checkbox('admin', true, isset($group->permissions['admin']) ? 1 : 0); }}
		    	{{Form::label('observer', 'Observer', array('class' => 'checkbox inline'))}}
		    	{{ Form::checkbox('observer', true, isset($group->permissions['observer']) ? 1 : 0); }}
		    </div>
		</div>
		
		{{Form::submit('Edit group', array('class' => 'btn'))}}

	{{ Form::close() }}

	{{ Form::open('groups/'.$group->id, 'DELETE', array('class' => 'form')) }}

		{{Form::submit('Delete group', array('class' => 'btn btn-danger'))}}

	{{ Form::close() }}

@stop