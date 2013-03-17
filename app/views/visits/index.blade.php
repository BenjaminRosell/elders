@extends('layouts.master')

<?php 
	
	$oneYearAgo = date("Y-m-01", strtotime( date( 'Y-m-01' )." -1 year") );
	for ($i = 1; $i <= 12; $i++) {
	    $monthsArray[] = date("M", strtotime( $oneYearAgo." +$i months"));
	    $monthsDates[] = date("Y-m-01", strtotime( $oneYearAgo." +$i months"));
	}

	$monthsJson = json_encode($monthsArray);

	$data = json_encode(array_values($stats));

	$percentage = json_encode(array_values($percentages))
?>

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
	@if(isset($error_message))
		<div class="alert alert-error">{{$error_message}}</div>
	@endif
	<br>
	
	{{ Form::open(array('url' => 'visits/generate', 'method' => 'POST', 'class'=>'form')) }}
		{{Form::submit('Generate Reports for this month', array('class'=>'btn btn-inverse pull-right', 'style' => 'margin-left: 10px;'))}}
		{{Form::text('month', '', array('class' => 'datepicker pull-right'))}}
	{{ Form::close() }}

	@if(isset($stats))
	<div class="clear"></div>
	<div class="heading center m2">
        <div class="separation"></div>
        <h2>Total visits made for the month</h2>
    </div>

    <div id="chart"></div>
	@endif

	@if(isset($percentages))
	<div class="clear"></div>
	<div class="heading center m2">
        <div class="separation"></div>
        <h2>Home teaching efficiency</h2>
    </div>

    <div id="percentages"></div>
	@endif

	<p><br></p>	
	@if(isset($visits))
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
			<td><a href="../../visits/{{$visit->id}}"> {{$visit->month}}</a></td>
			<td><a href="../../homes/{{$visit->home->id}}">{{ $visit->home->name }}</a></td>
			<td>{{ $visit->team->senior->first_name . ' ' . $visit->team->senior->last_name }} and {{ $visit->team->junior->first_name . ' ' . $visit->team->junior->last_name }}</td>
			<td>{{ $visit->visited == 1 ? 'Yes' : 'No'}}</td>
			<td>{{ $visit->status }}</td>
			<td>{{ $visit->visit_date }}</td>
			<td>{{ $visit->report_date }}</td>
		</tr>
	@endforeach
	</table>
	@endif
	@if ($admin)
    	<a href="../../visits/create" class="btn btn-inverse"><i class="icon-plus icon-white"></i> Add a new visit</a>
	@endif
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
		                        return '<b>'+ this.series.name +': '+ this.y +'</b>'
		                }
		            },
		            plotOptions: {
		            	column : {
		            		shadow : false,
		            		borderWidth :  0,
		            		dataLabels: {
		                        enabled: true,
		                        formatter: function() {
			                        return '<b>' + this.y +'</b>';
			                    }
		                    }
		            	}
		            },
		            series: [{
		                name: 'Total number of Visits',
		                data: {{$data}}
		            }]
		        });
		    });
		    
		});
		$(function () {
		    var chart2;
		    $(document).ready(function() {
		        chart = new Highcharts.Chart({
		            chart: {
		                renderTo: 'percentages',
		                type: 'line',
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
		                gridLineWidth : 1, 
		                min : 0, 
		                // stackLabels: {
		                //     enabled: true,
		                // }
		                title: {
		                    text: 'Percentage'
		                },
		                plotLines: [{
		                    value: 0,
		                    width: 1,
		                    color: '#808080'
		                }],
		            },
		            tooltip: {
		                formatter: function() {
		                        return '<b>'+ this.series.name +': '+ this.y +' %</b>'
		                }
		            },
		            plotOptions: {
		            	line : {
		            		dataLabels: {
		                        enabled: true,
		                        formatter: function() {
			                        return '<b>' + this.y +' %</b>';
			                    }
		                    },
		                    shadow : false,
		            		borderWidth :  0,
		            	}
		            },
		            series: [{
		                name: 'Total home teaching efficiency',
		                data: {{$percentage}}
		            }]
		        });
		    });
		    
		});
	});
</script>
@stop
