<form id="vehicle_insurance">
	<div class="row col-sm-12 col-md-12 bpp_o pb-5">
	<div class="container-fluid">
		<table id="ex_5" class="table table-striped table-borderless w-100">
			<thead class="thead_tables">
			<tr>
				<th class="table_th">Մեքենա</th>
				<th class="table_th">Երբ</th>
				<th class="table_th">Ապահովագրական Ընկերություն</th>
				<th class="table_th" style="min-width: 150px">Տեսակ</th>
				<th class="table_th">Վերջնաժամկետ</th>
				<th class="table_th">Գումար</th>
				<th class="">
					<? if (count($fleet['id']) > 1) { ?>
					<span data-toggle="modal"
						  data-target="#vehicle_insurance_m"
						  class=" btn btn-outline-secondary btn-sm " data-id="ex_5"
						  style="padding: .25rem .5rem !important;">
				<? } else { ?>
						<span class="ex_5_add_new_tr btn btn-outline-secondary btn-sm " data-id="ex_5"
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
							<?= $row['brand_model'] ?>
						</td>
						<td class="border">
							<?= $row['add_date'] ?>
						</td>
						<td class="border">
							<?= $row['insurance_company'] ?>
						</td>
						<td class="border">
							<?= $row['insurance_type'] ?>
						</td>
						<td class="border">
							<?= $row['end_date'] ?>
						</td>
						<td class="border">
							<?= $row['price'] ?>
						</td>
						<td class="border"></td>
					</tr>

					<?
				}
			}
			echo '</tbody>';
			if (count($fleet['id']) == 1) { ?>

			<tfoot class="ex_5">
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
					<input title=""  type="text" name="insurance_company[1]"
						   class="form-control text-center"/>
				</td>
				<td class="border">

					<select class="form-control selectpicker" data-size="5" name="insurance_type_id[1]" title="Տեսակ">
						<? foreach ($insurance_type as $it) { ?>
							<option value="<?= $it['id'] ?>"><?= $it['title'] ?></option>
						<? } ?>
					</select>

				</td>
				<td class="border">
					<input title="" type="date" name="end_date[1]" class="form-control text-center"/>
				</td>
				<td class="border">
					<input title="" type="number" min="0" name="price[1]" value=""
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

<div class="pos_abs_div fixed-bottom text-left pb-2 mt-md-2 mt-2">
	<span id="insurance" class="save_cancel_btn btn btn-success"><?= lang('save') ?></span>
	<span id="load" class="btn save_cancel_btn btn-success d-none">
		<?=$this->load->loading_svg()?>
	</span>

	<button class="dont_save btn btn-primary"><?= lang('cancel') ?></button>
	<span style="color: #8c8c8c;" class="pl-3"><?= lang('changed_property') ?></span>
</div>


<!--   Modal Start -->
<form id="vehicle_insurance_modal">
	<div class="modal fade " tabindex="-1" role="dialog" id="vehicle_insurance_m"
		 aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="max-width: 80%;">
			<div class="modal-content">
				<div class="modal-header bg-dark">
					<h6 class="text-white modal-title dar">ԱՊԱՀՈՎԱԳՐՈՒԹՅՈՒՆ</h6>

				</div>
				<div class="modal-body">


					<table id="ex_5" class="table table-striped table-borderless w-100">
						<thead class="thead_tables">
						<tr>
							<th class="table_th">Մեքենա</th>
							<th class="table_th">Երբ</th>
							<th class="table_th">Ապահովագրական Ընկերություն</th>
							<th class="table_th" style="min-width: 150px">Տեսակ</th>
							<th class="table_th">Վերջնաժամկետ</th>
							<th class="table_th">Գումար</th>
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
									<input title="" type="text" name="insurance_company[<?= $key + 1 ?>]"
										   class="form-control text-center"/>
								</td>
								<td>
									<select class="form-control selectpicker" data-size="5"
											name="insurance_type_id[<?= $key + 1 ?>]" title="Տեսակ">
										<? foreach ($insurance_type as $it) { ?>
											<option value="<?= $it['id'] ?>"><?= $it['title'] ?></option>
										<? } ?>
									</select>
								</td>
								<td class="border">
									<input title="" type="date" name="end_date[<?= $key + 1 ?>]"
										   class="form-control text-center"/>
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
						<button id="vehicle_insurance_add" type="button"
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

		$('select').selectpicker('refresh');


		$('.selectpicker').parent('div').children('button').css({
			'background': '#fff',
			'color': '#000',
			'border': '1px solid #ced4da'
		});
		$('.selectpicker').parent('div').children('button').removeClass('btn-light');



		var table = $('#ex_5').DataTable({
			"paging":   false,
			"info":     false,
			"columnDefs": [
				{ "orderable": false, "targets": 6 }
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
			.appendTo( '#ex_5_wrapper #ex_5_filter:eq(0)' );

		$('.dt-buttons').css('float', 'left');


		//vehicle insurance
		var j = 1;
		$(document).on('click', '.ex_5_add_new_tr', function (e) {
			j++;



			var fleet = $('input[name="vehicle[1]"]').val();

			var me = $(this);
			e.preventDefault();

			if (me.data('requestRunning')) {
				return;
			}

			me.data('requestRunning', true);

			$.when(
				$('.ex_5').append('<tr role="row">\n' +
				'<td><input readonly title="" type="text" name="vehicle[' + j + ']" value="' + fleet + '" class="form-control text-center"/></td>\n' +
				'<td><input  title="" type="date" name="date[' + j + ']" value="<?= mdate('%Y-%m-%d', now()) ?>" class="form-control text-center"/></td>\n' +
				'<td><input  title="" type="text" name="insurance_company[' + j + ']"  class="form-control text-center"/></td>\n' +
				'<td>' +
				'<select class="form-control selectpicker" data-size="5"  name="insurance_type_id[' + j + ']" title="Տեսակ">\n' +
				'\t\t\t\t\t\t\t<?foreach ($insurance_type as $it) {?>\n' +
				'\t\t\t\t\t\t\t\t<option value="<?=$it['id']?>"><?=$it['title']?></option>\n' +
				'\t\t\t\t\t\t\t<?}?>\n' +
				'\t\t\t\t\t\t</select>' +
				'</td>\n' +
				'<td><input  title="" type="date" name="end_date[' + j + ']"class="form-control text-center"/></td>\n' +
				'<td><input title="" type="number" name="price[' + j + ']" value="" class="form-control text-center"/></td>\n' +
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
			location.reload();
		})
	});

	<?}?>


	ajax('form#vehicle_insurance', 'span#insurance');

	ajax('form#vehicle_insurance_modal', '#vehicle_insurance_add');

	function ajax(form, button) {

		$(document).on('click', button, function (e) {
			var url = '<?=base_url($this->uri->segment(1) . '/Structure/insurance_ax') ?>';
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


