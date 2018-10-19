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
							<span class="badge badge-secondary badge-pill float-right">14</span>
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
					</div>
				</div>
				<!-- Vertical Tabs End-->


				<div class="col-sm-12 col-md-9">


					<div class="tab-content" id="nav-tabContent">

						<!--  Company  Start-->
						<div class="tab-pane fade show active" id="list-company" role="tabpanel"
							 aria-labelledby="list-company-list">

							<div class="jumbotron jumbotron-fluid pb-2 pt-2">
								<div class="container">
									<p class="display-5 font-weight-bold mb-0">Section: Company</p>
								</div>
							</div>

							<form id="company" >
								<div class="jumbotron jumbotron-fluid pb-2 pt-2">
									<div class="container">
										<p class="display-5 font-weight-bold"><?=lang('status')?></p>
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
																   <?=($company['company_type_id'] == $item['id'] ? 'checked' : '')?>
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
														 src="<?=($company['logo']  != '' ?  base_url('uploads/user_'.$user_id.'/company/'.$company['logo']) : base_url('assets/images/no_choose_image.svg'))?>">
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

												<p class="font-weight-bold display-5 mt-3"><?=lang('general_information')?></p>
												<hr class="my-4">

												<div class="form-group row">
													<label class="col-sm-4 col-form-label">Owner Firstname</label>
													<div class="col-sm-8">
														<input value="" name="owner_firstname" type="text" class="form-control" placeholder="Owner Firstname">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-sm-4 col-form-label">Owner Lastname</label>
													<div class="col-sm-8">
														<input value="" name="owner_lastname" type="text" class="form-control" placeholder="Owner Lastname">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-sm-4 col-form-label">Owner Position</label>
													<div class="col-sm-8">
														<input value="" name="owner_position" type="text" class="form-control" placeholder="Owner Position">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-sm-4 col-form-label">Owner Contact Number</label>
													<div class="col-sm-8">
														<input value="" name="owner_contact_number" type="text" class="form-control" placeholder="Owner Contact Number">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-sm-4 col-form-label">Owner Email</label>
													<div class="col-sm-8">
														<input value="" name="owner_email" type="email" class="form-control" placeholder="Owner Email">
													</div>
												</div>





												<div class="form-group row">

													<label class="col-sm-4 col-form-label"><?=lang('company_name')?></label>
													<div class="col-sm-8">
														<input value="<?=$company['name']?>" name="company_name" type="text" class="form-control" placeholder="Անվանում">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-4 col-form-label"><?=lang('activity_address')?></label>
													<div class="col-sm-8" style="background: #ababab;padding-top: 10px;">
														<div class="form-row">
															<select  name="up_country" class="col selectpicker form-control form-control-sm" data-size="5"  id="country" data-live-search="true" title="Select a country">
																<option value="">Select Activity Country ...</option>
																<? foreach ($country as $row) : ?>
																	<option value="<?= $row['id'] ?>"><?=$row['title']?></option>
																<? endforeach; ?>
															</select>
															<div class="col">
																<input type="text" class="form-control" placeholder="Activity Region">
															</div>
														</div>

														<div class="form-row mt-md-2 mt-2">
															<div class="col">
																<input type="text" class="form-control" placeholder="Activity Sity">
															</div>
															<div class="col">
																<input type="text" class="form-control" placeholder="Zip Code">
															</div>
														</div>

														<div class="form-group mt-md-2 mt-2">
															<div class="col" style="padding-left: 0;padding-right: 0;">
																<input type="text" class="form-control" placeholder="Activity Address">
															</div>
														</div>



													</div>
												</div>

												<div class="form-group row">
													<label class="col-sm-4 col-form-label"><?=lang('legal_address')?></label>
													<div class="col-sm-8" style="background: #ababab;padding-top: 10px;">
														<div class="form-row">
															<select  name="up_country" class="col selectpicker form-control form-control-sm" data-size="5"  id="country" data-live-search="true" title="Select a country">
																<option value="">Select Legal Country ...</option>
																<? foreach ($country as $row) : ?>
																	<option value="<?= $row['id'] ?>"><?=$row['title']?></option>
																<? endforeach; ?>
															</select>
															<div class="col">
																<input type="text" class="form-control" placeholder="Legal Region">
															</div>
														</div>

														<div class="form-row mt-md-2 mt-2">
															<div class="col">
																<input type="text" class="form-control" placeholder="Legal Sity">
															</div>
															<div class="col">
																<input type="text" class="form-control" placeholder="Zip Code">
															</div>
														</div>

														<div class="form-group mt-md-2 mt-2">
															<div class="col" style="padding-left: 0;padding-right: 0;">
																<input type="text" class="form-control" placeholder="Legal Address">
															</div>
														</div>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-4 col-form-label"><?=lang('tin')?></label>
													<div class="col-sm-8">
														<input value="<?=$company['tin']?>" name="tin" type="text" class="form-control" placeholder="<?=lang('tin')?>">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-sm-4 col-form-label"><?=lang('phone_number')?></label>
													<div class="col-sm-8">
														<input value="<?=$company['phone_number']?>" name="phone_number" type="text" class="form-control" placeholder="<?=lang('phone_number')?>">
													</div>
												</div>

												<div class="form-group row">
													<label class="col-sm-4 col-form-label"><?=lang('email')?></label>
													<div class="col-sm-8">
														<input value="<?=$company['email']?>" name="email" type="text" class="form-control" placeholder="<?=lang('email')?>">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-4 col-form-label"><?=lang('web_address')?></label>
													<div class="col-sm-8">
														<input value="<?=$company['web_address']?>" name="web_address" type="text" class="form-control" placeholder="<?=lang('web_address')?>">
													</div>
												</div>
											</div>







											<div class="col-sm-12 tab-content col-sm-6 col-12" id="nav-tabContent">

											<div class="accordion" id="accordionExample">
												<div class="card">
													<div class="card-header" id="headingOne">
														<h5 class="mb-0">
															<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
																N/D
															</button>
														</h5>
													</div>

													<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
														<div class="card-body">
															<form class="banck_account">
																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label"><?=lang('account_type')?></label>
																	<div class="col-sm-8">
																		<input value="" type="text"
																			   class="account_number form-control form-control-sm"
																			   placeholder="<?=lang('account_type')?>">
																	</div>
																</div>


																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Account
																		Number</label>
																	<div class="col-sm-8">
																		<input value="" type="text"
																			   class="account_number form-control form-control-sm"
																			   placeholder="Account Number">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Correspondent
																		Bank</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   class="form-control form-control-sm correspondent_bank"
																			   value=""
																			   placeholder="Correspondent Bank">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Swift
																		Code</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   class="form-control form-control-sm swift_code"
																			   value=""
																			   placeholder="Swift Code">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label
																		class="col-sm-4 col-form-label">Account</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   class="form-control form-control-sm account"
																			   value=""
																			   placeholder="Account">
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>
												<div class="card">
													<div class="card-header" id="headingTwo">
														<h5 class="mb-0">
															<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
																N/D
															</button>
														</h5>
													</div>
													<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
														<div class="card-body">
															<form class="banck_account">
																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label"><?=lang('account_type')?></label>
																	<div class="col-sm-8">
																		<input value="" type="text"
																			   class="account_number form-control form-control-sm"
																			   placeholder="<?=lang('account_type')?>">
																	</div>
																</div>


																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Account
																		Number</label>
																	<div class="col-sm-8">
																		<input value="" type="text"
																			   class="account_number form-control form-control-sm"
																			   placeholder="Account Number">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Correspondent
																		Bank</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   class="form-control form-control-sm correspondent_bank"
																			   value=""
																			   placeholder="Correspondent Bank">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Swift
																		Code</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   class="form-control form-control-sm swift_code"
																			   value=""
																			   placeholder="Swift Code">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label
																		class="col-sm-4 col-form-label">Account</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   class="form-control form-control-sm account"
																			   value=""
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
															<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
																N/D
															</button>
														</h5>
													</div>
													<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
														<div class="card-body">
															<form class="banck_account">
																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label"><?=lang('account_type')?></label>
																	<div class="col-sm-8">
																		<input value="" type="text"
																			   class="account_number form-control form-control-sm"
																			   placeholder="<?=lang('account_type')?>">
																	</div>
																</div>


																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Account
																		Number</label>
																	<div class="col-sm-8">
																		<input value="" type="text"
																			   class="account_number form-control form-control-sm"
																			   placeholder="Account Number">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Correspondent
																		Bank</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   class="form-control form-control-sm correspondent_bank"
																			   value=""
																			   placeholder="Correspondent Bank">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Swift
																		Code</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   class="form-control form-control-sm swift_code"
																			   value=""
																			   placeholder="Swift Code">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label
																		class="col-sm-4 col-form-label">Account</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   class="form-control form-control-sm account"
																			   value=""
																			   placeholder="Account">
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>

												<div class="card">
													<div class="card-header" id="headingFour">
														<h5 class="mb-0">
															<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
																N/D
															</button>
														</h5>
													</div>
													<div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
														<div class="card-body">

															<form class="banck_account">
																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label"><?=lang('account_type')?></label>
																	<div class="col-sm-8">
																		<input value="" type="text"
																			   class="account_number form-control form-control-sm"
																			   placeholder="<?=lang('account_type')?>">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Account
																		Number</label>
																	<div class="col-sm-8">
																		<input value="" type="text"
																			   class="account_number form-control form-control-sm"
																			   placeholder="Account Number">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Correspondent
																		Bank</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   class="form-control form-control-sm correspondent_bank"
																			   value=""
																			   placeholder="Correspondent Bank">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label class="col-sm-4 col-form-label">Swift
																		Code</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   class="form-control form-control-sm swift_code"
																			   value=""
																			   placeholder="Swift Code">
																	</div>
																</div>

																<div class="form-group row mb-0">
																	<label
																		class="col-sm-4 col-form-label">Account</label>
																	<div class="col-sm-8">
																		<input type="text"
																			   class="form-control form-control-sm account"
																			   value=""
																			   placeholder="Account">
																	</div>
																</div>
															</form>


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
							</form>
						</div>
						<!-- Company End -->


						<?
						$this->load->view('staff');
						?>


						<!-- Staff Start -->
						<div class="tab-pane fade" id="list-staff" role="tabpanel" aria-labelledby="list-staff-list">

							<div class="tab-pane fade show active" id="list-staff" role="tabpanel"
								 aria-labelledby="list-staff-list">

								<div class="jumbotron jumbotron-fluid pb-2 pt-2">
									<div class="container">
										<p class="display-5 font-weight-bold mb-0">Section: Staff</p>
									</div>
								</div>

								<div class="jumbotron jumbotron-fluid pb-2 pt-2">
									<div class="container">
										<div class="row">
											<div class="col-sm-12 col-md-2 col-2">
												<p class="display-5 font-weight-bold float-left">Toatl Staff</p> <span
													class="ml-2 mt-1 badge badge-secondary badge-pill">6</span>
											</div>

											<div class="col-sm-12 col-md-2 col-2">
												<p class="display-5 font-weight-bold float-left">Active Staff</p> <span
													class="ml-2 mt-1 badge badge-success badge-pill">4</span>
											</div>

											<div class="col-sm-12 col-md-2 col2">
												<p class="display-5 font-weight-bold float-left">Passive Staff</p> <span
													class="ml-2 mt-1 badge badge-warning badge-pill">2</span>
											</div>

											<div class="col-sm-12 col-md-4 col-4"></div>

											<div class="col-sm-12 col-md-2 col-2">
												<button class="btn btn-secondary" data-toggle="modal"
														data-target=".add_staff_modal">Add User
												</button>
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
																			 src="">
																		<div class="media-body">
																			<div class="input-group ml-2 ml-md-2">
														<span class="input-group-btn">
															<span
																class="btn btn-secondary btn-file mr-1">
																Browse… <input type="file" id="imgInp2"
																			   onchange="readURL2(this);">
															</span>
														</span>
																				<input type="text" class="form-control"
																					   readonly
																					   style="display: none;">

																			</div>
																		</div>
																	</div>


																</div>


															</div>

															<div class="row">
																<form
																	class="col-sm-12 col-md-12 col-12  mt-md-5 mt-5 pl-md-4 pl-4 pr-md-4 pr-4">
																	<div class="form-group row">
																		<label
																			class="col-sm-2 col-form-label">First
																			Name</label>
																		<div class="col-sm-10">
																			<input type="text" class="form-control"
																				   placeholder="First Name">
																		</div>
																	</div>
																	<div class="form-group row">
																		<label
																			class="col-sm-2 col-form-label">Last
																			Name</label>
																		<div class="col-sm-10">
																			<input type="text" class="form-control"
																				   placeholder="Last Name">
																		</div>
																	</div>
																	<div class="form-group row">
																		<label
																			class="col-sm-2 col-form-label">Contact
																			Number
																			1</label>
																		<div class="col-sm-10">
																			<input type="text" class="form-control"
																				   placeholder="Contact Number 1">
																		</div>
																	</div>
																	<div class="form-group row">
																		<label
																			class="col-sm-2 col-form-label">Contact
																			Number
																			2</label>
																		<div class="col-sm-10">
																			<input type="text" class="form-control"

																				   placeholder="Contact Number 2">
																		</div>
																	</div>
																	<div class="form-group row">
																		<label
																			class="col-sm-2 col-form-label">Address
																			Leave</label>
																		<div class="col-sm-10">
																			<input type="text" class="form-control"
																				   placeholder="Address Leave">
																		</div>
																	</div>
																	<div class="form-group row">
																		<label
																			class="col-sm-2 col-form-label">Post
																			Code</label>
																		<div class="col-sm-10">
																			<input type="text" class="form-control"
																				   placeholder="Post Code">
																		</div>
																	</div>
																	<div class="form-group row mb-0">

																		<label
																			class="col-sm-3 col-form-label">Department</label>
																		<select value=""
																				class="department form-control form-control-sm col-sm-8">
																			<option>Department 1</option>
																			<option>Department 2</option>
																		</select>

																	</div>
																	<div class="form-group row mb-0">

																		<label class="col-sm-3 col-form-label">Position
																			Type</label>
																		<select value=""
																				class="position_type form-control form-control-sm col-sm-8">
																			<option>Position Type 1</option>
																			<option>Position Type 2</option>
																		</select>

																	</div>


																	<div class="form-group mt-md-2 mt-2">
																		<label
																			for="exampleFormControlTextarea1">Other</label>
																		<textarea placeholder="Other"
																				  class="form-control"
																				  id="exampleFormControlTextarea1"
																				  rows="3"></textarea>
																	</div>

																	<div class="form-group row">
																		<label
																			class="col-sm-10 col-form-label">Status make
																			a
																			Passive?</label>
																		<div class="col-sm-2">
																			<input checked type="checkbox"
																				   class="form-control">
																		</div>
																	</div>
																	<div class="add_new_items">


																		<div class="row">
																			<div class="col-md-2">
																				<div>
																					<div class="media"
																						 style="position: relative;">
																						<img mr-1
																							 class="align-self-start"
																							 id='img-upload3'
																							 style="width: 100%; height: 100px;margin-right: 0 !important;;margin-top: 0px; !important;"
																							 alt=""
																							 src="">
																						<div class="media-body"
																							 style="position: absolute;left: 0;top: 0;height: 100%;width: 100%;">
																							<div
																								class="input-group"
																								style="position: absolute;left: 0;top: 0;width: 100%;height: 100%;">
														<span class="input-group-btn"
															  style="position: absolute;left: 0;top: 0;height: 100%;width: 100%;">
															<span
																class="btn btn-secondary btn-file btn-sm"
																style="    position: absolute;left: 0;top: 0;border: none;padding-top: 38px;width: 100%;height: 100%;background: #0000001f;">
																Browse… <input type="file" onchange="readURL3(this);"
																			   id="imgInp3">
															</span>
														</span>
																								<input type="text"
																									   class="form-control"
																									   readonly
																									   style="display: none;">

																							</div>
																						</div>
																					</div>


																				</div>
																			</div>
																			<div class="col-md-3">
																				<div class="form-group">
																					<label>Number</label>
																					<input type="text"
																						   class="form-control"
																						   placeholder="Number">
																				</div>
																			</div>
																			<div class="col-md-3">
																				<label>Epired Date</label>
																				<input type="date" name="bday"
																					   max="3000-12-31"
																					   min="1000-01-01"
																					   class="form-control">
																			</div>
																			<div class="col-md-3">
																				<div class="form-group">
																					<label>Issued</label>
																					<input type="text"
																						   class="form-control"
																						   placeholder="Issued">
																				</div>
																			</div>
																		</div>


																	</div>

																</form>

																<div style="width: 100%;">
																	<button type="button" style="border: none;"
																			class="mr-md-3 mr-3 float-right btn btn-outline-secondary float-right add_new_row">
																		<i class="fa fa-plus"></i>
																	</button>
																</div>

															</div>
														</div>
														<div class="modal-footer">
															<div class="text-right mt-4 pb-2">
																<button class="btn btn-secondary">Save</button>
																<button class="btn btn-secondary ml-2"
																		data-dismiss="modal">
																	Cancel
																</button>
															</div>
														</div>
													</div>
												</div>
											</div>

											<!-- Add User Modal End -->

										</div>
										<hr class="my-4">

										<div class="row col-sm-12 col-md-12"
											 style="background: #fff;padding-top: 10px; padding-bottom: 10px; overflow-x: scroll;">


											<table id="example2" class="table table-bordered"
												   style="width:100%">
												<thead style="background: #545b62;
