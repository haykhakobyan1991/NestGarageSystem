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
		height: 38px;
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


</style>

<?
	$lng = $this->load->lng();
?>

<div class="loader" style="width: 100%;z-index: 999 !important;"></div>
<img class="loader_svg"
	 style="width: 10em !important;margin-left: -100px !important;position: fixed !important;left: 50% !important;top: 50% !important;z-index: 999 !important;margin-top: -100px !important;"
	 src="<?= base_url('assets/images/puff.svg') ?>"/>

<div id="splitter">

	<div class="panel-left splitter-west" id="mydiv">
		<div class="row">
			<div class="col-sm-12 m-2">
				<div class="form-group row ml-2">
					<div class="car_icon col-sm-2" style="padding-top: 10px;">
						<img src="<?= base_url() ?>assets/images/icon-car-png-22.png"
							 style="width: 25px;display: inline-block;"/>
						<span class="count_cars_in_table"><?= count($result_fleets) ?></span>
					</div>
					<label class="label_group" style="margin-top: 10px;"><?= lang('group') ?></label>
					<div class="label_group col-sm-3 ml-0">
						<select style="margin-top: 1px;max-width: 220px; z-index: 999;"
								name="group"
								class="form-control form-control-sml sell_group_select">
							<option selected value="all_val"><?= lang('all1') ?></option>
							<?
							if (count($result) > 0) {
								foreach ($result as $row) { ?>
									<option data-id="<?= $row['group_id'] ?>"
											data-default="<?= $row['default'] ?>"
											data-cordinate="<?= (isset($new_result[$row['geoference_id']]) ? implode(',', $new_result[$row['geoference_id']]) : 'gago') ?>"
											value="<?= $row['fleet_id'] ?>"><?= $row['title'] . ($row['default'] == 1 ? ' *' : '') ?></option>
								<? }
							} ?>
						</select>
					</div>

					<div class="tools_div col-sm-2 pl-0" style="padding-top: 4px;">
						<button class="btn btn-sm btn-outline-secondary plus_btn mr-1"
								data-toggle="modal" data-target=".add_group"
								style="width: 20px;padding: 2px !important;"><img
								style="margin-right: 5px;margin-left: -15px;"
								src="<?= base_url() ?>assets/images/gps_tracking/plus-black-symbol.svg"
								class="ml-0 mr-0 "/></button>
						<button class="btn btn-sm btn-outline-secondary set_btn mr-1"
								id="edit_group_modal"
								data-toggle="modal"
								data-target="#edit_group"
								data-toggle2="tooltip"
								data-placement="top"
								style="width: 20px;padding: 2px !important;"><img
								style="margin-right: 5px;margin-left: -15px;"
								src="<?= base_url() ?>assets/images/gps_tracking/settings-work-tool.svg"
								class="ml-0 mr-0 "/></button>
						<button class="custom_fas_trash_btn btn btn-sm btn-outline-secondary delete_btn"
								data-toggle="modal"
								data-target=".del_group_modal"
								style="width: 20px;padding: 2px !important;">
							<i class="custom_fas_trash fas fa-trash"></i>

					</div>
				</div>


				<table id="example11" class="table table-bordered" style="width:100%">
					<thead>
					<tr>
						<th style="font-weight: 500;color: transparent;font-size: 1px !important;">
							<input class="sel_all_checkbox" style="margin-left: 5px;" type="checkbox"/>
						</th>
						<th
							style="font-weight: 500;color: transparent;font-size: 1px !important;min-width: 200px;">
							<i style="font-size: 12px !important;color: #000 !important;"
							   class="fas fa-sort-alpha-up"></i><?= lang('fleet') ?>
						</th>
						<th style="min-width: 150px;font-size: 12px !important;font-weight: 500;color: transparent;font-size: 1px !important;">
							<i style="font-size: 12px !important;color: #000 !important;"
							   class="fas fa-map-marker-alt"></i><?= lang('location') ?>
						</th>
						<th style="font-size: 12px !important;font-weight: 500;min-width: 25px !important;"
							class="text-center">
							<img width="50" height="30" src="<?= base_url() ?>assets/images/gps_tracking/triangle.svg"/>
						</th>
						<th style="font-weight: 500;color: transparent !important;font-size: 1px !important;">
							<i style="min-width: 150px;font-size: 12px !important;color: #000 !important;"
							   class="fas fa-user"></i>
							<?= lang('driver') ?>
						</th>
						<th style="font-size: 12px !important;font-weight: 500;"><?= lang('department') ?></th>

						<th style="font-weight: 500;color: transparent !important;font-size: 1px !important;">
							<i style="color: #000 !important;font-size: 12px !important;"
							   class="fas fa-gas-pump"></i><?= lang('fuel') ?>
						</th>

						<th style="font-size: 12px !important;font-weight: 500;color: transparent !important;font-size: 1px !important;">
							<i style="color: #000 !important; font-size: 12px  !important;"
							   class="fas fa-wifi"></i><?= lang('signal') ?>
						</th>
						<th style="font-size: 12px !important;font-weight: 500;"><?= lang('last_activity') ?></th>
						<th style="font-size: 12px !important;font-weight: 500;"></th>
					</tr>
					</thead>
					<tbody>

					<?

					$tmp = 0;
					$imei = '';
					$arr = array();

					foreach ($last_location as $val) {
						if ($imei != $val['imei']) {
							if ($tmp == 0) {
								$arr[$val['imei']] = array('lat' => $val['lat'], 'long' => $val['long'], 'date' => $val['date'], 'time' => $val['time'], 'course' => $val['course']);
							}
							$tmp = 1;
						} else {
							$tmp = 0;
						}
						$imei = $val['imei'];
					}

					$i = 0;
					foreach ($result_fleets as $fleets) :
						?>

						<tr>
							<td><input type="checkbox"/></td>
							<td>
								<span class="car_model"><?= $fleets['brand_model'] ?></span>
								<small class="form-text text-muted"><?= $fleets['fleet_plate_number'] ?></small>
							</td>
							<td class="address_span" data-address="<?= $i ?>"></td>
							<td class="text-center"><i class="text-warning fas fa-parking"></i></td>
							<td class="staff_span">
								<span><?= $fleets['staff'] ?></span>
								<small class="form-text text-muted"><?= $fleets['contact_1'] ?></small>
							</td>
							<td>
								<span class="span_department"><?= $fleets['department'] ?></span>
								<small style="font-size: 0.1px;"><?= $fleets['fleet_group'] ?></small>
							</td>
							<td>
								<div class="border-danger fuel_wrapper">
									<div class="fuel_first"></div>
								</div>
								<div class="border-danger fuel_wrapper ">
									<div class="fuel_seccond bg-danger"></div>
								</div>
							</td>
							<td>
								<div class="bg-warning"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td class="last_time_update">
								<?= $arr[$fleets['gps_tracker_imei']]['date'] ?>
								<small
									class="form-text text-muted"><?= $arr[$fleets['gps_tracker_imei']]['time'] ?></small>
							</td>
							<td class="show_car"
								data-coordinate='<?= $arr[$fleets['gps_tracker_imei']]['lat'] ?>, <?= $arr[$fleets['gps_tracker_imei']]['long'] ?>'
								data-id="<?=$fleets['id']?>"
								data-imei="<?=$fleets['gps_tracker_imei']?>"
								data-course="<?= $arr[$fleets['gps_tracker_imei']]['course'] ?>">
								<i class="fas fa-play-circle" style="cursor: pointer;"></i>
							</td>
						</tr>
						<?
						$i++;
					endforeach; ?>
					</tbody>
				</table>

			</div>
		</div>
	</div>


	<div class=" panel-right splitter-east">
		<div id="map" style="width: 100%;height: 100%;"></div>
	</div>
