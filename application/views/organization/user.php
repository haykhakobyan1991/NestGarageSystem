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

</style>
<script>
	$(document).ready(function() {
		$('#example4').DataTable();
	})
</script>

<?

$total = 0;
$active = 0;
$passive = 0;
$admin_name = '';
$role_name = '';
$photo = '';
foreach ($user as $row) :

	$total++;

	if ($row['status'] == 1) {
		$active++;
	} elseif ($row['status'] == -1) {
		$passive++;
	}

	if($row['parent_user_id'] == '') {
		$admin_name = $row['user_name'];
		$role_name = $row['role'];
		$photo = $row['photo'];
	}

endforeach;
?>

<!-- USERS START -->
<div class="tab-pane fade show active" id="list-users">

	<div class="tab-pane fade show active" id="list-users" role="tabpanel" aria-labelledby="list-users-list"
			 style="padding-top: 10px;">

			<div class="jumbotron jumbotron-fluid pb-2 pt-2">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<img style="-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"
								 class="float-left mr-2"
								 src="<?= ($photo != '' ? base_url('uploads/user_' . ($row['parent_user_id'] != '' ? $row['parent_user_id'] : $row['id']) . '/user/photo/' . $photo) : base_url('assets/img/user_img.jpg')) ?>"
							<p style="font-size: 18px;font-weight: 500;" class="mt-1">
								<span class="users_name"><?=$admin_name?></span>
								<span class="ml-2 mr-2">|</span>
								<span class="users_position font-weight-light"><?=$role_name?></span>
							</p>
						</div>
					</div>
				</div>
			</div>


		<!-- EDIT user modal-->

		<div class="modal fade bd-example-modal-lg " id="edit_user" tabindex="-1" role="dialog"
			 aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header bg-dark">
						<h5 class="text-white modal-title dar">Edit User</h5>
						<button type="button" class="text-white close"
								data-dismiss="modal"
								aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div  id="modal-body" class="modal-body">
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
							<h5 class="text-white modal-title dar">New User</h5>
							<button type="button" class="text-white close"
									data-dismiss="modal"
									aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form id="user">
							<div class="modal-body">
								<!-- Error Message -->

								<div class="for_message">
									<div class="alert alert-success d-none" role="alert"></div>
									<div class="alert alert-info  d-none" role="alert"></div>
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
													   placeholder="Last Name">
											</div>
										</div>
										<div class="form-group row">
											<label
												class="col-sm-2 col-form-label">E-mail *</label>
											<div class="col-sm-10">
												<input type="email" class="form-control form-control-sm"
													   name="email"
													   placeholder="E-mail">
											</div>
										</div>
										<div class="form-group row">
											<label
												class="col-sm-2 col-form-label">Contact Number *</label>
											<div class="col-sm-10">
												<input type="text" class="form-control form-control-sm"
													   name="contact_number"
													   placeholder="Contact Number">
											</div>
										</div>
										<div class="form-group row">
											<label
												class="col-sm-2 col-form-label">User Name *</label>
											<div class="col-sm-10">
												<input type="text" class="form-control form-control-sm"
													   name="username"
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
													   id="password-input"
													   onclick="this.focus();this.select()"
													   readonly/>
												<button type="button"
														class="btn btn-sm btn-outline-secondary ml-1 hide_password"
														style="border: none;outline: none;"><i class="fa fa-eye"></i>
												</button>
												<button id="generate-password-button" type="button"
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
														data-size="5" id="country" data-live-search="true"
														title="Select a Type">
													<? foreach ($role as $row_role) : ?>
														<option value="<?= $row_role['id'] ?>"><?= $row_role['title'] ?></option>
													<? endforeach; ?>
												</select>
											</div>
										</div>
										<div class="form-group row mt-2">
											<label class="ml-1 col-form-label">Status make a Passive?</label>
											<div class="col-sm-1">
												<input name="status" value="-1" type="checkbox"
													   class="form-control form-control-sm">
											</div>
										</div>

										<div class="form-group row">
											<label class="ml-1 col-form-label">Send a notification mail to the new
												created
												user?</label>
											<div class="col-sm-1">
												<input name="mail_to" value="1" type="checkbox"
													   class="form-control form-control-sm">
											</div>
										</div>
									</div>
								</div>
								<div class="text-right mt-4 pb-2">
									<span id="add_user" class="btn btn-sm btn-outline-success">Save</span>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Add User Modal End -->






		<div class="pb-2 pt-2">
				<div class="">
					<div class="row">
						<div class="col-sm-12 col-md-2 col-2">
							<p class="display-5 font-weight-bold float-left">Toatl Users</p> <span
								class="ml-2 mt-1 badge badge-secondary badge-pill"><?=$total?></span>
						</div>
						<div class="col-sm-12 col-md-2 col-2">
							<p class="display-5 font-weight-bold float-left">Active Users</p> <span
								class="ml-2 mt-1 badge badge-success badge-pill"><?=$active?></span>
						</div>
						<div class="col-sm-12 col-md-2 col2">
							<p class="display-5 font-weight-bold float-left">Passive Users</p> <span
								class="ml-2 mt-1 badge badge-warning badge-pill"><?=$passive?></span>
						</div>
						<div class="col-sm-12 col-md-4 col-4"></div>
						<div class="col-sm-12 col-md-2 col-2">
							<span class="btn btn-sm btn-outline-success" data-toggle="modal"
								  data-target=".add_user_modal">Add User
							</span>
						</div>
					</div>
					<hr class="my-4">
					<div class="row col-sm-12 col-md-12"
						 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">
						<table id="example4" class="table table-striped table-borderless"
							   style="width:100%">
							<thead style="background: #fff;color: #545b62;">
							<tr>
								<th style="font-size: 12px !important;font-weight: 500;">Name/Email</th>
								<th style="font-size: 12px !important;font-weight: 500;">Status</th>
								<th style="font-size: 12px !important;font-weight: 500;">Activity</th>
								<th style="font-size: 12px !important;font-weight: 500;">User Type</th>
								<th style="font-size: 12px !important;font-weight: 500;">User Name․</th>
								<th style="font-size: 12px !important;font-weight: 500;">Created Date</th>
								<th style="font-size: 12px !important;font-weight: 500;">By Whom</th>
								<th style="font-size: 12px !important;font-weight: 500;">Last Access Date/Time</th>
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
												src="<?= ($row['photo'] != '' ? base_url('uploads/user_' . ($row['parent_user_id'] != '' ? $row['parent_user_id'] : $row['id']) . '/user/photo/' . $row['photo']) : base_url('assets/img/user_img.jpg')) ?>"
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
										if($row['activity'] > $this->config->item('activity_wary_weak') OR $row['activity'] == '') {?>
											<div style="background-color:darkred;display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
											<span class="font-weight-light pl-1"
												  style="font-size: 13px;display: block;">Wary weak</span>
										<?} elseif($row['activity'] > $this->config->item('activity_weak')) {?>
											<div class="bg-danger"
												 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
											<span class="font-weight-light pl-1"
												  style="font-size: 13px;display: block;">Weak</span>
										<?} elseif($row['activity'] > $this->config->item('activity_average')) {?>
											<div class="bg-warning"
												 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
											<span class="font-weight-light pl-1"
												  style="font-size: 13px;display: block;">Average</span>
										<?}else{?>
											<div class="bg-success2"
												 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
											<span class="font-weight-light pl-1"
												  style="font-size: 13px;display: block;">Strong</span>
										<?}?>
									</td>
									<td><?=$row['role']?></td>
									<td><?=$row['username']?></td>
									<td><?=$row['creation_date']?></td>
									<td><?=$row['parent_user_name']?></td>
									<td><?=$row['last_activity']?></td>
									<td colspan="2">
										<span style="border: none;padding-top: 5px;cursor: pointer;" data-id="<?=$row['id']?>"
											  id="edit_user_modal"
											  data-toggle="modal" class="float-left text-success"
											  data-target="#edit_user"
											  data-toggle2="tooltip"
											  data-placement="top"
											  title="edit"><i class="fas fa-edit"></i></span>

										<span style="border: none;cursor: pointer;" data-toggle="modal"
											  id="delete_user_modal"
											  class="text-danger btn"
											  data-target=".bd-example-modal-sm" data-id="<?= $row['id'] ?>"
											  data-toggle2="tooltip"
											  data-placement="top"
											  title="delete"><i class="fas fa-trash"></i></span></td>
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
				<h5 class="modal-title text-secondary" id="exampleModalLabel">are you sure you want to delete ? </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer text-center">
				<div style="margin: 0 auto;">
					<button type="button" class="btn btn-outline-danger text-danger" data-dismiss="modal">No</button>
					<button type="button" id="delete_user" class="btn btn-outline-success text-success">Yes</button>
					<input type="hidden" name="user_id">
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
		var url = '<?=base_url('Organization/delete_user/')?>';

		$.post(url, {user_id: id}, function (result) {
			location.reload();
		});
	});


	$(document).on('click', '#add_user', function (e) {

		var url = '<?=base_url('Organization/add_user_ax') ?>';
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
			beforeSend : function (){
				scroll_top();
				close_message();
				$(this).html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/bars2.svg" />');
				$(this).addClass('bg-success2');
				$('.alert-info').removeClass('d-none');
				$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');
			},
			success: function (data) {
				if (data.success == '1') {

					scroll_top();

					$('.alert-success').removeClass('d-none');
					$('.alert-danger').addClass('d-none');
					$('.alert-info').addClass('d-none');
					$('.alert-success').text(data.message);

					close_message();


					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/user')?>";

					$(location).attr('href', url);

					$(location).attr('href', url + '#staff');

				} else {


					if ($.isArray(data.error.elements)) {
						scroll_top();

						var error = '';
						var i = 0;

						$('.alert-danger').addClass('d-none');
						$('.alert-success').addClass('d-none');
						$('.alert-info').addClass('d-none');


						$.each(data.error.elements, function (index) {
							$.each(data.error.elements[index], function (index, value) {

								if (value != '') {

									i++;
									if (i == 1) {
										error += '* - ով դաշտերը պարտադիր են <br> ';
									}

									if (index == 'username_unique') {
										error += value + ' <br> ';
									}

									if (index == 'email_unique') {
										error += value + ' <br> ';
									}

									if (index == 'username_unique') {
										index = 'username';
									}

									if (index == 'email_unique') {
										index = 'email';
									}

									$('input[name="' + index + '"]').addClass('border border-danger');
									$('select[name="' + index + '"]').addClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').addClass('border border-danger');
									$('input[name="' + index + '"]').parent('td').addClass('border border-danger');


									$('.alert-danger').removeClass('d-none');


									$('.alert-danger').html(error);


								} else {


									$('input[name="' + index + '"]').removeClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').removeClass('border border-danger');
									$('input[name="' + index + '"]').parent('td').removeClass('border border-danger');


								}

							});


						});

					}

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


	$(document).on('click', 'span#edit_user_button', function (e) {

		$(this).html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/bars2.svg" />');

		var url = '<?=base_url('Organization/edit_user_ax') ?>';
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
			beforeSend : function (){
				scroll_top();
				close_message();
				$(this).html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/bars2.svg" />');
				$(this).addClass('bg-success2');
				$('.alert-info').removeClass('d-none');
				$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');
			},
			success: function (data) {
				if (data.success == '1') {

					scroll_top();

					$('.alert-success').removeClass('d-none');
					$('.alert-danger').addClass('d-none');
					$('.alert-info').addClass('d-none');
					$('.alert-success').text(data.message);

					close_message();


					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/user')?>";

					$(location).attr('href', url);


				} else {

					$('.alert-info').addClass('d-none');

					if ($.isArray(data.error.elements)) {
						scroll_top();

						$('.alert-danger').addClass('d-none');
						$('.alert-success').addClass('d-none');

						$.each(data.error.elements, function (index) {

							$.each(data.error.elements[index], function (index, value) {

								if (value != '') {

									$('input[name="' + index + '"]').addClass('border border-danger');
									$('select[name="' + index + '"]').addClass('border border-danger');
									$('input[name="' + index + '"]').parent('td').addClass('border border-danger');


									$('.alert-danger').removeClass('d-none');
									$('.alert-danger').text('* - ով դաշտերը պարտադիր են');

								} else {
									$('input[name="' + index + '"]').removeClass('border border-danger');
									$('select[name="' + index + '"]').removeClass('border border-danger');
									$('input[name="' + index + '"]').parent('td').removeClass('border border-danger');


								}

							});


						});

					}

				}
			},
			error: function (jqXHR, textStatus) {
				// Handle errors here
				$('p#success').addClass('d-none');
				$('.alert-info').addClass('d-none');
				close_message()
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