color: #fff;">
												<tr>
													<th style="font-size: 12px !important;">Name Lastname</th>
													<th style="font-size: 12px !important;">Status</th>
													<th style="font-size: 12px !important;">Պաշտոն</th>
													<th style="font-size: 12px !important;">Բաժին</th>
													<th style="font-size: 12px !important;">ղեկավար</th>
													<th style="font-size: 12px !important;">Created date</th>
													<th style="font-size: 12px !important;">Ում կողմից</th>
												</tr>
												</thead>
												<tbody>
												<tr>
													<td>
														<div class="media">
															<img
																style="-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"
																class="mr-3"
																src="<?= base_url() ?>assets/img/user_img.jpg"
																alt="Generic placeholder image">
															<div class="media-body">
																Daniel Smith
																<small class="phone_number form-text text-muted">+375
																	556690
																</small>
															</div>
														</div>
													</td>
													<td class="text-center" style="vertical-align: middle;">
														<div class="bg-success"
															 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
													</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td>
														<div class="media">
															<img
																style="-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"
																class="mr-3" src="<?= base_url() ?>assets/img/b.jpg"
																alt="Generic placeholder image">
															<div class="media-body">
																Daniel Smith
																<small class="phone_number form-text text-muted">+375
																	556690
																</small>
															</div>
														</div>
													</td>
													<td class="text-center" style="vertical-align:middle;">
														<div class="bg-success"
															 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
													</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td>
														<div class="media">
															<img
																style="-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"
																class="mr-3"
																src="<?= base_url() ?>assets/img/user_img.jpg"
																alt="Generic placeholder image">
															<div class="media-body">
																Kaylee Rodgers
																<small class="phone_number form-text text-muted">+375
																	556690
																</small>
															</div>
														</div>
													</td>
													<td class="text-center" style="vertical-align: middle;">
														<div class="bg-danger"
															 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
													</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>

												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Staff End -->

						<!-- Veichls Start -->
						<div class="tab-pane fade" id="list-settings" role="tabpanel"
							 aria-labelledby="list-settings-list">

							<div class="tab-pane fade show active" id="list-staff" role="tabpanel"
								 aria-labelledby="list-staff-list">

								<div class="jumbotron jumbotron-fluid pb-2 pt-2">
									<div class="container">
										<p class="display-5 font-weight-bold mb-0">Section: Veichls</p>
									</div>
								</div>

								<div class="jumbotron jumbotron-fluid pb-2 pt-2">
									<div class="container">
										<div class="row">
											<div class="col-sm-12 col-md-2 col-2">
												<p class="display-5 font-weight-bold float-left">Toatl Vehicle</p> <span
													class="ml-2 mt-1 badge badge-secondary badge-pill">6</span>
											</div>

											<div class="col-sm-12 col-md-2 col-2">
												<p class="display-5 font-weight-bold float-left">Active Vehicle</p>
												<span
													class="ml-2 mt-1 badge badge-success badge-pill">4</span>
											</div>

											<div class="col-sm-12 col-md-2 col2">
												<p class="display-5 font-weight-bold float-left">Passive Vehicle</p>
												<span
													class="ml-2 mt-1 badge badge-warning badge-pill">2</span>
											</div>

											<div class="col-sm-12 col-md-4 col-4"></div>

											<div class="col-sm-12 col-md-2 col-2">
												<button class="btn btn-secondary" data-toggle="modal"
														data-target=".add_veichls_modal">Add Vehicle
												</button>
											</div>

										</div>


										<hr class="my-4">

										<div class="row col-sm-12 col-md-12"
											 style="background: #fff; padding-top: 10px;padding-bottom: 10px;overflow-x: scroll;">


											<table id="example3" class="table table-bordered"
												   style="width:100%">
												<thead style="background: #545b62;
