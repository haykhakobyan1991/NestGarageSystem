<?php
$user_id = $this->session->user_id;
$i = '';
?>

<div class="container-fluid" style="margin-top: 5rem;">
	<!-- Nav tabs -->
	<!-- Horizontal Tabs Start -->
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#organization">Organization</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#structure">Structure</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#menu3">Menu 2</a>
		</li>
	</ul>
	<!-- Horizontal Tabs End -->

	<!-- Tab panes -->
	<div class="tab-content">

		<div class="tab-pane container-fluid mt-3 mt-md-3 active" id="organization">

			<div class="row">

				<!-- Vertical Tabs Start-->
				<div class="col-sm-12 col-md-3">
					<div class="list-group" id="list-tab" role="tablist">

						<a class="list-group-item list-group-item-action active" id="list-company-list"
						   data-toggle="list"
						   href="#list-company" role="tab" aria-controls="company">Company
						</a>

						<a class="list-group-item list-group-item-action" id="list-department-list" data-toggle="list"
						   href="#list-department" role="tab" aria-controls="department">Department
							<span class="badge badge-secondary badge-pill float-right">4</span>
						</a>

						<a class="list-group-item list-group-item-action" id="list-staff-list" data-toggle="list"
						   href="#list-staff" role="tab" aria-controls="staff">Staff
							<span class="badge badge-secondary badge-pill float-right">2</span></a>

						<a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list"
						   href="#list-settings" role="tab" aria-controls="settings">Vehicles
							<span class="badge badge-secondary badge-pill float-right"></span>
						</a>

						<a class="list-group-item list-group-item-action" id="list-users-list" data-toggle="list"
						   href="#list-users" role="tab" aria-controls="settings">Users
							<span class="badge badge-secondary badge-pill float-right"></span>
						</a>


					</div>
				</div>
				<!-- Vertical Tabs End-->


				<div class="col-sm-12 col-md-9">


					<div class="tab-content" id="nav-tabContent">

						<!--  Company  Start-->
						<div class="tab-pane fade show active" id="list-company" role="tabpanel"
							 aria-labelledby="list-company-list">

							<!-- Error Message -->

							<div class="for_message">
								<div class="alert alert-success d-none" role="alert"></div>
								<div class="alert alert-danger d-none" role="alert"></div>
							</div>


							<div class="jumbotron jumbotron-fluid pb-2 pt-2">


								<div class="container">
									<p class="display-5 font-weight-bold mb-0">Section: Company</p>
								</div>


							</div>

							<form id="company">
								<div class="jumbotron jumbotron-fluid pb-2 pt-2">
									<div class="container">

										<p class="display-5 font-weight-bold"><?= lang('status') ?></p>

										<hr class="my-4">
										<div class="row">
											<table class="table table-hover table-secondary col-sm-12 col-md-5">
												<tbody>
												<? foreach ($company_type as $item) : ?>
													<tr>
														<td><?= $item['title'] ?></td>
														<td><input style="width: 20px;height: 20px;"
																   type="radio"
																   value="<?= $item['id'] ?>"
																<?= ($company['company_type_id'] == $item['id'] ? 'checked' : '') ?>
																   name="company_type"
																   aria-label="Checkbox for following text input"
																   class="btn btn-primary">
														</td>
													</tr>
												<? endforeach; ?>
												</tbody>
											</table>

											<div class="form-group col-sm-12 col-md-6">

												<div class="media">
													<img class="align-self-start mr-3 mt-3 mt-md-3" id='img-upload'
														 style="width: 100px;"
														 alt=""
														 src="<?= ($company['logo'] != '' ? base_url('uploads/user_' . $user_id . '/company/' . $company['logo']) : base_url('assets/images/no_choose_image.svg')) ?>">
													<div class="media-body">
														<h5 class="mt-0">LOGO</h5>
														<p>Upload your company LOGO</p>
														<div class="input-group ml-2 ml-md-2">
															<span class="input-group-btn">
																<span class="btn btn-secondary btn-file mr-1">
																	Browse… <input type="file" id="imgInp" name="photo">
																</span>
															</span>
															<input type="text" class="form-control" readonly
																   style="display: none;" title=""/>

														</div>
													</div>
												</div>

											</div>

										</div>

										<div class="row">
											<div class="col-md-12 col-md-6 ddddd">

												<p class="font-weight-bold display-5 mt-3"><?= lang('general_information') ?></p>
												<hr class="my-4">

												<div class="form-group row">

													<label
														class="col-sm-4 col-form-label"><?= lang('company_name') ?></label>
													<div class="col-sm-8">
														<input value="<?= $company['name'] ?>" name="company_name"
															   type="text" class="form-control"
															   placeholder="<?= lang('company_name') ?>">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-sm-4 col-form-label">Owner Firstname</label>
													<div class="col-sm-8">
														<input value="<?= $company['owner_firstname'] ?>"
															   name="owner_firstname" type="text" class="form-control"
															   placeholder="Owner Firstname">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-sm-4 col-form-label">Owner Lastname</label>
													<div class="col-sm-8">
														<input value="<?= $company['owner_lastname'] ?>"
															   name="owner_lastname" type="text" class="form-control"
															   placeholder="Owner Lastname">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-sm-4 col-form-label">Owner Position</label>
													<div class="col-sm-8">
														<input value="<?= $company['owner_position'] ?>"
															   name="owner_position" type="text" class="form-control"
															   placeholder="Owner Position">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-sm-4 col-form-label">Owner Contact Number</label>
													<div class="col-sm-8">
														<input value="<?= $company['owner_contact_number'] ?>"
															   name="owner_contact_number" type="text"
															   class="form-control" placeholder="Owner Contact Number">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-sm-4 col-form-label">Owner Email</label>
													<div class="col-sm-8">
														<input value="<?= $company['owner_email'] ?>" name="owner_email"
															   type="email" class="form-control"
															   placeholder="Owner Email">
													</div>
												</div>


												<div class="form-group row">
													<label
														class="col-sm-4 col-form-label"><?= lang('activity_address') ?></label>
													<div class="col-sm-8"
														 style="background: #ababab;padding-top: 10px;">
														<div class="form-row">
															<select name="activity_country"
																	class="col selectpicker form-control form-control-sm selectpicker_1"
																	data-size="5" id="country" data-live-search="true"
																	title="Select a country">
																<option value="">Select Activity Country ...</option>
																<? foreach ($country as $row) : ?>
																	<option <?= ($company['activity_country_id'] == $row['id'] ? 'selected' : '') ?>
																		value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
																<? endforeach; ?>
															</select>
															<div class="col">
																<input name="activity_state_region"
																	   value="<?= $company['activity_state_region'] ?>"
																	   type="text" class="form-control"
																	   placeholder="Activity State Region">
															</div>
														</div>

														<div class="form-row mt-md-2 mt-2">
															<div class="col">
																<input name="activity_city"
																	   value="<?= $company['activity_city'] ?>"
																	   type="text" class="form-control"
																	   placeholder="Activity City">
															</div>
															<div class="col">
																<input name="activity_zip_code"
																	   value="<?= $company['activity_zip_code'] ?>"
																	   type="text" class="form-control"
																	   placeholder="Zip Code">
															</div>
														</div>

														<div class="form-group mt-md-2 mt-2">
															<div class="col" style="padding-left: 0;padding-right: 0;">
																<input name="activity_address"
																	   value="<?= $company['activity_address'] ?>"
																	   type="text" class="form-control"
																	   placeholder="Activity Address">
															</div>
														</div>
														<button type="button"
																class="btn btn-secondary float-right mb-md-2 mb-2 copy_btn">
															copy
														</button>

													</div>
												</div>

												<div class="form-group row">
													<label
														class="col-sm-4 col-form-label"><?= lang('legal_address') ?></label>
													<div class="col-sm-8"
														 style="background: #ababab;padding-top: 10px;">
														<div class="form-row">
															<select name="legal_country"
																	class="col selectpicker form-control form-control-sm selectpicker_2"
																	data-size="5" id="country" data-live-search="true"
																	title="Select a country">
																<option value="">Select Legal Country ...</option>
																<? foreach ($country as $row) : ?>
																	<option <?= ($company['legal_country_id'] == $row['id'] ? 'selected' : '') ?>
																		value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
																<? endforeach; ?>
															</select>
															<div class="col">
																<input name="legal_state_region"
																	   value="<?= $company['legal_state_region'] ?>"
																	   type="text" class="form-control"
																	   placeholder="Legal Region">
															</div>
														</div>

														<div class="form-row mt-md-2 mt-2">
															<div class="col">
																<input name="legal_city"
																	   value="<?= $company['legal_city'] ?>" type="text"
																	   class="form-control" placeholder="Legal City">
															</div>
															<div class="col">
																<input name="legal_zip_code"
																	   value="<?= $company['legal_zip_code'] ?>"
																	   type="text" class="form-control"
																	   placeholder="Zip Code">
															</div>
														</div>

														<div class="form-group mt-md-2 mt-2">
															<div class="col" style="padding-left: 0;padding-right: 0;">
																<input name="legal_address"
																	   value="<?= $company['legal_address'] ?>"
																	   type="text" class="form-control"
																	   placeholder="Legal Address">
															</div>
														</div>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-4 col-form-label"><?= lang('tin') ?></label>
													<div class="col-sm-8">
														<input value="<?= $company['tin'] ?>" name="tin" type="text"
															   class="form-control" placeholder="<?= lang('tin') ?>">
													</div>
												</div>

												<div class="form-group row">
													<label
														class="col-sm-4 col-form-label"><?= lang('phone_number') ?></label>
													<div class="col-sm-8">
														<input value="<?= $company['phone_number'] ?>"
															   name="phone_number" type="text" class="form-control"
															   placeholder="<?= lang('phone_number') ?>">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-sm-4 col-form-label"><?= lang('email') ?></label>
													<div class="col-sm-8">
														<input value="<?= $company['email'] ?>" name="email" type="text"
															   class="form-control" placeholder="<?= lang('email') ?>">
													</div>
												</div>
												<div class="form-group row">
													<label
														class="col-sm-4 col-form-label"><?= lang('web_address') ?></label>
													<div class="col-sm-8">
														<input value="<?= $company['web_address'] ?>" name="web_address"
															   type="text" class="form-control"
															   placeholder="<?= lang('web_address') ?>">
													</div>
												</div>
											</div>


											<div class="col-sm-12 tab-content col-sm-6 col-12" id="nav-tabContent">

												<div class="accordion" id="accordionExample">
													<div class="card">
														<div class="card-header" id="headingOne">
															<h5 class="mb-0">
																<button class="btn btn-link" type="button"
																		data-toggle="collapse"
																		data-target="#collapseOne" aria-expanded="true"
																		aria-controls="collapseOne">
																	<?= ($company['account_name_1'] != '' ? $company['account_name_1'] : 'N/D') ?>
																</button>
															</h5>
														</div>

														<div id="collapseOne" class="collapse show"
															 aria-labelledby="headingOne"
															 data-parent="#accordionExample">
															<div class="card-body">

																<div class="form-group row mb-0">
																	<label
																		class="col-sm-4 col-form-label"><?= lang('account_type') ?></label>
																	<div class="col-sm-8">
																		<input
																			value="<?= $company['account_name_1'] ?>"
																			name="account_name_1"
																			type="text"
																			class="account_number form-control form-control-sm"
																			placeholder="<?= lang('account_type') ?>">
																	</div>
																</div>


																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Account
																		Number</label>
																	<div class="col-sm-8">
																		<input
																			value="<?= $company['account_number_1'] ?>"
																			name="account_number_1"
																			type="text"
																			class="account_number form-control form-control-sm"
																			placeholder="Account Number">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Correspondent
																		Bank</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   name="correspondent_bank_1"
																			   class="form-control form-control-sm correspondent_bank"
																			   value="<?= $company['correspondent_bank_1'] ?>"
																			   placeholder="Correspondent Bank">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Swift
																		Code</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   name="swift_code_1"
																			   class="form-control form-control-sm swift_code"
																			   value="<?= $company['swift_code_1'] ?>"
																			   placeholder="Swift Code">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label
																		class="col-sm-4 col-form-label">Account</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   value="<?= $company['account_1'] ?>"
																			   name="account_1"
																			   class="form-control form-control-sm account"
																			   placeholder="Account">
																	</div>
																</div>

															</div>
														</div>
													</div>
													<div class="card">
														<div class="card-header" id="headingTwo">
															<h5 class="mb-0">
																<button class="btn btn-link collapsed" type="button"
																		data-toggle="collapse"
																		data-target="#collapseTwo" aria-expanded="false"
																		aria-controls="collapseTwo">
																	<?= ($company['account_name_2'] != '' ? $company['account_name_2'] : 'N/D') ?>
																</button>
															</h5>
														</div>
														<div id="collapseTwo" class="collapse"
															 aria-labelledby="headingTwo"
															 data-parent="#accordionExample">
															<div class="card-body">

																<div class="form-group row mb-0">
																	<label
																		class="col-sm-4 col-form-label"><?= lang('account_type') ?></label>
																	<div class="col-sm-8">
																		<input
																			value="<?= $company['account_name_2'] ?>"
																			name="account_name_2"
																			type="text"
																			class="account_number form-control form-control-sm"
																			placeholder="<?= lang('account_type') ?>">
																	</div>
																</div>


																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Account
																		Number</label>
																	<div class="col-sm-8">
																		<input
																			value="<?= $company['account_number_2'] ?>"
																			name="account_number_2"
																			type="text"
																			class="account_number form-control form-control-sm"
																			placeholder="Account Number">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Correspondent
																		Bank</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   name="correspondent_bank_2"
																			   class="form-control form-control-sm correspondent_bank"
																			   value="<?= $company['correspondent_bank_2'] ?>"
																			   placeholder="Correspondent Bank">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Swift
																		Code</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   name="swift_code_2"
																			   class="form-control form-control-sm swift_code"
																			   value="<?= $company['swift_code_2'] ?>"
																			   placeholder="Swift Code">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label
																		class="col-sm-4 col-form-label">Account</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   name="account_2"
																			   class="form-control form-control-sm account"
																			   value="<?= $company['account_2'] ?>"
																			   placeholder="Account">
																	</div>
																</div>
							</form>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingThree">
						<h5 class="mb-0">
							<button class="btn btn-link collapsed" type="button"
									data-toggle="collapse"
									data-target="#collapseThree"
									aria-expanded="false"
									aria-controls="collapseThree">
								<?= ($company['account_name_3'] != '' ? $company['account_name_3'] : 'N/D') ?>
							</button>
						</h5>
					</div>
					<div id="collapseThree" class="collapse"
						 aria-labelledby="headingThree"
						 data-parent="#accordionExample">
						<div class="card-body">

							<div class="form-group row mb-0">
								<label
									class="col-sm-4 col-form-label"><?= lang('account_type') ?></label>
								<div class="col-sm-8">
									<input
										value="<?= $company['account_name_3'] ?>"
										type="text"
										name="account_name_3"
										class="account_number form-control form-control-sm"
										placeholder="<?= lang('account_type') ?>">
								</div>
							</div>


							<div class="form-group row mb-0">
								<label class="col-sm-4 col-form-label">Account
									Number</label>
								<div class="col-sm-8">
									<input
										value="<?= $company['account_number_3'] ?>"
										type="text"
										name="account_number_3"
										class="account_number form-control form-control-sm"
										placeholder="Account Number">
								</div>
							</div>

							<div class="form-group row mb-0">
								<label class="col-sm-4 col-form-label">Correspondent
									Bank</label>
								<div class="col-sm-8">
									<input type="text"
										   name="correspondent_bank_3"
										   class="form-control form-control-sm correspondent_bank"
										   value="<?= $company['correspondent_bank_3'] ?>"
										   placeholder="Correspondent Bank">
								</div>
							</div>

							<div class="form-group row mb-0">
								<label class="col-sm-4 col-form-label">Swift
									Code</label>
								<div class="col-sm-8">
									<input type="text"
										   name="swift_code_3"
										   class="form-control form-control-sm swift_code"
										   value="<?= $company['swift_code_3'] ?>"
										   placeholder="Swift Code">
								</div>
							</div>

							<div class="form-group row mb-0">
								<label
									class="col-sm-4 col-form-label">Account</label>
								<div class="col-sm-8">
									<input type="text"
										   name="account_3"
										   class="form-control form-control-sm account"
										   value="<?= $company['account_3'] ?>"
										   placeholder="Account">
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-header" id="headingFour">
						<h5 class="mb-0">
							<button class="btn btn-link collapsed" type="button"
									data-toggle="collapse"
									data-target="#collapseFour"
									aria-expanded="false"
									aria-controls="collapseFour">
								<?= ($company['account_name_4'] != '' ? $company['account_name_4'] : 'N/D') ?>
							</button>
						</h5>
					</div>
					<div id="collapseFour" class="collapse"
						 aria-labelledby="headingThree"
						 data-parent="#accordionExample">
						<div class="card-body">


							<div class="form-group row mb-0">
								<label
									class="col-sm-4 col-form-label"><?= lang('account_type') ?></label>
								<div class="col-sm-8">
									<input
										value="<?= $company['account_name_4'] ?>"
										type="text"
										name="account_name_4"
										class="account_number form-control form-control-sm"
										placeholder="<?= lang('account_type') ?>">
								</div>
							</div>

							<div class="form-group row mb-0">
								<label class="col-sm-4 col-form-label">Account
									Number</label>
								<div class="col-sm-8">
									<input
										value="<?= $company['account_number_4'] ?>"
										type="text"
										name="account_number_4"
										class="account_number form-control form-control-sm"
										placeholder="Account Number">
								</div>
							</div>

							<div class="form-group row mb-0">
								<label class="col-sm-4 col-form-label">Correspondent
									Bank</label>
								<div class="col-sm-8">
									<input type="text"
										   name="correspondent_bank_4"
										   class="form-control form-control-sm correspondent_bank"
										   value="<?= $company['correspondent_bank_4'] ?>"
										   placeholder="Correspondent Bank">
								</div>
							</div>

							<div class="form-group row mb-0">
								<label class="col-sm-4 col-form-label">Swift
									Code</label>
								<div class="col-sm-8">
									<input type="text"
										   name="swift_code_4"
										   class="form-control form-control-sm swift_code"
										   value="<?= $company['swift_code_4'] ?>"
										   placeholder="Swift Code">
								</div>
							</div>

							<div class="form-group row mb-0">
								<label
									class="col-sm-4 col-form-label">Account</label>
								<div class="col-sm-8">
									<input type="text"
										   name="account_4"
										   class="form-control form-control-sm account"
										   value="<?= $company['account_4'] ?>"
										   placeholder="Account">
								</div>
							</div>


						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="text-right pb-2 mt-md-2 mt-2">
		<span id="create_company" class="btn btn-secondary">Save</span>
	</div>

