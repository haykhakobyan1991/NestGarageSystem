<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/structure1.css"/>
<!-- Structure Start -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!--[if lt IE 9]>
<script src="https://code.highcharts.com/modules/oldie.js"></script>
<![endif]-->


<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.buttons.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jszip.min.js') ?>"></script>
<!--<script type="text/javascript" src="--><? //=base_url('assets/js/dataTables//vfs_fonts.js')?><!--"></script>-->
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.html5.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.colVis.min.js') ?>"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<?
$time = strtotime(mdate('%Y-%m-%d', now()));
?>

<style>
	.row.bg-secondary {
		min-height: 194px;
	}

	.modal {
		top: 20% !important;
	}

	.settings_btn, .print-btn:hover, .settings_btn, .print-btn:focus, .plus_btn:hover, .plus_btn:focus, .set_btn:hover, .set_btn:focus, .delete_btn:focus, .delete_btn:hover {
		border: none !important;
		outline: none !important;
		cursor: pointer;
		background: #fff !important;
	}

	.settings_btn, .print-btn, .plus_btn, .set_btn, .delete_btn {
		border: none !important;
		outline: none !important;
		cursor: pointer;
	}


	.dataTables_scrollBody::-webkit-scrollbar,
	.col-sm-6.scroll_style::-webkit-scrollbar,
	.col-sm-5.scroll_style::-webkit-scrollbar {
		width: .25em;
	}
	.dataTables_scrollBody::-webkit-scrollbar-track,
	.col-sm-6.scroll_style::-webkit-scrollbar-track,
	.col-sm-5.scroll_style::-webkit-scrollbar-track {
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	}
	.dataTables_scrollBody::-webkit-scrollbar-thumb,
	.col-sm-6.scroll_style::-webkit-scrollbar-thumb,
	.col-sm-5.scroll_style::-webkit-scrollbar-thumb {
		background-color: darkgrey;outline: 1px solid slategrey;
	}

</style>


<div id="add-info">


	<hr class="my-2">

	<div class="container-fluid" style="min-height: 35px;">


		<div style="float: right">
			<span class="p-3"><?= lang('from') ?></span>
			<input title="" type="date" value="<?= date("Y-m-d", strtotime("-1 month", $time)); ?>" name="from"
				   style="border: 1px solid silver;padding: 4px 2px 4px 10px;border-radius: 5px;"/>

			<span class="p-3"><?= lang('to') ?></span>
			<input title="" type="date" value="<?= mdate('%Y-%m-%d', now()) ?>" name="to"
				   style="border: 1px solid silver;padding: 4px 2px 4px 10px;;border-radius: 5px;"/>

			<button style="min-width: 94px;font-size: 14px !important;
		line-height: 14px !important;
		padding: 10px 24px !important;
		font-weight: 500 !important;margin-top: -4px;min-height: 37px !important;" type="button" id="search"
					class="ml-2 save_cancel_btn btn btn-success"><?= lang('see') ?>
			</button>
		</div>


	</div>

	<hr class="my-2">


	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div id="container" style="width:100%; height:auto;"></div>
			</div>
		</div>

		<hr class="my-2">


		<div id="group" class="d-none" style="position: absolute; left: 20%; ">
			<span class="p-3"><?= lang('group') ?></span>
			<select title="<?= lang('group') ?>"
					name="group"
					style="border: 1px solid silver;padding: 4px 2px 4px 10px;border-radius: 5px;"
					class="selectpicker">
				<option selected value=""><?= lang('all1') ?></option>
				<? foreach ($result as $row) { ?>
					<option data-id="<?= $row['group_id']?>" value="<?= $row['fleet_id'] ?>"><?= $row['title'] ?></option>
				<? } ?>
			</select>

			<button class="btn btn-sm btn-outline-secondary plus_btn mr-3"
					data-toggle="modal" data-target=".add_group"
					style="width: 20px;padding: 2px !important;"><img
					style="margin-right: 5px;margin-left: -15px;"
					src="<?= base_url() ?>assets/images/gps_tracking/plus-black-symbol.svg"
					class="ml-0 mr-0 "/></button>
			<button class="btn btn-sm btn-outline-secondary set_btn mr-3"
					id="edit_group_modal"
					data-toggle="modal"
					data-target="#edit_group"
					data-toggle2="tooltip"
					data-placement="top"
					style="width: 20px;padding: 2px !important;"><img
					style="margin-right: 5px;margin-left: -15px;"
					src="<?= base_url() ?>assets/images/gps_tracking/settings-work-tool.svg"
					class="ml-0 mr-0 "/></button>
			<button class="btn btn-sm btn-outline-secondary delete_btn" data-toggle="modal" data-target=".del_group_modal"
					style="width: 20px;padding: 2px !important;"><img
					style="margin-right: 5px;margin-left: -15px;"
					src="<?= base_url() ?>assets/images/gps_tracking/delete.svg"
					class="ml-0 mr-0 "/></button>
		</div>

		<div id="ex" class="container-fluid"></div>
	</div>

