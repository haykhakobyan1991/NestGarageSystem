
<form id="vehicle_fine">
	<div class="row col-sm-12 col-md-12 bpp_o pb-5">
	<div class="container-fluid">
		<table id="ex_3" class="table table-striped table-borderless w-100">
			<thead class="thead_tables">
			<tr>
				<th class="table_th"><?=lang('vehicle')?></th>
				<th class="table_th"><?=lang('when')?></th>
				<th class="table_th"><?=lang('type')?> *</th>
				<th class="table_th" style="min-width: 150px;"><?=lang('driver')?> *</th>
				<th class="table_th"><?=lang('other_info')?></th>
				<th class="table_th"><?=lang('price')?> *</th>
				<th class="">
					<? if (count($fleet['id']) > 1) { ?>
					<span data-toggle="modal"
						  data-target="#vehicle_fine_m"
						  class=" btn btn-outline-secondary btn-sm " data-id="ex_3"
						  style="padding: .25rem .5rem !important;">
				<? } else { ?>
						<span class="ex_3_add_new_tr btn btn-outline-secondary btn-sm " data-id="ex_3"
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
							<input class="form-control text-center" title="" type="text" disabled name="vehicle[<?= $row['id'] ?>]" value="<?= $row['brand_model'] ?>" >
							<span style="display: none"><?= $row['brand_model'] ?></span>
						</td>
						<td class="border">
							<input class="form-control text-center" title="" type="date" disabled name="fine_date[<?= $row['id'] ?>]" value="<?= $row['add_date'] ?>" >
							<span style="display: none"><?= $row['add_date'] ?></span>
						</td>
						<td class="border">
							<input class="form-control text-center" title="" type="text" disabled name="fine_type[<?= $row['id'] ?>]" value="<?= $row['type'] ?>" >
							<span style="display: none"><?= $row['type'] ?></span>
						</td>
						<td class="border">
							<select disabled class="form-control selectpicker" data-size="5" name="fine_staff_id[<?= $row['id'] ?>]" title="<?=lang('driver')?>">
								<? foreach ($this->load->get_drivers($row['fleet_id']) as $st) { ?>
									<option <?= ($row['staff_id'] == $st['id'] ? 'selected' : '') ?>  value="<?= $st['id'] ?>"><?= $st['name'] ?></option>
								<? } ?>
							</select>
							<span style="display: none"><?= $row['staff_name'] ?></span>
						</td>
						<td class="border">
							<input class="form-control text-center" title="" type="text" disabled name="fine_other_info[<?= $row['id'] ?>]" value="<?= $row['other_info'] ?>" >
							<span style="display: none"><?= $row['other_info'] ?></span>
						</td>
						<td class="border">
							<input disabled title="" type="number" min="0" name="fine_price[<?= $row['id'] ?>]" value="<?= $row['price'] ?>"
								   class="form-control text-center"/>
							<span style="display: none"><?= $row['price'] ?></span>
						</td>
						<td class="border">
							<span
								id="edit_fine"
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
			<tfoot class="ex_3">
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
					<input title="" type="text" name="type[1]" value=""
						   class="form-control text-center"/>
				</td>
				<td class="border">
					<select class="form-control selectpicker" data-size="5" name="staff_id[1]" title="<?=lang('driver')?>">
						<? foreach ($staff as $st) { ?>
							<option value="<?= $st['id'] ?>"><?= $st['name'] ?></option>
						<? } ?>
					</select>

				</td>
				<td class="border">
					<input title="" type="text" name="other_info[1]" value=""
						   class="form-control text-center"/>
				</td>
				<td class="border">
					<input title="" type="number" min="0" name="price[1]" value=""
						   class="form-control text-center"/>
				</td>
				<td class="border"></td>
			</tr>
			<tr>
				<td class="font-weight-bold" style="text-align: left !important;" ><?=lang('total')?></td>
				<td class="font-weight-bold" colspan="4"></td>
				<td class="font-weight-bold" id="sum"></td>
				<td></td>
			</tr>
			</tfoot>
			<? } else {
				echo '
				<tfoot>
					<tr>
						<td class="font-weight-bold" style="text-align: left !important;" >'.lang('total').'</td>
						<td class="font-weight-bold"  colspan="4"></td>
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
	<span id="fuel" class="save_cancel_btn btn btn-success"><?= lang('save') ?></span>
	<span id="load" class="btn save_cancel_btn btn-success d-none">
		<?=$this->load->loading_svg()?>
	</span>

	<button class="dont_save btn btn-primary"><?= lang('cancel') ?></button>
	<span style="color: #8c8c8c;" class="pl-3"><?= lang('changed_property') ?></span>
</div>

<!--   Modal Start -->
<form id="vehicle_fine_modal">
	<div class="modal fade " tabindex="-1" role="dialog" id="vehicle_fine_m"
		 aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="max-width: 80%">
			<div class="modal-content">
				<div class="modal-header bg-dark">
					<h6 class="text-white modal-title dar"><?=lang('fine')?></h6>

				</div>
				<div class="modal-body">

					<table class="table table-striped table-borderless w-100">
						<thead class="thead_tables">
						<tr>
							<th class="table_th"><?=lang('vehicle')?></th>
							<th class="table_th"><?=lang('when')?></th>
							<th class="table_th"><?=lang('type')?> *</th>
							<th class="table_th" style="min-width: 150px;"><?=lang('driver')?> *</th>
							<th class="table_th"><?=lang('other_info')?></th>
							<th class="table_th"><?=lang('price')?> *</th>
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
									<input type="text" name="type[<?= $key + 1 ?>]"
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
									<input type="text" name="other_info[<?= $key + 1 ?>]"
										   class="form-control">
								</td>

								<td class="border">
									<input title="" type="number" min="0" name="price[<?= $key + 1 ?>]" value=""
										   class="form-control text-center"/>
								</td>
							</tr>

						<? } ?>
						</tbody>
					</table>


					<div class="modal-footer pb-0">
						<button id="vehicle_fine_add" type="button"
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


	//vehicle fine
	var k = 1;
	$(document).on('click', '.ex_3_add_new_tr', function (e) {
		k++;

		var fleet = $('input[name="vehicle[1]"]').val();


		var me = $(this);
		e.preventDefault();

		if (me.data('requestRunning')) {
			return;
		}

		me.data('requestRunning', true);

		$.when($('.ex_3').append('<tr role="row">\n' +
			'<td><input title="" readonly type="text" name="vehicle[' + k + ']" value="' + fleet + '"  class="form-control text-center"/></td>\n' +
			'<td><input title="" type="date" name="date[' + k + ']" value="<?= mdate('%Y-%m-%d', now()) ?>"  class="form-control text-center"/></td>\n' +
			'<td><input title=""  type="text" name="type[' + k + ']" value=""  class="form-control text-center"/></td>\n' +
			'<td>' +
			'<select class="form-control selectpicker" data-size="5"  name="staff_id[' + k + ']" title="<?=lang('driver')?>">\n' +
                    '\t\t\t\t<?foreach ($staff as $st) {?>\n' +
                    '\t\t\t\t<option value="<?=$st['id']?>"><?=$st['name']?></option>\n' +
                    '\t\t\t\t<?}?>\n' +
                    '\t\t\t\t</select>\n' +
                    '</td>\n' +
                    '<td><input title=""  type="text" name="other_info[' + k + ']" value=""  class="form-control text-center"/></td>\n' +
                    '<td><input title="" type="number" name="price[' + k + ']" min="0" class="form-control text-center"/></td>\n' +
                    '<td>' +
                    '<span class="btn btn-outline-secondary btn-sm del_row_ft" style="padding: .25rem .5rem !important;">' +
                    '<i class=" fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"> </i>' +
                    '</span>' +
                    '</td>\n' +
                    '</tr>')).then(function () {
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

            var table = $('#ex_3').DataTable({
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
                    {"orderable": false, "targets": 6}
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
						title:  '<?=lang('Report_period').'  '.lang('from')?> '+$('input[name="from"]').val() + '  <?=lang('to')?> ' + $('input[name="to"]').val(),
						messageTop: '<?=lang('user')?> '+$('.username_login > a').text(),
                        filename: 'fine',
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
                .appendTo( '#ex_3_wrapper #ex_3_filter:eq(0)' );

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


	ajax('form#vehicle_fine', 'span#fuel');

	ajax('form#vehicle_fine_modal', '#vehicle_fine_add');

	function ajax(form, button) {

		$(document).on('click', button, function (e) {
			var url = '<?=base_url($this->uri->segment(1) . '/Structure/fine_ax') ?>';
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
	$(document).on('click', '#edit_fine', function() {
		var id = $(this).data('id');
		$('input[name="fine_date['+id+']"]').prop('disabled', false);
		$('select[name="fine_staff_id['+id+']"]').prop('disabled', false);
		$('select[name="fine_staff_id['+id+']"]').parent('div').children('button').removeClass('disabled');
		$('input[name="fine_type['+id+']"]').prop('disabled', false);
		$('input[name="fine_other_info['+id+']"]').prop('disabled', false);
		$('input[name="fine_price['+id+']"]').prop('disabled', false);

		$(this).parent('td').html('<button\n' +
			'\t\t\t\t\tdata-id="'+id+'"\n' +
			'\t\t\t\t\tid="edit_fine_btn"\n' +
			'\t\t\t\t\tstyle="min-width: 94px;\n' +
			'\t\t\t\t\tfont-size: 14px !important;\n' +
			'\t\t\t\t\tline-height: 14px !important;\n' +
			'\t\t\t\t\tpadding: 10px 24px !important;\n' +
			'\t\t\t\t\tfont-weight: 500 !important;\n' +
			'\t\t\t\t\tmargin-top: -4px;\n' +
			'\t\t\t\t\tmin-height: 37px !important;" type="button" id="search" class="ml-2 save_cancel_btn btn btn-success"><?=lang('edit')?></button>');
	});


	$(document).on('click', '#edit_fine_btn', function (e) {
		var td = $(this).parent('td');
		var id = $(this).data('id');

		var fine_add_date = $('input[name="fine_date['+id+']"]').val();
		var fine_staff_id = $('select[name="fine_staff_id['+id+']"]').val();
		var fine_type = $('input[name="fine_type['+id+']"]').val();
		var fine_other_info = $('input[name="fine_other_info['+id+']"]').val();
		var fine_price = $('input[name="fine_price['+id+']"]').val();

		var url = '<?=base_url($this->uri->segment(1) . '/Structure/edit_fine_ax') ?>';
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
			data: {fine_id: id, fine_add_date: fine_add_date, fine_staff_id: fine_staff_id, fine_type: fine_type, fine_other_info: fine_other_info, fine_price: fine_price},
			success: function (data) {
				if (data.success == '1') {

					td.html('<span\n'+
						'\t\t\t\t\t\t\t\tid="edit_fine"\n'+
						'\t\t\t\t\t\t\t\tdata-id="'+data.message+'"\n'+
						'\t\t\t\t\t\t\t\tstyle="border: none;padding-top: 5px;cursor: pointer; display: contents;"\n'+
						'\t\t\t\t\t\t\t\tclass="float-left text-secondary text-center" >\n'+
						'\t\t\t\t\t\t\t\t<i class="fas fa-edit"></i>\n'+
						'\t\t\t\t\t\t\t</span>');

					$('input[name="fine_date['+id+']"]').prop('disabled', true);
					$('select[name="fine_staff_id['+id+']"]').prop('disabled', true);
					$('select[name="fine_staff_id['+id+']"]').parent('div').children('button').removeClass('disabled');
					$('input[name="fine_type['+id+']"]').prop('disabled', true);
					$('input[name="fine_other_info['+id+']"]').prop('disabled', true);
					$('input[name="fine_price['+id+']"]').prop('disabled', true);


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
	$('input[name^="fine_price"]').each(function () {
		sum += parseInt($(this).val());
		console.log($(this).val());
	})

	$('td#sum').html(sum)

	$('.buttons-excel span').html('<?=lang('export')?>')
</script>


