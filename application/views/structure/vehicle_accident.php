<?
$folder = $this->session->folder;
?>
<style>
	a.ext > i{
		width: 90%;
		font-size: 20px;
		padding: 8px !important;
	}
</style>
<form id="vehicle_accident">
	<div class="row col-sm-12 col-md-12 bpp_o pb-5">
	<div class="container-fluid">
		<table id="ex_4" class="table table-striped table-borderless w-100">
			<thead class="thead_tables">
			<tr>
				<th class="table_th"><?=lang('vehicle')?></th>
				<th class="table_th"><?=lang('when')?> *</th>
				<th class="table_th"><?=lang('insurance_company')?> *</th>
				<th class="table_th"><?=lang('driver')?> *</th>
				<th class="table_th"><?=lang('conclusion_number')?> *</th>
				<th class="table_th"><?=lang('replacement_subject_specs_name')?></th>
				<th class="table_th"><?=lang('refundable_amount')?> *</th>
				<th class="table_th"><?=lang('picture')?></th>
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
							<input class="form-control text-center" title="" type="text" disabled name="accident_vehicle[<?= $row['id'] ?>]" value="<?= $row['brand_model'] ?>" >
							<span style="display: none"><?= $row['brand_model'] ?></span>
						</td>
						<td class="border">
							<input class="form-control text-center" title="" type="date" disabled name="accident_date[<?= $row['id'] ?>]" value="<?= $row['add_date'] ?>" >
							<span style="display: none"><?= $row['add_date'] ?></span>
						</td>

						<td class="border">
							<input disabled title="" type="text" name="accident_insurance_company[<?= $row['id'] ?>]" value="<?= $row['insurance_company'] ?>"
								   class="form-control text-center"/>
							<span style="display: none"><?= $row['insurance_company'] ?></span>
						</td>
						<td class="border" style="min-width: 150px;">
							<select disabled class="form-control selectpicker" data-size="5" name="accident_staff_id[<?= $row['id'] ?>]" title="<?=lang('driver')?>">
								<? foreach ($this->load->get_drivers($row['fleet_id']) as $st) { ?>
									<option <?= ($row['staff_id'] == $st['id'] ? 'selected' : '') ?>  value="<?= $st['id'] ?>"><?= $st['name'] ?></option>
								<? } ?>
							</select>
							<span style="display: none"><?= $row['staff_name'] ?></span>
						</td>
						<td class="border">
							<input disabled title="" type="text" name="accident_conclusion_number[<?= $row['id'] ?>]" value="<?= $row['conclusion_number'] ?>"
								   class="form-control text-center"/>
							<span style="display: none"><?= $row['conclusion_number'] ?></span>

						</td>
						<td class="border">
							<input disabled title="" type="text" name="accident_replacement_parts[<?= $row['id'] ?>]" value="<?= $row['replacement_parts'] ?>"
								   class="form-control text-center"/>
							<span style="display: none"><?= $row['replacement_parts'] ?></span>

						</td>
						<td class="border">
							<input disabled title="" type="text" name="accident_return_amount[<?= $row['id'] ?>]" value="<?= $row['return_amount'] ?>"
								   class="form-control text-center"/>
							<span style="display: none"><?= $row['return_amount'] ?></span>

						</td>

						<td class="border">
							<input style="width: 90%" disabled value="" title="" type="file" min="0" name="accident_file_<?= $row['id'] ?>"
								   id="accident_file_<?= $row['id'] ?>"
								   class="form-control text-center float-left"/>
							<input type="hidden" name="fl[<?= $row['id'] ?>]" value="<?=$row['fleet_id']?>">
							<a class="float-left ext"
							   style="width:10%"
							   target=""
							   download="<?= $row['file'] ?>"
							   href="<?= base_url('uploads/'.$folder.'/accident/fleet_'.$row['fleet_id'].'/') .  $row['file'] ?>">
								<?

								if($row['file']) {

									$ext = explode('.',  $row['file']);

									echo $this->select_ext($ext[1]);
								}
								?>

						</td>
						<td class="border">
							<span
								id="edit_accident"
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
				<td class="border">
					<input  value="" title="" type="file" min="0" name="accident_file_1"
							class="form-control text-center"/>
				</td>
				<td class="border"></td>
			</tr>
			<tr>
				<td class="font-weight-bold" ><?=lang('total')?></td>
				<td class="font-weight-bold" colspan="5"></td>
				<td class="font-weight-bold" id="sum"></td>
				<td></td>
				<td></td>
			</tr>
			</tfoot>
			<? } else {
				echo '
				<tfoot>
					<tr>
						<td class="font-weight-bold" >'.lang('total').'</td>
						<td class="font-weight-bold" colspan="5"></td>
						<td class="font-weight-bold" id="sum"></td>
						<td></td>
						<td></td>
					</tr>
				</tfoot>
				';
			}?>

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
							<th class="table_th"><?=lang('insurance_company')?> *</th>
							<th class="table_th" style="min-width: 150px;"><?=lang('driver')?> *</th>
							<th class="table_th"><?=lang('conclusion_number')?> *</th>
							<th class="table_th"><?=lang('replacement_subject_specs_name')?></th>
							<th class="table_th"><?=lang('refundable_amount')?> *</th>
							<th class="table_th"><?=lang('picture')?> </th>
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
								<td class="border">
									<input  value="" title="" type="file" min="0" name="accident_file_<?= $key + 1 ?>"
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
				'<td><input  value="" title="" type="file" min="0" name="accident_file_'+j+'" class="form-control text-center"/></td>\n' +
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
			{"orderable": false, "targets": 8}
		],
		dom: 'Bfrtip',
		buttons: [
			{
				extend: 'excelHtml5',
				title:  '<?=lang('Report_period').'  '.lang('from')?> '+$('input[name="from"]').val() + '  <?=lang('to')?> ' + $('input[name="to"]').val(),
				message: "<?=lang('company')?>: "+$('input[name="company"]').val()+",  <?=lang('user')?>: "+$('.username_login > a').text()+",  <?=lang('type')?>:  <?=lang('accident')?> ",
				autoWidth: true,
				filename: 'accident',
				footer: true,
				exportOptions: {
					format: {
						body: function ( data, row, column, node ) {
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


	//edit
	$(document).on('click', '#edit_accident', function() {
		var id = $(this).data('id');
		$('input[name="accident_date['+id+']"]').prop('disabled', false);
		$('select[name="accident_staff_id['+id+']"]').prop('disabled', false);
		$('select[name="accident_staff_id['+id+']"]').parent('div').children('button').removeClass('disabled');
		$('input[name="accident_insurance_company['+id+']"]').prop('disabled', false);
		$('input[name="accident_conclusion_number['+id+']"]').prop('disabled', false);
		$('input[name="accident_replacement_parts['+id+']"]').prop('disabled', false);
		$('input[name="accident_return_amount['+id+']"]').prop('disabled', false);
		$('input[name="accident_file_'+id+'"]').prop('disabled', false);

		$(this).parent('td').html('<button\n' +
			'\t\t\t\t\tdata-id="'+id+'"\n' +
			'\t\t\t\t\tid="edit_accident_btn"\n' +
			'\t\t\t\t\tstyle="min-width: 94px;\n' +
			'\t\t\t\t\tfont-size: 14px !important;\n' +
			'\t\t\t\t\tline-height: 14px !important;\n' +
			'\t\t\t\t\tpadding: 10px 24px !important;\n' +
			'\t\t\t\t\tfont-weight: 500 !important;\n' +
			'\t\t\t\t\tmargin-top: -4px;\n' +
			'\t\t\t\t\tmin-height: 37px !important;" type="button" id="search" class="ml-2 save_cancel_btn btn btn-success"><?=lang('edit')?></button>');
	});


	$(document).on('click', '#edit_accident_btn', function (e) {
		var td = $(this).parent('td');
		var id = $(this).data('id');

		var form_data = new FormData($('form#vehicle_accident')[0]);

		form_data.append('accident_id', id);

		var accident_add_date = $('input[name="accident_date['+id+']"]').val();
		var accident_staff_id = $('select[name="accident_staff_id['+id+']"]').val();
		var accident_insurance_company = $('input[name="accident_insurance_company['+id+']"]').val();
		var accident_conclusion_number = $('input[name="accident_conclusion_number['+id+']"]').val();
		var accident_replacement_parts = $('input[name="accident_replacement_parts['+id+']"]').val();
		var accident_return_amount = $('input[name="accident_return_amount['+id+']"]').val();

		var url = '<?=base_url($this->uri->segment(1) . '/Structure/edit_accident_ax') ?>';
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
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			success: function (data) {
				if (data.success == '1') {

					td.html('<span\n'+
						'\t\t\t\t\t\t\t\tid="edit_accident"\n'+
						'\t\t\t\t\t\t\t\tdata-id="'+data.message+'"\n'+
						'\t\t\t\t\t\t\t\tstyle="border: none;padding-top: 5px;cursor: pointer; display: contents;"\n'+
						'\t\t\t\t\t\t\t\tclass="float-left text-secondary text-center" >\n'+
						'\t\t\t\t\t\t\t\t<i class="fas fa-edit"></i>\n'+
						'\t\t\t\t\t\t\t</span>');

					$('input[name="accident_date['+id+']"]').prop('disabled', true);
					$('select[name="accident_staff_id['+id+']"]').prop('disabled', true);
					$('select[name="accident_staff_id['+id+']"]').parent('div').children('button').addClass('disabled');
					$('input[name="accident_insurance_company['+id+']"]').prop('disabled', true);
					$('input[name="accident_conclusion_number['+id+']"]').prop('disabled', true);
					$('input[name="accident_replacement_parts['+id+']"]').prop('disabled', true);
					$('input[name="accident_return_amount['+id+']"]').prop('disabled', true);
					$('input[name="accident_file_'+id+'"]').prop('disabled', true);


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
	$('input[name^="accident_return_amount"]').each(function () {
		sum += parseInt($(this).val());
		console.log($(this).val());
	});

	$('td#sum').html(sum);

	$('.buttons-excel span').html('<?=lang('export')?>')

</script>


