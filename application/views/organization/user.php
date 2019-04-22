<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<style>
	table#example4 thead tr th:last-child:after {
		content: '';
	}

	table#example4 thead tr th:last-child:before {
		content: '';
	}

	div#example4_wrapper {
		width: 100%;
	}
	input::placeholder{
		font-size: 12px !important;
	}
</style>
<script>
	$(document).ready(function () {
		$('#example4').DataTable({
			language: {
				search: "<?=lang('search')?>",
				emptyTable: "<?=lang('no_data')?>",
				info: "<?=lang('total')?> _TOTAL_ <?=lang('data')?>",
				infoEmpty: "<?=lang('total')?> 0 <?=lang('data')?>",
				infoFiltered: "(<?=lang('is_filtered')?> _MAX_ <?=lang('total_record')?>)",
				lengthMenu: "<?=lang('showing2')?> _MENU_ <?=lang('record2')?>",
				zeroRecords: "<?=lang('no_matching_records')?>",
				paginate: {
					first: "<?=lang('first')?>",
					last: "<?=lang('last')?>",
					next: "<?=lang('next')?>",
					previous: "<?=lang('prev')?>"
				}
			}
		});
	})
</script>
<?
$total = 0;
$active = 0;
$passive = 0;
$admin_name = '';
$role_name = '';
$photo = '';
$fb_id = '';
$google_id = '';
$folder = $this->session->folder;
foreach ($user as $row) :
	$total++;
	if ($row['status'] == 1) {
		$active++;
	} elseif ($row['status'] == -1) {
		$passive++;
	}
	if ($row['parent_user_id'] == '') {
		$admin_name = $row['user_name'];
		$role_name = $row['role'];
		$photo = $row['photo'];
		$google_id = $row['google_id'];
		$fb_id = $row['fb_id'];
	}