</div>

<!-- Delete Modal start -->
<div class="modal fade bd-example-modal-sm del_group_modal" tabindex="-1" role="dialog"
	 aria-labelledby="mySmallModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title text-secondary text-center" id="exampleModalLabel"
					style="font-size: 12px;"><?= lang('are_you_sure_you_want_to_delete') ?></h6>
			</div>
			<div class="modal-footer text-center">
				<div style="margin: 0 auto;">
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" id="delete_group"
							class="btn btn-outline-success cancel_btn"><?= lang('yes') ?>
					</button>
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" class="btn btn-outline-danger   yes_btn"
							data-dismiss="modal"><?= lang('cancel') ?></button>

					<input type="hidden" name="group_id">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Delete modal End -->

<!-- Edit Group Modal  Start -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
	 aria-hidden="true" id="edit_group">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-secondary " style="border-radius: unset;">
				<h6 class="text-white modal-title dar"><?= lang('EditGroup') ?></h6>
			</div>
			<div class="body-m">
				<img style="height: 50px;margin: 0 auto;display: block;text-align: center;"
					 src="<?= base_url() ?>assets/images/bars.svg"/>
			</div>
		</div>
	</div>
</div>

<!--Edit Group Modal end -->

<!-- Create Group Modal  Start -->

<div class="modal fade bd-example-modal-lg add_group" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
	 aria-hidden="true">

	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-secondary " style="border-radius: unset;">
				<h5 class="modal-title text-white"><?= lang('create_group') ?></h5>
			</div>
			<div class="modal-body">
				<form id="group_add">
					<div class="form-group row">
						<div class="col-sm-1"></div>
						<label class="col-sm-3 col-form-label"><?= lang('company_name') ?></label>
						<div class="col-sm-7">
							<input name="title" type="text" class="form-control"
								   placeholder="<?= lang('company_name') ?>">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-1"></div>
						<label class="col-sm-3 col-form-label"><?= lang('more_info') ?></label>
						<div class="col-sm-7">
							<textarea name="description" type="text" class="form-control"
									  placeholder="<?= lang('more_info') ?>"></textarea>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-1"></div>
						<label class="col-sm-3 col-form-label"><?= lang('geofences') ?></label>
						<div class="col-sm-7 label_group">
							<select class="sell_group_select form-control form-control-sm col-sm-12 " name="geoference">
								<option selected value=""><?= lang('geofences') ?></option>
								<?
								foreach ($geoference as $val) {
									echo '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
								}
								?>
							</select>
						</div>
					</div>

					<input type="hidden" name="groups">
					<input type="hidden" name="token" value="<?= $this->session->token ?>">

				</form>
				<hr class="my-2">
				<div class="row mt-1 pl-5 pr-5">
					<input id="sb_s" type="text" class="form-control" placeholder="<?= lang('search') ?>"
						   aria-label="Search" aria-describedby="basic-addon2" style="width: 50%;margin: 3px;">
					<div class="col-sm-6 scroll_style"
						 style="border: 5px solid #00000040;max-height: 300px; min-height: 300px; overflow-y: scroll;">

						<ul style="list-style: decimal;" class="list-group lg_1 mt-1">
							<? foreach ($result_fleets as $row_fleet) : ?>
								<li data-id="<?= $row_fleet['id'] ?>" style="cursor: pointer"
									class="p-1 sel_items mt-1 list-group-item"><?= $row_fleet['brand_model'] . '  (' . $row_fleet['fleet_plate_number'] . ')' ?></li>
							<? endforeach; ?>
						</ul>
					</div>
					<div class="col-sm-1 text-center">

						<button class="save_cancel_btn btn btn-success mb-1 p-0 add_lg_2"
								style="margin-top: 100px;min-height: 30px !important;min-width: 35px !important;">
							<i style="font-size: 16px;" class="fas fa-long-arrow-alt-right"> </i>
						</button>

						<button class="save_cancel_btn btn btn-success p-0 remove_lg_2"
								style="min-height: 30px !important;min-width: 35px !important;">
							<i style="font-size: 16px;" class="fas fa-long-arrow-alt-left"> </i>
						</button>

					</div>
					<div class="col-sm-5 scroll_style"
						 style="border: 5px solid #00000040;max-height: 300px; min-height: 300px; overflow-y: scroll;">
						<ul class="list-group lg_2 mt-1"></ul>

					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button id="add_group" type="button"
						class="btn btn-outline-success cancel_btn"><?= lang('save') ?>
				</button>
				<button id="load" class="btn btn-sm btn-outline-success cancel_btn d-none">
					<img style="height: 20px;margin: 0 auto;display: block;text-align: center;"
						 src="<?= base_url() ?>assets/images/bars2.svg"/>
				</button>
				<button type="button" class="cancel_btn close btn btn-sm"
						data-dismiss="modal"
						aria-label="Close">
					<?= lang('cancel') ?>
				</button>
			</div>
		</div>
	</div>
</div>

<!-- Create Group Modal End -->




<!-- Delete Modal start -->
<div class="modal fade bd-example-modal-sm del_group_modal" tabindex="-1" role="dialog"
	 aria-labelledby="mySmallModalLabel"
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

