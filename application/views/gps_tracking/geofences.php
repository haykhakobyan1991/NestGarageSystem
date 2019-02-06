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
<!--<script src="https://api-maps.yandex.ru/2.1/?apikey=57fb1bc4-e5b4-4fa9-96b8-73ee74c98245&lang=ru_RU"-->
<!--		type="text/javascript"></script>-->

<script type="text/javascript" src="<?= base_url('assets/js/ymap.js') ?>"></script>

<style>
	ul.pagination {
		margin-top: 5px !important;
	}

	#example_length {
		display: none !important;
	}

	div#example_wrapper {
		margin-top: -35px;
	}

	.modal-full {
		min-width: 100%;
		margin: 0;
	}
</style>
<div class="container-fluid">
	<hr class="my-2">
	<div class="row">
		<div class="col-sm-5">
			<div class="row">

				<div class="col-sm-2" style="padding-top: 10px;">
					<i style="font-size: 17px;" class="fas fa-draw-polygon"></i>
					<span class="count_cars_in_table">4</span>
				</div>

				<span style="padding-top: 11px;">Ստեղծել</span>
				<span class=" ml-3 mr-1 mt-3"
					  style="z-index: 999;"
					  data-toggle="modal"
					  data-target=".bd-example-modal-xl"><i class="fas fa-plus"></i>
				</span>
				<!--				<select name="company_type"-->
				<!--						id="table-filter"-->
				<!--						class="selectpicker form-control form-control-sm col-sm-3"-->
				<!--						data-size="5"-->
				<!--						id="company_type"-->
				<!--						data-live-search="true"-->
				<!--						title="--><? //= lang('all') ?><!--">-->
				<!--					<option value="">--><? //= lang('all') ?><!--</option>-->
				<!--					<option value="b geofences 1">b geofences 1</option>-->
				<!--					<option value="a geofences 1">a geofences 1</option>-->
				<!--					<option value="d geofences 1">d geofences 1</option>-->
				<!--					<option value="e geofences 1">d geofences 1</option>-->
				<!--				</select>-->


				<table id="example"
					   class="table table-striped table-borderless"
					   style="width:100%">
					<thead style="background: #fff;color: #545b62;">
					<tr>
						<th style="font-size: 12px !important;font-weight: 500;color: transparent;font-size: 1px !important;">
							<input class="sel_all_checkbox" type="checkbox" checked/>Select all
						</th>
						<th style="width: 40%;font-size: 12px !important;font-weight: 500;color: transparent;font-size: 1px !important;">
							<i style="font-size: 12px !important;color: #000 !important;"
							   class="fas fa-sort-alpha-up"></i>
						</th>
						<th class="no-sort">
							<img src="<?= base_url() ?>assets/images/gps_tracking/geofences/car-front.svg"
								 alt=""
								 title=""/></th>
						<th class="no-sort"><i class="fas fa-edit"></i></th>
						<th class="no-sort"><img
								src="<?= base_url() ?>assets/images/gps_tracking/geofences/archives.svg" alt=""
								title=""/></th>
						<th class="no-sort"><img
								src="<?= base_url() ?>assets/images/gps_tracking/geofences/rubbish-bin.svg" alt=""
								title=""/></th>
					</tr>
					</thead>
					<tbody>

					<tr>
						<td>
							<input name="coordinate"
								   type="checkbox"
								   checked
								   data-coordinate="[40.19060653826287, 44.50844357516261],
													[40.189981206597146, 44.51397965456936],
													[40.18741399465704, 44.510246019620624],
													[40.19060653826287, 44.50844357516261]"/>
						</td>
						<td>b geofences 1</td>
						<td class="text-left">0</td>
						<td
							data-toggle="modal"
							data-target=".bd-example-modal-xl_Edite"
							style="cursor: pointer;"
							class="text-left settings_geoObject">
							<i style="opacity: .5;" class="fas fa-edit"></i>
						</td>
						<td style="cursor: pointer;"><img style="opacity: .5;"
														  src="<?= base_url() ?>assets/images/gps_tracking/geofences/archives.svg"
														  alt=""
														  title=""/></td>
						<td style="cursor: pointer;"><img style="opacity: .5;"
														  src="<?= base_url() ?>assets/images/gps_tracking/geofences/rubbish-bin.svg"
														  alt=""
														  title=""/></td>
					</tr>

					<tr>
						<td><input name="coordinate"
								   type="checkbox"
								   checked
								   data-coordinate="[40.13331860515059,44.44393439075485],
								   					[40.09483366177357,44.54555792591108],
								   					[40.148601052086335,44.54967779895795],
								   					[40.13331860515059,44.44393439075485]"/>
						</td>
						<td>a geofences 1</td>
						<td class="text-left">4</td>
						<td
							data-toggle="modal"
							data-target=".bd-example-modal-xl_Edite"
							style="cursor: pointer;"
							class="text-left settings_geoObject">
							<i style="opacity: .5;" class="fas fa-edit"></i>
						</td>
						<td style="cursor: pointer;">
							<img style="opacity: .5;"
								 src="<?= base_url() ?>assets/images/gps_tracking/geofences/archives.svg"
								 alt=""
								 title=""/></td>
						<td style="cursor: pointer;"><img style="opacity: .5;"
														  src="<?= base_url() ?>assets/images/gps_tracking/geofences/rubbish-bin.svg"
														  alt=""
														  title=""/></td>
					</tr>

					<tr>
						<td>
							<input name="coordinate"
								   type="checkbox"
								   checked
								   data-coordinate="[40.188001002307885,44.52710650739624],
								   				[40.17977217076603,44.520068390941155],
								   				[40.174702709790814,44.52762149152713],
								   				[40.173122540044034,44.54118274030644],
								   				[40.18391962756528,44.5442726450916],
								   				[40.188001002307885,44.52710650739624]"/>
						</td>
						<td>d geofences 1</td>
						<td class="text-left">0</td>
						<td
							data-toggle="modal"
							data-target=".bd-example-modal-xl_Edite"
							style="cursor: pointer;"
							class="text-left settings_geoObject">
							<i style="opacity: .5;" class="fas fa-edit"></i></td>
						<td style="cursor: pointer;"><img style="opacity: .5;"
														  src="<?= base_url() ?>assets/images/gps_tracking/geofences/archives.svg"
														  alt=""
														  title=""/></td>
						<td style="cursor: pointer;"><img style="opacity: .5;"
														  src="<?= base_url() ?>assets/images/gps_tracking/geofences/rubbish-bin.svg"
														  alt=""
														  title=""/></td>
					</tr>

					<tr>
						<td>
							<input name="coordinate"
								   type="checkbox"
								   checked
								   data-coordinate="[40.182152607087005,44.48289401495332],
								   					[40.179848435430564,44.49079043829316],
								   					[40.181560113314845,44.50478084051483],
								   					[40.187320248036535,44.502635073302926],
								   					[40.189196299777905,44.487056803344416],
								   					[40.182152607087005,44.48289401495332]"/>
						</td>
						<td>e geofences 1</td>
						<td class="text-left">0</td>
						<td
							data-toggle="modal"
							data-target=".bd-example-modal-xl_Edite"
							style="cursor: pointer;"
							class="text-left settings_geoObject">
							<i style="opacity: .5;" class="fas fa-edit"></i></td>
						<td style="cursor: pointer;"><img style="opacity: .5;"
														  src="<?= base_url() ?>assets/images/gps_tracking/geofences/archives.svg"
														  alt=""
														  title=""/></td>
						<td style="cursor: pointer;"><img style="opacity: .5;"
														  src="<?= base_url() ?>assets/images/gps_tracking/geofences/rubbish-bin.svg"
														  alt=""
														  title=""/></td>
					</tr>

					</tbody>
				</table>


			</div>
		</div>

		<div class="col-sm-7">
			<div id="map" style="width: 100%; height: calc(100% - 150px);"></div>
		</div>
	</div>