endforeach;
?>
<!-- USERS START -->
<div class="tab-pane fade show active" id="list-users">
	<div class="tab-pane fade show active pt-0" id="list-users" role="tabpanel" aria-labelledby="list-users-list"
		 style="padding-top: 10px;">
		<div class="jumbotron jumbotron-fluid pb-2 pt-2">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6">
						<img style="-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;width: 50px"
							 class="float-left mr-2"
							 src="<?= ($photo != '' && $google_id == '' && $fb_id == '' ? base_url('uploads/' . $folder . '/user/photo/' . $photo) : ($photo != '' && $google_id != '' || $fb_id != '' ? $photo : base_url('assets/img/user_img.jpg'))) ?>"
						<p style="font-size: 18px;font-weight: 500;" class="mt-1">
							<span style="display: inline-block;margin-top: 12px;"
								  class="users_name"><?= $admin_name ?></span>
							<span class="ml-2 mr-2">|</span>
							<span class="users_position font-weight-light"><?= $role_name ?></span>
						</p>
					</div>
				</div>
			</div>
		</div>
		<!-- EDIT user modal -->

		<div class="modal fade bd-example-modal-lg " id="edit_user" tabindex="-1" role="dialog"
			 aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header bg-dark">
						<h6 class="text-white modal-title dar"><?= lang('user') ?></h6>
					</div>
					<div id="modal-body" class="modal-body">
						<img style="height: 50px;margin: 0 auto;display: block;text-align: center;"
							 src="<?= base_url('assets/images/bars.svg') ?>"/>
					</div>
				</div>
			</div>
		</div>
		<!-- Edit user modal end -->

		<!-- Add User Modal Start  -->
		<div class="modal fade add_user_modal" tabindex="-1" role="dialog"
			 aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header bg-dark">
						<h6 class="text-white modal-title dar"><?= lang('new_user') ?></h6>
					</div>
					<form id="user">
						<div class="modal-body">
							<!-- Error Message -->

							<div class="for_message">
								<div class="alert alert-success d-none" role="alert"></div>
								<div class="alert alert-info  d-none" role="alert"></div>
								<div class="alert alert-danger  d-none" role="alert"></div>
							</div>

							<div class="container-fluid">
								<div class="row">
									<div class="col-sm-էթ">
										<h5><?= lang('user_information') ?></h5>
										<p><?= lang('fill_followings_fields') ?></p>
									</div>
								</div>
								<hr class="my-2" style="margin-top: -10px !important;">
							</div>

							<div class="container">
								<div class="row">
									<div class="col-sm-12 col-md-12 col-12  mt-md-1 mt-1 pl-md-4 pl-4 pr-md-4 pr-4">
										<div class="form-group row">
											<div class="col-sm-1"></div>
											<label class="col-sm-2 col-form-label"><?= lang('first_name') ?> *</label>
											<div class="col-sm-7">
												<input type="text" class="form-control form-control-sm"
													   name="first_name"
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
													   placeholder="<?= lang('email') ?>">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-1"></div>
											<label
												class="col-sm-3 col-form-label"><?= lang('contact_number') ?>*</label>
											<div class="col-sm-7" style="margin-left: -61px;">
												<input type="text" class="form-control form-control-sm"
													   name="contact_number"
													   placeholder="<?= lang('contact_number') ?>">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-1"></div>
											<label
												class="col-sm-2 col-form-label"><?= lang('login') ?> *</label>
											<div class="col-sm-7">
												<input type="text"
													   class="form-control form-control-sm"
													   name="username"
													   placeholder="<?= lang('username') ?>">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-1"></div>
											<label class="col-sm-2 col-form-label"><?= lang('password') ?> *</label>
											<div class="col-sm-7">
												<input type="text"
													   class="form-control form-control-sm col-sm-5 float-left"
													   name="password"
													   placeholder="<?= lang('password') ?>"
													   id="password-input"
													   onclick="this.focus();this.select()"
												/>
												<button type="button"
														class="btn btn-sm btn-outline-secondary  ml-3 hide_password"
														style="border: none;outline: none;"><i class="fa fa-eye"></i>
												</button>
												<button id="generate-password-button"
														type="button"
														class="save_cancel_btn btn btn-success ml-3"
														style="font-size: 12px !important;line-height: 14px !important;padding: 12px 17px !important;font-weight: 500 !important;">
													<i class="fas fa-sync-alt"
													   style="margin-right: 8px;"></i><?= lang('generate') ?>
												</button>
											</div>
										</div>
										<div class="form-group row mb-0">
											<div class="col-sm-1"></div>
											<label class="col-sm-2 col-form-label"><?= lang('type') ?></label>
											<div class="col-sm-7">
												<select name="role"
														class="col selectpicker form-control form-control-sm form-control-sm"
														data-size="5" id="country" data-live-search="true"
														title="<?= lang('select_type') ?>">
													<? foreach ($role as $row_role) : ?>
														<option
															value="<?= $row_role['id'] ?>"><?= $row_role['title'] ?></option>
													<? endforeach; ?>
												</select>
											</div>
										</div>
										<div class="container-fluid">
											<div class="row mt-3">
												<div class="col-sm-1"></div>
												<label
													class="col-sm-4 ml-0 pl-0 col-form-label"><?= lang('status_make_passive') ?></label>
												<div class="col-sm-1">
													<input
														style="width: 18px;height: 18px;margin-left: -45px;margin-top: 7px;"
														value="-1"
														name="status" type="checkbox"
														class="form-control form-control-sm">
												</div>
											</div>

											<div class="row">
												<div class="col-sm-1"></div>
												<label
													class="ml-0 pl-0 col-form-label"><?= lang('send_email_to_new_user') ?></label>
												<div class="col-sm-1">
													<input
														style="width: 18px;height: 18px;margin-left: 0;margin-top: 7px;"
														name="mail_to" value="1" type="checkbox"
														class="form-control form-control-sm">
												</div>
											</div>

										</div>

									</div>
								</div>
							</div>
							<div class="modal-footer pb-0 col-sm-12" style="padding-right: 141px !important;">
								<button id="add_user" type="button"
										class="btn btn-outline-success cancel_btn"><?= lang('save') ?>
								</button>
								<button id="load" style="height: 40px !important; width: 93px !important;"
										class="btn btn-sm btn-outline-success cancel_btn d-none"><img
										style="height: 20px;margin: 0 auto;display: block;text-align: center;"
										src="<?= base_url() ?>assets/images/bars2.svg"/></button>
								<button type="button" class="cancel_btn close btn btn-sm"
										data-dismiss="modal"
										aria-label="Close">
									<?= lang('cancel') ?>
								</button>
							</div>

						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Add User Modal End -->

		<div class="container-fluid">
			<div class="row">
				<diiv class="col-sm-8 pt-2">
					<div class="row">
						<div class="col-sm-4">
							<p class="display-5 font-weight-bold float-left"
							   style="font-size: 13px;"><?= lang('total_user') ?></p> <span
								class="ml-2 mt-1 badge badge-secondary badge-pill"><?= $total ?></span>
						</div>
						<div class="col-sm-4">
							<p class="display-5 font-weight-bold float-left"
							   style="font-size: 13px;"><?= lang('active_user') ?></p>
							<span
								class="ml-2 mt-1 badge badge-success badge-pill"><?= $active ?></span>
						</div>
						<div class="col-sm-4">
							<p class="display-5 font-weight-bold float-left"
							   style="font-size: 13px;"><?= lang('passive_user') ?></p>
							<span
								class="ml-2 mt-1 badge badge-warning badge-pill"><?= $passive ?></span>
						</div>
					</div>
				</diiv>
				<div class="col-sm-4 text-right">
					<span class="btn btn-sm btn-outline-success"
						  style="font-size: 14px !important;line-height: 14px !important;padding: 12px 24px !important;font-weight: 500 !important;"
						  data-toggle="modal" data-target=".add_user_modal"><?= lang('add_user') ?>
				</div>
			</div>
			<hr class="my-2">
		</div>


		<div class="pt-2">
			<div class="row col-sm-12 col-md-12"
				 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: auto;margin-left: 0;margin-right: 0;">
				<table id="example4" class="table table-striped table-borderless"
					   style="width:100%">
					<thead style="background: #fff;color: #545b62;">
					<tr>
						<th style="font-size: 12px !important;font-weight: 500;"><?= lang('Name/Email') ?></th>
						<th style="font-size: 12px !important;font-weight: 500;"><?= lang('status') ?></th>
						<th style="font-size: 12px !important;font-weight: 500;"><?= lang('activity') ?></th>
						<th style="font-size: 12px !important;font-weight: 500;"><?= lang('type') ?></th>
						<th style="font-size: 12px !important;font-weight: 500;"><?= lang('login') ?>․</th>
						<th style="font-size: 12px !important;font-weight: 500;"><?= lang('Created_Date') ?></th>
						<th style="font-size: 12px !important;font-weight: 500;"><?= lang('by_whom') ?></th>
						<th style="font-size: 12px !important;font-weight: 500;"><?= lang('last_access') ?></th>
						<th style="font-size: 12px !important;font-weight500;min-width: 50px !important;"></th>
					</tr>
					</thead>
					<tbody>
					<? foreach ($user as $row) : ?>
						<tr>
							<td>
								<div class="media">
									<img
										style="-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 36px; height: 36px;"
										class="mr-3"
										src="<?= (($row['photo'] != '' && $row['google_id'] == '' && $row['fb_id'] == '') ? base_url('uploads/' . $folder . '/user/photo/' . $row['photo']) : ($row['photo'] != '' && $row['google_id'] != '' || $row['fb_id'] != '' ? $row['photo'] : base_url('assets/img/user_img.jpg'))) ?>"
										alt="Generic placeholder image">
									<div class="media-body">
										<?= $row['user_name'] ?>
										<small class="email_addres form-text text-muted">
											<?= $row['email'] ?>
										</small>
									</div>
								</div>
							</td>
							<td class="text-center">
								<? if ($row['status'] == '1') { ?>
									<div class="bg-success"
										 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
								<? } else { ?>
									<div class="bg-danger"
										 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
								<? } ?>
							</td>
							<td class="text-center">
								<?
								if ($row['activity'] > $this->config->item('activity_wary_weak') OR $row['activity'] == '') { ?>
									<div
										style="background-color:darkred;display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
									<span class="font-weight-light pl-1"
										  style="font-size: 13px;display: block;"></span>
								<? } elseif ($row['activity'] > $this->config->item('activity_weak')) { ?>
									<div class="bg-danger"
										 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
									<span class="font-weight-light pl-1"
										  style="font-size: 13px;display: block;"></span>
								<? } elseif ($row['activity'] > $this->config->item('activity_average')) { ?>
									<div class="bg-warning"
										 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
									<span class="font-weight-light pl-1"
										  style="font-size: 13px;display: block;"></span>
								<? } else {
									?>
									<div class="bg-success2"
										 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;background: rgba(40, 167, 69, 1);"></div>
									<span class="font-weight-light pl-1"
										  style="font-size: 13px;display: block;"></span>
								<? } ?>
							</td>
							<td><?= $row['role'] ?></td>
							<td><?= $row['username'] ?></td>
							<td><?= $row['creation_date'] ?></td>
							<td><?= $row['parent_user_name'] ?></td>
							<td><?= $row['last_activity'] ?></td>
							<td colspan="2">
										<span style="border: none;padding-top: 5px;cursor: pointer;"
											  data-id="<?= $row['id'] ?>"
											  id="edit_user_modal"
											  data-toggle="modal" class="float-left text-success"
											  data-target="#edit_user"><i class="fas fa-edit"></i></span>


								<? if ($this->session->user_id != $row['id'] && $row['parent_user_id'] != '' && $this->session->user_id == $row['parent_user_id']) { ?>
									<span style="border: none;cursor: pointer;" data-toggle="modal"
										  id="delete_user_modal"
										  class="text-secondary btn"
										  data-target=".bd-example-modal-sm" data-id="<?= $row['id'] ?>"><i
											class="fas fa-trash"></i></span>
								<? } ?>
							</td>
						</tr>
					<? endforeach; ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
