<?
$token = $this->session->token;
$time = strtotime(mdate('%Y-%m-%d', now()));
?>
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

<style>
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

	.dataTables_scrollBody {
		background: #fff;
	}
</style>

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
	<hr class="my-2">
	<div class="row">

		<div class="col-sm-2 p-0">
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
				<div id="car_info" class="card-body text-justify p-1" style="max-height: 300px;overflow-y: scroll;">


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
										<li class="list-group-item"><?= lang('Level_At_The_Beginning') ?> - 117.0706 l
										</li>
										<li class="list-group-item"><?= lang('total_consumption') ?> - ***</li>
										<li class="list-group-item"><?= lang('number_charges') ?> - ***</li>
										<li class="list-group-item"><?= lang('engine_consumption') ?> - 21.61 l - ***
										</li>
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
	$(document).ready(function () {
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

		//Example11 DataTable Start

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

		//Example11 DataTable End

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



				} else {

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
