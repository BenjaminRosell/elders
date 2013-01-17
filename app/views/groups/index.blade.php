@section('content')
	<h4>This is a list of groups and the defined permissions</h4>
	
	<table class="table table-striped">
		<tr>	
			<td>Group</td>
			<td>Permissions</td>
		</tr>
	@foreach ($groups as $group)
    	<tr>
			<td>{{ HTML::to('groups/'.$group->id, $group->name, array('id' => 'group_details'));}}</td>
			<td>
				{{ isset($group->permissions['users']) ? 'User ' : '' }}
				{{ isset($group->permissions['admin']) ? '- Admin ' : '' }}
				{{ isset($group->permissions['observer']) ? '- Observer ' : '' }}
			</td>
		</tr>
	@endforeach
	</table>

	{{ HTML::to('groups/create', 'Add a new group', array('id' => 'add_link', 'class' => 'btn'));}}

@stop