<? foreach ($result2 as $name => $value) {
	foreach ($value as $id => $val) {
		?>

		<span class="geofences_coordinate" style="display:none;" data-gCoordinate="<?= implode(',', $val) ?>"></span>

		<?
	}
} ?>


<script>

	$('table tr th:nth-child(2)').click(function () {

		if (!$(this).hasClass('az')) {
			$(this).html('<i style="font-size: 12px !important;color: #000 !important;" class="fas fa-sort-alpha-down"></i>');
			$(this).addClass('az');
		} else {
			$(this).html('<i style="font-size: 12px !important;color: #000 !important;" class="fas fa-sort-alpha-up"></i>');
			$(this).removeClass('az');
		}
	});

	$('td input').each(function () {
		$(this).prop('checked', true);
	});
	$('.sel_all_checkbox').prop('checked', true);

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
			"targets": [0, 2, 3, 4, 5, 6, 7, 8, 9],
			"orderable": false
		}],
		dom: 'Bfrtip',
		buttons: [
			'colvis'
		],
		"bPaginate": false,
		"paging": false,
		"order": [[1, "desc"]]
	});
	table.buttons().container().appendTo('#example11_wrapper #example11_filter:eq(0)');
	$(document).on('click', '.sel_items', function () {
		if ($(this).hasClass('bg-info')) {
			$(this).removeClass('bg-info text-white');
		} else {
			$(this).addClass('bg-info text-white')
		}
	});

	$('select[name="group"]').on('change', function () {
		$(this).children('option:selected').each(function () {
			if ($(this).val() != 'all_val') {
				table.search($(this).text().replace("✓", "")).draw();
			} else {
				table.search('').draw();
			}
		})
	});
	$(document).on('click', '.added_lg_2', function () {
		array = [];
		if ($(this).hasClass('bg-info')) {
			$(this).removeClass('bg-info text-white');
		} else {
			$(this).addClass('bg-info text-white');
		}
		$('.added_lg_2').each(function () {
			if ($(this).hasClass('bg-info')) {
				arr = {
					'key': $(this).data('key'),
					'name': $(this).text()
				};
				array.push(arr)
			}
		});
	});


	$(document).on('click', '.add_lg_2', function () {
		$('.sel_items').each(function () {
			if ($(this).hasClass('bg-info')) {
				$('.lg_2').append(this);
				$(this).addClass('added_lg_2');
				$(this).remove('.list-group');
				$(this).removeClass('bg-info text-white sel_items');
			}
		});

		// group input
		var group = '';

		$('.lg_2  li').each(function (e) {
			group += $(this).data('id') + ','
		});

		var groups = group.substring(0, group.length - 1);
		$('input[name="groups"]').val(groups);

		// end group input
		//$('.select_all').prop('checked', false);
	});
	$(document).on('click', '.remove_lg_2', function () {
		$('.added_lg_2').each(function () {
			if ($(this).hasClass('bg-info')) {
				$('.lg_1').append(this);
				$(this).remove('.lg_2');
				$(this).removeClass('bg-info text-white added_lg_2');
				$(this).addClass('sel_items');
				$('#nav-tabContent-car').remove();
				$('.tab-pane').children('form').remove();
			}
		});
		// group input

		var group = '';

		$('.lg_2  li').each(function (e) {
			group += $(this).data('id') + ','
		});

		var groups = group.substring(0, group.length - 1);
		$('input[name="groups"]').val(groups);

		// end group input
		//$('.select_all_2').prop('checked', false);
	});
	$('.select_all').on('change', function () {
		if ($('.select_all').is(':checked')) {
			$('.sel_items').addClass('bg-info text-white')
		} else {
			$('.sel_items').removeClass('bg-info text-white');
		}
	});
	$('.delete_all').click(function () {
		$('.sel_items').remove();
		//$('.lg_1').html('<h2 class="text-center" style="opacity: .4;color: gray;margin-top: 40%;" ><?//=lang('select_fleets_from_list')?>//</h2>');
	});
	$('.select_all_2').on('change', function () {
		if ($('.select_all_2').is(':checked')) {
			$('.added_lg_2').each(function () {
				if (!$(this).hasClass('bg-info text-white')) {
					$(this).trigger('click');
				}
			});
		} else {
			$('.added_lg_2').each(function () {
				if ($(this).hasClass('bg-info text-white')) {
					$(this).trigger('click');
				}
			});
		}
	});
	$('.delete_all_2').click(function () {
		$('.added_lg_2').remove();
		$('#nav-tabContent-car').remove();
		$('.tab-pane').children('form').remove();
		//$('.lg_2').html('<h2 class="text-center" style="opacity: .4;color: gray;margin-top: 40%;" ><?//=lang('move_here_to_see_the_costs')?>//</h2>')
	});
	$(function () {
		$('#sb_s').keyup(function () {
			var val = $(this).val().toLowerCase();
			$(".sel_items ").hide();
			$(".sel_items").each(function () {
				var text = $(this).text().toLowerCase();
				if (text.indexOf(val) != -1) {
					$(this).show();
				}
			});
		});
	});
	$(function () {
		$('#sb_s2').keyup(function () {
			var val = $(this).val().toLowerCase();
			$('.added_lg_2').hide();
			$('.added_lg_2').each(function () {
				var text = $(this).text().toLowerCase();
				if (text.indexOf(val) != -1) {
					$(this).show();
				}
			});
		});
	});
	$(document).on('click', '.fleets_ul li', function () {
		$(this).toggleClass('fleets_ul_active');
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

			var myMap_show_all_cars_onChange = new ymaps.Map("map", {
				center: [55.76, 37.64],
				zoom: 2
			}, {suppressMapOpenBlock: true});

			firstButton = new ymaps.control.Button({
				data: {
					content: "<i style='font-size: 20px;' class='fas fa-draw-polygon'></i>"
				},
				options: {
					selectOnClick: true
				}
			});
			myMap_show_all_cars_onChange.controls.add(firstButton, {float: 'right'});


			//Click Function Show All Geofences
			firstButton.events.add(['select', 'deselect'], function (e) {

				if (e.get('type') == 'select') {
					$('.geofences_coordinate').each(function () {

						geoObject_coordinates = $(this).attr('data-gCoordinate');
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

						myMap_show_all_cars_onChange.geoObjects.add(myPolygon);
						myMap_show_all_cars_onChange.controls.add(new ymaps.control.ZoomControl());
						myMap_show_all_cars_onChange.setBounds(myMap_show_all_cars_onChange.geoObjects.getBounds());

					});

					myMap_show_all_cars_onChange.container.fitToViewport()

				} else {
					$('#map').html('');
					ymaps.ready(init_all);
				}


			});
			address_arr = [];

			//<?//=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()).'/edit_vehicles/'.$row['id'])?>//">

			$('.show_car').each(function () {
				if ($(this).parent('tr').children('td:first-child').children('input').is(':checked')) {

					coordinate = $(this).data('coordinate');

					console.log(coordinate)
					course = $(this).data('course');
					array = JSON.parse("[" + coordinate + "]");

					var carCoordinate = '';
					latitude = array[0];
					longitude = array[1];

					ymaps.geocode(coordinate).then(function (res) {
						var firstGeoObject = res.geoObjects.get(0);
						address_arr.push(firstGeoObject.getAddressLine());

					});

					MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
						'<div style="color: #000000; font-weight: bold;">$[properties.iconContent]</div>'
					),

						myPlacemarkWithContent = new ymaps.Placemark([latitude, longitude], {
							balloonContentHeader: "<p><?=lang('basic_information')?></p>",
							balloonContentBody: "<p class='mb-0'><?=lang('object')?>:<span class='ml-1'><a href='<?=$this->load->old_baseUrl().$lng.'/edit_vehicles/'?>"+$(this).data('id')+"' target='_blank' >" + $(this).parent('tr').children('td:nth-child(2)').children('.car_model').text() + "</a></span></p>" +
								"<p class='mb-0'><?=lang('license_plate')?>:<span class='ml-1 car_number'>" + $(this).parent('tr').children('td:nth-child(2)').children('small').text() + "</span></p>" +
								"<p class='mb-0'><?=lang('message_time')?>:<span class='ml-1'>" + $(this).parent('tr').children('.last_time_update').text() + "</span></p>" +
								"<p class='mb-0'><?=lang('speed')?><span class='ml-1'>55 km/h</span></p>" +
								"<p class='mb-0'><?=lang('engine')?>:<span class='ml-1 bg-success' style='display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;'></span></p>" +
								"<p class='mb-0'><?=lang('driver')?>: <span class='ml-1'>" + $(this).parent('tr').children('.staff_span').children('span').text() + "</span></p>" +
								"<p class='mb-0'><?=lang('fuel')?>:<span class='ml-1'>25ll</span></p>",
							balloonContentFooter: "<p class='mb-0 pb-3' style='color: #000 !important;    margin-top: -7px !important;'><?=lang('place')?>:<span id='address' class='ml-1 place_span' style='color: #000 !important;'></span></p>"
						}, {
							iconLayout: ymaps.templateLayoutFactory.createClass([
								'<div style="transform:rotate({{options.rotate}}deg);">',
								'{% include "default#image" %}',
								'</div>'
							].join('')),
							iconImageHref: '<?= base_url() ?>assets/images/ymap/car.svg',
							iconImageSize: [35, 30],
							iconImageOffset: [-10, -35],
							iconRotate: course,
							iconShape: {
								type: 'Circle',
								coordinates: [0, 0],
								radius: 25
							}
						});

					myPlacemarkWithContent.events.add('balloonopen', function (e) {
						var car_number = $('.car_number').text();
						console.log(car_number);
						$('td small').each(function () {
							if($(this).text() == car_number){
								var get_address = $(this).parent('td').parent('tr').children('.address_span').text();
								$('.place_span').text(get_address)
							}
						});
					});

					myMap_show_all_cars_onChange.geoObjects.add(myPlacemarkWithContent);
					myMap_show_all_cars_onChange.controls.add(new ymaps.control.ZoomControl());
					myMap_show_all_cars_onChange.setBounds(myMap_show_all_cars_onChange.geoObjects.getBounds());
				}
			});


			setTimeout(function () {
				var e = 0;
				$('.address_span').each(function () {
					//alert(address_arr[e]);
					$(this).html(address_arr[e]);
					e++;
				});
			}, 2500);

			var width_map = $('.panel-right').width() - $('.panel-left').width() - 4;
			$('#map > ymaps').css('width', width_map);
			$('#map > ymaps').css('overflow', 'scroll');


		}


		//Show Geozone from selectoption

		$(document).on('change', 'select[name="group"]', function () {

			$(this).children('option:selected').each(function () {

				geozone_coordinates = $(this).data('cordinate');

				if (geozone_coordinates !== undefined && geozone_coordinates != 'gago') {


					ymaps.ready(init_Geozone);

					function init_Geozone() {

						$('#map').html('');

						var myMap_show_init_Geozone = new ymaps.Map("map", {
							center: [55.76, 37.64],
							zoom: 2
						}, {suppressMapOpenBlock: true});


						array_stting = JSON.parse("[" + geozone_coordinates + "]");

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

						myMap_show_init_Geozone.geoObjects.add(myPolygon);
						myMap_show_init_Geozone.controls.add(new ymaps.control.ZoomControl());
						myMap_show_init_Geozone.setBounds(myMap_show_init_Geozone.geoObjects.getBounds());

						$('.show_car').each(function () {
							if ($(this).parent('tr').children('td:first-child').children('input').is(':checked')) {

								coordinate = $(this).data('coordinate')
								console.log(coordinate)
								course = $(this).data('course');
								array = JSON.parse("[" + coordinate + "]");

								var carCoordinate = '';

								latitude = array[0];
								longitude = array[1];
								// alert('2');
								MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
									'<div style="color: #000000; font-weight: bold;">$[properties.iconContent]</div>'
								),

									myPlacemarkWithContent = new ymaps.Placemark([latitude, longitude], {
										balloonContentHeader: "<p><?=lang('basic_information')?></p>",
										balloonContentBody: "<p class='mb-0'><?=lang('object')?>:<span class='ml-1'><a href='<?=$this->load->old_baseUrl() . $lng . '/edit_vehicles/'?>"+$(this).data('id')+"' target='_blank'>" + $(this).parent('tr').children('td:nth-child(2)').children('.car_model').text() + "</a></span></p>" +
											"<p class='mb-0'><?=lang('license_plate')?>:<span class='ml-1'>" + $(this).parent('tr').children('td:nth-child(2)').children('small').text() + "</span></p>" +
											"<p class='mb-0'><?=lang('message_time')?>:<span class='ml-1'>" + $(this).parent('tr').children('.last_time_update').text() + "</span></p>" +
											"<p class='mb-0'><?=lang('speed')?><span class='ml-1'>55 km/h</span></p>" +
											"<p class='mb-0'><?=lang('engine')?>:<span class='ml-1 bg-success' style='display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;'></span></p>" +
											"<p class='mb-0'><?=lang('driver')?>: <span class='ml-1'>" + $(this).parent('tr').children('.staff_span').children('span').text() + "</span></p>" +
											"<p class='mb-0'><?=lang('fuel')?>:<span class='ml-1'>25l</span></p>" +
											"<p class='mb-0'><?=lang('place')?>:<span class='ml-1'>" + $(this).parent('tr').children('.address_span').text() + "</span></p>",
										balloonContentFooter: ""
									}, {
										iconLayout: ymaps.templateLayoutFactory.createClass([
											'<div style="transform:rotate({{options.rotate}}deg);">',
											'{% include "default#image" %}',
											'</div>'
										].join('')),
										iconImageHref: '<?= base_url() ?>assets/images/ymap/car.svg',
										iconImageSize: [35, 30],
										iconImageOffset: [-10, -35],
										iconRotate: course,
										iconShape: {
											type: 'Circle',
											coordinates: [0, 0],
											radius: 25
										}
									});

								myMap_show_init_Geozone.geoObjects.add(myPlacemarkWithContent);
								myMap_show_init_Geozone.controls.add(new ymaps.control.ZoomControl());
								myMap_show_init_Geozone.setBounds(myMap_show_init_Geozone.geoObjects.getBounds());
							}
						});

						var width_map = $('.panel-right').width() - $('.panel-left').width() - 4;
						$('#map > ymaps').css('width', width_map);
						$('#map > ymaps').css('overflow', 'scroll');
					}

				} else {
					ymaps.ready(init_Geozone2);

					function init_Geozone2() {

						$('#map').html('');

						var myMap_show_init_Geozone = new ymaps.Map("map", {
							center: [55.76, 37.64],
							zoom: 2
						}, {suppressMapOpenBlock: true});



						$('.show_car').each(function () {

							if ($(this).parent('tr').children('td:first-child').children('input').is(':checked')) {

								coordinate = $(this).data('coordinate');
								console.log(coordinate);
								course = $(this).data('course');
								course = $(this).data('course');

								array = JSON.parse("[" + coordinate + "]");

								var carCoordinate = '';

								latitude = array[0];
								longitude = array[1];

								MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
									'<div style="color: #000000; font-weight: bold;">$[properties.iconContent]</div>'
								),

									myPlacemarkWithContent = new ymaps.Placemark([latitude, longitude], {
										balloonContentHeader: "<p><?=lang('basic_information')?></p>",
										balloonContentBody: "<p class='mb-0'><?=lang('object')?>:<span class='ml-1'><a href='<?=$this->load->old_baseUrl() . $lng . '/edit_vehicles/'?>"+$(this).data('id')+"' target='_blank'>" + $(this).parent('tr').children('td:nth-child(2)').children('.car_model').text() + "</a></span></p>" +
											"<p class='mb-0'><?=lang('license_plate')?>:<span class='ml-1'>" + $(this).parent('tr').children('td:nth-child(2)').children('small').text() + "</span></p>" +
											"<p class='mb-0'><?=lang('message_time')?>:<span class='ml-1'>" + $(this).parent('tr').children('.last_time_update').text() + "</span></p>" +
											"<p class='mb-0'><?=lang('speed')?><span class='ml-1'>55 km/h</span></p>" +
											"<p class='mb-0'><?=lang('engine')?>:<span class='ml-1 bg-success' style='display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;'></span></p>" +
											"<p class='mb-0'><?=lang('driver')?>: <span class='ml-1'>" + $(this).parent('tr').children('.staff_span').children('span').text() + "</span></p>" +
											"<p class='mb-0'><?=lang('fuel')?>:<span class='ml-1'>25l</span></p>" +
											"<p class='mb-0'><?=lang('place')?>:<span class='ml-1'>" + $(this).parent('tr').children('.address_span').text() + "</span></p>",
										balloonContentFooter: ""
									}, {
										iconLayout: ymaps.templateLayoutFactory.createClass([
											'<div style="transform:rotate({{options.rotate}}deg);">',
											'{% include "default#image" %}',
											'</div>'
										].join('')),
										iconImageHref: '<?= base_url() ?>assets/images/ymap/car.svg',
										iconImageSize: [35, 30],
										iconImageOffset: [-10, -35],
										iconRotate: course,
										iconShape: {
											type: 'Circle',
											coordinates: [0, 0],
											radius: 25
										}
									});


								myMap_show_init_Geozone.geoObjects.add(myPlacemarkWithContent);
								myMap_show_init_Geozone.controls.add(new ymaps.control.ZoomControl());
								myMap_show_init_Geozone.setBounds(myMap_show_init_Geozone.geoObjects.getBounds(), {checkZoomRange: true});
							}
						});


						var width_map = $('.panel-right').width() - $('.panel-left').width() - 4;
						$('#map > ymaps').css('width', width_map);
						$('#map > ymaps').css('overflow', 'scroll');
					}
				}

			});

		});


		/* On Click Function Show single Car On Map */

		$('.show_car').click(function () {
			car_name = $(this).parent('tr').children('td:nth-child(2)').children('.car_model').text();
			car_nummber = $(this).parent('tr').children('td:nth-child(2)').children('small').text();
			massage_time = $(this).parent('tr').children('.last_time_update').text();
			driver_name = $(this).parent('tr').children('.staff_span').children('span').text();
			current_address = $(this).parent('tr').children('.address_span').text();
			data_id = $(this).data('id');

			$('#map').html('');

			coordinate = $(this).data('coordinate');
			course = $(this).data('course');
			array = JSON.parse("[" + coordinate + "]");
			ymaps.ready(init_singleCar(array));

			function init_singleCar(array) {
				var myMap_show_singleCar = new ymaps.Map("map", {
					center: [45.8989, 54.56566565],
					zoom: 2
				}, {suppressMapOpenBlock: true});
				var carCoordinate = '';

				firstButton = new ymaps.control.Button({
					data: {
						content: "<i style='font-size: 20px;' class='fas fa-draw-polygon'></i>"
					},
					options: {
						selectOnClick: true
					}
				});
				myMap_show_singleCar.controls.add(firstButton, {float: 'right'});

				//Click Function Show All Geofences
				firstButton.events.add(['select', 'deselect'], function (e) {

					if (e.get('type') == 'select') {
						$('.geofences_coordinate').each(function () {

							geoObject_coordinates = $(this).attr('data-gCoordinate');
							array_stting = JSON.parse("[" + geoObject_coordinates + "]");

							var rand_color = '#' + (function co(lor) {
								return (lor += [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f'][Math.floor(Math.random() * 16)]) && (lor.length == 6) ? lor : co(lor);
							})('') + '75';

							myPolygon = new ymaps.Polygon([
								array_stting
							], {}, {
								editorDrawingCursor: "crosshair",
								fillColor: rand_color,
								strokeColor: rand_color,
								strokeWidth: 2
							});

							myMap_show_singleCar.geoObjects.add(myPolygon);
							myMap_show_singleCar.controls.add(new ymaps.control.ZoomControl());
							myMap_show_singleCar.setBounds(myMap_show_singleCar.geoObjects.getBounds());

						});

					} else {
						$('.show_car').each(function () {
							if (coordinate == $(this).data('coordinate')) {
								$(this).trigger('click')
							}
						})
					}
				});

				latitude = array[0];
				longitude = array[1];

				MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
					'<div style="color: #000000; font-weight: bold;">$[properties.iconContent]</div>'
				),

					myPlacemarkWithContent = new ymaps.Placemark([latitude, longitude], {
						balloonContentHeader: "<p><?=lang('basic_information')?></p>",
						balloonContentBody: "<p class='mb-0'><?=lang('object')?>:<span class='ml-1'><a href='<?=$this->load->old_baseUrl() . $lng . '/edit_vehicles/'?>"+data_id+"' target='_blank'>" + car_name + "</a></span></p>" +
							"<p class='mb-0'><?=lang('license_plate')?>:<span class='ml-1'>" + car_nummber + "</span></p>" +
							"<p class='mb-0'><?=lang('message_time')?>:<span class='ml-1'>" + massage_time + "</span></p>" +
							"<p class='mb-0'><?=lang('speed')?><span class='ml-1'>55 km/h</span></p>" +
							"<p class='mb-0'><?=lang('engine')?>:<span class='ml-1 bg-success' style='display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;'></span></p>" +
							"<p class='mb-0'><?=lang('driver')?>: <span class='ml-1'>" + driver_name + "</span></p>" +
							"<p class='mb-0'><?=lang('fuel')?>:<span class='ml-1'>25l</span></p>" +
							"<p class='mb-0'><?=lang('place')?>:<span class='ml-1'>" + current_address + "</span></p>",
						balloonContentFooter: ""
					}, {
						iconLayout: ymaps.templateLayoutFactory.createClass([
							'<div style="transform:rotate({{options.rotate}}deg);">',
							'{% include "default#image" %}',
							'</div>'
						].join('')),
						iconImageHref: '<?= base_url() ?>assets/images/ymap/car.svg',
						iconImageSize: [35, 30],
						iconImageOffset: [-10, -35],
						iconRotate: course,
						iconShape: {
							type: 'Circle',
							coordinates: [0, 0],
							radius: 25
						}
					});

				myMap_show_singleCar.geoObjects.add(myPlacemarkWithContent);
				myMap_show_singleCar.controls.add(new ymaps.control.ZoomControl());
				myMap_show_singleCar.setBounds(myMap_show_singleCar.geoObjects.getBounds(), {checkZoomRange: true});

				var width_map = $('.panel-right').width() - $('.panel-left').width() - 4;
				$('#map > ymaps').css('width', width_map);
				$('#map > ymaps').css('overflow', 'scroll');
			}


		});


		/* On Change checkbox  */

		$('tr td input , th input').on('change', function () {
			$('#map').html('');
			ymaps.ready(init_all);

			function init_all() {
				var myMap_show_all_cars = new ymaps.Map("map", {
					center: [55.76, 37.64],
					zoom: 2
				}, {suppressMapOpenBlock: true});

				firstButton = new ymaps.control.Button("<i style='font-size: 20px;' class='fas fa-draw-polygon'></i>");
				myMap_show_all_cars.controls.add(firstButton, {float: 'right'});


				//Click Function Show All Geofences
				firstButton.events.add(['select', 'deselect'], function (e) {
					if (e.get('type') == 'select') {
						$('.geofences_coordinate').each(function () {

							geoObject_coordinates = $(this).attr('data-gCoordinate');
							array_stting = JSON.parse("[" + geoObject_coordinates + "]");

							var rand_color = '#' + (function co(lor) {
								return (lor += [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f'][Math.floor(Math.random() * 16)]) && (lor.length == 6) ? lor : co(lor);
							})('') + '75';

							myPolygon = new ymaps.Polygon([
								array_stting
							], {}, {
								editorDrawingCursor: "crosshair",
								fillColor: rand_color,
								strokeColor: rand_color,
								strokeWidth: 2
							});

							myMap_show_all_cars.geoObjects.add(myPolygon);
							myMap_show_all_cars.controls.add(new ymaps.control.ZoomControl());
							myMap_show_all_cars.setBounds(myMap_show_all_cars.geoObjects.getBounds());

						});
					} else {
						$('#map').html('');

						ymaps.ready(init_all);

						function init_all() {
							var myMap_show_all_cars = new ymaps.Map("map", {
								center: [55.76, 37.64],
								zoom: 2
							}, {suppressMapOpenBlock: true});


							$('.show_car').each(function () {

								if ($(this).parent('tr').children('td:first-child').children('input').is(':checked')) {

									coordinate = $(this).data('coordinate');
									course = $(this).data('course');
									array = JSON.parse("[" + coordinate + "]");

									var carCoordinate = '';

									latitude = array[0];
									longitude = array[1];

									MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
										'<div style="color: #000000; font-weight: bold;">$[properties.iconContent]</div>'
									),

										myPlacemarkWithContent = new ymaps.Placemark([latitude, longitude], {
											balloonContentHeader: "<p><?=lang('basic_information')?></p>",
											balloonContentBody: "<p class='mb-0'><?=lang('object')?>:<span class='ml-1'><a href='<?=$this->load->old_baseUrl() . $lng . '/edit_vehicles/'?>"+$(this).data('id')+"' target='_blank'>" + $(this).parent('tr').children('td:nth-child(2)').children('.car_model').text() + "</a></span></p>" +
												"<p class='mb-0'><?=lang('license_plate')?>:<span class='ml-1'>" + $(this).parent('tr').children('td:nth-child(2)').children('small').text() + "</span></p>" +
												"<p class='mb-0'><?=lang('message_time')?>:<span class='ml-1'>" + $(this).parent('tr').children('.last_time_update').text() + "</span></p>" +
												"<p class='mb-0'><?=lang('speed')?><span class='ml-1'>55 km/h</span></p>" +
												"<p class='mb-0'><?=lang('engine')?>:<span class='ml-1 bg-success' style='display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;'></span></p>" +
												"<p class='mb-0'><?=lang('driver')?>: <span class='ml-1'>" + $(this).parent('tr').children('.staff_span').children('span').text() + "</span></p>" +
												"<p class='mb-0'><?=lang('fuel')?>:<span class='ml-1'>25l</span></p>" +
												"<p class='mb-0'><?=lang('place')?>:<span class='ml-1'>" + $(this).parent('tr').children('.address_span').text() + "</span></p>",
											balloonContentFooter: ""
										}, {
											iconLayout: ymaps.templateLayoutFactory.createClass([
												'<div style="transform:rotate({{options.rotate}}deg);">',
												'{% include "default#image" %}',
												'</div>'
											].join('')),
											iconImageHref: '<?= base_url() ?>assets/images/ymap/car.svg',
											iconImageSize: [35, 30],
											iconImageOffset: [-10, -35],
											iconRotate: course,
											iconShape: {
												type: 'Circle',
												coordinates: [0, 0],
												radius: 25
											}
										});

									myMap_show_all_cars.geoObjects.add(myPlacemarkWithContent);
									myMap_show_all_cars.controls.add(new ymaps.control.ZoomControl());
									myMap_show_all_cars.setBounds(myMap_show_all_cars.geoObjects.getBounds(), {checkZoomRange: true});
								}
							});
						}
					}
				});


				$('.show_car').each(function () {
					if ($(this).parent('tr').children('td:first-child').children('input').is(':checked')) {

						coordinate = $(this).data('coordinate');
						course = $(this).data('course');
						array = JSON.parse("[" + coordinate + "]");

						var carCoordinate = '';

						latitude = array[0];
						longitude = array[1];

						MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
							'<div style="color: #000000; font-weight: bold;">$[properties.iconContent]</div>'
						),

							myPlacemarkWithContent = new ymaps.Placemark([latitude, longitude], {
								balloonContentHeader: "<p><?=lang('basic_information')?></p>",
								balloonContentBody: "<p class='mb-0'><?=lang('object')?>:<span class='ml-1'><a href='<?=$this->load->old_baseUrl() . $lng . '/edit_vehicles/'?>"+$(this).data('id')+"' target='_blank'>" + $(this).parent('tr').children('td:nth-child(2)').children('.car_model').text() + "</a></span></p>" +
									"<p class='mb-0'><?=lang('license_plate')?>:<span class='ml-1'>" + $(this).parent('tr').children('td:nth-child(2)').children('small').text() + "</span></p>" +
									"<p class='mb-0'><?=lang('message_time')?>:<span class='ml-1'>" + $(this).parent('tr').children('.last_time_update').text() + "</span></p>" +
									"<p class='mb-0'><?=lang('speed')?><span class='ml-1'>55 km/h</span></p>" +
									"<p class='mb-0'><?=lang('engine')?>:<span class='ml-1 bg-success' style='display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;'></span></p>" +
									"<p class='mb-0'><?=lang('driver')?>: <span class='ml-1'>" + $(this).parent('tr').children('.staff_span').children('span').text() + "</span></p>" +
									"<p class='mb-0'><?=lang('fuel')?>:<span class='ml-1'>25l</span></p>" +
									"<p class='mb-0'><?=lang('place')?>:<span class='ml-1'>" + $(this).parent('tr').children('.address_span').text() + "</span></p>",
								balloonContentFooter: ""
							}, {
								iconLayout: ymaps.templateLayoutFactory.createClass([
									'<div style="transform:rotate({{options.rotate}}deg);">',
									'{% include "default#image" %}',
									'</div>'
								].join('')),
								iconImageHref: '<?= base_url() ?>assets/images/ymap/car.svg',
								iconImageSize: [35, 30],
								iconImageOffset: [-10, -35],
								iconRotate: course,
								iconShape: {
									type: 'Circle',
									coordinates: [0, 0],
									radius: 25
								}
							});

						myMap_show_all_cars.geoObjects.add(myPlacemarkWithContent);
						myMap_show_all_cars.controls.add(new ymaps.control.ZoomControl());
						myMap_show_all_cars.setBounds(myMap_show_all_cars.geoObjects.getBounds(), {checkZoomRange: true});
					}
				});

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

	$(document).on('click', '.fas.fa-ellipsis-v', function () {
		$('.btn.btn-secondary.buttons-collection.dropdown-toggle.buttons-colvis').trigger('click')

		$('.dt-button.dropdown-item.buttons-columnVisibility:nth-child(4)').css('display', 'none');
		$('.dt-button.dropdown-item.buttons-columnVisibility:nth-child(1)').css('display', 'none');

	});

	// add group
	$(document).on('click', '#add_group', function (e) {

		var url = '<?=$this->load->old_baseUrl() . (($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/add_group_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#group_add')[0]);

		$('input').removeClass('border border-danger');
		$('input').parent('td').removeClass('border border-danger');
		$('select').removeClass('border border-danger');
		$('ul.list-group.lg_2').parent('div').removeClass('border-5 border-danger');
		loading('start', 'add_group');

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
				close_message();
				loading('start', 'add_group');
				$('.alert-info').removeClass('d-none');
				$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');

			},
			success: function (data) {
				if (data.success == '1') {
					close_message();
					$('.alert-success').removeClass('d-none');
					$('.alert-success').text(data.message);
					loading('stop', 'add_group');
					var url = "<?=current_url()?>";
					$(location).attr('href', url);
				} else {
					close_message();
					loading('stop', 'add_group');

					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'add_group');
						errors = '';
						tmp = '';
						$.each(data.error.elements, function (index) {
							$.each(data.error.elements[index], function (index, value) {
								if (value != '') {
									$('input[name="' + index + '"]').addClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').children('button').addClass('border border-danger');
									close_message();
									$('.alert-danger').removeClass('d-none');

									if (index == 'groups') {
										$('ul.list-group.lg_2').parent('div').addClass('border-5 border-danger');
									}

									if (value != tmp) {
										errors += value;
									}
									tmp = value;

								} else {
									$('input[name="' + index + '"]').removeClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').children('button').removeClass('border border-danger');
									$('ul.list-group.lg_2').parent('div').removeClass('border-5 border-danger');
								}
							});
						});
					}

					$('.alert-danger').html(errors);

				}
			},
			error: function (jqXHR, textStatus) {
				// Handle errors here
				$('p#success').addClass('d-none');
				console.log('ERRORS: ' + textStatus);
			},
			complete: function () {

			}
		});
	});

	// get edit modal
	$(document).on('click', '#edit_group_modal', function () {
		var url = '<?=$this->load->old_baseUrl() . (($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/edit_group_modal_ax/')?>' + $('select[name="group"] option:selected').data('id') + '/<?=$this->session->token?>';
		$.get(url, function (result) {
			// update modal content
			$('.body-m').html(result);

			var select = $('#geoference');


			select.clone().appendTo('#gro').addClass('clone');
			$('.clone').removeClass('d-none');

			var geoference_id = $('input[name="geoference_id"]').val();


			$.each($('.clone').children('option'), function (e) {
				if ($(this).val() == geoference_id) {
					$(this).prop('selected', true);
				}
			});

			// show modal
			$('#myModal').modal('show');
		});
	});


	$(document).on('click', '#edit_group_btn', function (e) {
		var url = '<?=$this->load->old_baseUrl() . (($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/edit_group_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#group_edit')[0]);

		$('input').removeClass('border border-danger');
		$('input').parent('td').removeClass('border border-danger');
		$('select').removeClass('border border-danger');

		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function () {
				loading('start', 'edit_group_btn');
			},
			success: function (data) {
				if (data.success == '1') {
					loading('stop', 'edit_group_btn');
					var url = "<?=current_url()?>";
					$(location).attr('href', url);
				} else {
					close_message();
					loading('stop', 'edit_group_btn');
					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'edit_group_btn');
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
										errors += value;
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
				$('p#success').addClass('d-none');
				console.log('ERRORS: ' + textStatus);
			},
			complete: function () {
			}
		});
	});


	$(document).on('click', '.delete_btn', function () {
		group_id = $('select[name="group"] option:selected').data('id');
		$('input[name="group_id"]').val(group_id);
	});
	$(document).on('click', '#delete_group', function () {
		var id = $('input[name="group_id"]').val();
		var url = '<?=$this->load->old_baseUrl() . (($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/delete_group/')?>';

		$.post(url, {group_id, id}, function (result) {
			location.reload();
		});
	});


	var dataTable_label = $('.dataTables_filter label').text();
	$('.dataTables_filter input').attr('placeholder', dataTable_label);

	var elem = $('.dataTables_filter label');
	// $(elem).html($(elem).html().replace($(elem).text(), ''));
