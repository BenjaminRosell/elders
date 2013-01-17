
@section('content')
	<h4>Creating Groups</h4>

	{{ Form::open('groups', 'POST', array('class' => 'form')) }}

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