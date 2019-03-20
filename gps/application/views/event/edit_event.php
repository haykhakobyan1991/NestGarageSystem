
<form class="edit_event">
	<div class="form-group">
		<label>Title</label>
		<input name="title" type="text" class="form-control" value="<?=$row['title']?>">
	</div>
	<div class="form-group">
		<label>Description</label>
		<textarea name="description" class="form-control"  rows="3"><?=$row['description']?></textarea>
	</div>
	<div class="form-group">
		<label><?=lang('staff')?></label>
		<select title="<?=lang('choose')?>" data-live-search="true" class="col selectpicker form-control form-control-sm" name="staff" id="">
			<? foreach ($result_staffs as $staff) : ?>
				<option <?=($row['staff_id'] == $staff['id'] ? 'selected' : '' )?> value="<?=$staff['id']?>"><?=$staff['name']?></option>
			<? endforeach; ?>
		</select>
	</div>
	<div class="form-group">
		<label><?=lang('vehicle')?></label>
		<select title="<?=lang('choose')?>" data-live-search="true" class="col selectpicker form-control form-control-sm" name="fleet" id="">
			<? foreach ($result_fleets as $fleet) : ?>
				<option <?=($row['fleet_id'] == $fleet['id'] ? 'selected' : '' )?> value="<?=$fleet['id']?>"><?=$fleet['brand_model']?></option>
			<? endforeach; ?>
		</select>
	</div>
	<input type="hidden" name="day" value="<?=$row['date']?>">
	<input type="hidden" name="event_id" value="<?=$row['id']?>">
</form>

<script>
	$('.selectpicker').selectpicker('refresh');

	$('.selectpicker').parent('div').children('button').css({
		'background': '#fff',
		'color': '#000',
		'border': '1px solid #ced4da'
	});
	$('.selectpicker').parent('div').children('button').removeClass('btn-light');
</script>
