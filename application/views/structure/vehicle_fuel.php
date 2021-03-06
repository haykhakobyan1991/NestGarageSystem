<style>
	input::placeholder {
		font-size: 12px !important;
	}
</style>

<form
	id="vehicle_fuel">
	<div
		class="row col-sm-12 col-md-12 bpp_o pb-5">
		<div
			class="container-fluid">
			<table
				id="ex_2"
				class="table table-striped table-borderless w-100">
				<thead
					class="thead_tables">
				<tr>
					<th class="table_th"><?= lang('vehicle') ?></th>
					<th class="table_th"><?= lang('when') ?></th>
					<th class="table_th"><?= lang('by_whom') ?></th>
					<th class="table_th"
						style="min-width: 150px;"><?= lang('driver') ?>
						*
					</th>
					<th class="table_th"><?= lang('quantity_liter') ?>
						*
					</th>
					<th class="table_th"><?= lang('one_liter_price') ?>
						*
					</th>
					<th class="table_th"><?= lang('price') ?>
						*
					</th>
					<th class="">
						<? if (count($fleet['id']) > 1) { ?>
						<span
							data-toggle="modal"
							data-target="#vehicle_fuel_m"
							class=" btn btn-outline-secondary btn-sm "
							data-id="ex_2"
							style="padding: .25rem .5rem !important;">
				<? } else { ?>
						<span
							class="ex_2_add_new_tr btn btn-outline-secondary btn-sm "
							data-id="ex_2"
							style="padding: .25rem .5rem !important;">
				<? } ?>
							<i class="fa fa-plus"> </i>
					</span>
					</th>
				</tr>
				</thead>
				<tbody>
				<?
				if ($fleet_data) {
					foreach ($fleet_data as $row) {
						?>

						<tr style="height: 40px;">

							<td class="border">
								<input
									class="form-control text-center"
									title=""
									type="text"
									disabled
									name="vehicle[<?= $row['id'] ?>]"
									value="<?= $row['brand_model'] ?>">
								<span
									style="display: none"><?= $row['brand_model'] ?></span>
							</td>
							<td class="border">
								<input
									class="form-control text-center"
									title=""
									type="date"
									disabled
									name="fuel_date[<?= $row['id'] ?>]"
									value="<?= $row['add_date'] ?>">
								<span
									style="display: none"><?= $row['add_date'] ?></span>
							</td>
							<td class="border">
								<input
									title=""
									disabled
									type="text"
									name="user[<?= $row['id'] ?>]"
									value="<?= $row['user_name'] ?>"
									class="form-control text-center"/>
								<span
									style="display: none"><?= $row['user_name'] ?></span>
							</td>
							<td class="border">
								<select
									disabled
									class="form-control selectpicker"
									data-size="5"
									name="fuel_staff_id[<?= $row['id'] ?>]"
									title="<?= lang('driver') ?>">
									<? foreach ($this->load->get_drivers($row['fleet_id']) as $st) { ?>
										<option <?= ($row['staff_id'] == $st['id'] ? 'selected' : '') ?>
											value="<?= $st['id'] ?>"><?= $st['name'] ?></option>
									<? } ?>
								</select>
								<span
									style="display: none"><?= $row['staff_name'] ?></span>
							</td>
							<td class="border">
								<input
									disabled
									title=""
									type="number"
									min="0"
									name="fuel_count_liter[<?= $row['id'] ?>]"
									value="<?= $row['count_liter'] ?>"
									class="form-control text-center"/>
								<span
									style="display: none"><?= $row['count_liter'] ?></span>
							</td>
							<td class="border">
								<input
									disabled
									title=""
									type="number"
									min="0"
									name="fuel_one_liter_price[<?= $row['id'] ?>]"
									value="<?= $row['one_liter_price'] ?>"
									class="form-control text-center"/>
								<span
									style="display: none"><?= $row['one_liter_price'] ?></span>
							</td>
							<td class="border">
								<input
									disabled
									title=""
									type="number"
									min="0"
									name="fuel_price[<?= $row['id'] ?>]"
									value="<?= $row['price'] ?>"
									class="form-control text-center"/>
								<span
									style="display: none"><?= $row['price'] ?></span>
							</td>
							<td class="border">
							<span
								id="edit_fuel"
								data-id="<?= $row['id'] ?>"
								style="border: none;padding-top: 5px;cursor: pointer; display: contents;"
								class="float-left text-secondary text-center">
								<i class="fas fa-edit"></i>
							</span>
							</td>
						</tr>

						<?
					}
				}
				echo '</tbody>';
				if (count($fleet['id']) == 1) { ?>

				<tfoot
					class="ex_2">
				<tr>
					<td class="border">
						<input
							title=""
							readonly
							type="text"
							name="vehicle[1]"
							value="<?= $fleet['name'][0] ?>"
							class="form-control text-center"/>
						<input
							type="hidden"
							name="fleet_id"
							value="<?= $fleet['id'][0] ?>">
					</td>
					<td class="border">
						<input
							title=""
							type="date"
							name="date[1]"
							value="<?= mdate('%Y-%m-%d', now()) ?>"
							class="form-control text-center"/>
					</td>
					<td class="border">
						<input
							title=""
							readonly
							type="text"
							name="user[1]"
							value="<?= $user['name'] ?>"
							class="form-control text-center"/>
					</td>
					<td class="border">

						<select
							class="form-control selectpicker"
							data-size="5"
							name="staff_id[1]">
							<? foreach ($staff as $st) { ?>
								<option
									value="<?= $st['id'] ?>"><?= $st['name'] ?></option>
							<? } ?>
						</select>

					</td>
					<td class="border">
						<input
							title=""
							type="number"
							min="0"
							name="count_liter[1]"
							value=""
							class="form-control text-center"/>
					</td>
					<td class="border">
						<input
							title=""
							type="number"
							min="0"
							name="one_liter_price[1]"
							value=""
							class="form-control text-center"/>
					</td>
					<td class="border">
						<input
							title=""
							type="number"
							min="0"
							name="price[1]"
							value=""
							class="form-control text-center"/>
					</td>
					<td class="border"></td>
				</tr>
				<tr>
					<td class="font-weight-bold"
						style="text-align: left !important;"><?= lang('total') ?></td>
					<td class="font-weight-bold"
						colspan="5"></td>
					<td class="font-weight-bold"
						id="sum"></td>
					<td></td>
				</tr>
				</tfoot>
				<? } else {
					echo '
				<tfoot>
					<tr>
						<td class="font-weight-bold" style="text-align: left !important;">' . lang('total') . '</td>
						<td class="font-weight-bold"  colspan="5"></td>
						<td class="font-weight-bold" id="sum"></td>
						<td></td>
					</tr>
				</tfoot>
				';
				} ?>

			</table>
		</div>
	</div>

