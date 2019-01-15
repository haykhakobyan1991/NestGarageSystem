<form id="vehicle_spares">
	<div class="row col-sm-12 col-md-12 bpp_o pb-5">
	<div class="container-fluid">
		<table id="ex_6" class="table table-striped table-borderless w-100">
			<thead class="thead_tables">
			<tr>
				<th class="table_th"><?=lang('vehicle')?></th>
				<th class="table_th"><?=lang('when')?></th>
				<th class="table_th"><?=lang('whence')?></th>
				<th class="table_th"><?=lang('type')?> *</th>
				<th class="table_th"><?=lang('producer')?></th>
				<th class="table_th"><?=lang('model')?></th>
				<th class="table_th" style="min-width: 150px;"><?=lang('new_used')?> *</th>
				<th class="table_th"><?=lang('quantity')?> *</th>
				<th class="table_th"><?=lang('unit_cost')?> *</th>
				<th class="table_th"><?=lang('price')?> *</th>
				<th class="">
					<? if (count($fleet['id']) > 1) { ?>
					<span data-toggle="modal"
						  data-target="#vehicle_spares_m"
						  class=" btn btn-outline-secondary btn-sm " data-id="ex_6"
						  style="padding: .25rem .5rem !important;">
				<? } else { ?>
						<span class="ex_6_add_new_tr btn btn-outline-secondary btn-sm " data-id="ex_6"
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
							<input class="form-control text-center" title="" type="text" disabled name="spares_vehicle[<?= $row['id'] ?>]" value="<?= $row['brand_model'] ?>" >
						</td>
						<td class="border">
							<input class="form-control text-center" title="" type="date" disabled name="spares_date[<?= $row['id'] ?>]" value="<?= $row['add_date'] ?>" >
						</td>
						<td class="border">
							<input value="<?= $row['whence'] ?>" disabled
								   title="" type="text" name="spares_whence[<?= $row['id'] ?>]"
								   class="form-control text-center"/>
						</td>
						<td class="border" style="min-width: 200px;">
							<input value="<?= $row['type'] ?>" disabled
								   title="" type="text" name="spares_type[<?= $row['id'] ?>]"
								   class="form-control text-center"/>
						</td>
						<td class="border">
							<input value="<?= $row['producer'] ?>" disabled
								   title="" type="text" name="spares_producer[<?= $row['id'] ?>]"
								   class="form-control text-center"/>
						</td>
						<td class="border">
							<input value="<?= $row['model'] ?>" disabled
								   title="" type="text" name="spares_model[<?= $row['id'] ?>]"
								   class="form-control text-center"/>
						</td>
						<td class="border">
							<select disabled class="form-control selectpicker" data-size="5" name="spares_depreciation[<?= $row['id'] ?>]" title="<?=lang('new_used')?>">
								<option <?=($row['depreciation'] == 1 ? 'selected' : '')?> value="1"><?=lang('new')?></option>
								<option <?=($row['depreciation'] == 2 ? 'selected' : '')?> value="2"><?=lang('used')?></option>
							</select>
						</td>
						<td class="border">
							<input value="<?= $row['count'] ?>" disabled
								   title="" type="number" min="0" name="spares_count[<?= $row['id'] ?>]"
								   class="form-control text-center"/>
						</td>
						<td class="border">
							<input value="<?= $row['one_price'] ?>" disabled
								   title="" type="number" min="0" name="spares_one_price[<?= $row['id'] ?>]"
								   class="form-control text-center"/>
						</td>
						<td class="border">
							<input value="<?= $row['price'] ?>" disabled
								   title="" type="number" min="0" name="spares_price[<?= $row['id'] ?>]"
								   class="form-control text-center"/>
						</td>
						<td class="border">
							<span
								id="edit_spares"
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

			<tfoot class="ex_6">
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
					<input title="" type="text" name="whence[1]"
						   class="form-control text-center"/>
				</td>
				<td class="border">
					<input title="" type="text" name="type[1]"
						   class="form-control text-center"/>
				</td>
				<td class="border">
					<input title="" type="text" name="producer[1]"
						   class="form-control text-center"/>
				</td>
				<td class="border">
					<input title="" type="text" name="model[1]"
						   class="form-control text-center"/>
				</td>
				<td class="border">
					<select class="form-control selectpicker" data-size="5" name="depreciation[1]" title="<?=lang('new_used')?>">
							<option value="1"><?=lang('new')?></option>
							<option value="2"><?=lang('used')?></option>
					</select>
				</td>
				<td class="border">
					<input title="" type="number" min="0" name="count[1]"
						   class="form-control text-center"/>
				</td>
				<td class="border">
					<input title="" type="number" min="0" name="one_price[1]"
						   class="form-control text-center"/>
				</td>
				<td class="border">
					<input title="" type="number" min="0" name="price[1]"
						   class="form-control text-center"/>
				</td>
				<td class="border"></td>
			</tr>
			<tr>
				<td class="font-weight-bold" style="text-align: left !important;"><?=lang('total')?></td>
				<td class="font-weight-bold" colspan="8"></td>
				<td class="font-weight-bold" id="sum"></td>
				<td></td>
			</tr>
			</tfoot>
			<? } else {
				echo '
				<tfoot>
					<tr>
						<td class="font-weight-bold" style="text-align: left !important;" >'.lang('total').'</td>
						<td class="font-weight-bold"  colspan="8"></td>
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
	<span id="spares" class="save_cancel_btn btn btn-success"><?= lang('save') ?></span>
	<span id="load" class="btn save_cancel_btn btn-success d-none">
		<?=$this->load->loading_svg()?>
	</span>

	<button class="dont_save btn btn-primary"><?= lang('cancel') ?></button>
	<span style="color: #8c8c8c;" class="pl-3"><?= lang('changed_property') ?></span>
</div>


<!--   Modal Start -->
<form id="vehicle_spares_modal">
	<div class="modal fade " tabindex="-1" role="dialog" id="vehicle_spares_m"
		 aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="max-width: 80%;">
			<div class="modal-content">
				<div class="modal-header bg-dark">
					<h6 class="text-white modal-title dar"><?=lang('spares')?></h6>

				</div>
				<div class="modal-body">


					<table id="ex_6" class="table table-striped table-borderless w-100">
						<thead class="thead_tables">
						<tr>
							<th class="table_th"><?=lang('vehicle')?></th>
							<th class="table_th"><?=lang('when')?></th>
							<th class="table_th"><?=lang('whence')?></th>
							<th class="table_th"><?=lang('type')?> *</th>
							<th class="table_th"><?=lang('producer')?></th>
							<th class="table_th"><?=lang('model')?></th>
							<th class="table_th" style="min-width: 150px;"><?=lang('new_used')?>*</th>
							<th class="table_th"><?=lang('quantity')?> *</th>
							<th class="table_th"><?=lang('unit_cost')?> *</th>
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
									<input title="" type="text" name="whence[<?= $key + 1 ?>]"
										   class="form-control text-center"/>
								</td>
								<td class="border">
									<input title="" type="text" name="type[<?= $key + 1 ?>]"
										   class="form-control text-center"/>
								</td>
								<td class="border">
									<input title="" type="text" name="producer[<?= $key + 1 ?>]"
										   class="form-control text-center"/>
								</td>
								<td class="border">
									<input title="" type="text" name="model[<?= $key + 1 ?>]"
										   class="form-control text-center"/>
								</td>
								<td class="border">
									<select class="form-control selectpicker" data-size="5" name="depreciation[<?= $key + 1 ?>]" title="<?=lang('new_used')?>">
										<option value="1"><?=lang('new')?></option>
										<option value="2>"><?=lang('used')?></option>
									</select>
								</td>
								<td class="border">
									<input title="" type="number" min="0" name="count[<?= $key + 1 ?>]"
										   class="form-control text-center"/>
								</td>
								<td class="border">
									<input title="" type="number" min="0" name="one_price[<?= $key + 1 ?>]"
										   class="form-control text-center"/>
								</td>
								<td class="border">
									<input title="" type="number" min="0" name="price[<?= $key + 1 ?>]"
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


					<div class="modal-footer pb-0">
						<button id="vehicle_spares_add" type="button"
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



		$(document).on('keyup', 'input[name="count[1]"]', function () {
			var count = $(this).val();
			var one_price = $('input[name="one_price[1]"]').val();

			sum =  parseFloat(count) * parseFloat(one_price);

			$('input[name="price[1]"]').val(sum);

		});

		$(document).on('keyup', 'input[name="one_price[1]"]', function () {
			var count = $('input[name="count[1]"]').val();
			var one_price = $(this).val();
			sum =  parseFloat(count) * parseFloat(one_price);

			$('input[name="price[1]"]').val(sum);

		});


		var table = $('#ex_6').DataTable({
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
			"paging":   false,
			"info":     false,
			"columnDefs": [
				{ "orderable": false, "targets": 10 }
			],
			dom: 'Bfrtip',
			buttons: [
				{
					extend: 'excelHtml5',
					title:  '<?=lang('Report_period').'  '.lang('from')?> '+$('input[name="from"]').val() + '  <?=lang('to')?> ' + $('input[name="to"]').val(),
					messageTop: '<?=lang('user')?> '+$('.username_login > a').text(),
					filename: 'spares',
					footer: true,
					exportOptions: {
						format: {
							body: function ( data, row, column, node ) {
								// Strip $ from salary column to make it numeric
								return column === 6 ?
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
			.appendTo( '#ex_6_wrapper #ex_6_filter:eq(0)' );

		$('.dt-buttons').css('float', 'left');


		//vehicle spares
		var j = 1;
		$(document).on('click', '.ex_6_add_new_tr', function (e) {
			j++;



			var fleet = $('input[name="vehicle[1]"]').val();

			var me = $(this);
			e.preventDefault();

			if (me.data('requestRunning')) {
				return;
			}

			me.data('requestRunning', true);

			$.when(
				$('.ex_6').append('<tr role="row">\n' +
				'<td><input readonly title="" type="text" name="vehicle[' + j + ']" value="' + fleet + '" class="form-control text-center"/></td>\n' +
				'<td><input  title="" type="date" name="date[' + j + ']" value="<?= mdate('%Y-%m-%d', now()) ?>" class="form-control text-center"/></td>\n' +
				'<td class="border">\n' +
				'\t<input title="" type="text" name="whence[' + j + ']"\n' +
				'\t\t   class="form-control text-center"/>\n' +
				'</td>\n' +
				'<td class="border">\n' +
				'\t<input title="" type="text" name="type[' + j + ']"\n' +
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
				'\t<select class="form-control selectpicker" data-size="5" name="depreciation[' + j + ']" title="<?=lang('new_used')?>">\n' +
				'\t\t<option value="1"><?=lang('new')?></option>\n' +
				'\t\t<option value="2>"><?=lang('used')?></option>\n' +
				'\t</select>\n' +
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
				'<td>' +
				'<span class="btn btn-outline-secondary btn-sm del_row_ft" style="padding: .25rem .5rem !important;">' +
				'<i class=" fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"> </i>' +
				'</span>' +
				'</td>\n'+
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


	ajax('form#vehicle_spares', 'span#spares');

	ajax('form#vehicle_spares_modal', '#vehicle_spares_add');

	function ajax(form, button) {

		$(document).on('click', button, function (e) {
			var url = '<?=base_url($this->uri->segment(1) . '/Structure/spares_ax') ?>';
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
		$(document).on('click', '#edit_spares', function() {
			var id = $(this).data('id');

			$('input[name="spares_date['+id+']"]').prop('disabled', false);
			$('select[name="spares_depreciation['+id+']"]').prop('disabled', false);
			$('select[name="spares_depreciation['+id+']"]').parent('div').children('button').removeClass('disabled');
			$('input[name="spares_whence['+id+']"]').prop('disabled', false);
			$('input[name="spares_type['+id+']"]').prop('disabled', false);
			$('input[name="spares_producer['+id+']"]').prop('disabled', false);
			$('input[name="spares_model['+id+']"]').prop('disabled', false);
			$('input[name="spares_count['+id+']"]').prop('disabled', false);
			$('input[name="spares_one_price['+id+']"]').prop('disabled', false);
			$('input[name="spares_price['+id+']"]').prop('disabled', false);


			$(this).parent('td').html('<button\n' +
				'\t\t\t\t\tdata-id="'+id+'"\n' +
				'\t\t\t\t\tid="edit_spares_btn"\n' +
				'\t\t\t\t\tstyle="min-width: 94px;\n' +
				'\t\t\t\t\tfont-size: 14px !important;\n' +
				'\t\t\t\t\tline-height: 14px !important;\n' +
				'\t\t\t\t\tpadding: 10px 24px !important;\n' +
				'\t\t\t\t\tfont-weight: 500 !important;\n' +
				'\t\t\t\t\tmargin-top: -4px;\n' +
				'\t\t\t\t\tmin-height: 37px !important;" type="button" id="search" class="ml-2 save_cancel_btn btn btn-success"><?=lang('edit')?></button>');
		});

		$(document).on('keyup', 'input[name^="spares_count["]', function () {
			var id = $(this).parent('td').parent('tr').find('button#edit_spares_btn').data('id');
			var count = $(this).val();
			var spares_one_price = $('input[name="spares_one_price['+id+']"]').val();

			sum =  parseFloat(count) * parseFloat(spares_one_price);

			$('input[name="spares_price['+id+']"]').val(sum);

		});

		$(document).on('keyup', 'input[name^="spares_one_price["]', function () {
			var id = $(this).parent('td').parent('tr').find('button#edit_spares_btn').data('id');
			var count = $('input[name="spares_count['+id+']"]').val();
			var spares_one_price = $(this).val();
			sum =  parseFloat(count) * parseFloat(spares_one_price);

			$('input[name="spares_price['+id+']"]').val(sum);

		});



		$(document).on('click', '#edit_spares_btn', function (e) {
			var td = $(this).parent('td');
			var id = $(this).data('id');

			var spares_date = $('input[name="spares_date['+id+']"]').val();
			var spares_depreciation = $('select[name="spares_depreciation['+id+']"]').val();
			var spares_whence = $('input[name="spares_whence['+id+']"]').val();
			var spares_type = $('input[name="spares_type['+id+']"]').val();
			var spares_producer = $('input[name="spares_producer['+id+']"]').val();
			var spares_model = $('input[name="spares_model['+id+']"]').val();
			var spares_count = $('input[name="spares_count['+id+']"]').val();
			var spares_one_price = $('input[name="spares_one_price['+id+']"]').val();
			var spares_price = $('input[name="spares_price['+id+']"]').val();

			var url = '<?=base_url($this->uri->segment(1) . '/Structure/edit_spares_ax') ?>';
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
					spares_id: id,
					spares_date: spares_date,
					spares_depreciation: spares_depreciation,
					spares_whence: spares_whence,
					spares_type: spares_type,
					spares_producer: spares_producer,
					spares_model: spares_model,
					spares_count: spares_count,
					spares_one_price: spares_one_price,
					spares_price: spares_price
				},
				success: function (data) {
					if (data.success == '1') {

						td.html('<span\n'+
							'\t\t\t\t\t\t\t\tid="edit_spares"\n'+
							'\t\t\t\t\t\t\t\tdata-id="'+data.message+'"\n'+
							'\t\t\t\t\t\t\t\tstyle="border: none;padding-top: 5px;cursor: pointer; display: contents;"\n'+
							'\t\t\t\t\t\t\t\tclass="float-left text-secondary text-center" >\n'+
							'\t\t\t\t\t\t\t\t<i class="fas fa-edit"></i>\n'+
							'\t\t\t\t\t\t\t</span>');

						$('input[name="spares_date['+id+']"]').prop('disabled', true);
						$('select[name="spares_depreciation['+id+']"]').prop('disabled', true);
						$('select[name="spares_depreciation['+id+']"]').parent('div').children('button').addClass('disabled');
						$('input[name="spares_whence['+id+']"]').prop('disabled', true);
						$('input[name="spares_type['+id+']"]').prop('disabled', true);
						$('input[name="spares_producer['+id+']"]').prop('disabled', true);
						$('input[name="spares_model['+id+']"]').prop('disabled', true);
						$('input[name="spares_count['+id+']"]').prop('disabled', true);
						$('input[name="spares_one_price['+id+']"]').prop('disabled', true);
						$('input[name="spares_price['+id+']"]').prop('disabled', true);


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
		$('input[name^="spares_price"]').each(function () {
			sum += parseInt($(this).val());
			console.log($(this).val());
		})

		$('td#sum').html(sum)

		$('.buttons-excel span').html('<?=lang('export')?>')

</script>


