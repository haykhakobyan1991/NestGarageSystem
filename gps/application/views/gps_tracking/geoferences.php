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

<link rel="stylesheet" href="https://static.zinoui.com/1.5/themes/silver/zino.core.css">
<link rel="stylesheet" href="https://static.zinoui.com/1.5/themes/silver/zino.splitter.css">


<script src="https://api-maps.yandex.ru/2.1/?apikey=57fb1bc4-e5b4-4fa9-96b8-73ee74c98245&lang=ru_RU"
		type="text/javascript"></script>
<!--<script type="text/javascript" src="--><?//= base_url('assets/js/ymap.js') ?><!--"></script>-->


<script src="https://static.zinoui.com/1.5/compiled/zino.position.min.js"></script>
<script src="https://static.zinoui.com/1.5/compiled/zino.draggable.min.js"></script>
<script src="https://static.zinoui.com/1.5/compiled/zino.splitter.min.js"></script>
<script src="https://static.zinoui.com/js/front.min.js"></script>

<?
$count = count($result);
?>

<style>
	body{overflow: hidden;}
	ul.pagination {
		margin-top: 5px !important;
	}

	#example_length {
		display: none !important;
	}

	div#example_wrapper {
		margin-top: -26px;
		margin-right: 10px;
	}

	.modal-full {
		min-width: 100%;
		margin: 0;
	}
	#splitter {
		height: calc(100% - 150px);
		width: 100%;
	}
	.splitter-west {
	}
	.splitter-east {
		width: 100%;
	}
	.zui-splitter-separator{
		z-index: 1 !important;
	}
	.panel-right.splitter-east.zui-splitter-pane.zui-splitter-pane-horizontal{
		width: 100% !important;
	}
</style>


<div class="container-fluid">
	<div id="splitter">
		<div class="panel-left splitter-west" id="mydiv">
			<div class="row">

				<div class="number_of col-sm-2" style="padding-top: 16px;">
					<i style="font-size: 17px;" class="fas fa-draw-polygon"></i>
					<span class="count_cars_in_table"><?=$count?></span>
				</div>


				<span  class="create_span ml-3 mr-1 mt-3"
					  style="z-index: 999;cursor: pointer;"
					  data-toggle="modal"
					  data-target=".bd-example-modal-xl">
					<span class="create_span" ><?=lang('create')?></span><i class="fas fa-plus pl-2"></i>
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
								src="<?= base_url() ?>assets/images/gps_tracking/geofences/rubbish-bin.svg" alt=""
								title=""/></th>
					</tr>
					</thead>
					<tbody>

					<?foreach ($result as $name => $value) {
						foreach ($value as $id => $val) {
							?>


							<tr>
								<td class="coords">
									<input name="coordinate"
										   type="checkbox"
										   checked
										   data-coordinate="<?= implode(',', $val) ?>"/>
								</td>
								<td class="name"><?= $name ?></td>
								<td class="text-left">0</td>
								<td
									data-toggle="modal"
									data-target=".bd-example-modal-xl_Edite"
									style="cursor: pointer;"
									class="text-left settings_geoObject">
									<i style="opacity: .5;" class="fas fa-edit"></i>
									<input type="hidden" name="id_edit" value="<?=$id?>">
								</td>
								<td style="cursor: pointer;"
									data-toggle="modal"
									id="delete_geo_modal"
									data-target=".bd-example-modal-sm"
									data-id="<?= $id ?>"
								>
									<img style="opacity: .5;" alt="" title=""
										 src="<?= base_url() ?>assets/images/gps_tracking/geofences/rubbish-bin.svg" />

								</td>
							</tr>

							<?
						}
					}?>


					</tbody>
				</table>


			</div>
		</div>

		<div class="panel-right splitter-west splitter-east">
			<div id="map" style="width: 100%; height:100%;"></div>
		</div>
	</div>
</div>


<!-- Add New Geofences Modal Start -->

