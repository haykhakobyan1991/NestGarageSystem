<!-- Department Start -->

<div class="tab-pane fade show active" id="list-department" role="tabpanel"
	 aria-labelledby="list-department-list">


	<div class="tab-pane fade show active" id="list-department" role="tabpanel"
		 aria-labelledby="list-department-list">


		<div class="jumbotron jumbotron-fluid pb-2 pt-2">
			<div class="container">
				<p class="display-5 font-weight-bold mb-0">Section: Departments</p>
			</div>
		</div>

		<div class="jumbotron jumbotron-fluid pb-2 pt-2">
			<div class="container">
				<p class="display-5 font-weight-bold float-left">Ստորաբաժանումների քանակ</p>
				<span
					class="ml-2 mt-1 badge badge-secondary badge-pill"><?= $department_num_rows ?></span>
				<span class="btn btn-secondary btn-sm float-right" data-toggle="modal"
					  data-target="#add_department">Ստեղծել Ստորաբաժանում
					</span>
				<hr class="my-4">
				<div class="row col-sm-12 col-md-12"
					 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: scroll;">


					<table id="example" class="table table-striped table-bordered"
						   style="width:100%">
						<thead style="background: #545b62;
color: #fff;">
						<tr>
							<th style="font-size: 12px !important;">Ստորաբաժանում</th>
							<th style="font-size: 12px !important;">Մանրամասն</th>
							<th style="font-size: 12px !important;">Անուն</th>
							<th style="font-size: 12px !important;">Ազգանուն</th>
							<th style="font-size: 12px !important;">Հեռ․</th>
							<th style="font-size: 12px !important;">Էլ․ հասցե</th>
							<th style="font-size: 12px !important;">Ստեղծվել է</th>
							<th style="font-size: 12px !important;">Ում կողմից</th>
							<th style="font-size: 12px !important;min-width: 50px !important;"></th>
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
											data-toggle="modal" class="float-left "
											data-target="#edit_department"><i class="fas fa-edit"></i></span>

									<span style="border: none; cursor:pointer;" data-toggle="modal"
										  data-target=".bd-example-modal-sm" data-id="<?= $item['id'] ?>"
										  id="delete_department_modal" class=""><i class="fas fa-trash"></i></span></td>

							</tr>

						<? endforeach; ?>
					</table>


				</div>


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
										<span id="add_department" type="button" class="btn btn-secondary">Save</span>
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
				<h5 class="modal-title text-danger" id="exampleModalLabel">are you sure you want to delete ? </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer text-center">
				<div style="margin: 0 auto;">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
					<button type="button" id="delete_department" class="btn btn-success">Yes</button>
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

</script>


