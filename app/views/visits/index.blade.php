@section('content')
	<h4>This is a list of your last visits</h4>
	
	<table class="table table-striped">
		<tr>	
			<td>Month</td>
			<td>Team</td>
			<td>Family</td>
			<td>Visited ?</td>
 			<td>Status</td>
			<td>Visit date</td>
			<td>Report date</td>
		</tr>
	@foreach ($visits as $visit)
		<tr>
			<td>{{ HTML::to('visits/'.$visit->id, $visit->month, array('id' => 'visit_link'));}}</td>
			<td>{{ $visit->team->senior->first_name . ' ' . $visit->team->senior->last_name }} and {{ $visit->team->junior->first_name . ' ' . $visit->team->junior->last_name }}</td>
			<td>{{ $visit->home->name }}</td>
			<td>{{ $visit->visited == 1 ? 'Yes' : 'No'}}</td>
			<td>{{ $visit->status }}</td>
			<td>{{ $visit->visit_date }}</td>
			<td>{{ $visit->report_date }}</td>
		</tr>
	@endforeach
	</table>
	@if ($admin)
    	{{ HTML::to('visits/create', 'Create a new visit', array('class' => 'btn' ))}}
	@endif
@stop