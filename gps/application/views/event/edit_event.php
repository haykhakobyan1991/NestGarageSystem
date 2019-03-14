<form class="edit_event">
	<div class="form-group">
		<div class="md-form">
			<label>Start Time</label>
			<input name="from" placeholder="Start Time" type="time" id="input_starttime"
				   class="form-control timepicker" value="<?=$start?>">
		</div>
	</div>
	<div class="form-group">
		<div class="md-form">
			<label>End Time</label>
			<input name="to" placeholder="End Time" type="time" id="input_endtime"
				   class="form-control timepicker" value="<?=$end?>">
		</div>
	</div>
	<div class="form-group">
		<label>Title</label>
		<input name="title" type="text" class="form-control" value="<?=$title?>">
	</div>
	<div class="form-group">
		<label>Description</label>
		<textarea name="description" class="form-control"  rows="3"><?=$description?></textarea>
	</div>
	<input type="hidden" name="day" value="<?=$date?>">
	<input type="hidden" name="event_id" value="<?=$id?>">
</form>