</div>


<!-- Add New Geofences Modal Start -->

<div class="modal fade bd-example-modal-xl pr-0" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog  modal-full">
		<div class="modal-content">
			<div class="modal-header" style="padding-bottom: 6px;padding-top: 6px;">
				<h5 class="modal-title" id="exampleModalLabel"><?= lang('Create_New_Geofences') ?></h5>
				<div class="float-right">
					<button style="float: none;margin-right: 1px;" class="cancel_btn close btn btn-sm refresh_map"><i class="fas fa-redo"></i></button>
					<button id="add_department_btn" type="button"
							class="btn btn-outline-success cancel_btn "><?= lang('save') ?>
					</button>
					<button id="load" style="height: 40px !important; width: 90px !important;"
							class="btn btn-sm btn-outline-success cancel_btn d-none"><img
							style="height: 20px;margin: 0 auto;display: block;text-align: center;"
							src="<?= base_url() ?>assets/images/bars2.svg"/></button>
					<button type="button" class="cancel_btn close btn btn-sm m-0 ml-1 delete_geofences_onMap"
							data-dismiss="modal"
							aria-label="Close">
						<?= lang('cancel') ?>
					</button>
				</div>

			</div>
			<div class="modal-content">
				<div id="map_new" style="width: 100%;height: calc(100% - 58px);"></div>
			</div>
		</div>
	</div>