</script>

<script>
	$(document).ready(function () {
		($('.sell_group_select').val() == 'all_val') ? $('.delete_btn').css('display', 'none') : $('.delete_btn').css('display', 'inline-block');
		$('.sell_group_select').on('change', function () {
			($(this).val() == 'all_val') ? $('.delete_btn').css('display', 'none') : $('.delete_btn').css('display', 'inline-block');
		});

		$('.dt-buttons.btn-group').append('<i style="cursor: pointer;" class="fas fa-ellipsis-v ml-2"></i>');

	});

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


				if ($('.panel-left').width() <= 565) {
					$('input[type=search]').css('display', 'none');
					$('.tools_div').removeClass('col-sm-2');
					$('.tools_div').addClass('col-sm-3');
					$('.car_icon').removeClass('col-sm-2');
					$('.car_icon').addClass('col-sm-3');
					$('i.fas.fa-ellipsis-v.ml-2').css('display', 'none')
				} else {
					$('input[type=search]').css('display', 'inline-block');
					$('.tools_div').removeClass('col-sm-3');
					$('.tools_div').addClass('col-sm-2');
					$('.car_icon').addClass('col-sm-2');
					$('.car_icon').removeClass('col-sm-3');
					$('i.fas.fa-ellipsis-v.ml-2').css('display', 'block')
				}

				if ($('.panel-left').width() <= 374) {
					$('.label_group').css('display', 'none');
					$('.tools_div').css('display', 'none');
					$('.car_icon').removeClass('col-sm-2');
					$('.car_icon').addClass('col-sm-7');
				} else {
					$('.label_group').css('display', 'block');
					$('.tools_div').css('display', 'block');
					$('.car_icon').addClass('col-sm-2');
					$('.car_icon').removeClass('col-sm-7');
				}

			}
		}
