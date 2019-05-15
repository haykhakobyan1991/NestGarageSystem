<style>
	input::placeholder {
		font-size: 12px !important;
	}
</style>

<form
	id="vehicle_grease">
	<div
		class="row col-sm-12 col-md-12 bpp_o pb-5">
		<div
			class="container-fluid">
			<table
				id="ex_10"
				class="table table-striped table-borderless w-100">
				<thead
					class="thead_tables">
				<tr>
					<th class="table_th"><?= lang('vehicle') ?></th>
					<th class="table_th"><?= lang('when') ?></th>
					<th class="table_th"><?= lang('whence') ?></th>
					<th class="table_th"><?= lang('producer') ?></th>
					<th class="table_th"><?= lang('model') ?></th>
					<th class="table_th"><?= lang('quantity_liter') ?></th>
					<th class="table_th"><?= lang('unit_cost') ?></th>
					<th class="table_th"><?= lang('price') ?></th>
					<th class="table_th"><?= lang('other_info') ?></th>
					<th class="">
						<? if (count($fleet['id']) > 1) { ?>
						<span
							data-toggle="modal"
							data-target="#vehicle_grease_m"
							class=" btn btn-outline-secondary btn-sm "
							data-id="ex_10"
							style="padding: .25rem .5rem !important;">
				<? } else { ?>
						<span
							class="ex_10_add_new_tr btn btn-outline-secondary btn-sm "
							data-id="ex_10"
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
								<?= $row['brand_model'] ?>
							</td>

							<td class="border">
								<?= $row['add_date'] ?>
							</td>

							<td class="border">
								<?= $row['whence'] ?>
							</td>

							<td class="border">
								<?= $row['producer'] ?>
							</td>

							<td class="border">
								<?= $row['model'] ?>
							</td>

							<td class="border">
								<?= $row['count'] ?>
							</td>

							<td class="border">
								<?= $row['one_price'] ?>
							</td>

							<td class="border">
								<?= $row['price'] ?>
							</td>

							<td class="border">
								<?= $row['other_info'] ?>
							</td>

							<td class="border"></td>
						</tr>

						<?
					}
				}
				echo '</tbody>';
				if (count($fleet['id']) == 1) { ?>

				<tfoot
					class="ex_10">
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
							type="text"
							name="whence[1]"
							class="form-control text-center"/>
					</td>
					<td class="border">
						<input
							title=""
							type="text"
							name="producer[1]"
							class="form-control text-center"/>
					</td>
					<td class="border">
						<input
							title=""
							type="text"
							name="model[1]"
							class="form-control text-center"/>
					</td>
					<td class="border">
						<input
							title=""
							type="number"
							min="0"
							name="count[1]"
							class="form-control text-center"/>
					</td>
					<td class="border">
						<input
							title=""
							type="number"
							min="0"
							name="one_price[1]"
							class="form-control text-center"/>
					</td>
					<td class="border">
						<input
							title=""
							type="number"
							min="0"
							name="price[1]"
							class="form-control text-center"/>
					</td>

					<td class="border">
						<input
							title=""
							type="text"
							name="other_info[1]"
							class="form-control text-center"/>
					</td>
					<td class="border"></td>
				</tr>
				</tfoot>
				<? } ?>

			</table>
		</div>
	</div>

</form>

