<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.buttons.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.colVis.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/gps_tracking/gps_tracking.css"/>
<link rel="stylesheet" href="https://static.zinoui.com/1.5/themes/silver/zino.core.css">
<link rel="stylesheet" href="https://static.zinoui.com/1.5/themes/silver/zino.splitter.css">

<script src="https://api-maps.yandex.ru/2.1/?apikey=57fb1bc4-e5b4-4fa9-96b8-73ee74c98245&lang=ru_RU"
		type="text/javascript"></script>
<!--<script type="text/javascript" src="--><? //= base_url('assets/js/ymap.js') ?><!--"></script>-->


<!--<script type="text/javascript" src="--><? //= base_url('assets/js/jquery-resizable.js') ?><!--"></script>-->
<!--<script src="--><? //= base_url('assets/js/dataTables/buttons.colVis.min.js') ?><!--"></script>-->
<script src="https://static.zinoui.com/1.5/compiled/zino.position.min.js"></script>
<script src="https://static.zinoui.com/1.5/compiled/zino.draggable.min.js"></script>
<script src="https://static.zinoui.com/1.5/compiled/zino.splitter.min.js"></script>
<script src="https://static.zinoui.com/js/front.min.js"></script>

<style>
	.card_hover {
		-webkit-transition: all .3s ease-in-out;
		-moz-transition: all .3s ease-in-out;
		-ms-transition: all .3s ease-in-out;
		-o-transition: all .3s ease-in-out;
		transition: all .3s ease-in-out;
		cursor: pointer;
	}

	.card_hover:hover {
		background-color: #a9a9a9;
		color: #fff;
	}

	.fleet_name_selected {
		background: #00000080;
		color: #fff;
	}

	.fleet_name {
		cursor: pointer;
	}

	.big_r {
		margin-right: 12rem !important;
	}

	.small_r {
		margin-right: 7rem !important;
	}
