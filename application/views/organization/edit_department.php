<form id="department_edit">
	<div class="for_message">
		<div class="alert alert-success d-none " role="alert"></div>
		<div class="alert alert-danger d-none " role="alert"></div>
	</div>


	<div class="form-group row mb-0">

		<label class="col-sm-3 col-form-label"><?=lang('item_name')?> *</label>
		<div class="col-sm-8">
			<input type="text" name="title" class="form-control" placeholder="<?=lang('item_name')?>" value="<?= $title ?>">
		</div>
	</div>

	<input type="hidden" name="department_id" value="<?= $id ?>">


	<div class="form-group row mb-0 mt-1">
		<label class="col-sm-3 form-label"><?=lang('head')?> </label>
		<div class="col-sm-8">
			<select name="head_staff" id="model_select" class="form-control selectpicker" data-size="5" id="head_staff" data-live-search="true" title="<?= lang('select_staff') ?>">
				<? foreach ($staff_for_select as $val) : ?>
					<option <?= ($head_staff_id == $val['id'] ? 'selected' : '') ?> value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
				<? endforeach; ?>
			</select>
		</div>
	</div>

	<div class="form-group row mb-2" style="margin-top: 0.4em;">
		<label class="col-sm-3 col-form-label"><?=lang('more_info')?></label>
		<div class="col-sm-8">
			<textarea rows="3" value="" type="text" class=" form-control" name="description" placeholder="<?=lang('more_info')?>"><?= $description ?></textarea>
		</div>
	</div>

	<div class="modal-footer pb-0 mb-0" style="margin-right: 22px;">
		<button id="edit_department_btn" type="button" class="btn btn-outline-success cancel_btn"><?= lang('save') ?></button>
		<span id="load" class="btn btn-outline-success cancel_btn d-none" style="min-width: 93px; max-height: 40px;">
			<img style="height: 25px; padding-bottom: 10px; display: block; text-align: center;  margin: 0 auto;" src="<?= base_url() ?>assets/images/bars2.svg"/>
		</span>
		<button type="button" class="cancel_btn close btn btn-sm" data-dismiss="modal" aria-label="Close">
			<?= lang('cancel') ?>
		</button>
	</div>


</form>
<script>
	$('#model_select').selectpicker('refresh');

	$('.selectpicker').parent('div').children('button').css({
		'background': '#fff',
		'color': '#000',
		'border': '1px solid #ced4da'
	});
	$('.selectpicker').parent('div').children('button').removeClass('btn-light');
</script>