//ddddddd
	});

	$(window).on('load', function () {
		var width_map = $('.panel-right').width() - $('.panel-left').width() - 4;
		$('#map > ymaps').css('width', width_map);
		$('#map > ymaps').css('overflow', 'scroll');
	})

	$(document).on('change', 'select[name="group"]', function () {
		if ($(this).children('option:selected').data('default') == '2') {
			$('button.custom_fas_trash_btn.btn.btn-sm.btn-outline-secondary.delete_btn').hide();
		} else {
			$('button.custom_fas_trash_btn.btn.btn-sm.btn-outline-secondary.delete_btn').show();
		}

		$('.count_cars_in_table').html($('#total').text())
	});

	$(document).on('keyup', 'input[type="search"]', function () {
		$('.count_cars_in_table').html($('#total').text())
	});

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

<select class="sell_group_select form-control form-control-sm col-sm-12 d-none" name="geoference" id="geoference">
	<option selected value=""><?= lang('geofences') ?></option>
	<?
	foreach ($geoference as $val) {
		echo '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
	}
	?>

</select>


<script>
	var fleet_ids =[];
	$('.show_car').each(function () {
		fleet_ids.push($(this).data('imei'));
	});

	setInterval(function () {
		var url = '<?=base_url() . (($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Gps/changDataCoordinate/')?>';

		$.post(url, {fleets: fleet_ids}, function (result) {

			$.each(JSON.parse(result), function (e, val) {
				$('.show_car').each(function () {

						if(e == $(this).data('imei')) {
							$(this).attr('data-coordinate',  val.lat+', '+val.long);
							$(this).addClass('changed');
						}

				});
			})

		});
	}, 10000)

</script>