<script>

	$(document).ready(function () {


		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/getHistoryAll_ax')?>';
		var date_from = $('input[name="from"]').val();
		var date_to = $('input[name="to"]').val();

		$.ajax({
			url: url,
			type: 'POST',
			data: {from: date_from, to: date_to},
			async: true,
			dataType: "json",
			beforeSend: function () {
				$('#ex').html('<img style="height: 10em; margin: 0 auto;display: block;text-align: center; margin-top: 100px" src="<?= base_url() ?>assets/images/puff.svg" />');
				$('#container').html('<img style="height: 10em; margin: 0 auto;display: block;text-align: center; margin-top: 100px" src="<?= base_url() ?>assets/images/puff.svg" />');
			},
			success: function (data) {
				chart(data);
				$('#ex').html(data.table);

			}
		}).done(function () {
			var table = $('#example').DataTable({
				language: {
					search: "<?=lang('search_fleet')?>",
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
				"paging": false,
				"info": false,
				"search": {regex: true},
				"iDisplayLength": 100,
				dom: 'Bfrtip',
				"columnDefs": [
					{ "searchable": false, "targets": [0,1,3] }
				],
				buttons: [
					{
						extend: 'excelHtml5',
						title: '',
						filename: 'excel_file',
						footer: true,
						exportOptions: {
							columns: ':visible'
						}
					},
					'colvis'
				]
			});

			console.log(table);

			$('.buttons-html5').append('<i style="padding-left: 10px;" class="fas fa-print"></i>');
			$('.buttons-colvis span').text('');
			$('.buttons-colvis span').text('<?=lang('column_visibility')?>');

			table.buttons().container()
				.appendTo('#example_wrapper #example_filter:eq(0)');
			$('.dt-buttons').css('float', 'left');

			$('#group').removeClass('d-none');


		});


		$(document).on('click', '#search', function (e) {
			var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/getHistoryAll_ax')?>';
			var date_from = $('input[name="from"]').val();
			var date_to = $('input[name="to"]').val();
			var search_car = $('input[type="search"]').val();
			var search_car_ids = $('select[name="group"]').val();


			$.ajax({
				url: url,
				type: 'POST',
				data: {from: date_from, to: date_to, search_car: search_car, search_car_ids: search_car_ids},
				async: true,
				dataType: "json",
				beforeSend: function () {
					$('#group').addClass('d-none');
					$('#ex').html('<img style="height: 10em; margin: 0 auto;display: block;text-align: center;  margin-top: 100px;" src="<?= base_url() ?>assets/images/puff.svg" />');
				},
				success: function (data) {
					chart(data);
					$('#ex').html(data.table);

				}
			}).done(function () {
				var table = $('#example').DataTable({
					language: {
						search: "<?=lang('search_fleet')?>",
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
					"search": {regex: true},
					"iDisplayLength": 100,
					"paging": false,
					"info": false,
					dom: 'Bfrtip',
					"columnDefs": [
						{ "searchable": false, "targets": [0,1,3] }
					],
					buttons: [
						{
							extend: 'excelHtml5',
							title: '',
							filename: 'excel_file',
							footer: true,
							exportOptions: {
								columns: ':visible'
							}
						},
						'colvis'
					]
				});


				table.buttons().container()
					.appendTo('#example_wrapper #example_filter:eq(0)');
				$('.dt-buttons').css('float', 'left');

				$('#group').removeClass('d-none');
			});




		})

	});

	function chart(data) {
	Highcharts.chart('container', {

		chart: {
			type: 'column'
		},

		title: {
			text: ''
		},

		xAxis: {
			categories: data.category
		},

		yAxis: {
			allowDecimals: false,
			min: 0,
			title: {
				text: 'AMD'
			}
		},

		tooltip: {
			formatter: function () {
				return '<b>' + this.x + '</b><br/>' +
					this.series.name + ': ' + this.y + '<br/>' +
					'<?=lang('total')?>: ' + this.point.stackTotal;
			}
		},



		plotOptions: {
			column: {
				stacking: 'normal'
			},

			series: {
				events: {
					legendItemClick: function (e) {

						$('#ex').html('<img style="z-index: 999; position: fixed;  margin-top: 100px; width: 10em" src="http://localhost/NestGarageSystem/assets/images/puff.svg">');

						var hidden = [];

						var chart = this.chart,
							index = this.index,
							tvis = this.visible;


						if(tvis) {
							hidden.push(this.userOptions.table);
						}

						$.each(chart.series,function(i,serie){

							if((!serie.visible) && (serie.index != index)) {
								hidden.push(serie.userOptions.table);
							}

						});

						var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/getHistoryAll_ax')?>';
						var date_from = $('input[name="from"]').val();
						var date_to = $('input[name="to"]').val();
						var search_car = $('input[type="search"]').val();
						var search_car_ids = $('select[name="group"]').val();


						$.ajax({
							url: url,
							type: 'POST',
							data: {from: date_from, to: date_to, hidden: hidden, search_car: search_car, search_car_ids: search_car_ids},
							async: true,
							dataType: "json",
							beforeSend: function () {
								$('#group').addClass('d-none');
								$('#ex').html('<img style="height: 10em; margin: 0 auto;display: block;text-align: center;  margin-top: 100px;" src="<?= base_url() ?>assets/images/puff.svg" />');
							},
							success: function (data) {
								$('#ex').html(data.table);
							}
						}).done(function () {
							var table = $('#example').DataTable({
								"paging": false,
								"info": false,
								"search": {regex: true},
								"iDisplayLength": 100,
								dom: 'Bfrtip',
								"columnDefs": [
									{ "searchable": false, "targets": [0,1,3] }
								],
								buttons: [
									{
										extend: 'excelHtml5',
										title: '',
										filename: 'excel_file',
										footer: true,
										exportOptions: {
											columns: ':visible'
										}
									},
									'colvis'
								]
							});

							table.buttons().container()
								.appendTo('#example_wrapper #example_filter:eq(0)');
							$('.dt-buttons').css('float', 'left');

							$('#group').removeClass('d-none');
						});
					}
				}
			}
		},


		series: data.data


	});
	}

	$(document).on('keyup', 'input[type="search"]', function () {

		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/getHistoryAll_ax')?>';
		var date_from = $('input[name="from"]').val();
		var date_to = $('input[name="to"]').val();
		var search_car = $(this).val();
		var search_car_ids = $('select[name="group"]').val();


		$.ajax({
			url: url,
			type: 'POST',
			data: {from: date_from, to: date_to, search_car: search_car, search_car_ids: search_car_ids},
			async: true,
			dataType: "json",
			beforeSend: function () {
				$('#container').html('<img style="height: 10em; margin: 0 auto;display: block;text-align: center;  margin-top: 100px;" src="<?= base_url() ?>assets/images/puff.svg" />');
			},
			success: function (data) {
				chart(data);
			}
		})
	});


	// group search in DataTable
	$(document).on('change', 'select[name="group"]', function () {

		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/getHistoryAll_ax')?>';
		var date_from = $('input[name="from"]').val();
		var date_to = $('input[name="to"]').val();
		var search_car_ids = $(this).val();
		var search_car = $('input[type="search"]').val();
		var search_cars = search_car_ids.split(',');

		var s = '';


		$.each(search_cars, function (k, val) {
			s += val + '|';
		});

		var new_s = s.substring(0, s.length - 1);

		console.log(new_s);

		$('#example').DataTable().column(2).search(new_s, true, false).draw();


		$.ajax({
			url: url,
			type: 'POST',
			data: {from: date_from, to: date_to, search_car_ids: search_car_ids, search_car: search_car},
			async: true,
			dataType: "json",
			beforeSend: function () {
				$('#container').html('<img style="height: 10em; margin: 0 auto;display: block;text-align: center;  margin-top: 100px;" src="<?= base_url() ?>assets/images/puff.svg" />');
			},
			success: function (data) {
				chart(data);
			}
		})
	});
	// end


	$(document).on('click', '.sel_items', function () {
		if ($(this).hasClass('bg-info')) {
			$(this).removeClass('bg-info text-white');
		} else {
			$(this).addClass('bg-info text-white')
		}
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

	});


	$(document).on('change', '.select_all', function () {
		if ($('.select_all').is(':checked')) {
			$('.sel_items').addClass('bg-info text-white')
		} else {
			$('.sel_items').removeClass('bg-info text-white');
		}
	});

	$(document).on('click', '.delete_all', function () {
		$('.sel_items').remove();

		//$('.lg_1').html('<h2 class="text-center" style="opacity: .4;color: gray;margin-top: 40%;" ><?//=lang('select_fleets_from_list')?>//</h2>');
	});

	/***************************************************************/
	$(document).on('change', '.select_all_2', function () {
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

	$(document).on('click', '.delete_all_2', function () {
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

	$(document).on('click', '.fleets_ul li', function () {
		$(this).toggleClass('fleets_ul_active');
	});



	// add group
	$(document).on('click', '#add_group', function (e) {

		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/add_group_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#group_add')[0]);

		$('input').removeClass('border border-danger');
		$('input').parent('td').removeClass('border border-danger');
		$('select').removeClass('border border-danger');
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

	// get edit modal
	$(document).on('click', '#edit_group_modal', function () {
		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/edit_group_modal_ax/')?>' + $('select[name="group"] option:selected').data('id');
		$.get(url, function (result) {

			// update modal content
			$('.body-m').html(result);

			// show modal
			$('#myModal').modal('show');
		});

	});


	$(document).on('click', '#edit_group_btn', function (e) {


		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/edit_group_ax') ?>';
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

		var url_0 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) .'/Fleet_history/group_type/')?>';

		$.post(url_0, {group_id: id}, function (result) {

		})

	});

	$(document).on('click', '#delete_group', function () {
		var id = $('input[name="group_id"]').val();
		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) .'/Fleet_history/delete_group/')?>';

		$.post(url, {group_id, id}, function (result) {
			location.reload();
		});
	});



</script>

	<!-- Delete Modal start -->
	<div class="modal fade bd-example-modal-sm del_group_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
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
					<h6 class="text-white modal-title dar"><?=lang('EditGroup')?></h6>
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
							<label class="col-sm-2 col-form-label"><?= lang('company_name') ?></label>
							<div class="col-sm-8">
								<input name="title" type="text" class="form-control"
									   placeholder="<?= lang('company_name') ?>">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-1"></div>
							<label class="col-sm-2 col-form-label"><?= lang('more_info') ?></label>
							<div class="col-sm-8">
							<textarea name="description" type="text" class="form-control"
									  placeholder="<?= lang('more_info') ?>"></textarea>
							</div>
						</div>

						<input type="hidden" name="groups">

					</form>
					<hr class="my-2">
					<div class="row mt-1 pl-1 pr-1">
						<input id="sb_s" type="text" class="form-control" placeholder="<?= lang('search') ?>"
							   aria-label="Search" aria-describedby="basic-addon2" style="width: 50%;margin: 3px;">
						<div class="col-sm-6 scroll_style"
							 style="border: 5px solid #00000040;max-height: 300px; min-height: 300px; overflow-y: scroll;">

							<ul style="list-style: decimal;" class="list-group lg_1 mt-1">
								<? foreach ($result_fleets as $row_fleet) : ?>
									<li data-id="<?= $row_fleet['id'] ?>" style="cursor: pointer"
										class="p-1 sel_items mt-1 list-group-item"><?= $row_fleet['brand_model'] ?></li>
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
							<ul class="list-group lg_2 mt-1">

							</ul>

						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button id="add_group" type="button"
							class="btn btn-outline-success cancel_btn"><?= lang('save') ?>
					</button>
					<button id="load" class="btn btn-sm btn-success d-none cancel_btn"><img
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

	<!-- Create Group Modal End -->