</div>

<!-- Add New Geofences Modal End -->

<!-- Edite Geofences Modal Start -->

<div id="shown" class="modal fade bd-example-modal-xl_Edite pr-0 hide" tabindex="-1" role="dialog"
	 aria-labelledby="myExtraLargeModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog  modal-full">
		<div class="modal-content">
			<div class="modal-header" style="padding-bottom: 6px;padding-top: 6px;">
				<h5 class="modal-title" id="exampleModalLabel"><?= lang('Create_New_Geofences') ?></h5>
				<div class="float-right">
					<button id="add_department_btn" type="button"
							class="btn btn-outline-success cancel_btn "><?= lang('save') ?>
					</button>
					<button id="load" style="height: 40px !important; width: 90px !important;"
							class="btn btn-sm btn-outline-success cancel_btn d-none"><img
							style="height: 20px;margin: 0 auto;display: block;text-align: center;"
							src="<?= base_url() ?>assets/images/bars2.svg"/></button>
					<button type="button" class="cancel_btn close btn btn-sm m-0 ml-1"
							data-dismiss="modal"
							aria-label="Close">
						<?= lang('cancel') ?>
					</button>
				</div>

			</div>
			<div class="modal-content">
				<div id="map_settings" style="width: 100%;height: calc(100% - 58px);"></div>
			</div>
		</div>
	</div>
</div>

<!-- Edite Geofences Modal End -->

