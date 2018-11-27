<form id="vehicle_fine">
	<div class="row col-sm-12 col-md-12 bpp_o pb-5">
	<div class="container-fluid">
		<table id="ex_3" class="table table-striped table-borderless w-100">
			<thead class="thead_tables">
			<tr>
				<th class="table_th">Մեքենա</th>
				<th class="table_th">Երբ</th>
				<th class="table_th">Տեասակ</th>
				<th class="table_th">Վարորդ</th>
				<th class="table_th">Այլ Ինֆորմացիա</th>
				<th class="table_th">Գումար</th>
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
			<tbody class="ex_3">
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
							<?= $row['type'] ?>
						</td>
						<td class="border">
							<?= $row['staff_name'] ?>
						</td>
						<td class="border">
							<?= $row['other_info'] ?>
						</td>
						<td class="border">
							<?= $row['price'] ?>
						</td>
						<td class="border"></td>
					</tr>

					<?
				}
			}

			if (count($fleet['id']) == 1) { ?>
				<tr>
					<td class="border">
						<input title="" readonly type="text" name="vehicle[1]" value="<?= $fleet['name'][0] ?>"
							   class="form-control text-center"/>
						<input type="hidden" name="fleet_id" value="<?= $fleet['id'][0] ?>">
					</td>
					<td class="border">
						<input title=""  type="date" name="date[1]" value="<?= mdate('%Y-%m-%d', now()) ?>"
							   class="form-control text-center"/>
					</td>
					<td class="border">
						<input title=""  type="text" name="type[1]" value=""
							   class="form-control text-center"/>
					</td>
					<td class="border">
						<input type="hidden" name="staff_id[1]" value="<?= $staff['id'] ?>">
						<input title="" name="staff[1]" readonly type="text"  value="<?= $staff['name'] ?>"
							   class="form-control text-center"/>
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
			<? } ?>
			</tbody>
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
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-dark">
					<h6 class="text-white modal-title dar">ՏՈւԳԱՆՔ</h6>

				</div>
				<div class="modal-body">
					<input type="hidden" name="fleet_ids" value="<?=implode(',', $fleet['id'])?>">


					<div class="form-group row mb-0">

						<label class="col-sm-4 col-form-label">Երբ *</label>
						<div class="col-sm-7">
							<input type="date" name="date" class="form-control">
						</div>
					</div>

					<div class="form-group row mb-0 mt-1 ">

						<label class="col-sm-4 col-form-label">Տեասակ *</label>
						<div class="col-sm-7">
							<input type="text" name="type" placeholder="Տեասակ" class="form-control">
						</div>
					</div>


					<div class="form-group row mb-0 mt-1">
						<label class="col-sm-4 col-form-label">Այլ Ինֆորմացիա</label>
						<div class="col-sm-7">
							<input type="text" name="other_info" placeholder="Այլ Ինֆորմացիա" class="form-control">
						</div>
					</div>


					<div class="form-group row mb-1 mt-1">
						<label class="col-sm-4 col-form-label">Գումար *</label>
						<div class="col-sm-7">
							<input type="number" name="price" placeholder="Գումար" class="form-control">
						</div>
					</div>


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





	$(".modal").on('hidden.bs.modal', function () {
		location.reload();
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
						var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/structure1/fine')?>";
						$(location).attr('href', url);

					} else {

						if ($.isArray(data.error.elements)) {
							loading('stop', 'inspection');
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
					loading('stop', 'inspection');
				},
				complete: function () {
					me.data('requestRunning', false);
				}
			});
		});

	}
</script>


