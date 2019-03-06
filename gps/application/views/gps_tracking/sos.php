<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.buttons.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.bootstrap4.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/gps_tracking/gps_tracking.css"/>
<link rel="stylesheet" href="https://static.zinoui.com/1.5/themes/silver/zino.core.css">
<link rel="stylesheet" href="https://static.zinoui.com/1.5/themes/silver/zino.splitter.css">
<script src="https://api-maps.yandex.ru/2.1/?apikey=57fb1bc4-e5b4-4fa9-96b8-73ee74c98245&lang=ru_RU" type="text/javascript"></script>
<script src="https://static.zinoui.com/1.5/compiled/zino.position.min.js"></script>
<script src="https://static.zinoui.com/1.5/compiled/zino.draggable.min.js"></script>
<script src="https://static.zinoui.com/1.5/compiled/zino.splitter.min.js"></script>
<script src="https://static.zinoui.com/js/front.min.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/gps_tracking/sos.css"/>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jszip.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.html5.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.colVis.min.js') ?>"></script>

<div class="loader" style="width: 100%;z-index: 999 !important;"></div>
<img class="loader_svg"
	 style="width: 10em !important;margin-left: -100px !important;position: fixed !important;left: 50% !important;top: 50% !important;z-index: 999 !important;margin-top: -100px !important;"
	 src="<?= base_url('assets/images/puff.svg') ?>"/>

<div id="splitter">

	<div class="panel-left splitter-west" id="mydiv">
		<div class="row">
			<div class="form-group row ml-2">
				<div class="car_icon col-sm-12 ml-2">
					<span class="count_cars_in_table"><?= lang('sos_alarms') ?></span>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top: 30px;">
			<div class="col-sm-12 mt-2">
				<table id="example11" class="table table-striped table-borderless w-100 dataTable no-footer"
					   style="width:100%">
					<thead>
					<tr>
						<th style="font-size: 12px !important;font-weight: 500;">
							<i class="far fa-envelope"></i>
						</th>
						<th style="font-size: 12px !important;font-weight: 500;min-width: 100px;">
							<?= lang('data_time') ?>
						</th>
						<th style="font-size: 12px !important;font-weight: 500;">
							<?= lang('fleet') ?>
						</th>
						<th style="font-size: 12px !important;font-weight: 500;">
							<?= lang('license_plate') ?>
						</th>
						<th style="font-size: 12px !important;font-weight: 500;">
							<?= lang('driver') ?>
						</th>
						<th style="font-size: 12px !important;font-weight: 500;">
							<i class="fas fa-trash text-secondary"></i>
						</th>


					</tr>
					</thead>
					<tbody>

					<?
					$lng = $this->load->lng();

					$_datetime = '';
					$_imei = '';
					$counter = 0;
					$echoDateTime = '';
					$_echoDateTime = '';

					$id = '';

					$unread = 0;
					foreach ($result as $row) {
						$counter++;
						if ($counter == 1) {
							$_datetime = new DateTime($row['datetime']);
							$id = $row['id'];
						}


						$token = $this->session->token;
						if ($_imei != $row['imei']) {
							$fl = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_SingleFleetByImei', array('token' => $token, 'imei' => $row['imei'])); //todo url
							$fleet[$row['imei']] = json_decode($fl, true);
						}
						$_imei = $row['imei'];


						// datetime 2 minute interval
						$datetime1 = new DateTime($row['datetime']);

						$interval = $datetime1->diff($_datetime);
						$elapsed = $interval->format('%i');

						if ($elapsed >= 2) {
							$id = $row['id'];
							$echoDateTime = $row['datetime'];
							$_datetime = new DateTime($row['datetime']);
						}


						if ($_echoDateTime != $echoDateTime) {

							if ($row['sos_visibility'] == '-1') {
								$unread++;
							}

							if ($row['sos_visibility'] != '2') {

								?>


								<tr>
									<td data-id="<?= $id ?>" class="show_car"
										data-coordinate="<?= $row['lat'] . ', ' . $row['long'] ?>"
										style="cursor: pointer;">
										<?
										if ($row['sos_visibility'] == -1) {
											echo '<i class="far fa-envelope text-success"></i>';
										} elseif ($row['sos_visibility'] == 1) {
											echo '<i class="far fa-envelope-open text-warning"></i>';
										}
										?>
									</td>
									<td><?= $echoDateTime ?></td>
									<td><?= $fleet[$row['imei']]['brand_model'] ?></td>
									<td><?= $fleet[$row['imei']]['fleet_plate_number'] ?></td>
									<td><?= $fleet[$row['imei']]['staff'] ?></td>


									<td class="delete_sos" style="cursor: pointer;" data-toggle="modal"
										data-target=".bd-example-modal-sm"><i
											class="fas fa-trash text-secondary"></i></td>
								</tr>

								<?
							}
						}
						$_echoDateTime = $echoDateTime;
					}
					$unread = $this->session->set_userdata('unread', $unread);
					?>

					</tbody>
				</table>

			</div>
		</div>
	</div>


	<div class=" panel-right splitter-east" style="position: relative">
		<div id="map" style="width: 100%;height: 100%;"></div>
	</div>
