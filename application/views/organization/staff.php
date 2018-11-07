<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<?
$user_id = $parent_user;
$total = 0;
$active = 0;
$passive = 0;
foreach ($staff as $row) :

	$total++;

	if ($row['status'] == 1) {
		$active++;
	} elseif ($row['status'] == -1) {
		$passive++;
	}

endforeach;
?>

<style>
	table#example2 thead tr th:last-child:after {
		content: '';
	}

	table#example2 thead tr th:last-child:before {
		content: '';
	}
</style>


<!-- Staff Start -->
<div class="tab-pane fade show active" id="list-staff" role="tabpanel" aria-labelledby="list-staff-list">

	<div class="tab-pane fade show active" id="list-staff" role="tabpanel" style="padding-top: 10px;"
		 aria-labelledby="list-staff-list">


		<div class="jumbotron jumbotron-fluid pb-2 pt-2">
			<div class="container">
				<p class="display-5 font-weight-bold mb-0">Section: Staff</p>
			</div>
		</div>


		<div class="pb-2 pt-2">
			<div class="">
				<div class="row">
					<div class="col-sm-12 col-md-2 col-2">
						<p class="display-5 font-weight-bold float-left">Toatl Staff</p> <span
							class="ml-2 mt-1 badge badge-secondary badge-pill"><?= $total ?></span>
					</div>

					<div class="col-sm-12 col-md-2 col-2">
						<p class="display-5 font-weight-bold float-left">Active Staff</p> <span
							class="ml-2 mt-1 badge badge-success badge-pill"><?= $active ?></span>
					</div>

					<div class="col-sm-12 col-md-2 col2">
						<p class="display-5 font-weight-bold float-left">Passive Staff</p> <span
							class="ml-2 mt-1 badge badge-warning badge-pill"><?= $passive ?></span>
					</div>

					<div class="col-sm-12 col-md-4 col-4"></div>

					<div class="col-sm-12 col-md-2 col-2">
							<span class="btn btn-outline-success" data-toggle="modal"
								  data-target=".add_staff_modal">Add User
							</span>
					</div>


					<!-- EDIT staff modal-->

					<div class="modal fade bd-example-modal-lg " id="edit_staff" tabindex="-1" role="dialog"
						 aria-labelledby="myLargeModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header bg-dark">
									<h5 class="text-white modal-title dar">Edit Staff</h5>
									<button type="button" class="text-white close"
											data-dismiss="modal"
											aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<img style="height: 50px;margin: 0 auto;display: block;text-align: center;"
										 src="<?= base_url('assets/images/bars.svg') ?>"/>
								</div>
							</div>
						</div>
					</div>

					<!-- Edit staff modal end -->


					<!-- Add User Modal Start  -->
					<form id="staff" enctype="multipart/form-data">
						<div class="modal fade add_staff_modal" tabindex="-1" role="dialog"
							 aria-labelledby="myLargeModalLabel" aria-hidden="true">

							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header bg-dark">

										<h5 class="text-white modal-title dar">New Staff</h5>


										<button type="button" class="text-white close"
												data-dismiss="modal"
												aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<!-- Error Message -->

										<div class="for_message">
											<div class="alert alert-success d-none" role="alert"></div>
											<div class="alert alert-danger  d-none" role="alert"></div>
											<div class="alert alert-info  d-none" role="alert"></div>
										</div>

										<div class="row">
											<div class="col-sm-12 col-md-6 col-6">
												<h2>Staff Infprmation</h2>
												<p>Fill in the following fields</p>
											</div>

											<div class="col-sm-12 col-md-6 col-6">
												<div class="media">
													<img class="align-self-start mr-3"
														 id='img-upload2'

														 style="width: 100px;" alt=""
														 src="<?= base_url('assets/images/no_choose_image.svg') ?>">
													<div class="media-body">
														<div class="input-group ml-2 ml-md-2">
														<span class="input-group-btn">
															<span
																class="btn btn-outline-success btn-file mr-1">
																Browse… <input type="file" id="imgInp2"
																			   name="photo"
																			   onchange="readURL2(this);">
															</span>
														</span>
															<input type="text" class="form-control form-control-sm"
																   readonly
																   style="display: none;">

														</div>
													</div>
												</div>


											</div>


										</div>

										<div class="row">
											<div
												class="col-sm-12 col-md-12 col-12  mt-md-5 mt-5 pl-md-4 pl-4 pr-md-4 pr-4">

												<div class="row">


													<label
														class="col-sm-2 col-form-label" style="font-size: 15px;">First
														Name *</label>
													<div class="col-sm-4">
														<input type="text" class="form-control form-control-sm"
															   name="firstname"
															   placeholder="First Name">
													</div>


													<label
														class="col-sm-2 col-form-label">Last
														Name *</label>
													<div class="col-sm-4">
														<input type="text" class="form-control form-control-sm"
															   name="lastname"
															   placeholder="Last Name">
													</div>


												</div>

												<div class="row mt-1">


													<label
														class="col-sm-2 col-form-label" style="font-size: 15px;">Contact
														Number
														1</label>
													<div class="col-sm-4">
														<input type="text" class="form-control form-control-sm"
															   name="contact_1"
															   placeholder="Contact Number 1">
													</div>

													<label
														class="col-sm-2 col-form-label">Contact
														Number
														2</label>
													<div class="col-sm-4">
														<input type="text" class="form-control form-control-sm"
															   name="contact_2"
															   placeholder="Contact Number 2">
													</div>


												</div>


												<div class="row mt-1">


													<label
														class="col-sm-2 col-form-label"
														style="font-size: 15px;">Email</label>
													<div class="col-sm-4">
														<input type="email" class="form-control form-control-sm"
															   name="email"
															   placeholder="Email">
													</div>


													<label
														class="col-sm-2 col-form-label">Leave Country</label>
													<div class="col-sm-4">
														<select name="country"
																class="col selectpicker form-control form-control-sm"
																data-size="5" id="country" data-live-search="true"
																title="Select a Country">
															<option value="">Select a Country ...</option>
															<? foreach ($country as $row) : ?>
																<option
																	value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
															<? endforeach; ?>
														</select>
													</div>


												</div>
												<div class="row mt-1">

													<label
														class="col-sm-2 col-form-label" style="font-size: 15px;">Address
														Leave</label>
													<div class="col-sm-4">
														<input type="text" class="form-control form-control-sm"
															   name="address"
															   placeholder="Address">
													</div>


													<label
														class="col-sm-2 col-form-label">Post
														Code</label>
													<div class="col-sm-4">
														<input type="text" class="form-control form-control-sm"
															   name="post_code"
															   placeholder="Post Code">
													</div>

												</div>

												<div class="row mt-1">


													<label
														class="col-sm-2 col-form-label" style="font-size: 15px;">Department</label>
													<div class="col-sm-4">
														<select name="department[]"
																class="col selectpicker form-control form-control-sm"
																multiple data-size="5" id="department"
																data-live-search="true"
																title="Select a Department">
															<option value="">Select Department ...</option>
															<? foreach ($department as $row) : ?>
																<option
																	value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
															<? endforeach; ?>
														</select>
													</div>


													<label class="col-sm-2 col-form-label">Position</label>
													<div class="col-sm-4">
														<input type="text" class="form-control form-control-sm"
															   name="position"
															   placeholder="Position">
													</div>

												</div>


												<div class="form-group mt-md-2 mt-2">
													<label
														for="exampleFormControlTextarea1">Other</label>
													<textarea placeholder="Other"
															  class="form-control"
															  id="exampleFormControlTextarea1"
															  name="other"
															  rows="3"></textarea>
												</div>

												<div class="form-group row">
													<label
														class="col-sm-10 col-form-label">Status make
														a
														Passive?</label>
													<div class="col-sm-2">
														<input name="status"
															   value="-1"
															   type="checkbox"
															   class="form-control form-control-sm">
													</div>
												</div>


												<div class="accordion" id="accordionExample1">
													<div class="card">
														<div class="card-header" id="headingOne">
															<h5 class="mb-0">
																<button class="btn btn-sm btn-link text-success"
																		type="button"
																		data-toggle="collapse"
																		data-target="#collapseOne"
																		aria-expanded="true"
																		aria-controls="collapseOne">
																	N/D
																</button>
															</h5>
														</div>

														<div id="collapseOne" class="collapse show"
															 aria-labelledby="headingOne"
															 data-parent="#accordionExample1">
															<div class="card-body">
																<div class="add_new_items">
																	<div class="row">

																		<div class="col-md-2">
																			<div class="form-group">
																				<label>Document</label>
																				<input type="text"
																					   name="document_1"
																					   class="form-control form-control-sm"
																					   placeholder="Document">
																			</div>
																		</div>

																		<div class="col-md-2">
																			<div class="form-group">
																				<label style="margin-top: 30px;"
																					   class="btn btn-sm btn-outline-success">
																					<span>Brows file</span>
																					<input class="btn_input"
																						   name="file_1" type="file"
																						   hidden style="display: none;"
																						   value="">
																				</label>
																			</div>
																		</div>

																		<div class="col-md-2">
																			<div class="form-group">
																				<label>Reference</label>
																				<input type="text"
																					   name="reference_1"
																					   class="form-control form-control-sm"
																					   placeholder="Reference">
																			</div>
																		</div>
																		<div class="col-md-3">
																			<label>Epired Date</label>
																			<input type="date" name="expiration_1"
																				   max="3000-12-31"
																				   min="1000-01-01"

																				   class="form-control form-control-sm">
																		</div>
																		<div class="col-md-3">
																			<div class="form-group">
																				<label>Note</label>
																				<input type="text"
																					   name="note_1"
																					   class="form-control form-control-sm"
																					   placeholder="Note">
																			</div>
																		</div>

																	</div>


																</div>
															</div>
														</div>
													</div>
													<div class="card">
														<div class="card-header" id="headingTwo">
															<h5 class="mb-0">
																<button
																	class="btn btn-sm btn-link collapsed text-success"
																	type="button"
																	data-toggle="collapse"
																	data-target="#collapseTwo"
																	aria-expanded="false"
																	aria-controls="collapseTwo">
																	N/D
																</button>
															</h5>
														</div>
														<div id="collapseTwo" class="collapse"
															 aria-labelledby="headingTwo"
															 data-parent="#accordionExample1">
															<div class="card-body">
																<div class="add_new_items">
																	<div class="row">

																		<div class="col-md-2">
																			<div class="form-group">
																				<label>Document</label>
																				<input type="text"
																					   name="document_2"
																					   class="form-control form-control-sm"
																					   placeholder="Document">
																			</div>
																		</div>

																		<div class="col-md-2">
																			<div class="form-group">
																				<label style="margin-top: 30px;"
																					   class="btn btn-sm btn-outline-success">
																					<span>Brows file</span>
																					<input class="btn_input"
																						   name="file_2" type="file"
																						   hidden style="display: none;"
																						   value="">
																				</label>
																			</div>
																		</div>

																		<div class="col-md-2">
																			<div class="form-group">
																				<label>Reference</label>
																				<input type="text"
																					   name="reference_2"
																					   class="form-control form-control-sm"
																					   placeholder="Reference">
																			</div>
																		</div>
																		<div class="col-md-3">
																			<label>Epired Date</label>
																			<input type="date" name="expiration_2"
																				   max="3000-12-31"
																				   min="1000-01-01"

																				   class="form-control form-control-sm">
																		</div>
																		<div class="col-md-3">
																			<div class="form-group">
																				<label>Note</label>
																				<input type="text"
																					   name="note_2"
																					   class="form-control form-control-sm"
																					   placeholder="Note">
																			</div>
																		</div>

																	</div>


																</div>
															</div>
														</div>
													</div>
													<div class="card">
														<div class="card-header" id="headingThree">
															<h5 class="mb-0">
																<button
																	class="btn btn-sm btn-link collapsed text-success"
																	type="button"
																	data-toggle="collapse"
																	data-target="#collapseThree"
																	aria-expanded="false"
																	aria-controls="collapseThree">
																	N/D
																</button>
															</h5>
														</div>
														<div id="collapseThree" class="collapse"
															 aria-labelledby="headingThree"
															 data-parent="#accordionExample1">
															<div class="card-body">
																<div class="add_new_items">
																	<div class="row">

																		<div class="col-md-2">
																			<div class="form-group">
																				<label>Document</label>
																				<input type="text"
																					   name="document_3"
																					   class="form-control form-control-sm"
																					   placeholder="Document">
																			</div>
																		</div>

																		<div class="col-md-2">
																			<div class="form-group">
																				<label style="margin-top: 30px;"
																					   class="btn btn-sm btn-outline-success">
																					<span>Brows file</span>
																					<input class="btn_input"
																						   name="file_3" type="file"
																						   hidden style="display: none;"
																						   value="">
																				</label>
																			</div>
																		</div>

																		<div class="col-md-2">
																			<div class="form-group">
																				<label>Reference</label>
																				<input type="text"
																					   name="reference_3"
																					   class="form-control form-control-sm"
																					   placeholder="Reference">
																			</div>
																		</div>
																		<div class="col-md-3">
																			<label>Epired Date</label>
																			<input type="date" name="expiration_3"
																				   max="3000-12-31"
																				   min="1000-01-01"

																				   class="form-control form-control-sm">
																		</div>
																		<div class="col-md-3">
																			<div class="form-group">
																				<label>Note</label>
																				<input type="text"
																					   name="note_3"
																					   class="form-control form-control-sm"
																					   placeholder="Note">
																			</div>
																		</div>

																	</div>
																</div>
															</div>
														</div>
													</div>

													<div class="card">
														<div class="card-header" id="headingFour">
															<h5 class="mb-0">
																<button
																	class="btn btn-sm btn-link collapsed text-success"
																	type="button"
																	data-toggle="collapse"
																	data-target="#collapseFour"
																	aria-expanded="false"
																	aria-controls="collapseThree">
																	N/D
																</button>
															</h5>
														</div>
														<div id="collapseFour" class="collapse"
															 aria-labelledby="headingFour"
															 data-parent="#accordionExample1">
															<div class="card-body">
																<div class="add_new_items">
																	<div class="row">

																		<div class="col-md-2">
																			<div class="form-group">
																				<label>Document</label>
																				<input type="text"
																					   name="document_4"
																					   class="form-control form-control-sm"
																					   placeholder="Document">
																			</div>
																		</div>

																		<div class="col-md-2">
																			<div class="form-group">
																				<label style="margin-top: 30px;"
																					   class="btn btn-sm btn-outline-success">
																					<span>Brows file</span>
																					<input class="btn_input"
																						   name="file_4" type="file"
																						   hidden style="display: none;"
																						   value="">
																				</label>
																			</div>
																		</div>

																		<div class="col-md-2">
																			<div class="form-group">
																				<label>Reference</label>
																				<input type="text"
																					   name="reference_4"
																					   class="form-control form-control-sm"
																					   placeholder="Reference">
																			</div>
																		</div>
																		<div class="col-md-3">
																			<label>Epired Date</label>
																			<input type="date" name="expiration_4"
																				   max="3000-12-31"
																				   min="1000-01-01"

																				   class="form-control form-control-sm">
																		</div>
																		<div class="col-md-3">
																			<div class="form-group">
																				<label>Note</label>
																				<input type="text"
																					   name="note_4"
																					   class="form-control form-control-sm"
																					   placeholder="Note">
																			</div>
																		</div>

																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>


											</div>
										</div>
										<div class="text-right mt-4 pb-2">
											<span id="add_staff" class="btn btn-outline-success">Save</span>
											<span id="load" class="btn btn-sm btn-success d-none"><img
													style="height: 20px;margin: 0 auto;display: block;text-align: center;"
													src="<?= base_url() ?>assets/images/bars2.svg"/></span>
										</div>
									</div>

								</div>
							</div>

						</div>
					</form>
					<!-- Add User Modal End -->

				</div>
				<hr class="my-4">

				<div class="row col-sm-12 col-md-12"
					 style="background: #fff;padding-top: 10px; padding-bottom: 10px; overflow-x: auto;">


					<table id="example2" class="table table-striped table-borderless"
						   style="width:100%">
						<thead style="background: #fff;