<div class="modal fade bd-example-modal-xl pr-0" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog  modal-full">
		<div class="modal-content">
			<form id="add_geo">
				<div class="modal-header" style="padding-bottom: 0px;padding-top: 10px;">
					<h5 class="modal-title" id="exampleModalLabel"><?= lang('Create_New_Geofences') ?></h5>

					<div class="form-group row mb-2">
						<label class="col-sm-6 col-form-label"><?=lang('GeoferenceName')?></label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="geo_name"  placeholder="<?=lang('GeoferenceName')?>">
						</div>
					</div>
					<div class="float-right">
						<button style="float: none;margin-right: 1px;" class="cancel_btn close btn btn-sm refresh_map"><i class="fas fa-redo"></i></button>
						<button id="add_geoference_btn" type="button"
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

					<input type="hidden" id="geometry" name="geometry"  value=""/>

				</div>
			</form>
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
			<form  id="edit_geo">
				<div class="modal-header" style="padding-bottom: 6px;padding-top: 6px;">
					<h5 class="modal-title" id="exampleModalLabel"><?= lang('edit_geoference') ?></h5>
					<input type="hidden" name="edit_id" value="" />
					<div class="form-group row mb-0">
						<label class="col-sm-6 col-form-label"><?=lang('GeoferenceName')?></label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="geo_name"  placeholder="<?=lang('GeoferenceName')?>">
						</div>
					</div>
					<div class="float-right">
						<button id="edit_geoference_btn" type="button"
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

					<input type="hidden" id="edit_geometry" name="edit_geometry"  value=""/>

				</div>
			</form>
			<div class="modal-content">
				<div id="map_settings" style="width: 100%;height: calc(100% - 58px);"></div>
			</div>
		</div>
	</div>
</div>

<!-- Edite Geofences Modal End -->


<!-- Delete Modal Start -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title text-secondary text-center" id="exampleModalLabel"
					style="font-size: 15px;"><?= lang('are_you_sure_you_want_to_delete') ?></h6>
			</div>
			<div class="modal-footer text-center">
				<div style="margin: 0 auto;">
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" id="delete_geo"
							class="btn btn-outline-success cancel_btn"><?= lang('yes') ?>
					</button>
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" class="btn btn-outline-danger yes_btn"
							data-dismiss="modal"><?= lang('cancel') ?></button>

					<input type="hidden" name="geo_id">
				</div>
			</div>
		</div>

	</div>
