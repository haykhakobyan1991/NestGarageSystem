<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/gps_tracking/gps_tracking.css"/>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.buttons.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.colVis.min.js') ?>"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<!--[if lt IE 9]>
<script src="https://code.highcharts.com/modules/oldie.js"></script>
<script src="https://code.highcharts.com/modules/oldie.js"></script>
<![endif]-->


<div class="container-fluid">
	<div class="row">
		<div class="col-sm-2">
			<div class="card">
				<div class="card-header"><?= lang('fleets') ?></div>
				<div class="card-body p-0" style="max-height: 170px;overflow-y: scroll;">
					<p class="card-text fleet_name mb-0 ml-1">Fleet 1</p>
					<p class="card-text fleet_name mb-0 ml-1">Fleet 2</p>
					<p class="card-text fleet_name mb-0 ml-1">Fleet 3</p>
					<p class="card-text fleet_name mb-0 ml-1">Fleet 4</p>
					<p class="card-text fleet_name mb-0 ml-1">Fleet 5</p>
					<p class="card-text fleet_name mb-0 ml-1">Fleet 6</p>
					<p class="card-text fleet_name mb-0 ml-1">Fleet 7</p>
					<p class="card-text fleet_name mb-0 ml-1">Fleet 8</p>
					<p class="card-text fleet_name mb-0 ml-1">Fleet 9</p>
					<p class="card-text fleet_name mb-0 ml-1">Fleet 10</p>
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
				<input data-toggle="modal" data-target="#exampleModal" name="end_date" type="number"
					   class="form-control form-control-sm">
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

<!-- Start Modal Graphic Settings -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="container-fluid">
					<form>
						<div class="form-group row">
							<label for="inputUnit" class="col-sm-2 col-form-label">Unit</label>
							<div class="col-sm-10">
								<div class="input-group">
									<select class="custom-select">
										<option value="1">cGuard</option>
										<option value="2">Two</option>
										<option value="3">Three</option>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group row">
							<label for="inputUnit" class="col-sm-2 col-form-label">Color</label>
							<div class="col-sm-10">
								<div class="input-group">
									<select class="custom-select">
										<option value="1">by Speed</option>
										<option value="2">Two</option>
										<option value="3">Three</option>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-2"></div>
							<div class="col-sm-10">
								<div class="row">
									<div class="col-sm-4"></div>
									<div class="col-sm-4">
										<p class="mb-0">Speed</p>
										<hr class="my-2">
										<p class="small">0 .. 39</p>
										<p class="small">40 .. 59</p>
										<p class="small">60 .. 89</p>
										<p class="small">90 .. 119</p>
										<p class="small">120 .. &#8734;</p>
									</div>

									<div class="col-sm-4">
										<p class="mb-0">Color</p>
										<hr class="my-2">
										<div
											style="width: 20px; height: 20px; margin: .65rem; border: 1px solid #000; background: #66FFFF;"></div>
										<div
											style="width: 20px; height: 20px; margin: .65rem; border: 1px solid #000; background: #0099FF;"></div>
										<div
											style="width: 20px; height: 20px; margin: .65rem; border: 1px solid #000; background: #3300FF;"></div>
										<div
											style="width: 20px; height: 20px; margin: .65rem; border: 1px solid #000; background: #990099;"></div>
										<div
											style="width: 20px; height: 20px; margin: .65rem; border: 1px solid #000; background: #FF0033;"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group row">
							<label for="inputUnit" class="col-sm-3 col-form-label">Line Thickness</label>
							<div class="col-sm-9">
								<div class="input-group">
									<select class="custom-select">
										<option value="1">2px</option>
										<option value="2">Two</option>
										<option value="3">Three</option>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-3"></div>
							<div class="btn-group btn-group-toggle ml-3" data-toggle="buttons">

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option1" autocomplete="off">
									<img src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/icon.svg"/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option2" autocomplete="off">
									<img
										src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/two-sportive-black-flags.svg"/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option3" autocomplete="off">
									<img src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/diesel.svg"/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option4" autocomplete="off">
									<img
										src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/speedometer.svg"/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option5" autocomplete="off">
									<img
										src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/gas-station.svg"/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option6" autocomplete="off">
									<img src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/flag.svg"/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option7" autocomplete="off">
									<img src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/image.svg"/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option8" autocomplete="off">
									<img
										src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/video-player.svg"/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option9" autocomplete="off">
									<img
										src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/parking-sign.svg"/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option10" autocomplete="off">
									<img src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/stop.svg"/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option11" autocomplete="off">
									<img
										src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/forward-right-arrow-button.svg"/>
								</label>

							</div>
						</div>


						<div class="form-group row mb-0">
							<label for="inputUnit" class="col-sm-4 col-form-label">Show annotations:</label>
							<div class="col-sm-8">
								<input style="margin-top: 12px;" type="checkbox"/>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputUnit" class="col-sm-4 col-form-label">Apply trip detector:</label>
							<div class="col-sm-8">
								<input style="margin-top: 12px;" type="checkbox"/>
							</div>
						</div>

					</form>
				</div>
			</div>
			<!--			<div class="modal-footer" style="margin-right: 20px;">-->
			<!--				<button id="add_department_btn" type="button"-->
			<!--						class="btn btn-outline-success cancel_btn ">--><? //= lang('save') ?>
			<!--				</button>-->
			<!--				<button id="load" style="height: 40px !important; width: 90px !important;"-->
			<!--						class="btn btn-sm btn-outline-success cancel_btn d-none"><img-->
			<!--						style="height: 20px;margin: 0 auto;display: block;text-align: center;"-->
			<!--						src="--><? //= base_url() ?><!--assets/images/bars2.svg" /></button>-->
			<!--				<button type="button" class="cancel_btn close btn btn-sm"-->
			<!--						data-dismiss="modal"-->
			<!--						aria-label="Close">-->
			<!--					--><? //= lang('cancel') ?>
			<!--				</button>-->
			<!--			</div>-->
		</div>
	</div>

	<!-- End Modal Graphic Settings -->
	<script>
		Highcharts.chart('container', {
			chart: {
				zoomType: 'x'
			},
			title: {
				text: 'Speed'
			},
			legend: {
				enabled: false
			},
			plotOptions: {
				series: {
					label: {
						connectorAllowed: false
					},
					pointStart: 2008
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
				}]
		});


		$(document).ready(function () {
			$('.count_unread').text('18')
		})
	</script>