color: #545b62;">
						<tr>
							<th style="font-size: 12px !important;font-weight:500;">Name Lastname</th>
							<th style="font-size: 12px !important;font-weight:500;">Status</th>
							<th style="font-size: 12px !important;font-weight:500;">Պաշտոն</th>
							<th style="font-size: 12px !important;font-weight:500;">Բաժին</th>
							<th style="font-size: 12px !important;font-weight:500;">ղեկավար</th>
							<th style="font-size: 12px !important;font-weight:500;">Created date</th>
							<th style="font-size: 12px !important;font-weight:500;">Ում կողմից</th>
							<th style="font-size: 12px !important;font-weight:500;">Փաստաթուղթ</th>
							<th style="font-size: 12px !important;font-weight:500;min-width: 50px !important;"></th>
						</tr>
						</thead>
						<tbody>
						<? foreach ($staff as $row) : ?>
							<tr>
								<td>
									<div class="media">
										<img
											style="-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 36px; height: 36px;"
											class="mr-3"
											src="<?= ($row['photo'] != '' ? base_url('uploads/user_' . $row['registrar_user_id'] . '/staff/thumbs/' . $row['photo']) : base_url('assets/img/b.jpg')) ?>"
											alt="Generic placeholder image">
										<div class="media-body">
											<?= $row['first_name'] . ' ' . $row['last_name'] ?>
											<small class="phone_number form-text text-muted">
												<?= $row['contact_1'] ?>
											</small>
										</div>
									</div>
								</td>
								<td class="text-center">
									<? if ($row['status'] == 1) { ?>
										<div class="bg-success"
											 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
									<? } else { ?>
										<div class="bg-danger"
											 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
									<? } ?>
								</td>
								<td><?= $row['position'] ?></td>
								<td><?= $row['department'] ?></td>
								<td><?= $row['head_staff'] ?></td>
								<td><?= $row['registration_date'] ?></td>
								<td><?= $row['user_name'] ?></td>

								<td>
									<table class="table-bordered">
										<tbody>

										<? if ($row['document_1'] != '') { ?>
											<tr>
												<td><?= $row['document_1'] ?></td>
												<td><?= ($row['reference_1'] != '' ? $row['reference_1'] : '-') ?></td>
												<td><?= ($row['expiration_1'] != '' ? $row['expiration_1'] : '-') ?></td>
												<td><?= ($row['note_1'] != '' ? $row['note_1'] : '-') ?></td>
												<td>
													<a style="font-size: 25px;color: #333;"
													   target="_blank"
													   href="<?= ($row['ext_1'] != '' ? base_url('uploads/user_' . $user_id . '/staff/files/') . $row['file_1'] . '.' . $row['ext_1'] : 'javascript:void(0)') ?>">
														<?= $this->select_ext($row['ext_1']); ?>
													</a>
												</td>
											</tr>
										<? }
										if ($row['document_2'] != '') { ?>
											<tr>
												<td><?= $row['document_2'] ?></td>
												<td><?= ($row['reference_2'] != '' ? $row['reference_2'] : '-') ?></td>
												<td><?= ($row['expiration_2'] != '' ? $row['expiration_2'] : '-') ?></td>
												<td><?= ($row['note_2'] != '' ? $row['note_2'] : '-') ?></td>
												<td>
													<a style="font-size: 25px;color: #333;"
													   target="_blank"
													   href="<?= ($row['ext_2'] != '' ? base_url('uploads/user_' . $user_id . '/staff/files/') . $row['file_2'] . '.' . $row['ext_2'] : 'javascript:void(0)') ?>">
														<?= $this->select_ext($row['ext_2']); ?>
													</a>
												</td>
											</tr>
										<? }
										if ($row['document_3'] != '') { ?>
											<tr>
												<td><?= $row['document_3'] ?></td>
												<td><?= ($row['reference_3'] != '' ? $row['reference_3'] : '-') ?></td>
												<td><?= ($row['expiration_3'] != '' ? $row['expiration_3'] : '-') ?></td>
												<td><?= ($row['note_3'] != '' ? $row['note_3'] : '-') ?></td>
												<td>
													<a style="font-size: 25px;color: #333;"
													   target="_blank"
													   href="<?= ($row['ext_3'] != '' ? base_url('uploads/user_' . $user_id . '/staff/files/') . $row['file_3'] . '.' . $row['ext_3'] : 'javascript:void(0)') ?>">
														<?= $this->select_ext($row['ext_3']); ?>
													</a>
												</td>
											</tr>
										<? }
										if ($row['document_4'] != '') { ?>
											<tr>
												<td><?= $row['document_4'] ?></td>
												<td><?= ($row['reference_4'] != '' ? $row['reference_4'] : '-') ?></td>
												<td><?= ($row['expiration_4'] != '' ? $row['expiration_4'] : '-') ?></td>
												<td><?= ($row['note_4'] != '' ? $row['note_4'] : '-') ?></td>
												<td>
													<a style="font-size: 25px;color: #333;"
													   target="_blank"
													   href="<?= ($row['ext_4'] != '' ? base_url('uploads/user_' . $user_id . '/staff/files/') . $row['file_4'] . '.' . $row['ext_4'] : 'javascript:void(0)') ?>">
														<?= $this->select_ext($row['ext_4']); ?>
													</a>
												</td>
											</tr>
										<? } ?>


										</tbody>
									</table>
								</td>

								<td colspan="2">
										<span style="border: none;padding-top: 5px;cursor: pointer;"
											  data-id="<?= $row['id'] ?>" id="edit_staff_modal"
											  data-toggle="modal" class="float-left text-success"
											  data-target="#edit_staff"
											  data-toggle2="tooltip"
											  data-placement="top"
											  title="edit"><i class="fas fa-edit"></i></span>

									<span style="border: none; cursor:pointer;" data-toggle="modal"
										  id="delete_staff_modal"
										  class="text-danger btn"
										  data-target=".bd-example-modal-sm" data-id="<?= $row['id'] ?>"
										  data-toggle2="tooltip"
										  data-placement="top"
										  title="delete"><i class="fas fa-trash"></i></span></td>
								</td>
							</tr>
						<? endforeach; ?>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>

