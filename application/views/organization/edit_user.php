<style>
	input::placeholder{
		font-size: 12px !important;
	}
</style>

<form id="user_edit_1">


	<div class="for_message">
		<div class="alert alert-success d-none" role="alert"></div>
		<div class="alert alert-danger  d-none" role="alert"></div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-էթ">
				<h5><?= lang('user_information') ?></h5>
			</div>
		</div>
		<hr class="my-2">
	</div>

	<div class="container">
		<div class="row">
			<div
				class="col-sm-12 col-md-12 col-12  mt-md-1 mt-1 pl-md-4 pl-4 pr-md-4 pr-4">
				<div class="form-group row">
					<div class="col-sm-1"></div>
					<label
						class="col-sm-2 col-form-label"><?= lang('first_name') ?>*</label>
					<div class="col-sm-7">
						<input type="text" class="form-control form-control-sm"
							   name="first_name"
							   value="<?= $first_name ?>"
							   placeholder="<?= lang('first_name') ?>">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-1"></div>
					<label
						class="col-sm-2 col-form-label"><?= lang('last_name') ?> *</label>
					<div class="col-sm-7">
						<input type="text" class="form-control form-control-sm"
							   name="last_name"
							   value="<?= $last_name ?>"
							   placeholder="<?= lang('last_name') ?>">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-1"></div>
					<label
						class="col-sm-2 col-form-label"><?= lang('email') ?> *</label>
					<div class="col-sm-7">
						<input type="email" class="form-control form-control-sm"
							   name="email"
							   value="<?= $email ?>"
							   placeholder="<?= lang('email') ?>">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-1"></div>
					<label
						class="col-sm-3 col-form-label"><?= lang('contact_number') ?>*</label>
					<div class="col-sm-7" style="margin-left: -61px;">
						<input type="text" class="form-control form-control-sm "
							   name="contact_number"
							   value="<?= $phone_number ?>"
							   placeholder="<?= lang('contact_number') ?>">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-1"></div>
					<label
						class="col-sm-2 col-form-label"><?= lang('login') ?> *</label>
					<div class="col-sm-7">
						<input type="text" class="form-control form-control-sm"
							   name="username"
							   value="<?= $username ?>"
							   placeholder="<?= lang('username') ?>">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-sm-1"></div>
					<label
						class="col-sm-2 col-form-label"><?= lang('password') ?> *</label>
					<div class="col-sm-7">
						<input type="text"
							   class="form-control form-control-sm col-sm-5 float-left"
							   name="password"
							   placeholder="<?= lang('password') ?>"
							   id="password_edit"
							   value=""
							   onclick="this.focus();this.select()"

						/>
						<button type="button"
								class="btn btn-sm btn-outline-secondary ml-3 hide_password_edit"
								style="border: none;outline: none;"><i class="fa fa-eye"></i>
						</button>
						<button id="generate-password-button_edit" type="button"
								class="save_cancel_btn btn btn-success  ml-3"
								style="font-size: 12px !important;line-height: 14px !important;padding: 12px 17px !important;font-weight: 500 !important;">
							<i
								class="fas fa-sync-alt" style="margin-right: 8px;"></i><?= lang('generate') ?>
						</button>
					</div>
				</div>

				<div class="form-group row mb-0">
					<div class="col-sm-1"></div>
					<label class="col-sm-2 col-form-label"><?= lang('type') ?></label>
					<div class="col-sm-7">
						<select name="role"
								class="col selectpicker form-control form-control-sm form-control-sm"
								id="role_type"
								data-size="5" data-live-search="true"
								title="<?= lang('select_type') ?>">
							<? foreach ($role as $row_role) : ?>
								<option <?= $role_id == $row_role['id'] ? 'selected' : '' ?>
									value="<?= $row_role['id'] ?>"><?= $row_role['title'] ?></option>
							<? endforeach; ?>
						</select>
					</div>
				</div>
				<div class="container-fluid">
					<div class="row mt-3">
						<div class="col-sm-1"></div>
						<label class="col-sm-4 ml-0 pl-0 col-form-label"><?= lang('status_make_passive') ?></label>
						<div class="col-sm-1">
							<input
								style="width: 18px;height: 18px;margin-left: -45px;margin-top: 7px;" <?= ($status == '-1' ? 'checked' : '') ?>
								name="status" value="-1" type="checkbox" class="form-control form-control-sm">
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" name="user_id" value="<?= $id ?>">

		</div>
	</div>
	<div class="modal-footer pb-0 col-sm-12" style="padding-right: 141px !important;">
		<button id="edit_user_button" type="button"
				class="btn btn-outline-success cancel_btn"><?= lang('save') ?>
		</button>
		<button id="load" class="btn btn-sm btn-outline-success cancel_btn d-none"
				style="max-height: 40px; min-width: 93px;"><img
				style="height: 20px;margin: 0 auto;display: block;text-align: center;"
				src="<?= base_url() ?>assets/images/bars2.svg"/></button>
		<button type="button" class="cancel_btn close btn btn-sm"
				data-dismiss="modal"
				aria-label="Close">
			<?= lang('cancel') ?>
		</button>
	</div>
</form>

<script src="<?= base_url('assets/js/generate_password.js') ?>"></script>
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

	$('.selectpicker').parent('div').children('button').css({
		'background': '#fff',
		'color': '#000',
		'border': '1px solid #ced4da'
	});
	$('.selectpicker').parent('div').children('button').removeClass('btn-light');


</script>
