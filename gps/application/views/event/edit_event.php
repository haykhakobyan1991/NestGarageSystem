<form class="edit_event">
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
