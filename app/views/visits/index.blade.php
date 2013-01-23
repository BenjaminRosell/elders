@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Home teaching visit reports</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Reports</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
	@if(Session::get('success_message'))
		<div class="alert alert-success">{{Session::get('success_message')}}</div>
	@endif

	@if(Session::get('error_message'))
		<div class="alert alert-error">{{Session::get('error_message')}}</div>
	@endif
	<br>
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
	@if ($admin)
    	<a href="../../visits/create" class="btn btn-inverse"><i class="icon-plus icon-white"></i> Add a new visit</a>
	@endif
@stop