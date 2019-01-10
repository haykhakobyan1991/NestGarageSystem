<form id="vehicle_accident">
	<div class="row col-sm-12 col-md-12 bpp_o pb-5">
	<div class="container-fluid">
		<table id="ex_4" class="table table-striped table-borderless w-100">
			<thead class="thead_tables">
			<tr>
				<th class="table_th"><?=lang('vehicle')?></th>
				<th class="table_th"><?=lang('when')?></th>
				<th class="table_th"><?=lang('insurance_company')?></th>
				<th class="table_th"><?=lang('driver')?></th>
				<th class="table_th"><?=lang('conclusion_number')?></th>
				<th class="table_th"><?=lang('replacement_subject_specs_name')?></th>
				<th class="table_th"><?=lang('refundable_amount')?></th>
				<th class="">
					<? if (count($fleet['id']) > 1) { ?>
					<span data-toggle="modal"
						  data-target="#vehicle_accident_m"
						  class=" btn btn-outline-secondary btn-sm " data-id="ex_4"
						  style="padding: .25rem .5rem !important;">
				<? } else { ?>
						<span class="ex_4_add_new_tr btn btn-outline-secondary btn-sm " data-id="ex_4"
							  style="padding: .25rem .5rem !important;">
				<? } ?>
							<i class="fa fa-plus"></i>
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
							<?= $row['insurance_company'] ?>
						</td>
						<td class="border">
							<?= $row['staff_name'] ?>
						</td>
						<td class="border">
							<?= $row['conclusion_number'] ?>
						</td>
						<td class="border">
							<?= $row['replacement_parts'] ?>
						</td>
						<td class="border">
							<?= $row['return_amount'] ?>
						</td>

						<td class="border"></td>
					</tr>

					<?
				}
			}
			echo '</tbody>';
			if (count($fleet['id']) == 1) { ?>
			<tfoot class="ex_4">
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
					<input title="" type="text" name="insurance_company[1]" value=""
						   class="form-control text-center"/>
				</td>

				<td class="border" style="min-width: 150px;">
					<select class="form-control selectpicker" data-size="5" name="staff_id[1]" title="Վարորդ">
						<? foreach ($staff as $st) { ?>
							<option value="<?= $st['id'] ?>"><?= $st['name'] ?></option>
						<? } ?>
					</select>
				</td>

				<td class="border">
					<input title="" type="text" name="conclusion_number[1]" value=""
						   class="form-control text-center"/>
				</td>
				<td class="border">
					<input title="" type="text" name="replacement_parts[1]" value=""
						   class="form-control text-center"/>
				</td>
				<td class="border">
					<input title="" type="number" min="0" name="return_amount[1]" value=""
						   class="form-control text-center"/>
				</td>
				<td class="border"></td>
			</tr>
			</tfoot>
			<? } ?>
			</tbody>
		</table>
	</div>
</div>

</form>

<div class="pos_abs_div fixed-bottom text-left pb-2 mt-md-2 mt-2">
	<span id="accident" class="save_cancel_btn btn btn-success"><?= lang('save') ?></span>
	<span id="load" class="btn save_cancel_btn btn-success d-none">
		<?=$this->load->loading_svg()?>
	</span>

	<button class="dont_save btn btn-primary"><?= lang('cancel') ?></button>
	<span style="color: #8c8c8c;" class="pl-3"><?= lang('changed_property') ?></span>
</div>

