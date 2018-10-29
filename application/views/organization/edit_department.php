<form id="department_edit">
	<div class="for_message">
		<div class="alert alert-success d-none " role="alert"></div>
		<div class="alert alert-danger d-none " role="alert"></div>
	</div>


	<div class="form-group row">

		<label class="col-sm-4 col-form-label">Անվանում *</label>
		<div class="col-sm-8">
			<input type="text" name="title" class="form-control" placeholder="Անվանում" value="<?= $title ?>">
		</div>
	</div>

	<input type="hidden" name="department_id" value="<?= $id ?>">


	<div class="form-group row">
		<label class="col-sm-4 col-form-label">Ղեկավար *</label>
		<div class="col-sm-8">
			<select name="head_staff"
					id="model_select"
					class="form-control selectpicker"
					data-size="5" id="head_staff" data-live-search="true"
					title="Select a Staff">
				<?
				foreach ($staff_for_select as $val) :
					?>
					<option <?= ($head_staff_id == $val['id'] ? 'selected' : '') ?>
						value="<?= $val['id'] ?>"><?= $val['name'] ?></option>

				<? endforeach; ?>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-sm-4 col-form-label">Մանրամասն</label>
		<div class="col-sm-8">
											<textarea rows="4" value="" type="text"
													  class=" form-control"
													  name="description"
													  placeholder="Մանրամասն"><?= $description ?></textarea>
		</div>
	</div>

	<div class="modal-footer">
		<span id="edit_department" type="button" class="btn btn-secondary">Save</span>
	</div>


</form>
<script>
	$('#model_select').selectpicker('refresh');

	$('.selectpicker').parent('div').children('button').css({'background': '#fff', 'color': '#000', 'border': '1px solid #ced4da'});
	$('.selectpicker').parent('div').children('button').removeClass('btn-light');
</script>
