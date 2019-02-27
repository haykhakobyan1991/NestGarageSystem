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
<script src="https://api-maps.yandex.ru/2.1/?apikey=57fb1bc4-e5b4-4fa9-96b8-73ee74c98245&lang=ru_RU" type="text/javascript"></script>
<script src="https://static.zinoui.com/1.5/compiled/zino.position.min.js"></script>
<script src="https://static.zinoui.com/1.5/compiled/zino.draggable.min.js"></script>
<script src="https://static.zinoui.com/1.5/compiled/zino.splitter.min.js"></script>
<script src="https://static.zinoui.com/js/front.min.js"></script>
<style>
	html,
	body {
		height: 100%;
	}
	body {
		overflow: hidden;
	}
	.btn.btn-secondary.buttons-collection.dropdown-toggle.buttons-colvis {
		display: none;
	}
	.dropdown-menu {
		padding: 0;
	}
	.dropdown-menu a:last-child {
		display: none;
		top: 55px;
		left: -15px;
	}
	.dataTables_filter label {
		font-size: 0px !important;
	}
	#example11_filter label input {
		height: 30px;
	}
	#example11_filter {
		height: 37px;
	}
	td {
		font-size: 11px !important;
	}
	.custom_fas_trash:hover, .custom_fas_trash:active, .custom_fas_trash:focus {
		color: #6c757d !important;
	}
	.custom_fas_trash_btn, .custom_fas_trash_btn:hover i, .custom_fas_trash_btn:focus i, .custom_fas_trash_btn:active i {
		color: #6c757d !important;
	}
	.border-5 {
		border-width: 5px !important;
	}
	.zui-splitter-separator {
		z-index: 1 !important;
	}
	.splitter-west {
	}
	.splitter-east {
		width: 100%;
	}
	.dt-button-collection.dropdown-menu {
		left: -100px !important;
	}
	a.dt-button.dropdown-item.buttons-columnVisibility {
		color: #fff !important;
		background: #8e8f90 !important;
	}
	a.dt-button.dropdown-item.buttons-columnVisibility.active {
		color: #8e8f90 !important;
		background: #fff !important;
	}
	.panel-right.splitter-east.zui-splitter-pane.zui-splitter-pane-horizontal {
		width: 100% !important;
	}
	td{text-align: center !important;}
	div#example11_wrapper {
		margin-top: -49px !important;
	}
</style>

<div class="loader" style="width: 100%;z-index: 999 !important;"></div>
<img class="loader_svg"
	 style="width: 10em !important;margin-left: -100px !important;position: fixed !important;left: 50% !important;top: 50% !important;z-index: 999 !important;margin-top: -100px !important;"
	 src="<?= base_url('assets/images/puff.svg') ?>"/>

<div id="splitter">

	<div class="panel-left splitter-west" id="mydiv">
		<div class="row">
			<div class="col-sm-12 mt-2">

				<div class="form-group row ml-2">
					<div class="car_icon col-sm-6" style="padding-top: 10px;">
						<span class="count_cars_in_table"><?= lang('sos_alarms') ?></span>
					</div>
				</div>


				<table id="example11" class="table table-bordered" style="width:100%">
					<thead>
					<tr>
						<th style="font-size: 12px !important;font-weight: 500;">
							<?= lang('fleet') ?>
						</th>
						<th style="font-size: 12px !important;font-weight: 500;">
							<?= lang('license_plate') ?>
						</th>
						<th style="font-size: 12px !important;font-weight: 500;">
							<?= lang('driver') ?>
						</th>
						<th style="font-size: 12px !important;font-weight: 500;min-width: 100px;">
							<?= lang('data_time') ?>
						</th>
						<th style="font-size: 12px !important;font-weight: 500;">
							<i class="far fa-envelope"></i>
						</th>
						<th style="font-size: 12px !important;font-weight: 500;">
							<i class="fas fa-trash text-secondary"></i>
						</th>


					</tr>
					</thead>
					<tbody>

					<?
					$_datetime = '';
					$_imei = '';
					$counter = 0;
					$echoDateTime = '';
					$_echoDateTime = '';
					foreach ($result as $row) {
						$counter++;
						if ($counter == 1) {
							$_datetime = new DateTime($row['datetime']);
						}

						$token = $this->session->token;
						if ($_imei != $row['imei']) {
							$fl = $this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/get_SingleFleetByImei', array('token' => $token, 'imei' => $row['imei'])); //todo url
							$fleet[$row['imei']] = json_decode($fl, true);
						}
						$_imei = $row['imei'];


						// datetime 10 minute interval
						$datetime1 = new DateTime($row['datetime']);

						$interval = $datetime1->diff($_datetime);
						$elapsed = $interval->format('%i');

						if ($elapsed >= 10) {
							$echoDateTime = $row['datetime'];
							$_datetime = new DateTime($row['datetime']);
						}


						if ($_echoDateTime != $echoDateTime) {
							?>

							<tr>
								<td><?= $fleet[$row['imei']]['brand_model'] ?></td>
								<td><?= $fleet[$row['imei']]['fleet_plate_number'] ?></td>
								<td><?= $fleet[$row['imei']]['staff'] ?></td>
								<td><?= $row['datetime'] ?></td>
								<td class="show_car" data-coordinate="<?= $row['lat'] . ', ' . $row['long'] ?>"
									style="cursor: pointer;"><!--<i class="far fa-envelope"></i>-->
									<i class="far fa-envelope text-success"></i></td>
								<td style="cursor: pointer;" data-toggle="modal" data-target=".bd-example-modal-sm"><i
										class="fas fa-trash text-secondary"></i></td>
							</tr>

						<? }
						$_echoDateTime = $echoDateTime;
					} ?>

					</tbody>
				</table>

			</div>
		</div>
	</div>


	<div class=" panel-right splitter-east">
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

					<input type="hidden" name="staff_id">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Delete modal End -->


