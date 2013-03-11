@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Groups and Permissions</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Groups</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
	<h4>This is a list of groups and the defined permissions</h4>
	
	<table class="table table-striped">
		<tr>	
			<td>Group</td>
			<td>Permissions</td>
		</tr>
	@foreach ($groups as $group)
    	<tr>
			<td><a href="groups/{{$group->id}}" > {{$group->name}}</a></td>
			<td>
				{{ isset($group->permissions['users']) ? 'User ' : '' }}
				{{ isset($group->permissions['admin']) ? '- Admin ' : '' }}
				{{ isset($group->permissions['observer']) ? '- Observer ' : '' }}
			</td>
		</tr>
	@endforeach
	</table>

	<a href="../../groups/create" class="btn btn-inverse"><i class="icon-plus icon-white"></i> Add a new group</a>

@stop