<form id="vehicle_repair">
	<div class="row col-sm-12 col-md-12 bpp_o pb-5">
	<div class="container-fluid">
		<table id="ex_7" class="table table-striped table-borderless w-100">
			<thead class="thead_tables">
			<tr>
				<th class="table_th"><?=lang('vehicle')?></th>
				<th class="table_th"><?=lang('when')?></th>
				<th class="table_th"><?=lang('repairs')?></th>
				<th class="table_th"><?=lang('repair_materials')?> *</th>
				<th class="table_th"><?=lang('price')?> *</th>
				<th class="">
					<? if (count($fleet['id']) > 1) { ?>
					<span data-toggle="modal"
						  data-target="#vehicle_repair_m"
						  class=" btn btn-outline-secondary btn-sm " data-id="ex_7"
						  style="padding: .25rem .5rem !important;">
				<? } else { ?>
						<span class="ex_7_add_new_tr btn btn-outline-secondary btn-sm " data-id="ex_7"
							  style="padding: .25rem .5rem !important;">
				<? } ?>
							<i class="fa fa-plus"> </i>
					</span>
				</th>
			</tr>
			</thead>
			<tbody >
			<?
			if ($fleet_data) {
				foreach ($fleet_data as $row) {
					?>

					<tr style="height: 40px;">

						<td class="border">
							<input class="form-control text-center" title="" type="text" disabled name="repair_vehicle[<?= $row['id'] ?>]" value="<?= $row['brand_model'] ?>" >
						</td>
						<td class="border">
							<input class="form-control text-center" title="" type="date" disabled name="repair_date[<?= $row['id'] ?>]" value="<?= $row['add_date'] ?>" >
						<td class="border">
							<input title="" type="text" name="repair_repairer[<?= $row['id'] ?>]"
								   class="form-control text-center" disabled value="<?= $row['repairer'] ?>"/>
						</td>
						<td class="border">
							<input title="" type="text" name="repair_necessary_parts[<?= $row['id'] ?>]"
								   class="form-control text-center" disabled value="<?= $row['necessary_parts'] ?>"/>
						</td>
						<td class="border">
							<input title="" type="number" min="0" name="repair_price[<?= $row['id'] ?>]"
								   class="form-control text-center" disabled value="<?= $row['price'] ?>"/>
						</td>
						<td class="border">
							<span
								id="edit_repair"
								data-id="<?= $row['id'] ?>"
								style="border: none;padding-top: 5px;cursor: pointer; display: contents;"
								class="float-left text-secondary text-center" >
								<i class="fas fa-edit"></i>
							</span>
						</td>
					</tr>

					<?
				}
			}
			echo '</tbody>';
			if (count($fleet['id']) == 1) { ?>
			<tfoot class="ex_7">
			<tr>
				<td class="border">
					<input title="" readonly type="text" name="vehicle[1]" value="<?= $fleet['name'][0] ?>"
						   class="form-control text-center"/>
					<input type="hidden" name="fleet_id" value="<?= $fleet['id'][0] ?>">
				</td>
				<td class="border">
					<input title="" type="date" name="date[1]" value="<?= mdate('%Y-%m-%d', now()) ?>"
						   class="form-control text-center"/>
				</td>
				<td class="border">
					<input title="" type="text" name="repairer[1]"
						   class="form-control text-center"/>
				</td>
				<td class="border">
					<input title="" type="text" name="necessary_parts[1]"
						   class="form-control text-center"/>
				</td>

				<td class="border">
					<input title="" type="number" min="0" name="price[1]" value=""
						   class="form-control text-center"/>
				</td>
				<td class="border"></td>
			</tr>
			<tr>
				<td class="font-weight-bold" style="text-align: left !important;" colspan="4"><?=lang('total')?></td>
				<td class="font-weight-bold" id="sum"></td>
				<td></td>
			</tr>
			</tfoot>
			<? } else {
				echo '
				<tfoot>
					<tr>
						<td class="font-weight-bold" style="text-align: left !important;" colspan="4">'.lang('total').'</td>
						<td class="font-weight-bold" id="sum"></td>
						<td></td>
					</tr>
				</tfoot>
				';
			}?>

		</table>
	</div>