<script>

	// $('table tr th:nth-child(2)').click(function () {
	//
	// 	if (!$(this).hasClass('az')) {
	// 		$(this).html('<i style="font-size: 12px !important;color: #000 !important;" class="fas fa-sort-alpha-down"></i>');
	// 		$(this).addClass('az');
	// 	} else {
	// 		$(this).html('<i style="font-size: 12px !important;color: #000 !important;" class="fas fa-sort-alpha-up"></i>');
	// 		$(this).removeClass('az');
	// 	}
	// });


	var table = $('#example11').DataTable({
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
			"targets": [5],
			"orderable": false
		}],
		dom: 'Bfrtip',
		buttons: [
			'colvis'
		],
		"bPaginate": false,
		"paging": false,
		"aaSorting": []
	});
	table.buttons().container().appendTo('#example11_wrapper #example11_filter:eq(0)');


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

			address = [];
			$('.show_car').each(function () {

				coordinate = $(this).data('coordinate');
				array = JSON.parse("[" + coordinate + "]");


				ymaps.geocode(coordinate).then(function (res) {
					var firstGeoObject = res.geoObjects.get(0);
					address.push(firstGeoObject.getLocalities().length ? firstGeoObject.getAddressLine() : firstGeoObject.getAdministrativeAreas());

				});

			//	setTimeout(function () {
					console.log(address);
			//	}, 3000)


				var carCoordinate = '';

				latitude = array[0];
				longitude = array[1];

				carCoordinate = new ymaps.Placemark([latitude, longitude], {
					balloonContentHeader: "<p><?=lang('basic_information')?></p>",
					balloonContentBody: "<p class='mb-0'><?=lang('object')?>:<span class='ml-1'><a href='#'>" + $(this).parent('tr').children('td:nth-child(1)').text() + "</a></span></p>" +
						"<p class='mb-0'><?=lang('license_plate')?>:<span class='ml-1'>" + $(this).parent('tr').children('td:nth-child(2)').text() + "</span></p>" +
						"<p class='mb-0'><?=lang('message_time')?>:<span class='ml-1'>" + $(this).parent('tr').children('td:nth-child(4)').text() + "</span></p>" +
						"<p class='mb-0'><?=lang('driver')?>: <span class='ml-1'>" + $(this).parent('tr').children('td:nth-child(3)').text() + "</span></p>" +
						"<p class='mb-0'><?=lang('place')?>:<span id='address' class='ml-1'></span></p>",
					balloonContentFooter: ""
				}, {
					iconLayout: 'default#image',
					iconImageHref: '<?= base_url() ?>assets/images/ymap/sos.svg',
					iconImageSize: [35, 30],
					iconImageOffset: [-10, -35]
				});

				myMap_show_all_cars_onChange.geoObjects.add(carCoordinate);
				myMap_show_all_cars_onChange.controls.add(new ymaps.control.ZoomControl());
				myMap_show_all_cars_onChange.setBounds(myMap_show_all_cars_onChange.geoObjects.getBounds());


			});
			var width_map = $('.panel-right').width() - $('.panel-left').width() - 4;
			$('#map > ymaps').css('width', width_map);
			$('#map > ymaps').css('overflow', 'scroll');
		}

		$('.show_car').click(function () {

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


				//Click Function Show All Geofences

				latitude = array[0];
				longitude = array[1];

				carCoordinate = new ymaps.Placemark([latitude, longitude], {
					balloonContentHeader: "<p><?=lang('basic_information')?></p>",
					balloonContentBody: "<p class='mb-0'><?=lang('object')?>:<span class='ml-1'><a href='#'>" + car_name + "</a></span></p>" +
						"<p class='mb-0'><?=lang('license_plate')?>:<span class='ml-1'>" + car_nummber + "</span></p>" +
						"<p class='mb-0'><?=lang('message_time')?>:<span class='ml-1'>" + massage_time + "</span></p>" +
						"<p class='mb-0'><?=lang('driver')?>: <span class='ml-1'>" + driver_name + "</span></p>" +
						"<p class='mb-0'><?=lang('place')?>:<span class='ml-1'>" + current_address + "</span></p>",
					balloonContentFooter: ""
				}, {
					iconLayout: 'default#image',
					iconImageHref: '<?= base_url() ?>assets/images/ymap/sos.svg',
					iconImageSize: [35, 30],
					iconImageOffset: [-10, -35]
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
</script>




