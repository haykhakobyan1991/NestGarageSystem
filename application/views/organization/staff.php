<?
$user_id = $this->session->user_id;
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
	<form id="staff" enctype="multipart/form-data">
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


						<!-- Add User Modal Start  -->

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
												<div class="form-group row">
													<label
														class="col-sm-2 col-form-label">First
														Name *</label>
													<div class="col-sm-10">
														<input type="text" class="form-control form-control-sm"
															   name="firstname"
															   placeholder="First Name">
													</div>
												</div>
												<div class="form-group row">
													<label
														class="col-sm-2 col-form-label">Last
														Name *</label>
													<div class="col-sm-10">
														<input type="text" class="form-control form-control-sm"
															   name="lastname"
															   placeholder="Last Name">
													</div>
												</div>
												<div class="form-group row">
													<label
														class="col-sm-2 col-form-label">Contact
														Number
														1</label>
													<div class="col-sm-10">
														<input type="text" class="form-control form-control-sm"
															   name="contact_1"
															   placeholder="Contact Number 1">
													</div>
												</div>
												<div class="form-group row">
													<label
														class="col-sm-2 col-form-label">Contact
														Number
														2</label>
													<div class="col-sm-10">
														<input type="text" class="form-control form-control-sm"
															   name="contact_2"
															   placeholder="Contact Number 2">
													</div>
												</div>

												<div class="form-group row">
													<label
														class="col-sm-2 col-form-label">Email</label>
													<div class="col-sm-10">
														<input type="email" class="form-control form-control-sm"
															   name="email"
															   placeholder="Email">
													</div>
												</div>

												<div class="form-group row">
													<label
														class="col-sm-2 col-form-label">Leave Country</label>
													<div class="col-sm-10">
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

												<div class="form-group row">
													<label
														class="col-sm-2 col-form-label">Address
														Leave</label>
													<div class="col-sm-10">
														<input type="text" class="form-control form-control-sm"
															   name="address"
															   placeholder="Address">
													</div>
												</div>


												<div class="form-group row">
													<label
														class="col-sm-2 col-form-label">Post
														Code</label>
													<div class="col-sm-10">
														<input type="text" class="form-control form-control-sm"
															   name="post_code"
															   placeholder="Post Code">
													</div>
												</div>


												<div class="form-group row ">

													<label
														class="col-sm-2 col-form-label">Department</label>
													<div class="col-sm-10">
														<select name="department"
																class="col selectpicker form-control form-control-sm"
																data-size="5" id="department" data-live-search="true"
																title="Select a Department">
															<option value="">Select Department ...</option>

														</select>
													</div>

												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label">Position</label>
													<div class="col-sm-10">
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
																<button class="btn btn-sm btn-link text-success" type="button"
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
																<button class="btn btn-sm btn-link collapsed text-success"
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
																<button class="btn btn-sm btn-link collapsed text-success"
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
																<button class="btn btn-sm btn-link collapsed text-success"
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
										</div>
									</div>

								</div>
							</div>
						</div>

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
									<td><?= $row['department_id'] ?></td>
									<td></td>
									<td><?= $row['registration_date'] ?></td>
									<td><?= $row['user_name'] ?></td>

									<td>
										<table>
											<tbody>

													<? if ($row['document_1'] != '') { ?>
													<tr>
														<td><?= $row['document_1'] ?></td>
														<td><?= $row['reference_1'] ?></td>
														<td><?= $row['expiration_1'] ?></td>
														<td><?= $row['note_1'] ?></td>
														<td><a target="_blank" href="<?= base_url('uploads/user_'.$user_id.'/staff/files/'). $row['file_1']. '.' . $row['ext_1']  ?>"><?=$row['file_1']. '.' . $row['ext_1']?></a></td>
													</tr>
													<? }
													if ($row['document_2'] != '') { ?>
													<tr>
														<td><?= $row['document_2'] ?></td>
														<td><?= $row['reference_2'] ?></td>
														<td><?= $row['expiration_2'] ?></td>
														<td><?= $row['note_2'] ?></td>
														<td><a target="_blank" href="<?= base_url('uploads/user_'.$user_id.'/staff/files/'). $row['file_2']. '.' . $row['ext_2']  ?>"><?=$row['file_2']. '.' . $row['ext_2']?></a></td>
													</tr>
													<? }
													if ($row['document_3'] != '') { ?>
													<tr>
														<td><?= $row['document_3'] ?></td>
														<td><?= $row['reference_3'] ?></td>
														<td><?= $row['expiration_3'] ?></td>
														<td><?= $row['note_3'] ?></td>
														<td><a target="_blank" href="<?= base_url('uploads/user_'.$user_id.'/staff/files/'). $row['file_1']. '.' . $row['ext_1']  ?>"><?=$row['file_3']. '.' . $row['ext_3']?></a></td>
													</tr>
													<? }
													if ($row['document_4'] != '') { ?>
													<tr>
														<td><?= $row['document_4'] ?></td>
														<td><?= $row['reference_4'] ?></td>
														<td><?= $row['expiration_4'] ?></td>
														<td><?= $row['note_4'] ?></td>
														<td><a target="_blank" href="<?= base_url('uploads/user_'.$user_id.'/staff/files/'). $row['file_1']. '.' . $row['ext_1']  ?>"><?=$row['file_4']. '.' . $row['ext_4']?></a></td>
													</tr>
													<? } ?>


											</tbody>
										</table>
									</td>

									<td colspan="2">
										<span style="border: none;padding-top: 5px;cursor: pointer;"
											  data-id="<?= $row['id'] ?>" id="edit_staff_modal"
											  data-toggle="modal" class="float-left text-success"
											  data-target="#edit_staff"><i class="fas fa-edit"></i></span>

										<span style="border: none;cursor: pointer;" data-id="<?= $row['id'] ?>"
											  id="delet_staff_modal" class="btn text-danger"><i class="fas fa-trash"></i></span>
									</td>
								</tr>
							<? endforeach; ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<!-- Staff End -->