</div>
</div>

</div>
<!-- Company End -->


<?
$this->load->view('department');
?>

<?
$this->load->view('staff');
?>

<?
$this->load->view('vehicles');
?>


<!-- USERS START -->
<div class="tab-pane fade" id="list-users" role="tabpanel" aria-labelledby="list-users-list">
	<form id="users">
		<div class="tab-pane fade show active" id="list-users" role="tabpanel" aria-labelledby="list-users-list">

			<div class="jumbotron jumbotron-fluid pb-2 pt-2">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<img style="-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"
								 class="float-left mr-2" src="<?= base_url() ?>assets/img/user_img.jpg" alt="">
							<p style="font-size: 18px;font-weight: 500;" class="mt-1">
								<span class="users_name">Daniel Smith</span>
								<span class="ml-2 mr-2">|</span>
								<span class="users_position font-weight-light">Super Admin</span>
							</p>
						</div>
					</div>
				</div>
			</div>


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
											<input type="text" class="form-control"
												   name="firstname"
												   placeholder="First Name">
										</div>
									</div>

									<div class="form-group row">
										<label
											class="col-sm-2 col-form-label">Last
											Name *</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"
												   name="lastname"
												   placeholder="Last Name">
										</div>
									</div>

									<div class="form-group row">
										<label
											class="col-sm-2 col-form-label">E-main *</label>
										<div class="col-sm-10">
											<input type="email" class="form-control"
												   name="email"
												   placeholder="E-mail">
										</div>
									</div>

									<div class="form-group row">
										<label
											class="col-sm-2 col-form-label">Contact Number *</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"
												   name="contactnumber"
												   placeholder="Contact Number">
										</div>
									</div>

									<div class="form-group row">
										<label
											class="col-sm-2 col-form-label">User Name *</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"
												   name="username"
												   placeholder="User Name">
										</div>
									</div>

									<div class="form-group row">
										<label
											class="col-sm-2 col-form-label">User Name *</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"
												   name="username"
												   placeholder="User Name">
										</div>
									</div>


									<div class="form-group row">
										<label
											class="col-sm-2 col-form-label">Password *</label>
										<div class="col-sm-10">
											<input type="text" class="form-control col-sm-8 float-left"
												   name="password"
												   placeholder="User Name"
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
											<select value="" class=" form-control">
												<option> choose type․․․</option>
												<option>Admin</option>
												<option>User</option>
											</select>

										</div>
									</div>


									<div class="form-group row mt-2">
										<label class="ml-1 col-form-label">Status make a Passive?</label>
										<div class="col-sm-1">
											<input name="status" value="-1" type="checkbox" class="form-control">
										</div>
									</div>

									<div class="form-group row">
										<label class="ml-1 col-form-label">Send a notification mail to the new created
											user?</label>
										<div class="col-sm-1">
											<input name="status" value="-1" type="checkbox" class="form-control">
										</div>
									</div>


								</div>
							</div>


						</div>

						<div class="modal-footer">
							<div class="text-right mt-4 pb-2">
								<span id="add_user" class="btn btn-secondary">Save</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Add User Modal End -->


			<div class="jumbotron jumbotron-fluid pb-2 pt-2">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-md-2 col-2">
							<p class="display-5 font-weight-bold float-left">Toatl Staff</p> <span
								class="ml-2 mt-1 badge badge-secondary badge-pill">3</span>
						</div>

						<div class="col-sm-12 col-md-2 col-2">
							<p class="display-5 font-weight-bold float-left">Active Staff</p> <span
								class="ml-2 mt-1 badge badge-success badge-pill">4</span>
						</div>

						<div class="col-sm-12 col-md-2 col2">
							<p class="display-5 font-weight-bold float-left">Passive Staff</p> <span
								class="ml-2 mt-1 badge badge-warning badge-pill">0</span>
						</div>

						<div class="col-sm-12 col-md-4 col-4"></div>

						<div class="col-sm-12 col-md-2 col-2">
							<span class="btn btn-secondary" data-toggle="modal"
								  data-target=".add_user_modal">Add User
							</span>
						</div>
					</div>


					<hr class="my-4">
					<div class="row col-sm-12 col-md-12"
						 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: scroll;">


						<table id="example4" class="table table-striped table-bordered"
							   style="width:100%">
							<thead style="background: #545b62;
