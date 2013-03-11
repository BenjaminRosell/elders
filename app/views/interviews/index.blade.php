 @section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Stewardship interviews master scheldule</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Interviews</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')

@foreach( $districts as $district)
	<h4 class="center">{{$district->name}} - {{User::name($district->steward)}} </h4>
	<table class="table table-striped">
		<tr>
			<td>Team</td>
			<td>Time</td>
			<td>Edit</td>
			<td>delete</td>
		</tr>
		@foreach ($district->interviews as $interview)
		<tr>
			<td>{{$interview->team->senior->first_name . ' ' . $interview->team->senior->last_name}} and {{$interview->team->junior->first_name . ' ' . $interview->team->junior->last_name}}</td>
			<td>{{$interview->time}}</td>
			<td><a href="../../../interviews/{{$interview->id}}" class="btn btn-inverse"><i class="icon-pencil icon-white"></i></a></td>
			<td>{{ Form::open(array('url' => 'interviews/'.$interview->id, 'method' => 'DELETE')) }}<button type="Submit" value="submit" class="btn btn-danger"><i class="icon-white icon-trash"></i></button>{{ Form::close()}}</td>
		</tr>
		@endforeach
	</table>
	<br><br>
@endforeach
<a href="../../interviews/create" class="btn btn-inverse"><i class="icon-plus icon-white"></i> Scheldule a new interview</a>
@stop