</div>
<!-- Delete Modal End -->

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

			var width_map = $('.panel-right').width() - $('.panel-left').width() + 30;

			$('#map > ymaps').css('width', width_map);
			$('#map > ymaps').css('overflow', 'scroll');
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

				var width_map = $('.panel-right').width() - $('.panel-left').width() + 30;

				$('#map > ymaps').css('width', width_map);
				$('#map > ymaps').css('overflow', 'scroll');
			}
		});


		//Yandex Map Modal Edit geoObject Start
		$(document).on('click', '.settings_geoObject', function () {
			var th = $(this);
			$('#shown').on('shown.bs.modal', function () {
				$('#map_settings').html('');

				geoObject_coordinates = th.parent('tr').children('td:first-child').children('input').attr('data-coordinate');
				array_seting = JSON.parse("[" + geoObject_coordinates + "]");

				$('input[name="edit_geometry"]').val(array_seting);

				ymaps.ready(init_singleCar(array_seting));

				function init_singleCar(array_seting) {

					var myMap_geofencesSetting = new ymaps.Map("map_settings", {
						center: [54.45454, 53.4665],
						zoom: 2
					}, {suppressMapOpenBlock: true});


					var myPolygon = new ymaps.Polygon([
						array_seting
					]);

					//console.log(array_seting);

					myMap_geofencesSetting.geoObjects.add(myPolygon);

					myMap_geofencesSetting.controls.add(new ymaps.control.ZoomControl());
					myMap_geofencesSetting.setBounds(myMap_geofencesSetting.geoObjects.getBounds(), {checkZoomRange: true});

					myPolygon.geometry.events.add('change', function () {
						$('input[name="edit_geometry"]').val(myPolygon.geometry.getCoordinates().toString());

					});

					myPolygon.editor.startDrawing();

				}
			});


			var edit_id = $(this).children('input').val();
			$('input[name="edit_id"]').val(edit_id);

			var  td_name = $(this).parent('tr').children('.name').text();
			$('input[name="geo_name"]').val(td_name);




		});
	});




	//Yandex Map Modal Start

	function createNewGeofences() {
		ymaps.ready(init2);

		function init2() {


			var myMap_new = new ymaps.Map("map_new", {
				center: [40.1533693, 44.4185276],
				zoom: 12
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

				$('input[name="geometry"]').val(myPolygon.geometry.getCoordinates().toString());


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
					// console.log(myPolygon.geometry.getCoordinates().toString());

					$('input[name="geometry"]').val(myPolygon.geometry.getCoordinates().toString());



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
	});
	//Bootstrap Datatable End

	$(document).on('click', '#add_geoference_btn', function (e) {

		var form_data = new FormData($('form#add_geo')[0]);
		var url = '<?=base_url($this->uri->segment(1) . '/Gps/add_geoference_ax') ?>';
		e.preventDefault();

		$('input').removeClass('border border-danger');
		$('select').parent('div').children('button').removeClass('border border-danger');

		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function () {
				scroll_top();

				$(this).html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/bars2.svg" />');
				$(this).addClass('bg-success2');
				$('.alert-info').removeClass('d-none');
				$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');
			},
			success: function (data) {
				if (data.success == '1') {
					close_message();
					$('.alert-success').removeClass('d-none');
					$('.alert-success').html(data.message);
					var url = "<?=current_url()?>";
					$(location).attr('href', url);
				} else {
					$('.alert-info').addClass('d-none');
					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'submit');
						errors = '';
						tmp = '';
						$.each(data.error.elements, function (index) {
							$.each(data.error.elements[index], function (index, value) {
								if (value != '') {
									$('input[name="' + index + '"]').addClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').children('button').addClass('border border-danger');
									close_message();
									$('.alert-danger').removeClass('d-none');
									if (value != tmp) {
										errors += value + '<br>';
									}
									tmp = value;
								} else {
									$('input[name="' + index + '"]').removeClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').children('button').removeClass('border border-danger');
								}
							});
						});
					}
					$('.alert-danger').html(errors);
				}
			},
			error: function (jqXHR, textStatus) {
				// Handle errors here
				close_message();
				$('.alert-info').addClass('d-none');
				console.log('ERRORS: ' + textStatus);
			},
			complete: function () {
			}
		});

	});



	$(document).on('click', '#edit_geoference_btn', function (e) {

		var form_data = new FormData($('form#edit_geo')[0]);
		var url = '<?=base_url($this->uri->segment(1) . '/Gps/edit_geoference_ax') ?>';
		e.preventDefault();

		$('input').removeClass('border border-danger');
		$('select').parent('div').children('button').removeClass('border border-danger');

		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function () {
				scroll_top();

				$(this).html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/bars2.svg" />');
				$(this).addClass('bg-success2');
				$('.alert-info').removeClass('d-none');
				$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');
			},
			success: function (data) {
				if (data.success == '1') {
					close_message();
					$('.alert-success').removeClass('d-none');
					$('.alert-success').html(data.message);
					var url = "<?=current_url()?>";
					$(location).attr('href', url);
				} else {
					$('.alert-info').addClass('d-none');
					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'submit');
						errors = '';
						tmp = '';
						$.each(data.error.elements, function (index) {
							$.each(data.error.elements[index], function (index, value) {
								if (value != '') {
									$('input[name="' + index + '"]').addClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').children('button').addClass('border border-danger');
									close_message();
									$('.alert-danger').removeClass('d-none');
									if (value != tmp) {
										errors += value + '<br>';
									}
									tmp = value;
								} else {
									$('input[name="' + index + '"]').removeClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').children('button').removeClass('border border-danger');
								}
							});
						});
					}
					$('.alert-danger').html(errors);
				}
			},
			error: function (jqXHR, textStatus) {
				// Handle errors here
				close_message();
				$('.alert-info').addClass('d-none');
				console.log('ERRORS: ' + textStatus);
			},
			complete: function () {
			}
		});

	});

</script>




<script>
	$(document).on('click', '#delete_geo_modal', function () {
		geo_id = $(this).data('id');
		$('input[name="geo_id"]').val(geo_id);
	});

	$(document).on('click', '#delete_geo', function () {
		var id = $('input[name="geo_id"]').val();
		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()).'/Gps/delete_geoference/')?>';

		$.post(url, {geo_id: id}, function (result) {
			location.reload();
		});
	});


	$(function () {
		$("#splitter").zinoSplitter({
			panes: [
				{
					size: 548
				},
				{
					size: "100%", region: "east"
				}
			],
			resize: function (event, ui) {
				log("resize");
			}
		});

		function log(str) {

			if (str == 'resize') {

				console.log($('.panel-right').width() - $('.panel-left').width() + 30)
				var width_map = $('.panel-right').width() - $('.panel-left').width() + 30;

				$('#map > ymaps').css('width', width_map);
				$('#map > ymaps').css('overflow', 'scroll');

				if($('.panel-left').width() <= 565){
					$('input[type=search]').css('display','none');

					$('.create_span').css('display','none')
					$('div#example_wrapper').css('margin-top','0');
					$('.number_of').removeClass('col-sm-2');
					$('.number_of').addClass('col-sm-12');

				} else {
					$('input[type=search]').css('display','inline-block');

					$('.create_span').css('display','inline-block')
					$('div#example_wrapper').css('margin-top','-26px');
					$('.number_of').removeClass('col-sm-12');
					$('.number_of').addClass('col-sm-2');
				}


			}
		}

	});
</script>


