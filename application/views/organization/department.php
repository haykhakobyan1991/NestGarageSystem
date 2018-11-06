<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<style>
	table#example thead tr th:last-child:after {
		content: '';
	}

	table#example thead tr th:last-child:before {
		content: '';
	}
</style>

<script>


</script>
<!-- Department Start -->

<div class="tab-pane fade show active" id="list-department" role="tabpanel"
	 aria-labelledby="list-department-list">


	<div class="tab-pane fade show active" id="list-department" role="tabpanel" style="padding-top:10px;"
		 aria-labelledby="list-department-list">


		<div class="jumbotron jumbotron-fluid pb-2 pt-2">
			<div class="container">
				<p class="display-5 font-weight-bold mb-0">Section: Departments</p>
			</div>
		</div>

		<div class=" pb-2 pt-2">
			<div class="">
				<p class="display-5 font-weight-bold float-left">Ստորաբաժանումների քանակ</p>
				<span
					class="ml-2 mt-1 badge badge-secondary badge-pill"><?= $department_num_rows ?></span>
				<span class="btn btn-outline-success btn-sm float-right" data-toggle="modal"
					  data-target="#add_department">Ստեղծել Ստորաբաժանում
					</span>
				<hr class="my-4">
				<div class="row col-sm-12 col-md-12"
					 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">


					<table id="example" class="table table-striped table-borderless"
						   style="width:100%">
						<thead style="background: #fff;
color: #545b62;">
						<tr>
							<th style="font-size: 12px !important;font-weight:500;">Ստորաբաժանում</th>
							<th style="font-size: 12px !important;font-weight:500;">Մանրամասն</th>
							<th style="font-size: 12px !important;font-weight:500;">Անուն</th>
							<th style="font-size: 12px !important;font-weight:500;">Ազգանուն</th>
							<th style="font-size: 12px !important;font-weight:500;">Հեռ․</th>
							<th style="font-size: 12px !important;font-weight:500;">Էլ․ հասցե</th>
							<th style="font-size: 12px !important;font-weight:500;">Ստեղծվել է</th>
							<th style="font-size: 12px !important;font-weight:500;">Ում կողմից</th>
							<th style="font-size: 12px !important;font-weight:500;min-width: 50px !important;"></th>
						</tr>
						</thead>
						<tbody>
						<? foreach ($department as $item) : ?>
							<tr>
								<td><?= $item['title'] ?></td>
								<td><?= $item['description'] ?></td>
								<td><?= $item['first_name'] ?></td>
								<td><?= $item['last_name'] ?></td>
								<td><?= $item['phone'] ?></td>
								<td><?= $item['email'] ?></td>
								<td><?= $item['registration_date'] ?></td>
								<td><?= $item['user_name'] ?></td>
								<td colspan="2">

										<span
											style="border: none;padding-top: 0px;padding-left: 5px;padding-right: 10px;cursor: pointer;:pointer;"
											data-id="<?= $item['id'] ?>" id="edit_department_modal"
											data-toggle="modal" class="float-left text-success"
											data-target="#edit_department"
											data-toggle2="tooltip"
											data-placement="top"
											title="edit"><i class="fas fa-edit"></i></span>

									<span style="border: none; cursor:pointer;" data-toggle="modal"
										  data-target=".bd-example-modal-sm" data-id="<?= $item['id'] ?>"
										  id="delete_department_modal" class="text-danger"
										  data-toggle2="tooltip"
										  data-placement="top"
										  title="delete"><i class="fas fa-trash"></i></span></td>

							</tr>


						<? endforeach; ?>
					</table>


				</div>


				<div class="modal fade bd-example-modal-lg " id="edit_department" tabindex="-1" role="dialog"
					 aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header bg-dark">
								<h5 class="text-white modal-title dar">Edit Department</h5>
								<button type="button" class="text-white close"
										data-dismiss="modal"
										aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<img style="height: 50px;margin: 0 auto;display: block;text-align: center;"
									 src="<?= base_url() ?>assets/images/bars.svg"/>
							</div>
						</div>
					</div>
				</div>

				<!--  Department Modal Start -->
				<form id="department">
					<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="add_department"
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
										<span id="add_department" type="button" class="btn btn-outline-success">Save</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Department End -->

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
					<button type="button" id="delete_department" class="btn btn-outline-success text-success">Yes</button>
					<input type="hidden" name="department_id">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Delete Modal End -->

<script>
	$(document).on('click', '#delete_department_modal', function () {
		department_id = $(this).data('id');
		$('input[name="department_id"]').val(department_id);
	});

	$(document).on('click', '#delete_department', function () {
		var id = $('input[name="department_id"]').val();
		var url = '<?=base_url('Organization/delete_department/')?>';

		$.post(url, {department_id, id}, function (result) {
			location.reload();
		});
	});


	// create department
	$(document).on('click', 'span#add_department', function (e) {

		var url = '<?=base_url('Organization/add_department_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#department')[0]);

		$('input').removeClass('border border-danger');
		$('input').parent('td').removeClass('border border-danger');
		$('select').removeClass('border border-danger');

		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			success: function (data) {
				if (data.success == '1') {

					scroll_top();

					$('.alert-success').removeClass('d-none');
					$('.alert-danger').addClass('d-none');
					$('.alert-success').text(data.message);

					close_message();


					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/department')?>";

					$(location).attr('href', url);


				} else {

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
				console.log('ERRORS: ' + textStatus);
			},
			complete: function () {

			}
		});
	});


	$(document).on('click', 'span#edit_department', function (e) {

		$(this).html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/bars2.svg" />');

		var url = '<?=base_url('Organization/edit_department_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#department_edit')[0]);

		$('input').removeClass('border border-danger');
		$('input').parent('td').removeClass('border border-danger');
		$('select').removeClass('border border-danger');

		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			success: function (data) {
				if (data.success == '1') {

					scroll_top();

					$('.alert-success').removeClass('d-none');
					$('.alert-danger').addClass('d-none');
					$('.alert-success').text(data.message);

					close_message();


					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/department')?>";

					$(location).attr('href', url);


				} else {

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
				console.log('ERRORS: ' + textStatus);
			},
			complete: function () {

			}
		});
	});


	$(document).on('click', '#edit_department_modal', function () {
		var url = '<?=base_url('Organization/edit_department_modal_ax/')?>' + $(this).data('id');
		$.get(url, function (result) {

			// update modal content
			$('.modal-body').html(result);

			// show modal
			$('#myModal').modal('show');
		});

	});


</script>