</div>

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

<!-- Delete Modal start -->
<div class="modal fade bd-example-modal-sm del_group_modal" tabindex="-1" role="dialog"
	 aria-labelledby="mySmallModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title text-secondary text-center" id="exampleModalLabel"
					style="font-size: 13px;"><?= lang('are_you_sure_you_want_to_delete') ?></h6>
			</div>
			<div class="modal-footer text-center">
				<div style="margin: 0 auto;">
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" id="delete_staff"
							class="btn btn-outline-success yes_btn"><?= lang('yes') ?>
					</button>
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" class="btn btn-outline-danger  cancel_btn"
							data-dismiss="modal"><?= lang('cancel') ?></button>

					<input type="hidden" name="sos_id">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Delete modal End -->

</div>
<script>


	function initDataTable() {

		var from_date = $('tbody').children('tr:first-child').children('td:nth-child(2)').text();
		var to_date   = $('tbody').children('tr:last-child').children('td:nth-child(2)').text();

		console.log(from_date);
		console.log(to_date);

		var table = $('#example11').DataTable({
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
					title: '<?=lang('Report_period') . '  ' . lang('from')?> ' + from_date + '  <?=lang('to')?> ' + to_date,
					messageTop: "<?=lang('company')?>: " + $('input[name="company"]').val() + ",  <?=lang('user')?>: " + $('.username_login > a').text(),
					autoWidth: true,
					filename: 'sos',
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

	$(window).on('load', function () {
		initDataTable();
	});
</script>
<script type="text/javascript">

	/***************************
	 ****************************
	 *** [ Yandex Map Start ] ***
	 ****************************
	 ***************************/

	$(document).ready(function () {
		ymaps.ready(init_all);

		function init_all() {
			var myPlacemark,
				myMap_show_all_cars_onChange = new ymaps.Map("map", {
					center: [55.76, 37.64],
					zoom: 2
				}, {suppressMapOpenBlock: true});

			$('.show_car').each(function () {

				coordinate = $(this).data('coordinate');
				array = JSON.parse("[" + coordinate + "]");

				var carCoordinate = '';
				latitude = array[0];
				longitude = array[1];


				carCoordinate = new ymaps.Placemark([latitude, longitude], {
					balloonContentHeader: "<p><?=lang('basic_information')?></p>",
					balloonContentBody: "<p class='mb-0'><?=lang('object')?>:<span class='ml-1'><a href='#'>" + $(this).parent('tr').children('td:nth-child(1)').text() + "</a></span></p>" +
						"<p class='mb-0'><?=lang('license_plate')?>:<span class='ml-1'>" + $(this).parent('tr').children('td:nth-child(2)').text() + "</span></p>" +
						"<p class='mb-0'><?=lang('message_time')?>:<span class='ml-1'>" + $(this).parent('tr').children('td:nth-child(4)').text() + "</span></p>" +
						"<p class='mb-0'><?=lang('driver')?>: <span class='ml-1'>" + $(this).parent('tr').children('td:nth-child(3)').text() + "</span></p>",
					balloonContentFooter: ""
				}, {
					iconLayout: 'default#image',
					iconImageHref: '<?= base_url() ?>assets/images/ymap/sos.svg',
					iconImageSize: [35, 30],
					iconImageOffset: [-10, -35]
				});

				carCoordinate.events.add('balloonopen', function (e) {
					carCoordinate.properties.set('balloonContentFooter', "Loading data...");

					ymaps.geocode(carCoordinate.geometry.getCoordinates(), {
						results: 1
					}).then(function (res) {
						var newContent = res.geoObjects.get(0) ?
							res.geoObjects.get(0).properties.get('name') :
							'Couldn\'t detect address.';
						carCoordinate.properties.set('balloonContentFooter', "<p class='mb-0' style='color: #000 !important;    margin-top: -7px !important;'><?=lang('place')?>:<span id='address' class='ml-1' style='color: #000 !important;'>" + newContent + "</span></p>");
					});

				});


				myMap_show_all_cars_onChange.geoObjects.add(carCoordinate);
				myMap_show_all_cars_onChange.controls.add(new ymaps.control.ZoomControl());
				myMap_show_all_cars_onChange.setBounds(myMap_show_all_cars_onChange.geoObjects.getBounds());

			});
			var width_map = $('.panel-right').width() - $('.panel-left').width() - 4;
			$('#map > ymaps').css('width', width_map);
			$('#map > ymaps').css('overflow', 'scroll');
		}


		$('.delete_sos').on('click', function () {
			var id = $(this).parent('tr').children('td.show_car').data('id');
			$('input[name="sos_id"]').val(id);

		});


		$('.yes_btn').click(function () {

			data_id = $('input[name="sos_id"]').val();

			$('.del_group_modal').modal('toggle');

			$('.show_car').each(function () {
				if ($(this).data('id') == data_id) {
					$(this).parent('tr').remove();
				}
			});

			unread = 0;
			$('.far.fa-envelope.text-success').each(function () {
				unread++;
			});
			$('.count_unread').text(unread);


			$.post('<?=base_url($this->uri->segment(1) . '/Gps/sos_visibility') ?>', {
				sos_visibility: 2,
				gps_id: $('input[name="sos_id"]').val(),
				count_unread: unread
			});

			$("#map").html('');
			ymaps.ready(init_all);

		});


		$('.show_car').click(function () {

			if ($(this).children('i').hasClass('fa-envelope')) {
				$(this).children('i').removeClass('fa-envelope');
				$(this).children('i').removeClass('text-success');
				$(this).children('i').addClass('fa-envelope-open');
				$(this).children('i').addClass('text-warning');
			} else {
				$(this).children('i').addClass('fa-envelope');
				$(this).children('i').addClass('text-success');
				$(this).children('i').removeClass('fa-envelope-open');
				$(this).children('i').removeClass('text-warning');

			}

			unread = 0;
			$('.far.fa-envelope.text-success').each(function () {
				unread++;
			});
			$('.count_unread').text(unread);


			if ($(this).children('i').hasClass('fa-envelope')) {
				$.post('<?=base_url($this->uri->segment(1) . '/Gps/sos_visibility') ?>', {
					sos_visibility: -1,
					gps_id: $(this).data('id'),
					count_unread: unread
				});
			} else {
				$.post('<?=base_url($this->uri->segment(1) . '/Gps/sos_visibility') ?>', {
					sos_visibility: 1,
					gps_id: $(this).data('id'),
					count_unread: unread
				});
			}


			car_name = $(this).parent('tr').children('td:nth-child(1)').text();
			car_nummber = $(this).parent('tr').children('td:nth-child(2)').text();
			massage_time = $(this).parent('tr').children('td:nth-child(4)').text();
			driver_name = $(this).parent('tr').children('td:nth-child(3)').text();
			current_address = $(this).parent('tr').children('.address_span').text();

			$('#map').html('');

			coordinate = $(this).data('coordinate');
			array = JSON.parse("[" + coordinate + "]");
			ymaps.ready(init_singleCar(array));

			function init_singleCar(array) {
				var myMap_show_singleCar = new ymaps.Map("map", {
					center: [45.8989, 54.56566565],
					zoom: 2
				}, {suppressMapOpenBlock: true});
				var carCoordinate = '';

				firstButton = new ymaps.control.Button('<div id="seeAll">\n' +
					'\t\t\t<span class="count_cars_in_table"><?= lang("all1") ?></span>\n' +
					'\t\t\t<img style="cursor: pointer" src="<?= base_url("assets/images/gps_tracking/eye.svg") ?>"/>\n' +
					'\t\t</div>')

				firstButton.events.add(['select', 'deselect'], function (e) {
					if (e.get('type') == 'select') {
						$('#map').html('');
						ymaps.ready(init_all);
					}
				});

				myMap_show_singleCar.controls.add(firstButton, {float: 'left'});

				//Click Function Show All Geofences

				latitude = array[0];
				longitude = array[1];

				carCoordinate = new ymaps.Placemark([latitude, longitude], {
					balloonContentHeader: "<p><?=lang('basic_information')?></p>",
					balloonContentBody: "<p class='mb-0'><?=lang('object')?>:<span class='ml-1'><a href='#'>" + car_name + "</a></span></p>" +
						"<p class='mb-0'><?=lang('license_plate')?>:<span class='ml-1'>" + car_nummber + "</span></p>" +
						"<p class='mb-0'><?=lang('message_time')?>:<span class='ml-1'>" + massage_time + "</span></p>" +
						"<p class='mb-0'><?=lang('driver')?>: <span class='ml-1'>" + driver_name + "</span></p>",
					balloonContentFooter: ""
				}, {
					iconLayout: 'default#image',
					iconImageHref: '<?= base_url() ?>assets/images/ymap/sos.svg',
					iconImageSize: [35, 30],
					iconImageOffset: [-10, -35]
				});

				carCoordinate.events.add('balloonopen', function (e) {
					carCoordinate.properties.set('balloonContentFooter', "Loading data...");

					ymaps.geocode(carCoordinate.geometry.getCoordinates(), {
						results: 1
					}).then(function (res) {
						var newContent = res.geoObjects.get(0) ?
							res.geoObjects.get(0).properties.get('name') :
							'Couldn\'t detect address.';
						carCoordinate.properties.set('balloonContentFooter', "<p class='mb-0' style='color: #000 !important;    margin-top: -7px !important;'><?=lang('place')?>:<span id='address' class='ml-1' style='color: #000 !important;'>" + newContent + "</span></p>");
					});

				});

				myMap_show_singleCar.geoObjects.add(carCoordinate);

				myMap_show_singleCar.controls.add(new ymaps.control.ZoomControl());
				myMap_show_singleCar.setBounds(myMap_show_singleCar.geoObjects.getBounds(), {checkZoomRange: true});

				var width_map = $('.panel-right').width() - $('.panel-left').width() - 4;
				$('#map > ymaps').css('width', width_map);
				$('#map > ymaps').css('overflow', 'scroll');
			}


		});

	});
	/*************************
	 **************************
	 *** [ Yandex Map End ] ***
	 **************************
	 *************************/
</script>

<script>
	$(function () {
		$("#splitter").zinoSplitter({
			panes: [
				{
					size: 570
				},
				{
					size: "100%",
					region: "east"
				}
			],
			resize: function (event, ui) {
				log("resize");
			}
		});

		function log(str) {
			if (str == 'resize') {
				var width_map = $('.panel-right').width() - $('.panel-left').width() - 4;
				$('#map > ymaps').css('width', width_map);
				$('#map > ymaps').css('overflow', 'scroll');
				if ($('.panel-left').width() <= 400) {
					$('input[type=search]').css('display', 'none');
					$('.car_icon').removeClass('col-sm-2');
					$('.car_icon').addClass('col-sm-3');
				} else {
					$('input[type=search]').css('display', 'inline-block');
					$('.car_icon').addClass('col-sm-2');
					$('.car_icon').removeClass('col-sm-3');
				}
				if ($('.panel-left').width() <= 374) {
					$('.car_icon').removeClass('col-sm-2');
					$('.car_icon').addClass('col-sm-7');
				} else {
					$('.car_icon').addClass('col-sm-2');
					$('.car_icon').removeClass('col-sm-7');
				}
			}
		}
	});
	$(window).on('load', function () {
		var width_map = $('.panel-right').width() - $('.panel-left').width() - 4;
		$('#map > ymaps').css('width', width_map);
		$('#map > ymaps').css('overflow', 'scroll');
	})
	$(document).ready(function () {
		function myFunction() {
			if (navigator.userAgent.indexOf("Firefox") != -1) {
				var window_height = window.innerHeight - 315;
				var window_height2 = window.innerHeight - 150;
				$('.dataTables_scrollBody').css('height', window_height);
				$('#splitter').css('height', window_height2);
			} else {
				$('.dataTables_scrollBody').css('height', 'calc(100% - 315px)');
				$('#splitter').css('height', 'calc(100% - 150px)');
			}
		}

		myFunction();
	})


	$(document).ready(function () {
		var count_unread = 0;
		$('.far.fa-envelope.text-success').each(function () {
			count_unread++;
			$('.count_unread').text(count_unread)
		});

	});

</script>




