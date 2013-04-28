@extends('layouts.master')

@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Home Teaching team profile</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Teams</h3>
    </section><!-- end #wrapper_slider -->
@stop

<?php 
    
    $oneYearAgo = date("Y-m-01", strtotime( date( 'Y-m-01' )." -1 year") );
    
    for ($i = 1; $i <= 12; $i++) {
        $monthsArray[] = date("M", strtotime( $oneYearAgo." +$i months"));
        $monthsDates[] = date("Y-m-01", strtotime( $oneYearAgo." +$i months"));
    }

    $monthsJson = json_encode($monthsArray);

    if (isset($stats) and $stats != false) {
        foreach ($stats as $family => $stat) {
             $history[$family] = json_encode(array_values($stat));
        }
    } else {
        $history = array();
    }
?>

@section('content')
	<h4>Home Teaching team # {{ $team->id }}</h4>

    <p>The team senior companion is {{ User::name($team->lead) }} </p>
    <p>The team junior companion is {{ User::name($team->companion) }}</p>
    <p>Their district is {{ $team->district->name }}</p>
    <p>The steward is {{ User::name($team->district->steward) }}</p>
    @if ($team->assignments)
    <p>The families assigned to this team are :</p>
    <ul class="icons">
        @foreach($team->assignments as $assignment)
        <li> <i class="icon-user"></i> <a href="../../../homes/{{$assignment->id}}">{{$assignment->name}}</a></li>
        <?php $family_names[$assignment->id] = $assignment->name; ?>
        @endforeach
    </ul>
    @endif
    <br>

    @if ($admin)
    {{ Form::open(array('url' => 'teams/'.$team->id, 'method' => 'DELETE', 'class' => 'form')) }}

		<a href="../../teams" class="btn btn-inverse"><i class="icon-chevron-left icon-white"></i> Back to teams</a>
		<a href="../../teams/<?php echo $team->id ?>/edit" class="btn btn-inverse"><i class="icon-pencil icon-white"></i> Edit this team</a>

		<button class="btn btn-danger pull-right"><i class="icon-trash  icon-white"></i> Delete team</button>

	{{Form::close()}}
    @endif

    <?php if (isset($stats) and $stats != false): ?>
    <div class="heading center m2">
        <div class="separation"></div>
        <h2>Visits History</h2>
    </div>

    <div id="chart"></div>
    <?php endif; ?>

@stop
<?php if (isset($stats) and $stats != false): ?>
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
                    text: 'Number of visits made per month',
                    x: -20 //center
                },
                xAxis: {
                    categories: <?=$monthsJson;?>
                },
                credits : { enabled : false },
                yAxis: {
                    allowDecimals : false, 
                    gridLineWidth : 1, 
                    title: {
                        text: ''
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        this.series.name +': '+ this.y +'<br/>'+
                        'Total: '+ this.point.stackTotal;
                }
                },
                plotOptions: {
                    column : {
                        stacking: 'normal',
                        shadow : false,
                        borderWidth :  0,
                    }
                },
                series: [
                    <?php 
                    foreach ($history as $family_id => $data) {
                        echo '{name: "' . $family_names[$family_id] .'",';
                        echo 'data: ' . $data. '},';
                    } ?>
                ]
                
            });
        });
        
    });
    });
</script>
@stop
<?php endif ?>