<!--   Modal Start -->
<form id="vehicle_accident_modal">
	<div class="modal fade " tabindex="-1" role="dialog" id="vehicle_accident_m"
		 aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="max-width: 80%;">
			<div class="modal-content">
				<div class="modal-header bg-dark">
					<h6 class="text-white modal-title dar"><?=lang('accident')?></h6>

				</div>
				<div class="modal-body">
					<table class="table table-striped table-borderless w-100">
						<thead class="thead_tables">
						<tr>
							<th class="table_th"><?=lang('vehicle')?></th>
							<th class="table_th"><?=lang('when')?></th>
							<th class="table_th"><?=lang('insurance_company')?></th>
							<th class="table_th" style="min-width: 150px;"><?=lang('driver')?></th>
							<th class="table_th"><?=lang('conclusion_number')?></th>
							<th class="table_th"><?=lang('replacement_subject_specs_name')?></th>
							<th class="table_th"><?=lang('refundable_amount')?></th>
						</tr>
						</thead>
						<tbody>
						<? foreach ($fleet['name'] as $key => $name) { ?>
							<tr class="">
								<td class="border">
									<?= $name ?>
									<input type="hidden" name="fl_id[<?= $key + 1 ?>]"
										   value="<?= $fleet['id'][$key] ?>">
								</td>
								<td class="border">
									<input title="" type="date" name="date[<?= $key + 1 ?>]"
										   value="<?= mdate('%Y-%m-%d', now()) ?>"
										   class="form-control text-center"/>
								</td>
								<td class="border">
									<input type="text" name="insurance_company[<?= $key + 1 ?>]"
										   class="form-control">
								</td>
								<td>
									<select class="form-control selectpicker" data-size="5"
											name="staff_id[<?= $key + 1 ?>]" title="<?=lang('driver')?>">
										<? foreach ($this->load->get_drivers($fleet['id'][$key]) as $st) { ?>
											<option value="<?= $st['id'] ?>"><?= $st['name'] ?></option>
										<? } ?>
									</select>
								</td>
								<td class="border">
									<input type="text" name="conclusion_number[<?= $key + 1 ?>]"
										   class="form-control">
								</td>

								<td class="border">
									<input type="text" name="replacement_parts[<?= $key + 1 ?>]"
										   class="form-control">
								</td>

								<td class="border">
									<input title="" type="number" min="0" name="return_amount[<?= $key + 1 ?>]" value=""
										   class="form-control text-center"/>
								</td>
							</tr>

						<? } ?>
						</tbody>
					</table>


					<div class="modal-footer pb-0">
						<button id="vehicle_accident_add" type="button"
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


	//vehicle accident
	var j = 1;
	$(document).on('click', '.ex_4_add_new_tr', function (e) {
		j++;


		var fleet = $('input[name="vehicle[1]"]').val();

		var me = $(this);
		e.preventDefault();

		if (me.data('requestRunning')) {
			return;
		}

		me.data('requestRunning', true);

		$.when(
			$('.ex_4').append('<tr role="row">\n' +
				'<td><input readonly title="" type="text" name="vehicle[' + j + ']" value="' + fleet + '" class="form-control text-center"/></td>\n' +
				'<td><input  title="" type="date" name="date[' + j + ']" value="<?= mdate('%Y-%m-%d', now()) ?>" class="form-control text-center"/></td>\n' +
				'<td><input  title="" type="text" name="insurance_company[' + j + ']"  class="form-control text-center"/></td>\n' +
				'<td>' +
				'<select class="form-control selectpicker" data-size="5"  name="staff_id[' + j + ']" title="<?=lang('driver')?>">\n' +
				'\t\t\t\t\t\t\t<?foreach ($staff as $st) {?>\n' +
				'\t\t\t\t\t\t\t\t<option value="<?=$st['id']?>"><?=$st['name']?></option>\n' +
				'\t\t\t\t\t\t\t<?}?>\n' +
				'\t\t\t\t\t\t</select>' +
				'</td>\n' +
				'<td><input title="" type="text" name="conclusion_number[' + j + ']" value="" class="form-control text-center"/></td>\n' +
				'<td><input title="" type="text" name="replacement_parts[' + j + ']" value="" class="form-control text-center"/></td>\n' +
				'<td><input title="" type="number" name="return_amount[' + j + ']" value="" class="form-control text-center"/></td>\n' +
				'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row" > </i></td>\n' +
				'</tr>')
		).then(function () {
			me.data('requestRunning', false);

			$('select').selectpicker('refresh');

			$('.selectpicker').parent('div').children('button').css({
				'background': '#fff',
				'color': '#000',
				'border': '1px solid #ced4da'
			});
			$('.selectpicker').parent('div').children('button').removeClass('btn-light');
		});


	});


	$('select').selectpicker('refresh');


	$('.selectpicker').parent('div').children('button').css({
		'background': '#fff',
		'color': '#000',
		'border': '1px solid #ced4da'
	});
	$('.selectpicker').parent('div').children('button').removeClass('btn-light');


	var table = $('#ex_4').DataTable({
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
			{"orderable": false, "targets": 7}
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

	table.buttons().container()
		.appendTo( '#ex_4_wrapper #ex_4_filter:eq(0)' );

	$('.dt-buttons').css('float', 'left');




	<? if (count($fleet['id']) == 1) {?>

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


	ajax('form#vehicle_accident', 'span#accident');

	ajax('form#vehicle_accident_modal', '#vehicle_accident_add');

	function ajax(form, button) {

		$(document).on('click', button, function (e) {
			var url = '<?=base_url($this->uri->segment(1) . '/Structure/accident_ax') ?>';
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


