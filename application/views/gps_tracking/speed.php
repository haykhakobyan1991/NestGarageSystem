<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.buttons.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.colVis.min.js') ?>"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<!--[if lt IE 9]>
<script src="https://code.highcharts.com/modules/oldie.js"></script>
<![endif]-->

<link rel="stylesheet" href="<?= base_url() ?>assets/css/gps_tracking/gps_tracking.css"/>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-2">
			<div class="card">
				<div class="card-header">
					Տրանսպորտային միջոցներ
				</div>
				<div class="card-body" style="max-height: 280px;overflow-y: scroll;">
					<p class="card-text fleet_name">Fleet 1</p>
					<p class="card-text fleet_name">Fleet 2</p>
					<p class="card-text fleet_name">Fleet 3</p>
					<p class="card-text fleet_name">Fleet 4</p>
					<p class="card-text fleet_name">Fleet 5</p>
					<p class="card-text fleet_name">Fleet 6</p>
					<p class="card-text fleet_name">Fleet 7</p>
					<p class="card-text fleet_name">Fleet 8</p>
					<p class="card-text fleet_name">Fleet 9</p>
					<p class="card-text fleet_name">Fleet 10</p>
				</div>
			</div>
			<div class="form-group row mt-2">
				<label class="col-sm-4 mt-2">Սկսած:</label>
				<input class="form-control form-control-sm col-sm-7" type="date">
			</div>
			<div class="form-group row">
				<label class="col-sm-4 mt-2">Մինչև:</label>
				<input type="date" class="col-sm-7 form-control form-control-sm">
			</div>
			<div class="form-group">
				<label class="">Առավելագույն Արագությունը:</label>
				<input type="number" class="form-control form-control-sm">
			</div>
			<div class="row">
				<div class="container-fluid">
					<button style="border: 1px solid rgb(255, 122, 89) !important;color: rgb(255, 122, 89);opacity: 1 !important;
    transition: all .3s ease-in-out;background: #fff;" class="generate btn btn-sm btn-block ">Գեներացնել</button>
				</div>
			</div>
		</div>
		<div class="col-sm-10">
			<div id="container"></div>
		</div>
	</div>
</div>

<script>
	Highcharts.chart('container', {
		title: {
			text: 'Solar Employment Growth by Sector, 2010-2016'
		},

		subtitle: {
			text: 'Source: thesolarfoundation.com'
		},

		yAxis: {
			title: {
				text: 'Number of Employees'
			}
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'middle'
		},
		plotOptions: {
			series: {
				label: {
					connectorAllowed: false
				},
				pointStart: 2010
			}
		},
		series: [{
			name: 'speed',
			data: [15, 20, 25, 35, null, null, null, 35, 25, 20, 15]
		}, {
			name: 'speed',
			data: [null, null, null, 35, 45, 55, 45, 35]
		}],
		responsive: {
			rules: [{
				condition: {
					maxWidth: 500
				},
				chartOptions: {
					legend: {
						layout: 'horizontal',
						align: 'center',
						verticalAlign: 'bottom'
					}
				}
			}]
		}
	});
</script>