<!-- Staff End -->


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
					<button type="button" id="delete_staff" class="btn btn-outline-success text-success">Yes</button>
					<input type="hidden" name="staff_id">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Delete Modal End -->


<script>
	$(document).on('click', '#delete_staff_modal', function () {
		staff_id = $(this).data('id');
		$('input[name="staff_id"]').val(staff_id);
	});


	$(document).ready(function () {
		$('#example2').DataTable();
	});


	$(document).on('click', '#delete_staff', function () {
		var id = $('input[name="staff_id"]').val();
		var url = '<?=base_url('Organization/delete_staff/')?>';

		$.post(url, {staff_id: id}, function (result) {
			location.reload();
		});
	});


	$(document).on('click', '#add_staff', function (e) {

		var url = '<?=base_url('Organization/add_staff_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#staff')[0]);

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
				scroll_top();
				close_message();
				loading('start', 'add_staff');
				$('.alert-info').removeClass('d-none');
				$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');
			},
			success: function (data) {
				if (data.success == '1') {

					close_message();
					$('.alert-success').removeClass('d-none');
					$('.alert-success').text(data.message);
					loading('stop', 'add_staff');

					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/staff')?>";

					$(location).attr('href', url);

					$(location).attr('href', url + '#staff');

				} else {
					close_message();
					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'add_staff');

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


	$(document).on('click', '#edit_staff_btn', function (e) {


		var url = '<?=base_url('Organization/edit_staff_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#staff_edit')[0]);

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
				scroll_top();
				close_message();
				loading('start', 'edit_staff_btn');
				$('.alert-info').removeClass('d-none');
				$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');
			},
			success: function (data) {
				if (data.success == '1') {

					close_message();
					$('.alert-success').removeClass('d-none');
					$('.alert-success').text(data.message);
					loading('stop', 'edit_staff_btn');

					close_message();


					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/staff')?>";

					$(location).attr('href', url);


				} else {
					close_message();
					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'edit_staff_btn');

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


	$(document).on('click', '#edit_staff_modal', function () {

		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Organization/edit_staff_modal_ax/')?>' + $(this).data('id');
		$.get(url, function (result) {

			// update modal content
			$('.modal-body').html(result);

			// show modal
			$('#myModal').modal('show');
		});

	});

	/* Staff image Uploade Start*/
	function readURL2(input) {

		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#img-upload2').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	// Input type File Staff
	$(document).on('change', '.btn_input', function () {

		var upload_file = $(this).val();
		var upload_file = upload_file.split("\\");
		var upload_file = upload_file[upload_file.length - 1];

		var text_truncate = function (str, length, ending) {
			if (length == null) {
				length = 100;
			}
			if (ending == null) {
				ending = '...';
			}
			if (str.length > length) {
				return str.substring(0, length - ending.length) + ending;
			} else {
				return str;
			}
		};

		if (upload_file == '') {
			$(this).parent('label').children('span').text('Brows file');
		} else {
			if (upload_file.length > 13) {
				var short_text = text_truncate(upload_file, 13, ' ...');
				$(this).parent('label').children('span').text(short_text);
			} else {
				$(this).parent('label').children('span').text(upload_file);
			}
		}

	});

</script>
