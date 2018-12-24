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
				<div class="card-header"><?= lang('fleets') ?></div>
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
				<label class="col-sm-4 mt-2"><?= lang('from') ?>:</label>
				<input class="form-control form-control-sm col-sm-7" type="date">
			</div>
			<div class="form-group row">
				<label for="start_date" class="col-sm-4 mt-2"><?= lang('to') ?>:</label>
				<input name="start_date" type="date" class="col-sm-7 form-control form-control-sm">
			</div>
			<div class="form-group">
				<label for="end_date" class=""><?= lang('max_speed') ?>:</label>
				<input name="end_date" type="number" class="form-control form-control-sm">
			</div>
			<div class="row">
				<div class="container-fluid">
					<button
						style="border: 1px solid rgb(255, 122, 89) !important;color: rgb(255, 122, 89);opacity: 1 !important;transition: all .3s ease-in-out;background: #fff;"
						class="generate btn btn-sm btn-block "><?= lang('generate') ?>
					</button>
				</div>
			</div>
			<div class="card mt-3">
				<div class="card-header">Ինֆորմացիա</div>
				<div class="card-body text-justify">
					<div class="text"><span style="font-size: 13px;"><?= lang('name') ?>:</span><span>  Maz_1</span></div>
					<div class="text"><span style="font-size: 13px;"><?= lang('license_plate') ?>:</span><span>  455dd54</span></div>
					<div class="text"><span style="font-size: 13px;"><?= lang('type') ?>:</span><span>  Բեռնատար</span></div>
					<div class="text"><span style="font-size: 13px;"><?= lang('description') ?>:</span><span>  Koryun Maruqyan</span></div>
					<div class="text"><span style="font-size: 13px;"><?= lang('contact_number') ?>:</span><span>  +(374) 55 554 443</span></div>
				</div>
			</div>
		</div>
		<div class="col-sm-10">
			<div id="container"></div>
			<div class="jumbotron jumbotron-fluid pt-2 pl-0 pr-0 pb-1 mt-2">
				<div class="container">
					<h5><?= lang('get_information') ?></h5>
					<div class="row">
						<div class="col-sm-4">
							<div class="card mt-3">
								<div class="card-body text-justify">
									<label><?= lang('from') ?> ։ </label><span>  02-12-2018 / 18:30</span><br>
									<label><?= lang('to') ?> ։ </label><span>  22-12-2018 / 17:30</span>
								</div>
							</div>
							<div class="card mt-3">
								<div class="card-body text-justify">
									<p>Maz_1</p>
								</div>
							</div>
						</div>
						<div class="col-sm-8">
							<div class="card mt-3">
								<div class="card-body text-justify">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">1. Միջին արագությունը 50 կմ/ժամ</li>
										<li class="list-group-item">2. Առավելագույն արագությունը 75 կմ/ժամ</li>
										<li class="list-group-item">3. Գերազանցումների քանակը 0</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	Highcharts.chart('container', {
		title: {
			text: 'Speed tracking'
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
			data: [null, 1, 2, 3, 5, 10, 15, 20, 25, 35, null, null, null, 35, 25, 20, 15, 20, 25, 30, 35, null, null, null, 35, 30, 20, 15, 10, 5, 3, 2, 1, null],
			color: 'rgb(144, 237, 125)'
		},
		{
			name: 'speed',
			data: [null, null, null, null, null, null, null, null, null, 35, 45, 55, 45, 35, null, null, null, null, null, null, 35, 45, 55, 45, 35],
			color: '#f45b5b',
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