</form>

<div
	class="pos_abs_div fixed-bottom text-left pb-2 mt-md-2 mt-2">
	<span
		id="fuel"
		class="save_cancel_btn btn btn-success"><?= lang('save') ?></span>
	<span
		id="load"
		class="btn save_cancel_btn btn-success d-none">
		<?= $this->load->loading_svg() ?>
	</span>

	<button
		class="dont_save btn btn-primary"><?= lang('cancel') ?></button>
	<span
		style="color: #8c8c8c;"
		class="pl-3"><?= lang('changed_property') ?></span>
</div>


<!--   Modal Start -->
<form
	id="vehicle_fuel_modal">
	<div
		class="modal fade "
		tabindex="-1"
		role="dialog"
		id="vehicle_fuel_m"
		aria-labelledby="myLargeModalLabel"
		aria-hidden="true">
		<div
			class="modal-dialog"
			style="max-width: 80%;">
			<div
				class="modal-content">
				<div
					class="modal-header bg-dark">
					<h6 class="text-white modal-title dar"><?= lang('fuel_consumption') ?></h6>

				</div>
				<div
					class="modal-body">


					<table
						id="ex_2"
						class="table table-striped table-borderless w-100">
						<thead
							class="thead_tables">
						<tr>
							<th class="table_th"><?= lang('vehicle') ?></th>
							<th class="table_th"><?= lang('when') ?></th>
							<th class="table_th"
								style="min-width: 150px;"><?= lang('driver') ?>
								*
							</th>
							<th class="table_th"><?= lang('quantity_liter') ?>
								*
							</th>
							<th class="table_th"><?= lang('one_liter_price') ?>
								*
							</th>
							<th class="table_th"><?= lang('price') ?>
								*
							</th>
						</tr>
						</thead>
						<tbody>
						<? foreach ($fleet['name'] as $key => $name) { ?>
							<tr class="">
								<td class="border">
									<?= $name ?>
									<input
										type="hidden"
										name="fl_id[<?= $key + 1 ?>]"
										value="<?= $fleet['id'][$key] ?>">
								</td>
								<td class="border">
									<input
										title=""
										type="date"
										name="date[<?= $key + 1 ?>]"
										value="<?= mdate('%Y-%m-%d', now()) ?>"
										class="form-control text-center"/>
								</td>
								<td>
									<select
										class="form-control selectpicker"
										data-size="5"
										name="staff_id[<?= $key + 1 ?>]"
										title="<?= lang('driver') ?>">
										<? foreach ($this->load->get_drivers($fleet['id'][$key]) as $st) { ?>
											<option
												value="<?= $st['id'] ?>"><?= $st['name'] ?></option>
										<? } ?>
									</select>
								</td>
								<td class="border">
									<input
										title=""
										type="number"
										name="count_liter[<?= $key + 1 ?>]"
										max="3000-12-31"
										min="1000-01-01"
										class="form-control text-center"/>
								</td>
								<td class="border">
									<input
										title=""
										type="number"
										name="one_liter_price[<?= $key + 1 ?>]"
										max="3000-12-31"
										min="1000-01-01"
										class="form-control text-center"/>
								</td>

								<td class="border">
									<input
										title=""
										type="number"
										min="0"
										name="price[<?= $key + 1 ?>]"
										value=""
										class="form-control text-center"/>
								</td>
							</tr>

							<script>

								$(document).on('keyup', 'input[name="count_liter[<?=$key + 1?>]"]', function () {
									var count = $(this).val();
									var one_liter_price = $('input[name="one_liter_price[<?=$key + 1?>]"]').val();

									sum = parseFloat(count) * parseFloat(one_liter_price);

									$('input[name="price[<?=$key + 1?>]"]').val(sum);

								});

								$(document).on('keyup', 'input[name="one_liter_price[<?=$key + 1?>]"]', function () {
									var count = $('input[name="count_liter[<?=$key + 1?>]"]').val();
									var one_liter_price = $(this).val();
									sum = parseFloat(count) * parseFloat(one_liter_price);

									$('input[name="price[<?=$key + 1?>]"]').val(sum);

								});
							</script>
						<? } ?>
						</tbody>
					</table>


					<div
						class="modal-footer pb-0">
						<button
							id="vehicle_fuel_add"
							type="button"
							class="save_cancel_btn btn btn-success"><?= lang('save') ?>
						</button>
						<button
							id="load"
							class=" btn btn-success d-none"><?= $this->load->loading_svg() ?></button>
						<button
							type="button"
							class="cancel_btn close btn btn-sm"
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


	$(document).on('keyup', 'input[name="count_liter[1]"]', function () {
		var count = $(this).val();
		var one_liter_price = $('input[name="one_liter_price[1]"]').val();

		sum = parseFloat(count) * parseFloat(one_liter_price);

		$('input[name="price[1]"]').val(sum);

	});

	$(document).on('keyup', 'input[name="one_liter_price[1]"]', function () {
		var count = $('input[name="count_liter[1]"]').val();
		var one_liter_price = $(this).val();
		sum = parseFloat(count) * parseFloat(one_liter_price);

		$('input[name="price[1]"]').val(sum);

	});

	var table = $('#ex_2').DataTable({
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
			{
				"orderable": false,
				"targets": 7
			}
		],
		dom: 'Bfrtip',
		buttons: [
			{
				extend: 'excelHtml5',
				title: '<?=lang('Report_period') . '  ' . lang('from')?> ' + $('input[name="from"]').val() + '  <?=lang('to')?> ' + $('input[name="to"]').val(),
				message: "<?=lang('company')?>: " + $('input[name="company"]').val() + ",  <?=lang('user')?>: " + $('.username_login > a').text() + ",  <?=lang('type')?>:  <?=lang('fuel_consumption')?> ",
				autoWidth: true,
				filename: 'fuel',
				footer: true,
				exportOptions: {
					format: {
						body: function (data, row, column, node) {
							// Strip $ from salary column to make it numeric
							return column === 3 ?
								$(data).find("option:selected").text() : $(data).val()
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
		.appendTo('#ex_2_wrapper #ex_2_filter:eq(0)');

	$('.dt-buttons').css('float', 'left');

	//vehicle fuel
	var j = 1;
	$(document).on('click', '.ex_2_add_new_tr', function (e) {
		j++;

		var fleet = $('input[name="vehicle[1]"]').val();

		var me = $(this);
		e.preventDefault();

		if (me.data('requestRunning')) {
			return;
		}

		me.data('requestRunning', true);

		$.when(
			$('.ex_2').append('<tr role="row">\n' +
				'<td><input readonly title="" type="text" name="vehicle[' + j + ']" value="' + fleet + '" class="form-control text-center"/></td>\n' +
				'<td><input  title="" type="date" name="date[' + j + ']" value="<?= mdate('%Y-%m-%d', now()) ?>" class="form-control text-center"/></td>\n' +
				'<td><input readonly title="" type="text" name="user[' + j + ']" value="<?= $user['name'] ?>" class="form-control text-center"/></td>\n' +
				'<td>' +
				'<select class="form-control selectpicker" data-size="5"  name="staff_id[' + j + ']" title="<?=lang('driver')?>">\n' +
				'\t\t\t\t\t\t\t<?foreach ($staff as $st) {?>\n' +
				'\t\t\t\t\t\t\t\t<option value="<?=$st['id']?>"><?=$st['name']?></option>\n' +
				'\t\t\t\t\t\t\t<?}?>\n' +
				'\t\t\t\t\t\t</select>' +
				'</td>\n' +
				'<td><input title="" type="number" name="count_liter[' + j + ']" value="" class="form-control text-center"/></td>\n' +
				'<td><input title="" type="number" name="one_liter_price[' + j + ']" value="" class="form-control text-center"/></td>\n' +
				'<td><input title="" type="number" name="price[' + j + ']" value="" class="form-control text-center"/></td>\n' +
				'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row" > </i></td>\n' +
				'</tr>' +
				'<script>' +
				'$(\'select\').selectpicker(\'refresh\');' +
				'$(\'.selectpicker\').parent(\'div\').children(\'button\').css({\n' +
				'\t\t\t\'background\': \'#fff\',\n' +
				'\t\t\t\'color\': \'#000\',\n' +
				'\t\t\t\'border\': \'1px solid #ced4da\'\n' +
				'\t\t});\n' +
				'\t\t$(\'.selectpicker\').parent(\'div\').children(\'button\').removeClass(\'btn-light\');' +
				'$(document).on(\'keyup\', \'input[name="count_liter[' + j + ']"]\', function () {\n' +
				'\t\t\t\t\tvar count = $(this).val();\n' +
				'\t\t\t\t\tvar one_liter_price = $(\'input[name="one_liter_price[' + j + ']"]\').val();\n' +
				'\n' +
				'\t\t\t\t\tsum =  parseFloat(count) * parseFloat(one_liter_price);\n' +
				'\n' +
				'\t\t\t\t\t$(\'input[name="price[' + j + ']"]\').val(sum);\n' +
				'\n' +
				'\t\t\t\t});\n' +
				'\n' +
				'\t\t\t\t$(document).on(\'keyup\', \'input[name="one_liter_price[' + j + ']"]\', function () {\n' +
				'\t\t\t\t\tvar count = $(\'input[name="count_liter[' + j + ']"]\').val();\n' +
				'\t\t\t\t\tvar one_liter_price = $(this).val();\n' +
				'\t\t\t\t\tsum =  parseFloat(count) * parseFloat(one_liter_price);\n' +
				'\n' +
				'\t\t\t\t\t$(\'input[name="price[' + j + ']"]\').val(sum);\n' +
				'\n' +
				'\t\t\t\t});' +
				'</' +
				'script>')).then(function () {
			me.data('requestRunning', false);
		});

	});


	$('select').selectpicker('refresh');


	$('.selectpicker').parent('div').children('button').css({
		'background': '#fff',
		'color': '#000',
		'border': '1px solid #ced4da'
	});
	$('.selectpicker').parent('div').children('button').removeClass('btn-light');


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


	ajax('form#vehicle_fuel', 'span#fuel');

	ajax('form#vehicle_fuel_modal', '#vehicle_fuel_add');

	function ajax(form, button) {

		$(document).on('click', button, function (e) {
			var url = '<?=base_url($this->uri->segment(1) . '/Structure/fuel_ax') ?>';
			var me = $(this);
			e.preventDefault();

			if (me.data('requestRunning')) {
				return;
			}

			me.data('requestRunning', true);
			var form_data = new FormData($(form)[0]);

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
					loading('start', 'inspection');
				},
				success: function (data) {
					if (data.success == '1') {

						loading('stop', 'inspection');
						var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/structure1/add_expenses')?>";
						location.reload();

					} else {

						if ($.isArray(data.error.elements)) {
							loading('stop', 'inspection');
							errors = '';
							tmp = '';
							$.each(data.error.elements, function (index) {
								$.each(data.error.elements[index], function (index, value) {
									if (value != '') {
										$('input[name="' + index + '"]').addClass('border border-danger');
										$('select[name="' + index + '"]').parent('div').children('button').addClass('border border-danger');

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
					}
				},
				error: function (jqXHR, textStatus) {
					console.log('ERRORS: ' + textStatus);
					loading('stop', 'inspection');
				},
				complete: function () {
					me.data('requestRunning', false);
				}
			});
		});

	}


	//edit
	$(document).on('click', '#edit_fuel', function () {
		var id = $(this).data('id');
		$('input[name="fuel_date[' + id + ']"]').prop('disabled', false);
		$('select[name="fuel_staff_id[' + id + ']"]').prop('disabled', false);
		$('select[name="fuel_staff_id[' + id + ']"]').parent('div').children('button').removeClass('disabled');
		$('input[name="fuel_one_liter_price[' + id + ']"]').prop('disabled', false);
		$('input[name="fuel_count_liter[' + id + ']"]').prop('disabled', false);
		$('input[name="fuel_price[' + id + ']"]').prop('disabled', false);

		$(this).parent('td').html('<button\n' +
			'\t\t\t\t\tdata-id="' + id + '"\n' +
			'\t\t\t\t\tid="edit_fuel_btn"\n' +
			'\t\t\t\t\tstyle="min-width: 94px;\n' +
			'\t\t\t\t\tfont-size: 14px !important;\n' +
			'\t\t\t\t\tline-height: 14px !important;\n' +
			'\t\t\t\t\tpadding: 10px 24px !important;\n' +
			'\t\t\t\t\tfont-weight: 500 !important;\n' +
			'\t\t\t\t\tmargin-top: -4px;\n' +
			'\t\t\t\t\tmin-height: 37px !important;" type="button" id="search" class="ml-2 save_cancel_btn btn btn-success"><?=lang('edit')?></button>');
	});


	$(document).on('keyup', 'input[name^="fuel_count_liter["]', function () {
		var id = $(this).parent('td').parent('tr').find('button#edit_fuel_btn').data('id');
		var count = $(this).val();
		var one_liter_price = $('input[name="fuel_one_liter_price[' + id + ']"]').val();

		sum = parseFloat(count) * parseFloat(one_liter_price);

		$('input[name="fuel_price[' + id + ']"]').val(sum);

	});

	$(document).on('keyup', 'input[name^="fuel_one_liter_price["]', function () {
		var id = $(this).parent('td').parent('tr').find('button#edit_fuel_btn').data('id');
		var count = $('input[name="fuel_count_liter[' + id + ']"]').val();
		var one_liter_price = $(this).val();
		sum = parseFloat(count) * parseFloat(one_liter_price);

		$('input[name="fuel_price[' + id + ']"]').val(sum);

	});


	$(document).on('click', '#edit_fuel_btn', function (e) {
		var td = $(this).parent('td');
		var id = $(this).data('id');

		var fuel_add_date = $('input[name="fuel_date[' + id + ']"]').val();
		var fuel_staff_id = $('select[name="fuel_staff_id[' + id + ']"]').val();
		var fuel_one_liter_price = $('input[name="fuel_one_liter_price[' + id + ']"]').val();
		var fuel_count_liter = $('input[name="fuel_count_liter[' + id + ']"]').val();
		var fuel_price = $('input[name="fuel_price[' + id + ']"]').val();

		var url = '<?=base_url($this->uri->segment(1) . '/Structure/edit_fuel_ax') ?>';
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
				fuel_id: id,
				fuel_add_date: fuel_add_date,
				fuel_staff_id: fuel_staff_id,
				fuel_one_liter_price: fuel_one_liter_price,
				fuel_count_liter: fuel_count_liter,
				fuel_price: fuel_price
			},
			success: function (data) {
				if (data.success == '1') {

					td.html('<span\n' +
						'\t\t\t\t\t\t\t\tid="edit_fuel"\n' +
						'\t\t\t\t\t\t\t\tdata-id="' + data.message + '"\n' +
						'\t\t\t\t\t\t\t\tstyle="border: none;padding-top: 5px;cursor: pointer; display: contents;"\n' +
						'\t\t\t\t\t\t\t\tclass="float-left text-secondary text-center" >\n' +
						'\t\t\t\t\t\t\t\t<i class="fas fa-edit"></i>\n' +
						'\t\t\t\t\t\t\t</span>');

					$('input[name="fuel_date[' + id + ']"]').prop('disabled', true);
					$('select[name="fuel_staff_id[' + id + ']"]').prop('disabled', true);
					$('select[name="fuel_staff_id[' + id + ']"]').parent('div').children('button').addClass('disabled');
					$('input[name="fuel_one_liter_price[' + id + ']"]').prop('disabled', true);
					$('input[name="fuel_count_liter[' + id + ']"]').prop('disabled', true);
					$('input[name="fuel_price[' + id + ']"]').prop('disabled', true);


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
	$('input[name^="fuel_price"]').each(function () {
		sum += parseInt($(this).val());
		console.log($(this).val());
	})

	$('td#sum').html(sum)

	$('.buttons-excel span').html('<?=lang('export')?>')
</script>
