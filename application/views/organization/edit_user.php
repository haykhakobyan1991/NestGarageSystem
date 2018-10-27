<form id="user_edit" enctype="multipart/form-data" >
	<div class="modal-body">
		<!-- Error Message -->

		<div class="for_message">
			<div class="alert alert-success d-none" role="alert"></div>
			<div class="alert alert-danger  d-none" role="alert"></div>
		</div>

		<div class="row">
			<div class="col-sm-12 col-md-6 col-6">
				<h2>Users Infprmation</h2>
				<p>Fill in the following fields</p>
			</div>
		</div>
		<div class="row">
			<div
				class="col-sm-12 col-md-12 col-12  mt-md-5 mt-5 pl-md-4 pl-4 pr-md-4 pr-4">
				<div class="form-group row">
					<label
						class="col-sm-2 col-form-label">First
						Name *</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-sm"
							   name="first_name"
							   value="<?= $first_name ?>"
							   placeholder="First Name">
					</div>
				</div>
				<div class="form-group row">
					<label
						class="col-sm-2 col-form-label">Last
						Name *</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-sm"
							   name="last_name"
							   value="<?= $last_name ?>"
							   placeholder="Last Name">
					</div>
				</div>
				<div class="form-group row">
					<label
						class="col-sm-2 col-form-label">E-mail *</label>
					<div class="col-sm-10">
						<input type="email" class="form-control form-control-sm"
							   name="email"
							   value="<?= $email ?>"
							   placeholder="E-mail">
					</div>
				</div>
				<div class="form-group row">
					<label
						class="col-sm-2 col-form-label">Contact Number *</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-sm"
							   name="contact_number"
							   value="<?= $phone_number ?>"
							   placeholder="Contact Number">
					</div>
				</div>
				<div class="form-group row">
					<label
						class="col-sm-2 col-form-label">User Name *</label>
					<div class="col-sm-10">
						<input type="text" class="form-control form-control-sm"
							   name="username"
							   value="<?= $username ?>"
							   placeholder="User Name">
					</div>
				</div>

				<div class="form-group row">
					<label
						class="col-sm-2 col-form-label">Password *</label>
					<div class="col-sm-10">
						<input type="text"
							   class="form-control form-control-sm col-sm-8 float-left"
							   name="password"
							   placeholder="Password"
							   id="password_edit"
							   value=""
							   onclick="this.focus();this.select()"
							   readonly
							   />
						<button type="button"
								class="btn btn-sm btn-outline-secondary ml-1 hide_password_edit"
								style="border: none;outline: none;"><i class="fa fa-eye"></i>
						</button>
						<button id="generate-password-button_edit" type="button"
								class="btn btn-sm btn-outline-secondary ml-2 mt-1"><i
								class="fas fa-sync-alt"></i> generate
						</button>
					</div>
				</div>

				<div class="form-group row mb-0">
					<label class="col-sm-2 col-form-label">Type</label>
					<div class="col-sm-6">
						<select name="role"
								class="col selectpicker form-control form-control-sm form-control-sm"
								id="role_type"
								data-size="5" data-live-search="true"
								title="Select a Type">
							<? foreach ($role as $row_role) : ?>
								<option <?= $role_id == $row_role['id'] ? 'selected' : '' ?>
									value="<?= $row_role['id'] ?>"><?= $row_role['title'] ?></option>
							<? endforeach; ?>
						</select>
					</div>
				</div>
				<div class="form-group row mt-2">
					<label class="ml-1 col-form-label">Status make a Passive?</label>
					<div class="col-sm-1">
						<input <?= ($status == '-1' ? 'checked' : '') ?> name="status" value="-1" type="checkbox"
																		 class="form-control form-control-sm">
					</div>
				</div>


			</div>
			<input type="hidden" name="user_id" value="<?= $id ?>">

		</div>
		<div class="text-right mt-4 pb-2">
			<span id="edit_user_button" class="btn btn-sm btn-outline-success">Save</span>
		</div>
	</div>
</form>

<script src="<?= base_url() ?>assets/js/generate_password.js"></script>
<script>
	$('select').selectpicker('refresh');


	$(document).on('click', '.hide_password_edit', function () {
		if ($(this).hasClass('hidden')) {
			$('input#password_edit').attr('type', 'text');
			console.log($('#password_edit'));
			$(this).removeClass('hidden');
		} else {
			$('input#password_edit').attr('type', 'password');
			$(this).addClass('hidden');
		}

	});



</script>
