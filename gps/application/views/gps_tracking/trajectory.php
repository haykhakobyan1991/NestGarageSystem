<?
$token = $this->session->token;
$time = strtotime(mdate('%Y-%m-%d', now()));
?>
<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>

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


<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.buttons.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jszip.min.js') ?>"></script>
<!--<script type="text/javascript" src="--><? //=base_url('assets/js/dataTables//vfs_fonts.js')?><!--"></script>-->
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.html5.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.colVis.min.js') ?>"></script>

<style>
	button.btn.btn-secondary.buttons-collection.dropdown-toggle.buttons-colvis {
		display: inline-block !important;
	}

	.card_hover {
		-webkit-transition: all .3s ease-in-out;
		-moz-transition: all .3s ease-in-out;
		-ms-transition: all .3s ease-in-out;
		-o-transition: all .3s ease-in-out;
		transition: all .3s ease-in-out;
		cursor: pointer;
	}

	a.dt-button.dropdown-item.buttons-columnVisibility {
		color: #fff !important;
		background: #8e8f90 !important;
	}

	a.dt-button.dropdown-item.buttons-columnVisibility.active {
		color: #8e8f90 !important;
		background: #fff !important;
	}

	.card_hover:hover {
		background-color: #a9a9a9;
		color: #fff;
	}

	/*.fleet_name_selected {*/
	/*background: #00000080;*/
	/*color: #fff;*/
	/*}*/

	.fleet_name {
		cursor: pointer;
	}

	.big_r {
		margin-right: 8rem !important;
	}

	.small_r {
		margin-right: 7rem !important;
	}

	.card-body.p-0 p {
		font-size: 12px;
	}

	.table-bordered td {
		padding-left: 5px !important;
	}

	div#example11_wrapper {
		margin-top: 0px !important;
	}

	.dataTables_info {
		display: none !important;
	}

	#example11_wrapper {
		padding: 0 !important;
	}

	#example11_wrapper div.row:nth-child(2) div.col-sm-12 {
		padding: 5px !important;
	}

	.border-td-danger {
		border: 1px #dc3545 solid !important;
	}

	.dataTables_scrollBody {
		background: #fff;
	}

	@media screen and (min-width: 1350px) {
		.custon_style {
			width: 11.33333% !important;
			flex: 0 0 11.33333% !important;
		}
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
		<div class="col-sm-2 p-0 custon_style">
			<form>
				<table id="example11" class="table table-bordered p-0">
					<thead>
					<tr>
						<th style="font-size: 12px !important;font-weight: 500;color: transparent;font-size: 1px !important;">
							<input class="sel_all_checkbox selectAll_fleets" style="margin-left: 5px;"
								   type="checkbox"/>
						</th>
						<th style="font-size: 12px !important;font-weight: 500;color: transparent;font-size: 1px !important;">
							<i style="font-size: 12px !important;color: #000 !important;"
							   class="fas fa-sort-alpha-up"></i> <?= lang('fleet') ?>
						</th>
					</tr>
					</thead>
					<tbody style="overflow-y: scroll;">

					<?
					foreach ($result_fleets as $fleets) {
						?>
						<tr>
							<td><input class="checkbox_sel_fleet" type="checkbox"/></td>
							<td>
								<div class="form-group form-check m-0 pl-0">
									<label class="card-text fleet_name"
										   data-imei="<?= $fleets['gps_tracker_imei'] ?>"
										   data-id="<?= $fleets['id'] ?>"><?= $fleets['brand_model'] ?>
										<small class="form-text text-muted">
											(<?= $fleets["fleet_plate_number"] ?>)
										</small>
									</label>

								</div>
							</td>
						</tr>
					<? }; ?>
					</tbody>
				</table>


				<input type="hidden" name="fleets" value="">
				<div class="row mt-1">
					<div class="col-sm-12">
						<div class="form-group m-0">
							<label class="mb-1"><?= lang('from') ?>:</label>
							<input
								name="from"
								value="<?= date("Y-m-d", strtotime("-10 day", $time)); ?>"
								style="font-size: 11px !important;" type="date"
								class="form-control form-control-sm pl-1 pr-0">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group m-0">
							<label class="mb-1"><?= lang('to') ?>:</label>
							<input
								name="to"
								value="<?= mdate('%Y-%m-%d', now()) ?>"
								style="font-size: 11px !important;" type="date"
								class="form-control form-control-sm pl-1 pr-0">
						</div>
					</div>
				</div>

				<div class="row mt-2">
					<div class="col-lg-12" style="text-align: left;">
						<label style="font-size: 11px !important;"><?= lang('speed') ?></label>
						<input type="checkbox" name="speed_yn" value="1" class="speed_checkbox rem_right float-right"
							   style="margin-top: 2px;"/>
					</div>
				</div>

				<div class="row set_maxSpeed d-none">
					<div class="col-sm-12">
						<div class="form-group">
							<label><?= lang('max_speed') ?></label>
							<input name="speed" type="text" alt="<?= lang('max_speed') ?>"
								   title="<?= lang('max_speed') ?>"
								   class="form-control form-control-sm" placeholder="<?= lang('max_speed') ?>"
								   value="60">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12" style="text-align: left;">
						<label style="font-size: 11px !important;"><?= lang('engine') ?></label>
						<input name="engine" value="1" type="checkbox" class="rem_right float-right"
							   style="margin-top: 2px;"/>
					</div>
				</div>

			</form>


			<div class="row">
				<div class="container-fluid">
					<button
						style="border: 1px solid rgb(255, 122, 89) !important;color: rgb(255, 122, 89);opacity: 1 !important;transition: all .3s ease-in-out;background: #fff;"
						id="generate"
						class="generate btn btn-sm btn-block "><?= lang('generate') ?>
					</button>
					<button
						style="height: 40px;border: 1px solid rgb(255, 122, 89) !important;color: rgb(255, 122, 89);opacity: 1 !important;transition: all .3s ease-in-out;background: #fff;"
						id="load1"
						class="btn btn-sm btn-block d-none">
						<img style="height: 24px;
														   margin: 0 auto;
														   padding-bottom: 8px;
														   display: block;
														   text-align: center;"
							 src="<?= base_url() ?>assets/images/bars2.svg"/></button>
				</div>
			</div>
			<div class="card mt-3">
				<div class="card-header"><?= lang('information') ?></div>
				<div id="car_info" class="card-body text-justify p-1" style="max-height: 300px;overflow-y: scroll;"></div>
			</div>
		</div>
		<div class="col-sm-10">
			<div id="ajax_time" class="alert alert-info font-weight-bold text-center d-none" role="alert"></div>
			<div id="map" class="mb-1" style="width: 100%; height: calc(100% - 150px) !important;"></div>
			<div id="fleet_info"></div>
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
									<img src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/icon.svg"
										 alt=""/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option2" autocomplete="off">
									<img
										src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/two-sportive-black-flags.svg"
										alt=""/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option3" autocomplete="off">
									<img src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/diesel.svg"
										 alt=""/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option4" autocomplete="off">
									<img
										src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/speedometer.svg"
										alt=""/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option5" autocomplete="off">
									<img
										src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/gas-station.svg"
										alt=""/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option6" autocomplete="off">
									<img src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/flag.svg"
										 alt=""/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option7" autocomplete="off">
									<img src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/image.svg"
										 alt=""/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option8" autocomplete="off">
									<img
										src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/video-player.svg"
										alt=""/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option9" autocomplete="off">
									<img
										src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/parking-sign.svg"
										alt=""/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option10" autocomplete="off">
									<img src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/stop.svg"
										 alt=""/>
								</label>

								<label class="btn btn-group-sm btn-outline-light"
									   style="padding: .2rem .3rem !important;">
									<input type="radio" name="options" id="option11" autocomplete="off">
									<img
										src="<?= base_url() ?>assets/images/gps_tracking/speed_settings/forward-right-arrow-button.svg"
										alt=""/>
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

			var table = $('#example11').DataTable({
				"scrollY": "250px",
				"scrollCollapse": true,
				"searching": false,
				language: {
					search: "<?=lang('search')?>",
					emptyTable: "<?=lang('no_data')?>",
					info: "<?=lang('total')?> <span id='total'>_TOTAL_</span> <?=lang('data')?>",
					infoEmpty: "<?=lang('total')?> 0 <?=lang('data')?>",
					infoFiltered: "(<?=lang('is_filtered')?> _MAX_ <?=lang('total_record')?>)",
					lengthMenu: "<?=lang('showing2')?> _MENU_ <?=lang('record2')?>",
					zeroRecords: "<?=lang('no_matching_records')?>",
					paginate: {
						first: "<?=lang('first')?>",
						last: "<?=lang('last')?>",
						next: "<?=lang('next')?>",
						previous: "<?=lang('prev')?>"
					}
				},
				"columnDefs": [{
					"targets": [0],
					"orderable": false
				}],
				"bPaginate": false,
				"paging": false,
				"order": [[1, "desc"]]
			});


			ymaps.ready(start_map);

			function start_map() {
				myMap = new ymaps.Map("map", {
					center: [40.1776192, 44.4898932],
					zoom: 13
				}, {suppressMapOpenBlock: true});
			}

		});

		$('.selectAll_fleets').on('change', function () {
			if ($('.selectAll_fleets').is(':checked')) {
				$('.checkbox_sel_fleet').each(function () {
					$(this).prop('checked', true);
					$(this).parent('td').parent('tr').children('td:nth-child(2)').children('div').children('label').addClass('fleet_name_selected');

				})
			} else {
				$('.checkbox_sel_fleet').each(function () {
					$(this).prop('checked', false);
					$(this).parent('td').parent('tr').children('td:nth-child(2)').children('div').children('label').removeClass('fleet_name_selected');

				})
			}
		});

		$(document).on('click', '.checkbox_sel_fleet', function () {
			if ($(this).is(':checked')) {
				$(this).parent('td').parent('tr').children('td:nth-child(2)').children('div').children('label').addClass('fleet_name_selected');
				$(this).parent('td').parent('tr').children('td:nth-child(2)').children('div').children('label').trigger('click');
			} else {
				$(this).parent('td').parent('tr').children('td:nth-child(2)').children('div').children('label').removeClass('fleet_name_selected');
				$(this).parent('td').parent('tr').children('td:nth-child(2)').children('div').children('label').trigger('click');
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
			var fleet_imeis = [];
			var token = '<?=$token?>';
			$('#car_info').html('');

			$('.card-text.fleet_name').each(function () {

				if ($(this).hasClass('fleet_name_selected')) {
					fleet_ids.push($(this).data('id'));
					fleet_imeis.push($(this).data('imei'));
				}

			});

			$.post('<?=$this->load->old_baseUrl() . $this->load->lng() . '/Api/get_fleet_info' ?>', {
				token: token,
				fleet_ids: fleet_ids.join(",")
			}, function (data) {
				var result = '';
				console.log(JSON.parse(data));
				$.each(JSON.parse(data), function (e, val) {
					result += '<div class="card mb-1 card_hover">\n' +
						'\t\t\t\t\t\t<div class="card-body p-2" style="font-size: 11px !important;">\n' +
						'\t\t\t\t\t\t\t<div class="text"><span\n' +
						'\t\t\t\t\t\t\t\t\tstyle="font-size: 13px;"><?= lang("name") ?>:</span><span> ' + val.brand + ' ' + val.model + '</span>\n' +
						'\t\t\t\t\t\t\t</div>\n' +
						'\t\t\t\t\t\t\t<div class="text"><span\n' +
						'\t\t\t\t\t\t\t\t\tstyle="font-size: 13px;"><?= lang("license_plate") ?>:</span><span>  ' + val.fleet_plate_number + '</span>\n' +
						'\t\t\t\t\t\t\t</div>\n' +
						'\t\t\t\t\t\t\t<div class="text"><span\n' +
						'\t\t\t\t\t\t\t\t\tstyle="font-size: 13px;"><?= lang("type") ?>:</span><span>  ' + val.fleet_type + '</span>\n' +
						'\t\t\t\t\t\t\t</div>\n' +
						'\t\t\t\t\t\t\t<div class="text"><span><?= lang("driver") ?>:</span><span>  ' + val.first_name + ' ' + val.last_name + '</span>\n' +
						'\t\t\t\t\t\t\t</div>\n' +
						'\t\t\t\t\t\t\t<div class="text"><span style="font-size: 13px;"><?= lang("contact_number") ?>:</span><span>  ' + (val.contact_1 !== null ? val.contact_1 : '') + (val.contact_2 !== null ? ', ' + val.contact_2 : '') + '</span>\n' +
						'\t\t\t\t\t\t\t</div>\n' +
						'\t\t\t\t\t\t</div>\n' +
						'\t\t\t\t\t</div>';
				});

				$('#car_info').html(result)
			});

			console.log(fleet_ids.join(","));

			$('input[name="fleets"]').val(fleet_imeis.join(","))

		});


		$(document).on('change', '.selectAll_fleets', function () {

			var fleet_ids = [];
			var fleet_imeis = [];
			var token = '<?=$token?>';

			$('#car_info').html('');

			$('.card-text.fleet_name').each(function () {

				if ($(this).hasClass('fleet_name_selected')) {
					fleet_ids.push($(this).data('id'));
					fleet_imeis.push($(this).data('imei'));
				}

			});

			$.post('<?=$this->load->old_baseUrl() . $this->load->lng() . '/Api/get_fleet_info' ?>', {
				token: token,
				fleet_ids: fleet_ids.join(",")
			}, function (data) {
				var result = '';
				console.log(JSON.parse(data));
				$.each(JSON.parse(data), function (e, val) {
					result += '<div class="card mb-1 card_hover">\n' +
						'\t\t\t\t\t\t<div class="card-body p-2" style="font-size: 11px !important;">\n' +
						'\t\t\t\t\t\t\t<div class="text"><span\n' +
						'\t\t\t\t\t\t\t\t\tstyle="font-size: 13px;"><?= lang("name") ?>:</span><span> ' + val.brand + ' ' + val.model + '</span>\n' +
						'\t\t\t\t\t\t\t</div>\n' +
						'\t\t\t\t\t\t\t<div class="text"><span\n' +
						'\t\t\t\t\t\t\t\t\tstyle="font-size: 13px;"><?= lang("license_plate") ?>:</span><span>  ' + val.fleet_plate_number + '</span>\n' +
						'\t\t\t\t\t\t\t</div>\n' +
						'\t\t\t\t\t\t\t<div class="text"><span\n' +
						'\t\t\t\t\t\t\t\t\tstyle="font-size: 13px;"><?= lang("type") ?>:</span><span>  ' + val.fleet_type + '</span>\n' +
						'\t\t\t\t\t\t\t</div>\n' +
						'\t\t\t\t\t\t\t<div class="text"><span><?= lang("driver") ?>:</span><span>  ' + val.first_name + ' ' + val.last_name + '</span>\n' +
						'\t\t\t\t\t\t\t</div>\n' +
						'\t\t\t\t\t\t\t<div class="text"><span style="font-size: 13px;"><?= lang("contact_number") ?>:</span><span>  ' + (val.contact_1 !== null ? val.contact_1 : '') + (val.contact_2 !== null ? ', ' + val.contact_2 : '') + '</span>\n' +
						'\t\t\t\t\t\t\t</div>\n' +
						'\t\t\t\t\t\t</div>\n' +
						'\t\t\t\t\t</div>';
				});

				$('#car_info').html(result)
			});


			console.log(fleet_ids.join(","));

			$('input[name="fleets"]').val(fleet_imeis.join(","))

		});

		$('.speed_checkbox').on('change', function () {
			let speed_checkbox = $('.set_maxSpeed');
			($(this).is(':checked')) ? speed_checkbox.removeClass('d-none') : speed_checkbox.addClass('d-none');
		});

		$(document).on('click', '.generate', function (e) {
			// ajax time
			var xsht = 0;
			setInterval(function () {
				xsht++;
			}, 10);
			//ajax time end

			var me = $(this);
			e.preventDefault();

			if (me.data('requestRunning')) {
				return;
			}

			me.data('requestRunning', true);


			var url = '<?=base_url($this->uri->segment(1) . '/Gps/get_trajectory') ?>';

			var form_data = new FormData($('form')[0]);
			$('input').removeClass('border border-danger');
			$('select').parent('div').children('button').removeClass('border border-danger');
			$('.checkbox_sel_fleet').parent('td').removeClass('border-td-danger');

			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data: form_data,
				contentType: false,
				cache: false,
				processData: false,
				beforeSend: function () {
					$('#generate').addClass('d-none');
					$('#load1').removeClass('d-none');
				},
				success: function (data) {
					if (data.success == '1') {

						close_message();
						$('#generate').removeClass('d-none');
						$('#load1').addClass('d-none');

						$('#map').html('');

						var coordinate = [];
						var coordinate_qx = [];
						var qx = [];


						$.each(data.message.imei, function (e, val) {
							coordinate[e] = '';
							coordinate_qx[e] = '';
							qx[e] = 0;
							$.each(val, function (i, value) {
								if (value.cord) {
									coordinate[e] += value.cord + ',';
								}

								if (value.cord_qx) {
									coordinate_qx[e] += value.cord_qx + ',';
									qx[e]++;
								}

							});
						});


						ymaps.ready(init);


						function init() {


							array_coordinate = [];
							array_coordinate_qx = [];
							var emai = '';


							myMap = new ymaps.Map("map", {
								center: [40.1776192, 44.4898932],
								zoom: 13
							}, {suppressMapOpenBlock: true});


							distanc = [];

							$.each(data.message.imei, function (e, val) {

								if (emai != e) {

									array_coordinate[e] = JSON.parse("[" + coordinate[e].substring(0, coordinate[e].length - 1) + "]");
									console.log(array_coordinate);
									//qx

									array_coordinate_qx[e] = JSON.parse("[" + coordinate_qx[e].substring(0, coordinate_qx[e].length - 1) + "]");

									console.table(array_coordinate_qx);


									myMap.events.add('click', function (e) {
										if (!myMap.balloon.isOpen()) {
											var coords = e.get('coords');
											myMap.balloon.open(coords, {
												contentHeader: '',
												contentBody: [
													coords[0].toPrecision(6),
													coords[1].toPrecision(6)
												].join(', '),
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


									var colors = ['6c757d', '007bff', '28a745', 'fd7e14', 'dc3545', '343a40'];


									ymaps.route(
										array_coordinate[e],
										{
											mapStateAutoApply: true
										}).then(function (route) {
										console.log(route);
										route.getPaths().options.set({
											strokeColor: colors[Math.floor(Math.random() * colors.length)],
											strokeWidth: 5,
											opacity: 0.7
										});

										myMap.geoObjects.add(route.getPaths());


										$('.distance').each(function () {
											if ($(this).data('value') == e) {
												$(this).html(parseFloat(route.getHumanLength()))
											}
										})




										myGeoObject_start = new ymaps.GeoObject({
											geometry: {
												type: "Point",
												coordinates: array_coordinate[e][0]
											},
											properties: {iconContent: '<?=lang('start_point')?>',}
										}, {
											preset: 'islands#greenStretchyIcon',
											draggable: false
										});

										myGeoObject_end = new ymaps.GeoObject({
											geometry: {
												type: "Point",
												coordinates: array_coordinate[e][array_coordinate[e].length - 1]
											},
											properties: {iconContent: '<?=lang('end_point')?>',}
										}, {
											preset: 'islands#redStretchyIcon',
											draggable: false
										});
										myMap.geoObjects
											.add(myGeoObject_start)
											.add(myGeoObject_end);


									});
								}
								emai = e;

							});

							// var highSpeed = new ymaps.Polyline(array_coordinate_qx,
							// {
							// 	balloonContent: "Ломаная линия"
							// }, {
							// 	balloonCloseButton: false,
							// 	strokeColor: "#ff0000",
							// 	strokeWidth: 4,
							// 	strokeOpacity: 0.9
							// });

							var info = '';
							var _imei = '';
							$.each(data.message.imei, function (e, val) {
								$.each(val, function (i, value) {
									coord_placemark = JSON.parse("[" + value.cord + "]");

									MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
										'<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
									),

										myPlacemarkWithContent = new ymaps.Placemark([coord_placemark[0][0], coord_placemark[0][1]], {
											hintContent: 'A custom placemark icon with contents',
											balloonContent: '<p>' + value.fleet + '<p>' +
												'<p><?=lang("time")?>: ' + value.time + '</p>' +
												'<p><?=lang("speed")?>: ' + value.speed + ' <?=lang("km/h")?></p>' +
												'<p><?=lang("engine")?>: ' + (value.engine_power == 1 ? '<span class="ml-1 bg-danger" style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></span>' : '<span class="ml-1 bg-success" style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></span>') + '</p>'
										}, {
											iconLayout: ymaps.templateLayoutFactory.createClass([
												'<div style="transform:rotate({{options.rotate}}deg);">',
												'{% include "default#image" %}',
												'</div>'
											].join('')),
											iconImageHref: (value.cord == value.cord_qx ? '<?= base_url("assets/images/gps_tracking/trajectory/navigation_qx.svg") ?>' : '<?= base_url("assets/images/gps_tracking/trajectory/navigation.svg") ?>'),
											iconImageSize: [20, 20],
											iconImageOffset: [-5, -5],
											iconContentOffset: [15, 15],
											iconRotate: value.course,
											iconShape: {
												type: 'Circle',
												coordinates: [0, 0],
												radius: 25
											}
										});


									myMap.geoObjects.add(myPlacemarkWithContent);
									myMap.controls.add(new ymaps.control.ZoomControl());
									myMap.setBounds(myMap.geoObjects.getBounds());

									if (_imei != e) {

										if (value.engine == 1) {
											$('.engineOnOf').removeClass('d-none');
											info += '<tr>\n' +
												'<td>' + value.fleet + '</td>\n' +
												'<td>' + value.fleet_plate_number + '</td>\n' +
												'<td>' + value.staff + '</td>\n' +
												'<td><span class="distance" data-value="' + e + '" ></span><?= lang("km") ?></td>\n' +
												'<td>' + value.speed_avg + '<?= lang("km/h") ?></td>\n' +
												'<td>' + qx[e] + '.</td>\n' +
												'<td>' + data.message.power[e]['on'] + '</td>\n' +
												'<td>' + data.message.power[e]['off'] + '</td>\n' +
												'<td>' + data.message.null_speed[e] + '</td>\n' +
												'</tr>\n';
											as = 1;
										} else {
											info += '<tr>\n' +
												'<td>' + value.fleet + '</td>\n' +
												'<td>' + value.fleet_plate_number + '</td>\n' +
												'<td>' + value.staff + '</td>\n' +
												'<td><span class="distance" data-value="' + e + '" ></span><?= lang("km") ?></td>\n' +
												'<td>' + value.speed_avg + '<?= lang("km/h") ?></td>\n' +
												'<td>' + qx[e] + '.</td>\n' +
												'<td>' + data.message.null_speed[e] + '</td>\n' +
												'</tr>\n';
											as = 2;
										}


									}
									_imei = e;

									var table_top = '<table id="example12" class="table table-striped table-borderless w-100 dataTable no-footer">\n' +
										'\t\t\t\t\t<thead>\n' +
										'\t\t\t\t\t<tr>\n' +
										'\t\t\t\t\t\t<th style="font-size: 12px !important;font-weight: 500;">\n' +
										'\t\t\t\t\t\t\t<?= lang("fleet") ?>\n' +
										'\t\t\t\t\t\t</th>\n' +
										'\t\t\t\t\t\t<th style="font-size: 12px !important;font-weight: 500;">\n' +
										'\t\t\t\t\t\t\t<?= lang("license_plate") ?>\n' +
										'\t\t\t\t\t\t</th>\n' +
										'\t\t\t\t\t\t<th style="font-size: 12px !important;font-weight: 500;">\n' +
										'\t\t\t\t\t\t\t<?= lang("driver") ?>\n' +
										'\t\t\t\t\t\t</th>\n' +
										'\t\t\t\t\t\t<th style="font-size: 12px !important;font-weight: 500;">\n' +
										'\t\t\t\t\t\t\t<?= lang("trajectory") ?>\n' +
										'\t\t\t\t\t\t</th>\n' +
										'\t\t\t\t\t\t<th style="font-size: 12px !important;font-weight: 500;">\n' +
										'\t\t\t\t\t\t\t<?= lang("average_speed") ?>\n' +
										'\t\t\t\t\t\t</th>\n' +
										'\t\t\t\t\t\t<th style="font-size: 12px !important;font-weight: 500;">\n' +
										'\t\t\t\t\t\t\t<?= lang("Number_exceedance") ?>\n' +
										'\t\t\t\t\t\t</th>\n' +
										'\t\t\t\t\t\t<th class="engineOnOf" style="font-size: 12px !important;font-weight: 500;">\n' +
										'\t\t\t\t\t\t\t<?= lang("on_road") ?>\n' +
										'\t\t\t\t\t\t</th>\n' +
										'\t\t\t\t\t\t<th class="engineOnOf" style="font-size: 12px !important;font-weight: 500;">\n' +
										'\t\t\t\t\t\t\t<?= lang("engine_turn_of") ?>\n' +
										'\t\t\t\t\t\t</th>\n' +
										'\t\t\t\t\t\t<th style="font-size: 12px !important;font-weight: 500;">\n' +
										'\t\t\t\t\t\t\t<?=lang("stop")?>\n' +
										'\t\t\t\t\t\t</th>\n' +
										'\t\t\t\t\t</tr>\n' +
										'\t\t\t\t\t</thead>\n' +
										'\t\t\t\t\t<tbody class="example_12_tbody">\n' +
										'</tbody>\n' +
										'\t\t\t\t</table>';


									$('#fleet_info').html(table_top);


								});

								$('.example_12_tbody').html(info);

							});

							setTimeout(function () {


								if (as == 2) {

									function initDataTable() {
										var table = $('#example12').DataTable({
											"searching": true,
											"ordering": true,
											"bPaginate": false,
											"paging": false,
											language: {
												search: "<?=lang('search')?>",
												emptyTable: "<?=lang('no_data')?>",
												info: "<?=lang('total')?> <span id='total'>_TOTAL_</span> <?=lang('data')?>",
												infoEmpty: "<?=lang('total')?> 0 <?=lang('data')?>",
												infoFiltered: "(<?=lang('is_filtered')?> _MAX_ <?=lang('total_record')?>)",
												lengthMenu: "<?=lang('showing2')?> _MENU_ <?=lang('record2')?>",
												zeroRecords: "<?=lang('no_matching_records')?>",
												paginate: {
													first: "<?=lang('first')?>",
													last: "<?=lang('last')?>",
													next: "<?=lang('next')?>",
													previous: "<?=lang('prev')?>"
												}
											},
											dom: 'Bfrtip',
											buttons: [
												{
													extend: 'excelHtml5',
													title: '<?=lang('Report_period') . '  ' . lang('from')?> ' + $('input[name="from"]').val() + '  <?=lang('to')?> ' + $('input[name="to"]').val(),
													messageTop: "<?=lang('company')?>: "+$('input[name="company"]').val()+",  <?=lang('user')?>: "+$('.username_login > a').text(),
													autoWidth: true,
													filename: 'trajectory',
													footer: true,
													exportOptions: {
														columns: ':visible'
													}
												},
												'colvis'
											]
										});

										$('.buttons-excel span').html('<?=lang('export')?>');
										$('.buttons-html5').append('<i style="padding-left: 10px;" class="fas fa-print"></i>');
										$('.buttons-colvis span').text('');
										$('.buttons-colvis span').text('<?=lang('column_visibility')?>');
										table.buttons().container()
											.appendTo('#example12_wrapper #example12_filter:eq(0)');
										$('.dt-buttons').css('float', 'left');
									}

									$('.engineOnOf').remove();
									initDataTable();

								} else {
									function initDataTable() {
										var table = $('#example12').DataTable({
											"searching": true,
											"ordering": true,
											"bPaginate": false,
											"paging": false,
											language: {
												search: "<?=lang('search')?>",
												emptyTable: "<?=lang('no_data')?>",
												info: "<?=lang('total')?> <span id='total'>_TOTAL_</span> <?=lang('data')?>",
												infoEmpty: "<?=lang('total')?> 0 <?=lang('data')?>",
												infoFiltered: "(<?=lang('is_filtered')?> _MAX_ <?=lang('total_record')?>)",
												lengthMenu: "<?=lang('showing2')?> _MENU_ <?=lang('record2')?>",
												zeroRecords: "<?=lang('no_matching_records')?>",
												paginate: {
													first: "<?=lang('first')?>",
													last: "<?=lang('last')?>",
													next: "<?=lang('next')?>",
													previous: "<?=lang('prev')?>"
												}
											},
											dom: 'Bfrtip',
											buttons: [
												{
													extend: 'excelHtml5',
													title: '<?=lang('Report_period') . '  ' . lang('from')?> ' + $('input[name="from"]').val() + '  <?=lang('to')?> ' + $('input[name="to"]').val(),
													messageTop: "<?=lang('company')?>: "+$('input[name="company"]').val()+",  <?=lang('user')?>: "+$('.username_login > a').text()+",  <?=lang('type')?>:  <?=lang('trajectory_speed')?> ",
													autoWidth: true,
													filename: 'trajectory',
													exportOptions: {
														columns: ':visible'
													}
												},
												'colvis'
											]
										});

										$('.buttons-excel span').html('<?=lang('export')?>');
										$('.buttons-html5').append('<i style="padding-left: 10px;" class="fas fa-print"></i>');
										$('.buttons-colvis span').text('');
										$('.buttons-colvis span').text('<?=lang('column_visibility')?>');
										table.buttons().container()
											.appendTo('#example12_wrapper #example12_filter:eq(0)');
										$('.dt-buttons').css('float', 'left');
									}

									initDataTable();
								}

							}, xsht+3000);


							// //MultiRoute
							// myMap.geoObjects.add(multiRoute.getPaths());

							// myMap.geoObjects.add(highSpeed);
							myMap.controls.add(new ymaps.control.ZoomControl());
							myMap.setBounds(myMap.geoObjects.getBounds());

						}

					} else {

						$('#map').html('');
						myMap = new ymaps.Map("map", {
							center: [40.1776192, 44.4898932],
							zoom: 13
						}, {suppressMapOpenBlock: true});

						$('.alert-info').addClass('d-none');
						$('#generate').removeClass('d-none');
						$('#load1').addClass('d-none');
						if ($.isArray(data.error.elements)) {
							scroll_top();
							$('#generate').removeClass('d-none');
							$('#load1').addClass('d-none');
							errors = '';
							tmp = '';
							$.each(data.error.elements, function (index) {
								$.each(data.error.elements[index], function (index, value) {
									if (value != '') {
										$('input[name="' + index + '"]').addClass('border border-danger');
										$('select[name="' + index + '"]').parent('div').children('button').addClass('border border-danger');
										close_message();
										$('.alert-danger').removeClass('d-none');

										if (index == 'fleets') {
											$('.checkbox_sel_fleet').parent('td').addClass('border-td-danger')
										}

										if (value != tmp) {
											errors += value + '<br>';
										}
										tmp = value;
									} else {
										$('input[name="' + index + '"]').removeClass('border border-danger');
										$('select[name="' + index + '"]').parent('div').children('button').removeClass('border border-danger');
										$('.checkbox_sel_fleet').parent('td').removeClass('border-td-danger');
									}
								});
							});
						}

					}
				},
				error: function (jqXHR, textStatus) {
					// Handle errors here
					$('#generate').removeClass('d-none');
					$('#load1').addClass('d-none');
					close_message();
					$('.alert-info').addClass('d-none');
					console.log('ERRORS: ' + textStatus);
				},
				complete: function () {
					$('#ajax_time').html('Ajax time - ' + xsht / 100 + 's');
					$('#ajax_time').removeClass('d-none');
					setTimeout(function () {
						$('#ajax_time').addClass('d-none');
					}, 4000);

					me.data('requestRunning', false);
				}
			});


		});

	</script>