<script type="text/javascript">

	$(document).ready(function () {

		ymaps.ready(init_all);

		function init_all() {
			var myMap_show_all_geofances = new ymaps.Map("map", {
				center: [55.76, 37.64],
				zoom: 2
			}, {suppressMapOpenBlock: true});

			$('input[name="coordinate"]').each(function () {

				if ($(this).is(':checked')) {
					geoObject_coordinates = $(this).data('coordinate')
					array_stting = JSON.parse("[" + geoObject_coordinates + "]");

					var rand_color = '#' + (function co(lor) {
						return (lor += [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f'][Math.floor(Math.random() * 16)]) && (lor.length == 6) ? lor : co(lor);
					})('') + '75';

					var myPolygon = new ymaps.Polygon([
						array_stting
					], {}, {
						editorDrawingCursor: "crosshair",
						fillColor: rand_color,
						strokeColor: rand_color,
						strokeWidth: 2
					});

					myMap_show_all_geofances.geoObjects.add(myPolygon);
					myMap_show_all_geofances.controls.add(new ymaps.control.ZoomControl());
					myMap_show_all_geofances.setBounds(myMap_show_all_geofances.geoObjects.getBounds());

				}
			});
		}


		//Yandex map checkbox onchange
		$('input[name="coordinate"], .sel_all_checkbox').on('change', function () {
			$('#map').html('');
			ymaps.ready(init_all);

			function init_all() {
				var myMap_show_all_geofances = new ymaps.Map("map", {
					center: [55.76, 37.64],
					zoom: 2
				}, { suppressMapOpenBlock: true });

				$('input[name="coordinate"]').each(function () {

					if ($(this).is(':checked')) {
						geoObject_coordinates = $(this).data('coordinate');
						array_stting = JSON.parse("[" + geoObject_coordinates + "]");

						var rand_color = '#' + (function co(lor) {
							return (lor += [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f'][Math.floor(Math.random() * 16)]) && (lor.length == 6) ? lor : co(lor);
						})('') + '75';

						var myPolygon = new ymaps.Polygon([
							array_stting
						], {}, {
							editorDrawingCursor: "crosshair",
							fillColor: rand_color,
							strokeColor: rand_color,
							strokeWidth: 2
						});
						
						myMap_show_all_geofances.geoObjects.add(myPolygon);
						myMap_show_all_geofances.controls.add(new ymaps.control.ZoomControl());
						myMap_show_all_geofances.setBounds(myMap_show_all_geofances.geoObjects.getBounds());
					}
				});
			}
		});


		//Yandex Map Modal Edit geoObject Start
		$(document).on('click', '.settings_geoObject', function () {
			var th = $(this);
			$('#shown').on('shown.bs.modal', function () {
				$('#map_settings').html('');

				geoObject_coordinates = th.parent('tr').children('td:first-child').children('input').attr('data-coordinate');
				array_seting = JSON.parse("[" + geoObject_coordinates + "]");

				ymaps.ready(init_singleCar(array_seting));

				function init_singleCar(array_seting) {

					var myMap_geofencesSetting = new ymaps.Map("map_settings", {
						center: [54.45454, 53.4665],
						zoom: 2
					}, {suppressMapOpenBlock: true});


					var myPolygon = new ymaps.Polygon([
						array_seting
					]);

					myMap_geofencesSetting.geoObjects.add(myPolygon);

					myMap_geofencesSetting.controls.add(new ymaps.control.ZoomControl());
					myMap_geofencesSetting.setBounds(myMap_geofencesSetting.geoObjects.getBounds(), {checkZoomRange: true});

					myPolygon.geometry.events.add('change', function () {
						console.log(myPolygon.geometry.getCoordinates().toString());
					});

					myPolygon.editor.startDrawing();

				}
			});
		});
	});

	//Yandex Map Modal Start

	function createNewGeofences() {
		ymaps.ready(init2);

		function init2() {
			var myMap_new = new ymaps.Map("map_new", {
				center: [55.76, 37.64],
				zoom: 7
			});

			var myPolygon = new ymaps.Polygon([], {}, {
				editorDrawingCursor: "crosshair",
				editorMaxPoints: 100,
				fillColor: '#00ff0054',
				strokeColor: '#0000FF',
				strokeWidth: 3
			});

			myMap_new.geoObjects.add(myPolygon);
			var stateMonitor = new ymaps.Monitor(myPolygon.editor.state);
			stateMonitor.add("drawing", function (newValue) {
				myPolygon.options.set("strokeColor", newValue ? '#FF0000' : '#0000FF');
			});

			myPolygon.geometry.events.add('change', function () {
				console.log(myPolygon.geometry.getCoordinates().toString());
			});
			myPolygon.editor.startDrawing();


			firstButton = new ymaps.control.Button("<i class='fas fa-draw-polygon'></i> Polygon");
			myMap_new.controls.add(firstButton, {float: 'left'});

			firstButton.events.add('click', function () {

				var myPolygon = new ymaps.Polygon([], {}, {
					editorDrawingCursor: "crosshair",
					editorMaxPoints: 10,
					fillColor: '#00ff0054',
					strokeColor: '#0000FF',
					strokeWidth: 3
				});
				myMap_new.geoObjects.add(myPolygon);
				var stateMonitor = new ymaps.Monitor(myPolygon.editor.state);
				stateMonitor.add("drawing", function (newValue) {
					myPolygon.options.set("strokeColor", newValue ? '#FF0000' : '#0000FF');
				});

				myPolygon.geometry.events.add('change', function () {
					console.log(myPolygon.geometry.getCoordinates().toString());
				});
				myPolygon.editor.startDrawing();

			});
		}
	}

	createNewGeofences();

	$('.delete_geofences_onMap').click(function () {
		$('#map_new').html('');
		createNewGeofences();
	});


	$('.refresh_map').click(function () {
		$('#map_new').html('');
		createNewGeofences();
	})

	//Yandex Map Modal End

	//Bootstrap Data table Start
	$(document).ready(function () {
		var table = $('#example').DataTable({
			language: {
				search: "<?=lang('search')?>",
				emptyTable: "<?=lang('no_data')?>",
				info: "<?=lang('total')?> _TOTAL_ <?=lang('data')?>",
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
				"orderable": false, "targets": 0
			}],
			"bPaginate": false,
			"scrollY": ""
		});
		$('#table-filter').on('change', function () {
			table.search(this.value).draw();
		});

		$('table tr th:nth-child(2)').click(function () {
			if (!$(this).hasClass('az')) {
				$(this).html('<i style="font-size: 12px !important;color: #000 !important;" class="fas fa-sort-alpha-down"></i>');
				$(this).addClass('az');
			} else {
				$(this).html('<i style="font-size: 12px !important;color: #000 !important;" class="fas fa-sort-alpha-up"></i>');
				$(this).removeClass('az');
			}
		});

		$('.sel_all_checkbox').on('change', function () {
			if ($('input.sel_all_checkbox').is(':checked')) {
				$('td input').each(function () {
					$(this).prop('checked', true);
				});
			} else {
				$('td input').each(function () {
					$(this).prop('checked', false);
				});
			}
		});
	})
	//Bootstrap Datatable End
</script>

