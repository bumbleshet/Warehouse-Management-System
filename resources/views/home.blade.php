@extends('adminlte::page')

@section('title')
	Warehouse Management
@endsection

@section('content_header')
	<h1>Header</h1>
	Hi this is content header.
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-solid box-success">
			<div class="box-header with-border">
				<div class="box-title">Students</div>
			</div>
			<div class="box-body">
				<div class="chart" style="height: 300px;" >
					<canvas id="pieChart" style="height: 100%;"></canvas>	
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
	var ctx = document.getElementById("pieChart").getContext('2d');
	var pieChart = new Chart(ctx,{
	    type: 'pie',
	    data: {
			datasets: [{
		        data: [
			        {{ $male = 50}},
			        {{ $female =50 }}
			        ],
			    backgroundColor: ['#a4ea81','#75aaff'],
		    }],

		    // These labels appear in the legend and in the tooltips when hovering different arcs
		    labels: [
		        'Male',
		        'Female',
		    ]
	    },
	    // options: options
	});
</script>
@endsection