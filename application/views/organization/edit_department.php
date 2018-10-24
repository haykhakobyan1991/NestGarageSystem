<!--  Department Modal Start -->
<div class="modal fade bd-example-modal-lg " id="edit_department" tabindex="-1" role="dialog"
	 aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-dark">
				<h5 class="text-white modal-title dar">New Department</h5>
				<button type="button" class="text-white close"
						data-dismiss="modal"
						aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- Error Message -->

				<div class="for_message">
					<div class="alert alert-success d-none " role="alert"></div>
					<div class="alert alert-danger d-none " role="alert"></div>
				</div>


				<div class="form-group row">

					<label class="col-sm-4 col-form-label">Անվանում *</label>
					<div class="col-sm-8">
						<input type="text" name="title" class="form-control" placeholder="Անվանում">
					</div>
				</div>


				<div class="form-group row">
					<label class="col-sm-4 col-form-label">Ղեկավար *</label>
					<div class="col-sm-8">
						<select name="head_staff"
								class="form-control selectpicker"
								data-size="5" id="head_staff" data-live-search="true"
								title="Select a Staff">
							<?
							foreach ($staff_for_select as $val) :
								?>
								<option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
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
													  placeholder="Մանրամասն"></textarea>
					</div>
				</div>

				<div class="modal-footer">
					<span id="add_department" type="button" class="btn btn-secondary">Save</span>
				</div>


			</div>

		</div>

	</div>
</div>
</div>
</div>
</div>

</form>
</div>

<!-- Department End -->
