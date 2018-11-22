<form id="department_edit">
	<div class="for_message">
		<div class="alert alert-success d-none " role="alert"></div>
		<div class="alert alert-danger d-none " role="alert"></div>
	</div>


	<div class="form-group row mb-0">

		<label class="col-sm-3 col-form-label">Անվանում *</label>
		<div class="col-sm-8">
			<input type="text" name="title" class="form-control" placeholder="Անվանում" value="<?= $title ?>">
		</div>
	</div>

	<input type="hidden" name="department_id" value="<?= $id ?>">


	<div class="form-group row mb-0 mt-1">
		<label class="col-sm-3 form-label">Ղեկավար *</label>
		<div class="col-sm-8">
			<select name="head_staff" id="model_select" class="form-control selectpicker" data-size="5" id="head_staff" data-live-search="true" title="<?= lang('select_staff') ?>">
				<? foreach ($staff_for_select as $val) : ?>
					<option <?= ($head_staff_id == $val['id'] ? 'selected' : '') ?> value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
				<? endforeach; ?>
			</select>
		</div>
	</div>

	<div class="form-group row mb-2 mt-1">
		<label class="col-sm-3 col-form-label">Մանրամասն</label>
		<div class="col-sm-8">
			<textarea rows="3" value="" type="text" class=" form-control" name="description" placeholder="Մանրամասն"><?= $description ?></textarea>
		</div>
	</div>

	<div class="modal-footer pb-0 mb-0">
		<button id="edit_department_btn" type="button" class="btn btn-outline-success"><?= lang('save') ?></button>
		<span id="load" class="btn btn-sm btn-success d-none">
			<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/bars2.svg"/>
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