<!--USERS END-->


<!-- Delete Modal Start -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title text-secondary text-center" id="exampleModalLabel"
					style="font-size: 12px;"><?= lang('are_you_sure_you_want_to_delete') ?></h6>
			</div>
			<div class="modal-footer text-center">
				<div style="margin: 0 auto;">
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" id="delete_user"
							class="btn btn-outline-success cancel_btn"><?= lang('yes') ?>
					</button>
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" class="btn btn-outline-danger yes_btn"
							data-dismiss="modal"><?= lang('cancel') ?></button>

					<input type="hidden" name="staff_id">
				</div>
			</div>
		</div>

	</div>
</div>
<!-- Delete Modal End -->

<script>

	$(document).on('click', '#delete_user_modal', function () {
		user_id = $(this).data('id');
		$('input[name="user_id"]').val(user_id);
	});

	$(document).on('click', '#delete_user', function () {
		var id = $('input[name="user_id"]').val();
		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Organization/delete_user/')?>';

		$.post(url, {user_id: id}, function (result) {
			location.reload();
		});
	});


	$(document).on('click', '#add_user', function (e) {

		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Organization/add_user_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#user')[0]);

		$('input').removeClass('border border-danger');
		$('input').parent('td').removeClass('border border-danger');
		$('select').removeClass('border border-danger');
		$('select').parent('div').removeClass('border border-danger');

		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function () {
				scroll_top();
				close_message();
				loading('start', 'add_user');
				$('.alert-info').removeClass('d-none');
				$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');
			},
			success: function (data) {
				if (data.success == '1') {

					scroll_top();
					close_message();
					$('.alert-success').removeClass('d-none');
					$('.alert-success').text(data.message);
					loading('stop', 'add_user');

					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/user')?>";
					$(location).attr('href', url);

				} else {

					$('.alert-info').addClass('d-none');

					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'add_user');
						errors = '';
						tmp = '';


						$.each(data.error.elements, function (index) {
							$.each(data.error.elements[index], function (index, value) {
								if (value != '') {
									$('input[name="' + index + '"]').addClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').children('button').addClass('border border-danger');
									close_message();
									$('.alert-danger').removeClass('d-none');

									if (value != tmp) {
										errors += value;
									}
									tmp = value;

								} else {
									$('input[name="' + index + '"]').removeClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').children('button').removeClass('border border-danger');
								}
							});
						});
					}

					$('.alert-danger').html(errors);

				}
			},
			error: function (jqXHR, textStatus) {
				// Handle errors here
				$('p#success').addClass('d-none');
				console.log('ERRORS: ' + textStatus);
				$('.alert-info').addClass('d-none');
			},
			complete: function () {

			}
		});
	});


	$(document).on('click', 'button#edit_user_button', function (e) {

		$(this).html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/bars2.svg" />');

		var url = '<?=base_url($this->uri->segment(1) . '/Organization/edit_user_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#user_edit_1')[0]);

		$('input').removeClass('border border-danger');
		$('input').parent('td').removeClass('border border-danger');
		$('select').removeClass('border border-danger');

		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: form_data,
			contentType: false,
			processData: false,
			cache: false,
			beforeSend: function () {
				scroll_top();
				close_message();
				loading('start', 'edit_user_button');
				$('.alert-info').removeClass('d-none');
				$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');
			},
			success: function (data) {
				if (data.success == '1') {

					scroll_top();
					close_message();
					$('.alert-success').removeClass('d-none');
					$('.alert-success').text(data.message);
					loading('stop', 'edit_user_button');

					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/user')?>";
					$(location).attr('href', url);


				} else {

					$('.alert-info').addClass('d-none');

					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'edit_user_button');
						errors = '';
						tmp = '';


						$.each(data.error.elements, function (index) {
							$.each(data.error.elements[index], function (index, value) {
								if (value != '') {
									$('input[name="' + index + '"]').addClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').children('button').addClass('border border-danger');
									close_message();
									$('.alert-danger').removeClass('d-none');

									if (value != tmp) {
										errors += value;
									}
									tmp = value;

								} else {
									$('input[name="' + index + '"]').removeClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').children('button').removeClass('border border-danger');
								}
							});
						});
					}

					$('.alert-danger').html(errors);

				}
			},
			error: function (jqXHR, textStatus) {
				// Handle errors here
				$('p#success').addClass('d-none');
				$('.alert-info').addClass('d-none');
				close_message();
				console.log('ERRORS: ' + textStatus);
			},
			complete: function () {

			}
		});
	});


	$(document).on('click', '#edit_user_modal', function () {
		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Organization/edit_user_modal_ax/')?>' + $(this).data('id');
		$.get(url, function (result) {

			// update modal content
			$('#modal-body').html(result);

			// show modal
			$('#myModal').modal('show');
		});

	});


</script>