color: #fff;">
												<tr>
													<th style="font-size: 12px !important;">Name Lastname</th>
													<th style="font-size: 12px !important;">Status</th>
													<th style="font-size: 12px !important;">Պաշտոն</th>
													<th style="font-size: 12px !important;">Բաժին</th>
													<th style="font-size: 12px !important;">ղեկավար</th>
													<th style="font-size: 12px !important;">Created date</th>
													<th style="font-size: 12px !important;">Ում կողմից</th>
												</tr>
												</thead>
												<tbody>
												<tr>
													<td>Veichls 1</td>
													<td style="text-align: center; vertical-align: middle;">
														<div class="bg-success"
															 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
													</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td>Veichls 2</td>
													<td style="text-align: center;vertical-align: middle;">
														<div class="bg-success"
															 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
													</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td>Veichls 3</td>
													<td style="text-align: center;vertical-align: middle;">
														<div class="bg-danger"
															 style="margin-top: 12%; display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
													</td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>

												</tr>


											</table>


										</div>
									</div>
								</div>
							</div>


							<!-- Add Veichls Modal Start -->

							<div class="modal fade add_veichls_modal" tabindex="-1" role="dialog"
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
											<div class="row">
												<div class="col-sm-12 col-md-6 col-6">
													<h2>Vehicle Information</h2>
													<p>Fill in the following fields</p>
												</div>
											</div>

											<nav>
												<div class="nav nav-tabs" id="nav-tab" role="tablist">
													<a class="nav-item nav-link active" id="nav-home-tab"
													   data-toggle="tab"
													   href="#nav-home" role="tab" aria-controls="nav-home"
													   aria-selected="true">MAIN</a>
													<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
													   href="#nav-profile" role="tab" aria-controls="nav-profile"
													   aria-selected="false">INFO</a>
												</div>
											</nav>
											<div class="tab-content" id="nav-tabContent">

												<!-- Tab MAIN Start -->
												<div class="tab-pane fade show active" id="nav-home" role="tabpanel"
													 aria-labelledby="nav-home-tab">

													<form class="mt-3 mt-md-3">

														<div class="first_row">
															<div class="form-group row" style="position: relative;">
																<label
																	class="col-sm-2 col-form-label">Կցված</label>
																<div class="col-sm-9">
																	<select value=""
																			class="currency form-control form-control-sm">
																		<option>opton 1</option>
																		<option>option 2</option>
																	</select>
																</div>
																<div class="col-1">
																	<button type="button" style="border:none;"
																			class="add_new_row btn btn-outline-secondary float-right">
																		<i class="fas fa-plus"></i></i></button>
																</div>

															</div>
														</div>


														<div class="form-group row">
															<label
																class="col-sm-2 col-form-label">Տ/մ տեսակ</label>
															<div class="col-sm-10">
																<select value=""
																		class="currency form-control form-control-sm">
																	<option>opton 1</option>
																	<option>option 2</option>
																</select>
															</div>
														</div>
														<div class="form-group row">
															<label
																class="col-sm-2 col-form-label">Մակնիշ</label>
															<div class="col-sm-10">
																<select value=""
																		class="currency form-control form-control-sm">
																	<option>opton 1</option>
																	<option>option 2</option>
																</select>
															</div>
														</div>
														<div class="form-group row">
															<label
																class="col-sm-2 col-form-label">Տիպար</label>
															<div class="col-sm-10">
																<select value=""
																		class="currency form-control form-control-sm">
																	<option>opton 1</option>
																	<option>option 2</option>
																</select>
															</div>
														</div>

														<div class="form-group row">
															<label
																class="col-sm-2 col-form-label">Թողարկման
																տարեթիվ</label>
															<div class="col-sm-10">
																<select value=""
																		class="currency form-control form-control-sm">
																	<option>Choose...</option>
																	<?php for ($i = 1900; $i <= date('Y'); $i++) { ?>
																		<option value="<?= $i ?>"><?= $i ?></option>
																	<?php } ?>

																</select>
															</div>
														</div>


													</form>

												</div>

												<!-- Tab MAIN End -->

												<!-- Tab INFO Start -->
												<div class="tab-pane fade" id="nav-profile" role="tabpanel"
													 aria-labelledby="nav-profile-tab">Info Section
												</div>
												<!-- Tab INFO End -->

											</div>

										</div>
										<div class="modal-footer">
											<div class="text-right mt-4 pb-2">
												<button class="btn btn-secondary">Save</button>
												<button class="btn btn-secondary ml-2" data-dismiss="modal">
													Cancel
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Add Veichls Modal End -->

						</div>
						<!-- Veichls End -->


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






