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
<script src="https://api-maps.yandex.ru/2.1/?apikey=624e82b8-f673-476e-ada3-3c68555422b9&lang=ru_RU"
		type="text/javascript"></script>
<style>
	ul.pagination {margin-top: 5px !important;}
	#example_length {display: none !important;}
	div#example_wrapper {margin-top: -35px;}
	.modal-full {min-width: 100%;margin: 0;}
</style>
<div class="container-fluid">
	<hr class="my-2">
	<div class="row">
		<div class="col-sm-5">
			<div class="row">
				<button class="btn btn-outline-secondary ml-3 mr-1" 
						style="z-index: 999;" 
						data-toggle="modal"
						data-target=".bd-example-modal-xl"
				>New
				</button>
				<select name="company_type" 
						id="table-filter" 
						class="selectpicker form-control form-control-sm col-sm-3"
						data-size="5" 
						id="company_type" 
						data-live-search="true"
						title="<?= lang('all') ?>">
					<option value=""><?= lang('all') ?></option>
					<option value="b geofences 1">b geofences 1</option>
					<option value="a geofences 1">a geofences 1</option>
					<option value="d geofences 1">d geofences 1</option>
				</select>


				<table id="example" 
				       class="table table-striped table-borderless"
					   style="width:100%">
					<thead style="background: #fff;color: #545b62;">
					<tr>
						<th style="font-size: 12px !important;font-weight: 500;color: transparent;font-size: 1px !important;">
							<!--<input class="sel_all_checkbox" type="checkbox"/>Select all -->
						</th>
						<th style="width: 40%;font-size: 12px !important;font-weight: 500;color: transparent;font-size: 1px !important;">
							<i style="font-size: 12px !important;color: #000 !important;"
							   class="fas fa-sort-alpha-up"></i>
						</th>
						<th class="no-sort">
							<img src="<?= base_url() ?>assets/images/gps_tracking/geofences/car-front.svg" 
							     alt=""
								 title=""/></th>
						<th class="no-sort"><img
								src="<?= base_url() ?>assets/images/gps_tracking/geofences/screwdriver-and-wrench-crossed.svg"
								alt="" title=""/></th>
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
								   type="radio"
								   data-coordinate="[40.19060653826287, 44.50844357516261],[40.189981206597146, 44.51397965456936],[40.18741399465704, 44.510246019620624],[40.19060653826287, 44.50844357516261]"
								/>
						</td>
						<td>b geofences 1</td>
						<td class="text-left">0</td>
						<td style="cursor: pointer;" class="text-left">
							<img style="opacity: .5;"
								 src="<?= base_url() ?>assets/images/gps_tracking/geofences/screwdriver-and-wrench-crossed.svg"
								 alt="" 
								 title=""
							/>
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
						           type="radio"
								   data-coordinate="[55.388712763532915,32.24634252406617],[55.38324024891158,32.40289769984742],[55.29165843010759,32.319126947894304],[55.31124505920083,32.11862645961305],[55.388712763532915,32.24634252406617]"/>
						</td>
						<td>a geofences 1</td>
						<td class="text-left">4</td>
						<td style="cursor: pointer;" class="text-left">
							<img style="opacity: .5;"
					             src="<?= base_url() ?>assets/images/gps_tracking/geofences/screwdriver-and-wrench-crossed.svg"
								 alt="" 
								 title=""/></td>
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
								   type="radio"
								   data-coordinate="[56.388712763532915,31.24634252406617],[55.38324024894358,32.40289549984742],[55.29165866010759,32.319126943394304],[55.31124655920083,32.11862645961305],[55.388712763537615,32.24634252236617]" /></td>
						<td>d geofences 1</td>
						<td class="text-left">0</td>
						<td style="cursor: pointer;" class="text-left">
						    <img style="opacity: .5;"
								 src="<?= base_url() ?>assets/images/gps_tracking/geofences/screwdriver-and-wrench-crossed.svg"
								 alt="" 
								 title=""/></td>
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
				<h5 class="modal-title" id="exampleModalLabel">Create New Geofences</h5>
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
				<div id="map_new" style="width: 100%;height: calc(100% - 58px);"></div>
			</div>
		</div>
	</div>
</div>

<!-- Add New Geofences Modal End -->


<script type="text/javascript">
	// Yandex Map Start
	
	//Init Map On Pae Loade Start
	ymaps.ready(init3);
	function init3() {
		var myMap_new = new ymaps.Map("map", {
			center: [55.76, 37.64],
			zoom: 7
		});
	}
	//Init Map On Page Load End



	$('input').on('change', function () {

		$('#map').html('');
		ymaps.ready(init);

		$('input[name="coordinate"]').each(function () {
			if ($(this).is(":checked")) {
				coordinate = $(this).data('coordinate');
				array = JSON.parse("[" + coordinate + "]");
				init(array);
			}
		});

	});

	function init(array) {
		console.log(array);
		var myPolygon = new ymaps.Polygon([array]);
		var myMap = new ymaps.Map("map", {
					center: [array[0][0], array[0][1]],
					zoom: 12
				});
		myMap.geoObjects.add(myPolygon);
	}
 

	//Yandex Map Modal Start

	ymaps.ready(init2);

	function init2() {
		var myMap_new = new ymaps.Map("map_new", {
			center: [55.76, 37.64],
			zoom: 7
		});

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
				"targets": 'no-sort',
				"orderable": false,
			}]
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