<div
	class="pos_abs_div fixed-bottom text-left pb-2 mt-md-2 mt-2">
	<span
		id="grease"
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
	id="vehicle_grease_modal">
	<div
		class="modal fade "
		tabindex="-1"
		role="dialog"
		id="vehicle_grease_m"
		aria-labelledby="myLargeModalLabel"
		aria-hidden="true">
		<div
			class="modal-dialog"
			style="max-width: 80%;">
			<div
				class="modal-content">
				<div
					class="modal-header bg-dark">
					<h6 class="text-white modal-title dar"><?= lang('grease') ?></h6>

				</div>
				<div
					class="modal-body">


					<table
						id="ex_10"
						class="table table-striped table-borderless w-100">
						<thead
							class="thead_tables">
						<tr>
							<th class="table_th"><?= lang('vehicle') ?></th>
							<th class="table_th"><?= lang('when') ?></th>
							<th class="table_th"><?= lang('whence') ?></th>
							<th class="table_th"><?= lang('producer') ?></th>
							<th class="table_th"><?= lang('model') ?></th>
							<th class="table_th"><?= lang('quantity_liter') ?></th>
							<th class="table_th"><?= lang('unit_cost') ?></th>
							<th class="table_th"><?= lang('price') ?></th>
							<th class="table_th"><?= lang('other_info') ?></th>
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
								<td class="border">
									<input
										title=""
										type="text"
										name="whence[<?= $key + 1 ?>]"
										class="form-control text-center"/>
								</td>
								<td class="border">
									<input
										title=""
										type="text"
										name="producer[<?= $key + 1 ?>]"
										class="form-control text-center"/>
								</td>
								<td class="border">
									<input
										title=""
										type="text"
										name="model[<?= $key + 1 ?>]"
										class="form-control text-center"/>
								</td>

								<td class="border">
									<input
										title=""
										type="number"
										min="0"
										name="count[<?= $key + 1 ?>]"
										class="form-control text-center"/>
								</td>
								<td class="border">
									<input
										title=""
										type="number"
										min="0"
										name="one_price[<?= $key + 1 ?>]"
										class="form-control text-center"/>
								</td>
								<td class="border">
									<input
										title=""
										type="number"
										min="0"
										name="price[<?= $key + 1 ?>]"
										class="form-control text-center"/>
								</td>
								<td class="border">
									<input
										title=""
										type="text"
										name="other_info[<?= $key + 1 ?>]"
										class="form-control text-center"/>
								</td>
							</tr>

							<script>

								$(document).on('keyup', 'input[name="count[<?=$key + 1?>]"]', function () {
									var count = $(this).val();
									var one_price = $('input[name="one_price[<?=$key + 1?>]"]').val();

									sum = parseFloat(count) * parseFloat(one_price);

									$('input[name="price[<?=$key + 1?>]"]').val(sum);

								});

								$(document).on('keyup', 'input[name="one_price[<?=$key + 1?>]"]', function () {
									var count = $('input[name="count[<?=$key + 1?>]"]').val();
									var one_price = $(this).val();
									sum = parseFloat(count) * parseFloat(one_price);

									$('input[name="price[<?=$key + 1?>]"]').val(sum);

								});
							</script>
						<? } ?>
						</tbody>
					</table>


					<div
						class="modal-footer pb-0">
						<button
							id="vehicle_grease_add"
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


	$(document).on('keyup', 'input[name="count[1]"]', function () {
		var count = $(this).val();
		var one_price = $('input[name="one_price[1]"]').val();

		sum = parseFloat(count) * parseFloat(one_price);

		$('input[name="price[1]"]').val(sum);

	});

	$(document).on('keyup', 'input[name="one_price[1]"]', function () {
		var count = $('input[name="count[1]"]').val();
		var one_price = $(this).val();
		sum = parseFloat(count) * parseFloat(one_price);

		$('input[name="price[1]"]').val(sum);

	});


	var table = $('#ex_10').DataTable({
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
				"targets": 9
			}
		],
		dom: 'Bfrtip',
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

	table.order([0, 'asc']).draw();

	$('.buttons-html5').append('<i style="padding-left: 10px;" class="fas fa-print"></i>');
	$('.buttons-colvis span').text('');
	$('.buttons-colvis span').text('<?=lang('column_visibility')?>');

	table.buttons().container()
		.appendTo('#ex_10_wrapper #ex_10_filter:eq(0)');

	$('.dt-buttons').css('float', 'left');


	//vehicle grease
	var j = 1;
	$(document).on('click', '.ex_10_add_new_tr', function (e) {
		j++;


		var fleet = $('input[name="vehicle[1]"]').val();

		var me = $(this);
		e.preventDefault();

		if (me.data('requestRunning')) {
			return;
		}

		me.data('requestRunning', true);

		$.when(
			$('.ex_10').append('<tr role="row">\n' +
				'<td><input readonly title="" type="text" name="vehicle[' + j + ']" value="' + fleet + '" class="form-control text-center"/></td>\n' +
				'<td><input  title="" type="date" name="date[' + j + ']" value="<?= mdate('%Y-%m-%d', now()) ?>" class="form-control text-center"/></td>\n' +
				'<td class="border">\n' +
				'\t<input title="" type="text" name="whence[' + j + ']"\n' +
				'\t\t   class="form-control text-center"/>\n' +
				'</td>\n' +
				'<td class="border">\n' +
				'\t<input title="" type="text" name="producer[' + j + ']"\n' +
				'\t\t   class="form-control text-center"/>\n' +
				'</td>\n' +
				'<td class="border">\n' +
				'\t<input title="" type="text" name="model[' + j + ']"\n' +
				'\t\t   class="form-control text-center"/>\n' +
				'</td>\n' +
				'<td class="border">\n' +
				'\t<input title="" type="number" min="0" name="count[' + j + ']"\n' +
				'\t\t   class="form-control text-center"/>\n' +
				'</td>\n' +
				'<td class="border">\n' +
				'\t<input title="" type="number" min="0" name="one_price[' + j + ']"\n' +
				'\t\t   class="form-control text-center"/>\n' +
				'</td>\n' +
				'<td class="border">\n' +
				'\t<input title="" type="number" min="0" name="price[' + j + ']"\n' +
				'\t\tclass="form-control text-center"/>\n' +
				'\t</td>' +
				'<td class="border">\n' +
				'\t<input title="" type="text" name="other_info[' + j + ']"\n' +
				'\t\tclass="form-control text-center"/>\n' +
				'\t</td>' +
				'<td>' +
				'<span class="btn btn-outline-secondary btn-sm del_row_ft" style="padding: .25rem .5rem !important;">' +
				'<i class=" fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"> </i>' +
				'</span>' +
				'</td>\n' +
				'</tr>' +
				'\n' +
				'<script>' +
				'$(\'select\').selectpicker(\'refresh\');' +
				'$(\'.selectpicker\').parent(\'div\').children(\'button\').css({\n' +
				'\t\t\t\'background\': \'#fff\',\n' +
				'\t\t\t\'color\': \'#000\',\n' +
				'\t\t\t\'border\': \'1px solid #ced4da\'\n' +
				'\t\t});\n' +
				'\t\t$(\'.selectpicker\').parent(\'div\').children(\'button\').removeClass(\'btn-light\');' +
				'$(document).on(\'keyup\', \'input[name="count[' + j + ']"]\', function () {\n' +
				'\t\t\t\t\tvar count = $(this).val();\n' +
				'\t\t\t\t\tvar one_price = $(\'input[name="one_price[' + j + ']"]\').val();\n' +
				'\n' +
				'\t\t\t\t\tsum =  parseFloat(count) * parseFloat(one_price);\n' +
				'\n' +
				'\t\t\t\t\t$(\'input[name="price[' + j + ']"]\').val(sum);\n' +
				'\n' +
				'\t\t\t\t});\n' +
				'\n' +
				'\t\t\t\t$(document).on(\'keyup\', \'input[name="one_price[' + j + ']"]\', function () {\n' +
				'\t\t\t\t\tvar count = $(\'input[name="count[' + j + ']"]\').val();\n' +
				'\t\t\t\t\tvar one_price = $(this).val();\n' +
				'\t\t\t\t\tsum =  parseFloat(count) * parseFloat(one_price);\n' +
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


	ajax('form#vehicle_grease', 'span#grease');

	ajax('form#vehicle_grease_modal', '#vehicle_grease_add');

	function ajax(form, button) {

		$(document).on('click', button, function (e) {
			var url = '<?=base_url($this->uri->segment(1) . '/Structure/grease_ax') ?>';
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
</script>
