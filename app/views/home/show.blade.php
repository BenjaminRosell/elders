@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">{{$home->name}}</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Users</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
    <p>The home email is <a href="maito:{{$home->email}}">{{ $home->email }}</a></p>
    <p>The home's phone number is {{ $home->phone_number }}</p>
    <p>Their address is {{$home->address}}</p>
    <p>Their home teachers are {{$home->team->senior->first_name}} {{$home->team->senior->last_name}} and {{$home->team->junior->first_name}} {{$home->team->senior->last_name}}</p>
    {{ Form::open('homes/'.$home->id, 'DELETE', array('class' => 'form')) }}
	    {{ HTML::to('homes/' . $home->id .'/edit', 'Edit this user', array('id' => 'edit_link', 'class' => 'btn btn-inverse'));}}
		{{ HTML::to('homes', 'Back to home list', array('id' => 'back_link', 'class' => 'btn btn-inverse'));}}
		
		@if($admin)
			{{Form::submit('Delete user', array('class' => 'btn btn-danger pull-right'))}}
		@endif
	{{Form::close()}}
	<div class="heading center m2">
        <div class="separation"></div>
        <h2>Visit Reports</h2>
    </div>
	<table class="table table-striped">
		<tr>	
			<td><strong>Month</strong></td>
			<td><strong>Family</strong></td>
			<td><strong>Team</strong></td>
			<td><strong>Visited ?</strong></td>
 			<td><strong>Status</strong></td>
			<td><strong>Visit date</strong></td>
			<td><strong>Report date</strong></td>
		</tr>
	@foreach ($visits as $visit)
		<tr>
			<td>{{ HTML::to('visits/'.$visit->id, $visit->month, array('id' => 'visit_link'));}}</td>
			<td>{{ $visit->home->name }}</td>
			<td>{{ $visit->team->senior->first_name . ' ' . $visit->team->senior->last_name }} and {{ $visit->team->junior->first_name . ' ' . $visit->team->junior->last_name }}</td>
			<td>{{ $visit->visited == 1 ? 'Yes' : 'No'}}</td>
			<td>{{ $visit->status }}</td>
			<td>{{ $visit->visit_date }}</td>
			<td>{{ $visit->report_date }}</td>
		</tr>
	@endforeach
	</table>

@stop