color: #fff;">
							<tr>
								<th style="font-size: 12px !important;">Name/Email</th>
								<th style="font-size: 12px !important;">Status</th>
								<th style="font-size: 12px !important;">Activity</th>
								<th style="font-size: 12px !important;">User Type</th>
								<th style="font-size: 12px !important;">User Name․</th>
								<th style="font-size: 12px !important;">Passwprd</th>
								<th style="font-size: 12px !important;">Created Date</th>
								<th style="font-size: 12px !important;">By Whom</th>
								<th style="font-size: 12px !important;">Last Access Date/Time</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>

									<div class="media">
										<img
											style="-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 36px; height: 36px;"
											class="mr-3"
											src="<?= base_url() ?>assets/img/user_img.jpg"
											alt="Generic placeholder image">
										<div class="media-body">
											Daniel Smith
											<small class="email_addres form-text text-muted">
												haikhakobyan2@gmail.com
											</small>
										</div>
									</div>

								</td>
								<td class="text-center">
									<div class="bg-success"
										 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
								</td>
								<td class="text-center">
									<div class="bg-success"
										 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
									<span class="font-weight-light pl-1"
										  style="font-size: 13px;display: block;">Strong</span>
								</td>
								<td>Admin</td>
								<td>User Name</td>
								<td>dfdf/?ff</td>
								<td>10.10.2017</td>
								<td>Daniel Smith</td>
								<td>22.10.2018/20:42</td>
							</tr>
							<tr>
								<td>

									<div class="media">
										<img
											style="-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 36px; height: 36px;"
											class="mr-3"
											src="<?= base_url() ?>assets/img/user_img.jpg"
											alt="Generic placeholder image">
										<div class="media-body">
											Daniel Smith
											<small class="email_addres form-text text-muted">
												haikhakobyan2@gmail.com
											</small>
										</div>
									</div>

								</td>
								<td class="text-center">
									<div class="bg-danger"
										 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
								</td>
								<td class="text-center">
									<div class="bg-warning"
										 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
									<span class="font-weight-light pl-1"
										  style="font-size: 13px;display: block;">Average</span>
								</td>
								<td>User</td>
								<td>User Name</td>
								<td>!d@eefg</td>
								<td>12.09.2018</td>
								<td>Daniel Smith</td>
								<td>20.10.2018/19:23</td>
							</tr>

						</table>


					</div>


				</div>
			</div>


		</div>
	</form>
</div>
<!--USERS END-->


</div>
</div>
</div>
</div>


<div class="tab-pane container-fluid mt-3 mt-md-3 fade" id="structure">
	Structure
</div>
<div class="tab-pane container-fluid mt-3 mt-md-3 fade" id="menu1">Lorem ipsum dolor sit amet, consectetur
	adipisicing elit. Minus, veniam?
</div>
<div class="tab-pane container-fluid mt-3 mt-md-3 fade" id="menu2">Lorem ipsum dolor sit amet, consectetur
	adipisicing elit. Dolor neque nostrum rerum? Dolores enim expedita non quaerat totam! Dignissimos, in?
</div>
<div class="tab-pane container-fluid mt-3 mt-md-3 fade" id="menu3">Lorem ipsum dolor sit amet.</div>
</div>
</div>






