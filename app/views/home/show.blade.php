<?php 
	
	$oneYearAgo = date("Y-m-01", strtotime( date( 'Y-m-01' )." -1 year") );
	for ($i = 1; $i <= 12; $i++) {
	    $monthsArray[] = date("M", strtotime( $oneYearAgo." +$i months"));
	    $monthsDates[] = date("Y-m-01", strtotime( $oneYearAgo." +$i months"));
	}

	$monthsJson = json_encode($monthsArray);

	foreach ($stats as $stat){
	 	$status[$stat['month']] = $stat['visited'];
	}

	foreach ($monthsDates as $month) {	
		if (isset($status[$month])) {
			$data[] = (int) $status[$month];
		} else {
			$data[] = 0;
		}
	}

	$data = json_encode($data);

?>
@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">{{$home->name}}</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Users</h3>
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
    <p>The home email is <a href="mailto:{{$home->email}}">{{ $home->email }}</a></p>
    <p>The home's phone number is {{ $home->phone_number }}</p>
    <p>Their address is {{$home->address}}</p>
    <p>Their home teachers are {{$home->team->senior->first_name}} {{$home->team->senior->last_name}} and {{$home->team->junior->first_name}} {{$home->team->junior->last_name}}</p>
    <br>
    {{ Form::open(array('url' =>'homes/'.$home->id, 'method' => 'DELETE', 'class' => 'form')) }}
	    <a href="../../../homes/{{$home->id}}/edit" class="btn btn-inverse"><i class="icon-white icon-pencil"></i> Edit this family</a>
	    <a href="../../../homes" class="btn btn-inverse"><i class="icon-white icon-chevron-left"></i> Back to family list</a>
		
		@if($admin)
			<button class="btn btn-danger pull-right" value="Submit" type="submit"><i class="icon-white icon-trash"></i> Delete Family</button>
		@endif
	{{Form::close()}}
	
	<div class="heading center m2">
        <div class="separation"></div>
        <h2>Goals</h2>
    </div>

    @if (count($home->goal) > 0)
	    <table class="table table-striped">
			<tr>	
				<td><strong>Goal</strong></td>
				<td><strong>Due Date</strong></td>
				<td><strong>Status</strong></td>
			</tr>
		@foreach ($home->goal as $goal)
			<tr <?=($goal->completed == 1) ? 'class="success"' : '';?>>
				<td><a href="../../goals/{{$goal->id}}" class="fancybox" data-fancybox-type="iframe"> {{$goal->name}}</a></td>
				<td>{{$goal->date_due}}</td>
				<td><?=($goal->completed == 1) ? 'Completed' : 'Ongoing';?></td>
			</tr>
		@endforeach
		</table>
    @endif

    <a href="../../goals/create/{{$home->id}}" data-fancybox-type="iframe" class="btn btn-inverse fancybox"><i class="icon-white icon-plus"></i> Add Goal</a>

    <div class="heading center m2">
        <div class="separation"></div>
        <h2>Charts</h2>
    </div>

    <div id="chart"></div>

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
			<td><a href="../../visits/{{$visit->id}}" > {{$visit->month}}</a></td>
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

@section('javascript')
<script type="text/javascript">
	
	jQuery(document).ready(function($) {
		$(function () {
	    var chart;
	    $(document).ready(function() {
	        chart = new Highcharts.Chart({
	            chart: {
	                renderTo: 'chart',
	                type: 'column',
	                marginBottom: 85
	            },
	            title: {
	                text: 'History of Monthly visits',
	                x: -20 //center
	            },
	            xAxis: {
	                categories: <?=$monthsJson;?>
	            },
	            credits : { enabled : false },
	            yAxis: {
	                //allowDecimals : false, 
	                gridLineWidth : 0, 
	                title: {
	                    text: ''
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }],
	                labels: [{
	                    enable: false
	                }]
	            },
	            tooltip: {
	                formatter: function() {
	                        return '<b>'+ this.series.name +'</b>'
	                }
	            },
	            plotOptions: {
	            	column : {
	            		shadow : false,
	            		borderWidth :  0,
	            	}
	            },
	            series: [{
	                name: '{{$home->name}}',
	                data: {{$data}}
	            }]
	        });
	    });
	    
	});
	});
</script>
@stop

