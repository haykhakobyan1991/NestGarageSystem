<div class="modal-body">
	<form id="group_edit">
		<div class="form-group row">
			<div class="col-sm-1"></div>
			<label class="col-sm-2 col-form-label"><?= lang('company_name') ?></label>
			<div class="col-sm-8">
				<input name="title" type="text" class="form-control "
					  <?=(isset($result_selected_fleets[0]['default']) && $result_selected_fleets[0]['default'] == 2 ? 'readonly' : '')?>
					   placeholder="<?= lang('company_name') ?>"
					   value="<?=$result_selected_fleets[0]['title']?>"
				>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-1"></div>
			<label class="col-sm-2 col-form-label"><?= lang('more_info') ?></label>
			<div class="col-sm-8">
				<textarea <?=(isset($result_selected_fleets[0]['default']) && $result_selected_fleets[0]['default'] == 2 ? 'readonly' : '')?> name="description" type="text" class="form-control" placeholder="<?= lang('more_info') ?>"><?=$result_selected_fleets[0]['details']?></textarea>
			</div>
		</div>

		<div class="form-group row">
			<div class="col-sm-1"></div>
			<label class="col-sm-2 col-form-label"><?= lang('geofences') ?></label>
			<div class="col-sm-8" id="gro">

			</div>
		</div>

		<input type="hidden" name="edit_groups" value="<?=$selected_fleet_ids?>">
		<input type="hidden" name="group_id" value="<?=$group_id?>">
		<input type="hidden" name="token" value="<?=$token?>">
		<input type="hidden" name="geoference_id" value="<?=(isset($result_selected_fleets[0]['geoference_id']) ? $result_selected_fleets[0]['geoference_id'] : '')?>">


	</form>
	<hr class="my-2">
	<div class="row mt-1 pl-1 pr-1">
		<input id="sb_s2" type="text" class="form-control" placeholder="<?= lang('search') ?>"
			   aria-label="Search" aria-describedby="basic-addon2" style="width: 50%;margin: 3px;">
		<div class="col-sm-6 scroll_style"
			 style="border: 5px solid #00000040; max-height: 300px; min-height: 300px; overflow-y: scroll;">

			<ul style="list-style: decimal;" class="list-group lg_11 mt-1">
				<? foreach ($result_fleets as $row_fleet) : ?>
					<li data-id="<?= $row_fleet['id'] ?>"
						class="p-1 sel_items2 mt-1 list-group-item"
						style="cursor: pointer; <?=(isset($result_selected_fleets[0]['default']) && $result_selected_fleets[0]['default'] == 2 ? 'pointer-events: none; opacity: .6;' : '')?>"><?= $row_fleet['brand_model'] . '  (' .  $row_fleet['fleet_plate_number'] . ')' ?></li>
				<? endforeach; ?>
			</ul>
		</div>
		<div class="col-sm-1 text-center">

			<button class="save_cancel_btn btn btn-success mb-1 p-0 add_lg_22"
					style="margin-top: 100px;min-height: 30px !important;min-width: 35px !important;">
				<i style="font-size: 16px;" class="fas fa-long-arrow-alt-right"> </i>
			</button>

			<button class="save_cancel_btn btn btn-success p-0 remove_lg_22"
					style="min-height: 30px !important;min-width: 35px !important;">
				<i style="font-size: 16px;" class="fas fa-long-arrow-alt-left"> </i>
			</button>

		</div>
		<div class="col-sm-5 scroll_style"
			 style="border: 5px solid #00000040; max-height: 300px; min-height: 300px; overflow-y: scroll;">
			<ul class="list-group lg_22 mt-1">

				<? foreach ($result_selected_fleets as $row_fleet) : ?>
					<li data-id="<?= $row_fleet['id'] ?>"
						class="p-1 added_lg_22 mt-1 list-group-item"
						style="cursor: pointer; <?=($row_fleet['default'] == 2 ? 'pointer-events: none; opacity: .6;' : '')?>"><?= $row_fleet['brand_model'] . '  (' .  $row_fleet['fleet_plate_number'] . ')' ?></li>
				<? endforeach; ?>
			</ul>

		</div>

	</div>
</div>
<div class="modal-footer">
	<button id="edit_group_btn" type="button"
			class="btn btn-outline-success cancel_btn"><?= lang('save') ?>
	</button>
	<button id="load" class="btn btn-sm btn-outline-success cancel_btn d-none"><img
			style="height: 20px;margin: 0 auto;display: block;text-align: center;"
			src="<?= base_url() ?>assets/images/bars2.svg"/></button>
	<button type="button" class="cancel_btn close btn btn-sm"
			data-dismiss="modal"
			aria-label="Close">
		<?= lang('cancel') ?>
	</button>
</div>

<script>
	$(document).on('click', '.sel_items2', function () {
		if ($(this).hasClass('bg-info')) {
			$(this).removeClass('bg-info text-white');
		} else {
			$(this).addClass('bg-info text-white')
		}
	});

	$(document).on('click', '.added_lg_22', function () {

		array = [];
		if ($(this).hasClass('bg-info')) {
			$(this).removeClass('bg-info text-white');
		} else {
			$(this).addClass('bg-info text-white');
		}
		$('.added_lg_22').each(function () {
			if ($(this).hasClass('bg-info')) {
				arr = {
					'key': $(this).data('key'),
					'name': $(this).text()
				};
				array.push(arr)
			}
		});
	});

	$(document).on('click', '.add_lg_22', function () {


		$('.sel_items2').each(function () {
			if ($(this).hasClass('bg-info')) {
				$('.lg_22').append(this);
				$(this).addClass('added_lg_22');
				$(this).remove('.list-group');
				$(this).removeClass('bg-info text-white sel_items2');
			}
		});

		// group input

		var group = '';

		$('.lg_22  li').each(function (e) {
			group += $(this).data('id') + ','
		});

		var groups = group.substring(0, group.length - 1);

		$('input[name="edit_groups"]').val(groups);

		// end group input

	});

	$(document).on('click', '.remove_lg_22', function () {
		$('.added_lg_22').each(function () {
			if ($(this).hasClass('bg-info')) {
				$('.lg_11').append(this);
				$(this).remove('.lg_22');
				$(this).removeClass('bg-info text-white added_lg_22');
				$(this).addClass('sel_items2');
				$('#nav-tabContent-car').remove();
				$('.tab-pane').children('form').remove();
			}
		});

		// group input

		var group = '';

		$('.lg_22  li').each(function (e) {
			group += $(this).data('id') + ','
		});

		var groups = group.substring(0, group.length - 1);

		$('input[name="edit_groups"]').val(groups);

		// end group input

	});


		$(document).on('keyup','#sb_s2', function () {
			var val = $(this).val().toLowerCase();
			$('.sel_items2').hide();
			$('.sel_items2').each(function () {
				var text = $(this).text().toLowerCase();
				if (text.indexOf(val) != -1) {
					$(this).show();
				}
			});
		});

</script>