</div>

</form>

<div class="pos_abs_div fixed-bottom text-left pb-2 mt-md-2 mt-2">
	<span id="repair" class="save_cancel_btn btn btn-success"><?= lang('save') ?></span>
	<span id="load" class="btn save_cancel_btn btn-success d-none">
		<?=$this->load->loading_svg()?>
	</span>

	<button class="dont_save btn btn-primary"><?= lang('cancel') ?></button>
	<span style="color: #8c8c8c;" class="pl-3"><?= lang('changed_property') ?></span>
</div>

<!--   Modal Start -->
<form id="vehicle_repair_modal">
	<div class="modal fade" tabindex="-1" role="dialog" id="vehicle_repair_m"
		 aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="max-width: 80% !important">
			<div class="modal-content">
				<div class="modal-header bg-dark">
					<h6 class="text-white modal-title dar"><?=lang('repair')?></h6>

				</div>
				<div class="modal-body">




					<table id="ex_7" class="table table-striped table-borderless w-100">
						<thead class="thead_tables">
						<tr>
							<th class="table_th"><?=lang('vehicle')?></th>
							<th class="table_th"><?=lang('when')?></th>
							<th class="table_th"><?=lang('repairs')?></th>
							<th class="table_th"><?=lang('repair_materials')?> *</th>
							<th class="table_th"><?=lang('price')?> *</th>
						</tr>
						</thead>
						<tbody>
						<? foreach ($fleet['name'] as $key => $name) { ?>
							<tr class="">
								<td class="border">
									<?=$name?>
									<input type="hidden" name="fl_id[<?=$key+1?>]" value="<?=$fleet['id'][$key]?>">
								</td>
								<td class="border">
									<input title="" type="date" name="date[<?=$key+1?>]" value="<?= mdate('%Y-%m-%d', now()) ?>"
										   class="form-control text-center"/>
								</td>
								<td class="border">
									<input title="" type="text" name="repairer[<?=$key+1?>]"
										   class="form-control text-center"/>
								</td>

								<td class="border">
									<input title="" type="text" name="necessary_parts[<?=$key+1?>]"
										   class="form-control text-center"/>
								</td>

								<td class="border">
									<input title="" type="number" min="0" name="price[<?=$key+1?>]" value=""
										   class="form-control text-center"/>
								</td>
							</tr>
						<? } ?>
						</tbody>
					</table>


					<div class="modal-footer pb-0">
						<button id="vehicle_repair_add" type="button"
								class="save_cancel_btn btn btn-success"><?= lang('save') ?>
						</button>
						<button id="load" class=" btn btn-success d-none"><?=$this->load->loading_svg()?></button>
						<button type="button" class="cancel_btn close btn btn-sm"
								data-dismiss="modal"
								aria-label="Close">
							<?= lang('cancel') ?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<!--modal end-->

