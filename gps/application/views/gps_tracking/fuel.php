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

<!-- Settings Modal Start -->

<div class="modal fade bd-example-modal-lg settings_modal" tabindex="-1" role="dialog"
	 aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content settings_modal_content">
			<div class="modal-header bg-dark">
				<h5 class="modal-title text-white"><?= lang('settings') ?></h5>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group row mb-0">
								<label class="col-sm-7"><?= lang('analog_input') ?>: 1</label>
								<input class="col-sm-1 mt-1" type="checkbox"/>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group row mb-0">
								<label class="col-sm-7 text-right"><?= lang('analog_input') ?>: 2</label>
								<input class="col-sm-1 mt-1" type="checkbox"/>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group row mb-0">
								<label class="col-sm-8 text-right"><?= lang('analog_input') ?>: 1 + 2</label>
								<input class="col-sm-1 mt-1" type="checkbox"/>
							</div>
						</div>
					</div>
					<hr class="my-2">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label><?= lang('titles') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label><?= lang('titles') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label><?= lang('titles') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
					</div>
					<hr class="my-2">


					<div class="row">
						<div class="col-sm-6">
							<div class="form-group row mb-0">
								<label class="col-sm-4 mt-2"><?= lang('coefficient') ?></label>
								<input type="number" class="form-control form-control-sm col-sm-2">
								<div class="col-sm-1 mt-2">+</div>
								<input type="number" class="form-control form-control-sm col-sm-2"><span class="ml-1 mt-2">*A</span>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group row mb-0">
								<label class="col-sm-4 mt-2"><?= lang('coefficient') ?></label>
								<input type="number" class="form-control form-control-sm col-sm-2">
								<div class="col-sm-1 mt-2">+</div>
								<input type="number" class="form-control form-control-sm col-sm-2"><span class="ml-1 mt-2">*A</span>
							</div>
						</div>
					</div>
					<hr class="my-2">

					<div class="row">
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label class=""><?= lang('engine') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label class=""><?= lang('cargo') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label class=""><?= lang('sos') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
					</div>
					<hr class="my-2">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label class=""><?= lang('titles') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label class=""><?= lang('titles') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label class=""><?= lang('titles') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
					</div>
					<hr class="my-2">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group mb-0">
								<label><?= lang('default_speed') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10"/>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-0">
								<label><?= lang('readout_time') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10"/>
							</div>
						</div>
					</div>
					<hr class="my-2">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group row mb-0">
								<label
									class="colnavbar navbar-expand-lg navbar-light bg-light pl-0 pr-0-sm-6"><?= lang('event') ?></label>
								<input class="col-sm-1 mt-1" type="checkbox"/>
							</div>
						</div>
					</div>
					<hr class="my-2">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group row mb-0 pl-3">
								<select class="form-control form-control-sm col-sm-10">
									<option selected>value 1</option>
									<option>value 2</option>
									<option>value 3</option>
									<option>value 4</option>
									<option>value 5</option>
								</select>
								<div class="col-sm-2">
									<button class="btn btn-sm btn-secondary"
											style="-webkit-border-radius: 50% !important;-moz-border-radius: 50% !important;border-radius: 50% !important;width: 30px !important;height: 30px !important;padding: 0 !important;line-height: unset !important;">
										+
									</button>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button id="add_staff" type="button"
						class="btn btn-outline-success cancel_btn"><?= lang('save') ?>
				</button>
				<button id="load" class="btn btn-sm btn-success d-none "><img
						style="height: 20px;margin: 0 auto;display: block;text-align: center;"
						src="<?= base_url() ?>assets/images/bars2.svg"/></button>
				<button type="button" class="cancel_btn close btn btn-sm"
						data-dismiss="modal"
						aria-label="Close">
					<?= lang('cancel') ?>
				</button>
			</div>
		</div>
	</div>
</div>
<!-- Settings Modal End -->

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
				<div class="card-header"><?=lang('information')?></div>
				<div class="card-body text-justify">
					<div class="text"><span style="font-size: 13px;"><?= lang('name') ?>:</span><span>  Maz_1</span>
					</div>
					<div class="text"><span
							style="font-size: 13px;"><?= lang('license_plate') ?>:</span><span>  455dd54</span></div>
					<div class="text"><span style="font-size: 13px;"><?= lang('type') ?>:</span><span>  Բեռնատար</span>
					</div>
					<div class="text"><span style="font-size: 13px;"><?= lang('description') ?>:</span><span>  Koryun Maruqyan</span>
					</div>
					<div class="text"><span style="font-size: 13px;"><?= lang('contact_number') ?>:</span><span>  +(374) 55 554 443</span>
					</div>
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
										<li class="list-group-item"><?=lang('Level_At_The_Beginning')?> - 117.0706 l</li>
										<li class="list-group-item"><?=lang('total_consumption')?> - ***</li>
										<li class="list-group-item"><?=lang('number_charges')?> - ***</li>
										<li class="list-group-item"><?=lang('engine_consumption')?> - 21.61 l - ***</li>
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
			console.log(data);
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
					name: 'USD to EUR',
					data: data
				}]
			});
		});
	});
</script>