</style>
<div class="loader" style="width: 100%;z-index: 999 !important;"></div>
<img class="loader_svg"
	 style="width: 10em !important;margin-left: -100px !important;position: fixed !important;left: 50% !important;top: 50% !important;z-index: 999 !important;margin-top: -100px !important;"
	 src="<?= base_url('assets/images/puff.svg') ?>"/>
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
								<input type="number" class="form-control form-control-sm col-sm-2"><span
									class="ml-1 mt-2">*A</span>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group row mb-0">
								<label class="col-sm-4 mt-2"><?= lang('coefficient') ?></label>
								<input type="number" class="form-control form-control-sm col-sm-2">
								<div class="col-sm-1 mt-2">+</div>
								<input type="number" class="form-control form-control-sm col-sm-2"><span
									class="ml-1 mt-2">*A</span>
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
	<div class="row">
		<div class="col-sm-2 p-0">
			<div class="card">
				<div class="card-header"><?= lang('fleets') ?> <input type="checkbox"
																	  class="float-right mt-1 selectAll_fleets"></div>
				<div class="card-body p-0" style="max-height: 170px;overflow-y: scroll;"><?
					foreach ($result_fleets as $fleets) {
						?>
						<p class="card-text fleet_name ml-1 mr-1 mb-0"
						   data-id="<?= $fleets['id'] ?>"><?= $fleets['brand_model'] ?></p><?
					} ?>
				</div>
			</div>
			<div class="row mt-1">
				<div class="col-sm-12">
					<div class="form-group m-0">
						<label class="mb-1"><?= lang('from') ?>:</label>
						<input style="font-size: 11px !important;" type="date"
							   class="form-control form-control-sm pl-1 pr-0">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group m-0">
						<label class="mb-1"><?= lang('to') ?>:</label>
						<input style="font-size: 11px !important;" type="date"
							   class="form-control form-control-sm pl-1 pr-0">
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-lg-12" style="text-align: left;">
					<label style="font-size: 11px !important;"><?= lang('speed') ?></label>
					<input type="checkbox" class="rem_right float-right" style="margin-top: 2px;"/>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12" style="text-align: left;">
					<label style="font-size: 11px !important;"><?= lang('engine') ?></label>
					<input type="checkbox" class="rem_right float-right" style="margin-top: 2px;"/>
				</div>
			</div>


			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label><?= lang('max_speed') ?></label>
						<input name="" type="text" alt="<?= lang('max_speed') ?>" title="<?= lang('max_speed') ?>"
							   class="form-control form-control-sm" placeholder="<?= lang('max_speed') ?>" value="60">
					</div>
				</div>
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
				<div class="card-header"><?= lang('information') ?></div>
				<div class="card-body text-justify p-1" style="max-height: 300px;overflow-y: scroll;">
					<div class="card mb-1 card_hover">
						<div class="card-body p-2" style="font-size: 11px !important;">
							<div class="text"><span
									style="font-size: 13px;"><?= lang('name') ?>:</span><span>  Maz_1</span>
							</div>
							<div class="text"><span
									style="font-size: 13px;"><?= lang('license_plate') ?>:</span><span>  455dd54</span>
							</div>
							<div class="text"><span
									style="font-size: 13px;"><?= lang('type') ?>:</span><span>  Բեռնատար</span>
							</div>
							<div class="text"><span><?= lang('description') ?>:</span><span>  Koryun Maruqyan</span>
							</div>
							<div class="text"><span style="font-size: 13px;"><?= lang('contact_number') ?>:</span><span>  +(374) 55 554 443</span>
							</div>
						</div>
					</div>

					<div class="card mb-1 card_hover">
						<div class="card-body p-2" style="font-size: 11px !important;">
							<div class="text"><span
									style="font-size: 13px;"><?= lang('name') ?>:</span><span>  Maz_1</span>
							</div>
							<div class="text"><span
									style="font-size: 13px;"><?= lang('license_plate') ?>:</span><span>  455dd54</span>
							</div>
							<div class="text"><span
									style="font-size: 13px;"><?= lang('type') ?>:</span><span>  Բեռնատար</span>
							</div>
							<div class="text"><span"><?= lang('description') ?>:</span><span>  Koryun Maruqyan</span>
							</div>
							<div class="text"><span style="font-size: 13px;"><?= lang('contact_number') ?>:</span><span>  +(374) 55 554 443</span>
							</div>
						</div>
					</div>
					<div class="card mb-1 card_hover">
						<div class="card-body p-2" style="font-size: 11px;">
							<div class="text"><span
									style="font-size: 13px;"><?= lang('name') ?>:</span><span>  Maz_1</span>
							</div>
							<div class="text"><span
									style="font-size: 13px;"><?= lang('license_plate') ?>:</span><span>  455dd54</span>
							</div>
							<div class="text"><span
									style="font-size: 13px;"><?= lang('type') ?>:</span><span>  Բեռնատար</span>
							</div>
							<div class="text"><span><?= lang('description') ?>:</span><span>  Koryun Maruqyan</span>
							</div>
							<div class="text"><span style="font-size: 13px;"><?= lang('contact_number') ?>:</span><span>  +(374) 55 554 443</span>
							</div>
						</div>
					</div>
					<div class="card mb-1 card_hover">
						<div class="card-body p-2" style="font-size: 11px;">

							<div class="text"><span
									style="font-size: 13px;"><?= lang('name') ?>:</span><span>  Maz_1</span>
							</div>
							<div class="text"><span
									style="font-size: 13px;"><?= lang('license_plate') ?>:</span><span>  455dd54</span>
							</div>
							<div class="text"><span
									style="font-size: 13px;"><?= lang('type') ?>:</span><span>  Բեռնատար</span>
							</div>
							<div class="text"><span><?= lang('description') ?>:</span><span>  Koryun Maruqyan</span>
							</div>
							<div class="text"><span style="font-size: 13px;"><?= lang('contact_number') ?>:</span><span>  +(374) 55 554 443</span>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="col-sm-10">

			<div id="map" class="mb-1" style="width: 100%; height: calc(100% - 150px) !important;"></div>

			<div class="jumbotron jumbotron-fluid pt-2 pl-0 pr-0 pb-1 mb-0">
				<div class="container">
					<h6><?= lang('get_information') ?></h6>
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body text-justify p-1">
									<label><?= lang('trajectory') ?>
										։ </label><span>  ----- <?= lang('km') ?></span><br>
									<label><?= lang('average_speed') ?> ։ </label><span> ---- <?= lang('km/h') ?></span><br>
									<label><?= lang('Number_exceedance') ?>: </label><span> ---- </span><br>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body text-justify p-1">
									<label><?= lang('engine_turn_on') ?>: </label><span> ____ <?= lang('hour') ?></span><br>
									<label><?= lang('engine_turn_of') ?>: </label><span> ____ <?= lang('hour') ?></span><br>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="jumbotron jumbotron-fluid pt-2 pl-0 pr-0 pb-1 mb-0">
				<div class="container">
					<h6><?= lang('get_information') ?></h6>
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body text-justify p-1">
									<label>Trajectory ։ </label><span>  ---- km</span><br>
									<label>Average Speed ։ </label><span>km/h</span><br>
									<label>Number of exceedance: </label><span>-----</span><br>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body text-justify p-1">
									<label>Engine Turned ON time: </label><span>____ Hour</span><br>
									<label>Engine Turned OFF time: </label><span>____ Hour</span><br>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="jumbotron jumbotron-fluid pt-2 pl-0 pr-0 pb-1 mb-0">
				<div class="container">
					<h6><?= lang('get_information') ?></h6>
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body text-justify p-1">
									<label>Trajectory ։ </label><span>  ---- km</span><br>
									<label>Average Speed ։ </label><span>km/h</span><br>
									<label>Number of exceedance: </label><span>-----</span><br>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body text-justify p-1">
									<label>Engine Turned ON time: </label><span>____ Hour</span><br>
									<label>Engine Turned OFF time: </label><span>____ Hour</span><br>
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
		</div>
	</div>

	<!-- End Modal Graphic Settings -->
	<script>

		$(document).ready(function () {
			ymaps.ready(init);


			function init() {
				coordinate = '[40.1855, 44.5131], [40.1847, 44.5122],[40.1842, 44.5115], [40.1838, 44.5111], [40.1828, 44.5124], [40.1824, 44.5120], [40.1825, 44.5119]';

				array_coordinate = JSON.parse("[" + coordinate + "]");

				myMap = new ymaps.Map("map", {
					center: [55.745508, 37.435225],
					zoom: 13
				}, {
					balloonMaxWidth: 200
				}, {suppressMapOpenBlock: true});

				myMap.events.add('click', function (e) {
					if (!myMap.balloon.isOpen()) {
						var coords = e.get('coords');
						myMap.balloon.open(coords, {
							contentHeader: '',
							contentBody: [
									coords[0].toPrecision(6),
									coords[1].toPrecision(6)
								].join(', ') ,
							contentFooter: ''
						});
					} else {
						myMap.balloon.close();
					}
				});

				myMap.events.add('contextmenu', function (e) {
					myMap.hint.open(e.get('coords'), '');
				});

				myMap.events.add('balloonopen', function (e) {
					myMap.hint.close();
				});

				console.table(array_coordinate);

				var myPolyline = new ymaps.Polyline(
					array_coordinate
					, {
						balloonContent: "Ломаная линия"
					}, {
						balloonCloseButton: false,
						strokeColor: "#60a8f0",
						strokeWidth: 4,
						strokeOpacity: 0.8
					});

				var highSpeed = new ymaps.Polyline([
					[40.1847, 44.5122],
					[40.1842, 44.5115]
				], {
					balloonContent: "Ломаная линия"
				}, {
					balloonCloseButton: false,
					strokeColor: "#ff0000",
					strokeWidth: 4,
					strokeOpacity: 0.9
				});


				$.each(array_coordinate, function (i, val) {

					myPlacemarkWithContent = new ymaps.Placemark(val, {
						hintContent: 'A custom placemark icon with contents',
						balloonContent: 'content'
					}, {
						iconLayout: 'default#imageWithContent',
						iconImageHref: '<?= base_url("assets/images/gps_tracking/navigation.svg") ?>',
						iconImageSize: [20, 20],
						iconImageOffset: [-10, -10],
						iconContentOffset: [15, 15]
					});
					myMap.geoObjects.add(myPlacemarkWithContent);
					myMap.controls.add(new ymaps.control.ZoomControl());
					myMap.setBounds(myMap.geoObjects.getBounds());
				});

				myMap.geoObjects
					.add(myPolyline)
					.add(highSpeed);
				myMap.controls.add(new ymaps.control.ZoomControl());
				myMap.setBounds(myMap.geoObjects.getBounds());



				/* Position */
				position = new ymaps.Placemark([40.20058, 44.566886], {
					hintContent: 'A custom placemark icon with contents',
					balloonContent: 'content'
				}, {
					iconLayout: 'default#imageWithContent',
					iconImageHref: '<?= base_url("assets/images/gps_tracking/navigation.svg") ?>',
					iconImageSize: [20, 20],
					iconImageOffset: [-10, -10],
					iconContentOffset: [15, 15]
				});
				myMap.geoObjects.add(position);

			}

			$('.card-text.fleet_name').click(function () {
				($(this).hasClass('fleet_name_selected')) ? $(this).removeClass('fleet_name_selected') : $(this).addClass('fleet_name_selected');
			});
		});

		$('.selectAll_fleets').on('change', function () {
			if ($('.selectAll_fleets').is(':checked')) {
				console.log('checked')
				$('.card-text.fleet_name').each(function () {
					$(this).addClass('fleet_name_selected');
				})
			} else {
				console.log('unchecked')
				$('.card-text.fleet_name').each(function () {
					$(this).removeClass('fleet_name_selected');
				})
			}
		});

		$(window).on('load', function () {
			if ($(window).width() > 1349) {

				$('.rem_right').addClass('big_r');
			} else {

				$('.rem_right').addClass('small_r');
			}
		});


		$(document).on('click', '.card-text.fleet_name', function () {

			var fleet_ids = [];

			$('.card-text.fleet_name').each(function () {

				if ($(this).hasClass('fleet_name_selected')) {
					fleet_ids.push($(this).data('id'));
				}

			});

			console.log(fleet_ids.join(","));

		});

	</script>