<script>


	var table = $('#ex_7').DataTable({
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
		"paging": false,
		"info": false,
		"columnDefs": [
			{"orderable": false, "targets": 5}
		],
		dom: 'Bfrtip',
		buttons: [
			{
				extend: 'excelHtml5',
				title: '',
				filename: 'excel_file',
				footer: true,
				exportOptions: {
					format: {
						body: function ( data, row, column, node ) {
							// Strip $ from salary column to make it numeric
							return $(data).val()
						}
					},
					columns: ':visible'
				}
			},
			'colvis'
		]
	});

	table.order([0, 'asc']).draw();

	$('.buttons-html5').append('<i style="padding-left: 10px;" class="fas fa-print"></i>');
	$('.buttons-colvis span').text('');
	$('.buttons-colvis span').text('<?=lang('column_visibility')?>');

	table.buttons().container()
		.appendTo( '#ex_7_wrapper #ex_7_filter:eq(0)' );

	$('.dt-buttons').css('float', 'left');



	<? if (count($fleet['id']) == 1) { ?>

	$(document).on('change keyup', 'input,select,textarea', function () {
		if (!$('.pos_abs_div').hasClass('animated')) {
			$('.pos_abs_div').animate({
				bottom: "+=60",
			});
			$('.pos_abs_div').addClass('animated');
		}
	});

	$('.dont_save').on('click', function () {
		$('.pos_abs_div').removeClass('animated');
		$('.pos_abs_div').animate({
			bottom: "-=60"
		}, function () {

		})
	});

	<?}?>


	//vehicle spares
	var j = 1;
	$(document).on('click', '.ex_7_add_new_tr', function (e) {
		j++;



		var fleet = $('input[name="vehicle[1]"]').val();

		var me = $(this);
		e.preventDefault();

		if (me.data('requestRunning')) {
			return;
		}

		me.data('requestRunning', true);

		$.when(
			$('.ex_7').append('<tr role="row">\n' +
				'<td><input readonly title="" type="text" name="vehicle[' + j + ']" value="' + fleet + '" class="form-control text-center"/></td>\n' +
				'<td><input  title="" type="date" name="date[' + j + ']" value="<?= mdate('%Y-%m-%d', now()) ?>" class="form-control text-center"/></td>\n' +
				'<td class="border">\n' +
				'\t<input title="" type="text" name="repairer[' + j + ']"\n' +
				'\t\t   class="form-control text-center"/>\n' +
				'</td>\n' +
				'<td class="border">\n' +
				'\t<input title="" type="text" name="necessary_parts[' + j + ']"\n' +
				'\t\t   class="form-control text-center"/>\n' +
				'</td>\n' +
				'<td class="border">\n' +
				'\t<input title="" type="number" min="0" name="price[' + j + ']"\n' +
				'\t\tclass="form-control text-center"/>\n' +
				'\t</td>' +
				'<td>' +
				'<span class="btn btn-outline-secondary btn-sm del_row_ft" style="padding: .25rem .5rem !important;">' +
				'<i class=" fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"> </i>' +
				'</span>' +
				'</td>\n'+
				'</tr>' )).then(function () {
			me.data('requestRunning', false);
		});



	});


	ajax('form#vehicle_repair', 'span#repair');

	ajax('form#vehicle_repair_modal', '#vehicle_repair_add');

	function ajax(form, button) {

		$(document).on('click', button, function (e) {
			var url = '<?=base_url($this->uri->segment(1) . '/Structure/repair_ax') ?>';
			var me = $(this);
			e.preventDefault();

			if (me.data('requestRunning')) {
				return;
			}

			me.data('requestRunning', true);
			var form_data = new FormData($(form)[0]);
			$('input').removeClass('border border-danger');
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data: form_data,
				contentType: false,
				cache: false,
				processData: false,
				beforeSend: function () {
					loading('start', 'repair');
				},
				success: function (data) {
					if (data.success == '1') {

						loading('stop', 'repair');
						var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/structure1/add_expenses')?>";
						location.reload();

					} else {

						if ($.isArray(data.error.elements)) {
							loading('stop', 'repair');
							errors = '';
							tmp = '';
							$.each(data.error.elements, function (index) {
								$.each(data.error.elements[index], function (index, value) {
									if (value != '') {
										$('input[name="' + index + '"]').addClass('border border-danger');

										if (value != tmp) {
											errors += value;
										}
										tmp = value;

									} else {
										$('input[name="' + index + '"]').removeClass('border border-danger');
									}
								});
							});
						}
					}
				},
				error: function (jqXHR, textStatus) {
					console.log('ERRORS: ' + textStatus);
					loading('stop', 'repair');
				},
				complete: function () {
					me.data('requestRunning', false);
				}
			});
		});

	}


	//edit
	$(document).on('click', '#edit_repair', function() {
		var id = $(this).data('id');

		$('input[name="repair_date['+id+']"]').prop('disabled', false);
		$('input[name="repair_repairer['+id+']"]').prop('disabled', false);
		$('input[name="repair_necessary_parts['+id+']"]').prop('disabled', false);
		$('input[name="repair_price['+id+']"]').prop('disabled', false);


		$(this).parent('td').html('<button\n' +
			'\t\t\t\t\tdata-id="'+id+'"\n' +
			'\t\t\t\t\tid="edit_repair_btn"\n' +
			'\t\t\t\t\tstyle="min-width: 94px;\n' +
			'\t\t\t\t\tfont-size: 14px !important;\n' +
			'\t\t\t\t\tline-height: 14px !important;\n' +
			'\t\t\t\t\tpadding: 10px 24px !important;\n' +
			'\t\t\t\t\tfont-weight: 500 !important;\n' +
			'\t\t\t\t\tmargin-top: -4px;\n' +
			'\t\t\t\t\tmin-height: 37px !important;" type="button" id="search" class="ml-2 save_cancel_btn btn btn-success"><?=lang('edit')?></button>');
	});


	$(document).on('click', '#edit_repair_btn', function (e) {
		var td = $(this).parent('td');
		var id = $(this).data('id');

		var repair_date = $('input[name="repair_date['+id+']"]').val();
		var repair_repairer = $('input[name="repair_repairer['+id+']"]').val();
		var repair_necessary_parts = $('input[name="repair_necessary_parts['+id+']"]').val();
		var repair_price = $('input[name="repair_price['+id+']"]').val();


		var url = '<?=base_url($this->uri->segment(1) . '/Structure/edit_repair_ax') ?>';
		var me = $(this);
		e.preventDefault();

		if (me.data('requestRunning')) {
			return;
		}

		me.data('requestRunning', true);

		$('input').removeClass('border border-danger');
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: {
				repair_id: id,
				repair_date: repair_date,
				repair_repairer: repair_repairer,
				repair_necessary_parts: repair_necessary_parts,
				repair_price: repair_price
			},
			success: function (data) {
				if (data.success == '1') {

					td.html('<span\n'+
						'\t\t\t\t\t\t\t\tid="edit_repair"\n'+
						'\t\t\t\t\t\t\t\tdata-id="'+data.message+'"\n'+
						'\t\t\t\t\t\t\t\tstyle="border: none;padding-top: 5px;cursor: pointer; display: contents;"\n'+
						'\t\t\t\t\t\t\t\tclass="float-left text-secondary text-center" >\n'+
						'\t\t\t\t\t\t\t\t<i class="fas fa-edit"></i>\n'+
						'\t\t\t\t\t\t\t</span>');

					$('input[name="repair_date['+id+']"]').prop('disabled', true);
					$('input[name="repair_repairer['+id+']"]').prop('disabled', true);
					$('input[name="repair_necessary_parts['+id+']"]').prop('disabled', true);
					$('input[name="repair_price['+id+']"]').prop('disabled', true);


				} else {

					if ($.isArray(data.error.elements)) {
						// loading('stop', 'inspection');
						errors = '';
						tmp = '';
						$.each(data.error.elements, function (index) {
							$.each(data.error.elements[index], function (index, value) {
								if (value != '') {
									$('input[name="' + index + '"]').addClass('border border-danger');

									if (value != tmp) {
										errors += value;
									}
									tmp = value;

								} else {
									$('input[name="' + index + '"]').removeClass('border border-danger');
								}
							});
						});
					} else {
						alert();
					}
				}
			},
			error: function (jqXHR, textStatus) {
				console.log('ERRORS: ' + textStatus);
				// loading('stop', 'inspection');
			},
			complete: function () {
				me.data('requestRunning', false);
			}
		});
	});

	var sum = 0;
	$('input[name^="repair_price"]').each(function () {
		sum += parseInt($(this).val());
		console.log($(this).val());
	})

	$('td#sum').html(sum)


	$('.buttons-excel span').html('<?=lang('export')?>')
</script>


