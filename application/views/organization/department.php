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

	a.page_link {
		color: #fff !important;
		background: rgb(255, 122, 89) !important;
	}

	.btn.dropdown-toggle.bs-placeholder {
		font-size: 13px !important;
	}
</style>

<script>
	$(document).ready(function () {
		$('#example').DataTable({
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
<!-- Department Start -->

<div class="tab-pane fade show active" id="list-department" role="tabpanel" style="padding-top:10px;"
	 aria-labelledby="list-department-list">


	<div class="pt-2">
		<div class="container-fluid">
			<p class="display-5 font-weight-bold mb-0"><?= lang('department') ?></p>
			<hr class="my-2">
		</div>

		<div class="container-fluid">
			<p class="display-5 font-weight-bold float-left"><?= lang('count_departments') ?></p>
			<span
				class="ml-2 mt-1 badge badge-secondary badge-pill"><?= $department_num_rows ?></span><?
			if ($this->load->authorisation('Organization', 'add_department', 1)) :
				?>
				<span class="btn btn-outline-success btn-sm float-right" data-toggle="modal"
					  data-target="#add_department"><?= lang('create_departments') ?>
				</span><?
			endif;
			?>
			<hr class="my-4">
		</div>


		<div class="row  m-0 col-sm-12 col-md-12"
			 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">


			<table id="example" class="table table-striped table-borderless"
				   style="width:100%">
				<thead style="background: #fff;
color: #545b62;">
				<tr>
					<th style="font-size: 12px !important;font-weight:500;"><?= lang('department') ?></th>
					<th style="font-size: 12px !important;font-weight:500;"><?= lang('more_info') ?></th>
					<th style="font-size: 12px !important;font-weight:500;"><?= lang('first_name') ?></th>
					<th style="font-size: 12px !important;font-weight:500;"><?= lang('last_name') ?></th>
					<th style="font-size: 12px !important;font-weight:500;"><?= lang('phone_number') ?></th>
					<th style="font-size: 12px !important;font-weight:500;"><?= lang('email') ?></th>
					<th style="font-size: 12px !important;font-weight:500;"><?= lang('Created_Date') ?></th>
					<th style="font-size: 12px !important;font-weight:500;"><?= lang('by_whom') ?></th>
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
						<td colspan="2"><?
							if ($this->load->authorisation('Organization', 'edit_department', 1)) :
								?>
								<span
									style="border: none;padding-top: 0px;padding-left: 5px;padding-right: 10px;cursor: pointer;:pointer;"
									data-id="<?= $item['id'] ?>" id="edit_department_modal"
									data-toggle="modal" class="float-left text-success"
									data-target="#edit_department"
									data-toggle2="tooltip"
									data-placement="top"
									title="edit"><i class="fas fa-edit"></i></span>
							<? endif; ?>

							<? if ($this->load->authorisation('Organization', 'delete_department', 1)) : ?>
							<span style="border: none; cursor:pointer;" data-toggle="modal"
								  data-target=".bd-example-modal-sm" data-id="<?= $item['id'] ?>"
								  id="delete_department_modal" class="text-secondary"
								  data-toggle2="tooltip"
								  data-placement="top"
								  title="delete"><i class="fas fa-trash"></i></span></td>
						<? endif; ?>
					</tr>


				<? endforeach; ?>
			</table>


		</div>


		<div class="modal fade" id="edit_department" tabindex="-1" role="dialog"
			 aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-dark">
						<h6 class="text-white modal-title dar"><?= lang('department') ?></h6>
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
			<div class="modal fade " tabindex="-1" role="dialog" id="add_department"
				 aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header bg-dark">
							<h6 class="text-white modal-title dar"><?= lang('New_Department') ?></h6>
						</div>
						<div class="modal-body">
							<!-- Error Message -->

							<div class="for_message">
								<div class="alert alert-success d-none " role="alert"></div>
								<div class="alert alert-danger d-none " role="alert"></div>
							</div>


							<div class="form-group row mb-0">

								<label class="col-sm-3 col-form-label"><?= lang('item_name') ?> *</label>
								<div class="col-sm-8">
									<input type="text" name="title" class="form-control"
										   placeholder="<?= lang('item_name') ?>">
								</div>
							</div>


							<div class="form-group row mb-0 mt-1" style="font-size: 13px !important;">
								<label class="col-sm-3 col-form-label"><?= lang('head') ?> </label>
								<div class="col-sm-8">
									<select name="head_staff"
											class="form-control selectpicker"
											data-size="5" id="head_staff" data-live-search="true"
											title="<?= lang('select_staff') ?>">
										<?
										foreach ($staff_for_select as $val) :
											?>
											<option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
										<? endforeach; ?>
									</select>
								</div>
							</div>

							<div class="form-group row mb-2" style="margin-top: 0.4em;">
								<label class="col-sm-3 col-form-label"><?= lang('more_info') ?></label>
								<div class="col-sm-8">
											<textarea style="font-size: 13px;" rows="3" value="" type="text"
													  class=" form-control"
													  name="description"
													  placeholder="<?= lang('more_info') ?>"></textarea>
								</div>
							</div>

							<div class="modal-footer pb-0" style="margin-right: 22px;">
								<button id="add_department_btn" type="button"
										class="btn btn-outline-success cancel_btn "><?= lang('save') ?>
								</button>
								<button id="load" style="height: 40px !important; width: 90px !important;"
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
					</div>
				</div>
			</div>
		</form>
	</div>
</div>


<!-- Department End -->

<!-- Delete Modal Start -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title text-secondary text-center" id="exampleModalLabel"
					style="font-size: 15px;"><?= lang('are_you_sure_you_want_to_delete') ?></h6>
			</div>
			<div class="modal-footer text-center">
				<div style="margin: 0 auto;">
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" id="delete_department"
							class="btn btn-outline-danger  cancel_btn"><?= lang('yes') ?>
					</button>
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" class=" btn btn-outline-success yes_btn "
							data-dismiss="modal"><?= lang('cancel') ?></button>

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
		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Organization/delete_department/')?>';

		$.post(url, {department_id, id}, function (result) {
			location.reload();
		});
	});


	// create department
	$(document).on('click', '#add_department_btn', function (e) {

		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Organization/add_department_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#department')[0]);

		$('input').removeClass('border border-danger');
		$('input').parent('td').removeClass('border border-danger');
		$('select').removeClass('border border-danger');
		loading('start', 'add_department_btn');

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
				loading('start', 'add_department_btn');
				$('.alert-info').removeClass('d-none');
				$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');
			},
			success: function (data) {
				if (data.success == '1') {
					close_message();


					$('.alert-success').removeClass('d-none');
					$('.alert-success').text(data.message);

					loading('stop', 'add_department_btn');


					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/department')?>";

					$(location).attr('href', url);


				} else {
					close_message();
					loading('stop', 'add_department_btn');

					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'add_department_btn');
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
			},
			complete: function () {

			}
		});
	});


	$(document).on('click', '#edit_department_btn', function (e) {


		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Organization/edit_department_ax') ?>';
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
			beforeSend: function () {


				loading('start', 'edit_department_btn');

			},
			success: function (data) {
				if (data.success == '1') {


					loading('stop', 'edit_department_btn');


					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/department')?>";

					$(location).attr('href', url);


				} else {
					close_message();
					loading('stop', 'edit_department_btn');

					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'edit_department_btn');
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
			},
			complete: function () {

			}
		});
	});


	$(document).on('click', '#edit_department_modal', function () {
		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Organization/edit_department_modal_ax/')?>' + $(this).data('id');
		$.get(url, function (result) {

			// update modal content
			$('.modal-body').html(result);

			// show modal
			$('#myModal').modal('show');
		});

	});


</script>


