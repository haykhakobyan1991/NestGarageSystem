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
	<hr class="my-2">
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

			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12">
						<span>Zoom</span>
						<div class="btn-group btn-group-toggle" data-toggle="buttons">
							<label class="btn btn-outline-secondary active">
								<input type="radio" name="options" id="option1" autocomplete="off" checked> 1m
							</label>
							<label class="btn btn-outline-secondary">
								<input type="radio" name="options" id="option2" autocomplete="off"> 3m
							</label>
							<label class="btn btn-outline-secondary">
								<input type="radio" name="options" id="option3" autocomplete="off"> 6m
							</label>
							<label class="btn btn-outline-secondary">
								<input type="radio" name="options" id="option3" autocomplete="off"> YTD
							</label>
							<label class="btn btn-outline-secondary">
								<input type="radio" name="options" id="option3" autocomplete="off"> 1y
							</label>
							<label class="btn btn-outline-secondary">
								<input type="radio" name="options" id="option3" autocomplete="off"> All
							</label>
						</div>
					</div>
				</div>
			</div>

			<div id="container" class="mt-2"></div>
			<div class="jumbotron jumbotron-fluid pt-2 pl-0 pr-0 pb-1 mt-2">
				<div class="container">
					<h5><?= lang('get_information') ?></h5>
					<div class="row pb-2">
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
						<div class="col-sm-4">
							<div class="card mt-3">
								<div class="card-body text-justify">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">Level at the beginning - 117.0706 l</li>
										<li class="list-group-item">total consumption - ***</li>
										<li class="list-group-item">Number of charges - ***</li>
										<li class="list-group-item">Volume of charges - ***</li>
										<li class="list-group-item">Engine consumption - 21.61 l - ***</li>
									</ul>
								</div>
							</div>
						</div>

						<div class="col-sm-4">
							<div class="card mt-3">
								<div class="card-body text-justify">
									<ul class="list-group list-group-flush">
										<li class="list-group-item">Level at the end - 97.8844 l</li>
										<li class="list-group-item">Average consumption - ***</li>
										<li class="list-group-item">Number of discharges - ***</li>
										<li class="list-group-item">Volume of discharges - ***</li>
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
	$(function () {
		$.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=usdeur.json&callback=?', function (data) {
			console.table(data);
			$('#container').highcharts({
				chart: {
					zoomType: 'x'
				},
				title: {
					text: 'Fuel'
				},
				xAxis: {
					type: 'datetime'
				},
				yAxis: {
					title: {
						text: 'Exchange rate'
					}
				},
				legend: {
					enabled: false
				},
				plotOptions: {
					area: {
						fillColor: {
							linearGradient: {
								x1: 0,
								y1: 0,
								x2: 0,
								y2: 1
							},
							stops: [
								[0, Highcharts.getOptions().colors[0]],
								[1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
							]
						},
						marker: {
							radius: 2
						},
						lineWidth: 1,
						states: {
							hover: {
								lineWidth: 1
							}
						},
						threshold: null
					}
				},

				series: [{
					type: 'area',
					name: 'USD to EUR',
					data: data
				}]
			});
		});
	});
</script>
