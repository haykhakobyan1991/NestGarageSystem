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

<!-- USERS START -->
<div class="tab-pane fade show active" id="list-users">
	<form id="users">
		<div class="tab-pane fade show active" id="list-users" role="tabpanel" aria-labelledby="list-users-list"
			 style="padding-top: 10px;">

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
												   name="contactnumber"
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
											<input type="text" class="form-control form-control-sm col-sm-8 float-left"
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
											<select name="country"
													class="col selectpicker form-control form-control-sm form-control-sm"
													data-size="5" id="country" data-live-search="true"
													title="Select a Country">
												<option value="">Select a Country ...</option>
												<option value="admin">admin</option>
												<option value="user">user</option>
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
										<label class="ml-1 col-form-label">Send a notification mail to the new created
											user?</label>
										<div class="col-sm-1">
											<input name="status" value="-1" type="checkbox"
												   class="form-control form-control-sm">
										</div>
									</div>
								</div>
							</div>
							<div class="text-right mt-4 pb-2">
								<span id="add_user" class="btn btn-sm btn-outline-success">Save</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Add User Modal End -->
			<div class="pb-2 pt-2">
				<div class="">
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
								<th style="font-size: 12px !important;font-weight: 500;">Passwprd</th>
								<th style="font-size: 12px !important;font-weight: 500;">Created Date</th>
								<th style="font-size: 12px !important;font-weight: 500;">By Whom</th>
								<th style="font-size: 12px !important;font-weight: 500;">Last Access Date/Time</th>
								<th style="font-size: 12px !important;font-weight500;min-width: 50px !important;"></th>
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
									<div class="bg-success2"
										 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
									<span class="font-weight-light pl-1"
										  style="font-size: 13px;display: block;">Strong</span>
								</td>
								<td>Admin</td>
								<td>User Name</td>
								<td>dfdf/?ff</td>
								<td>10.10.2017</td>
								<td>

									<table>
										<tbody>
										<tr>
											<td>fff</td>
											<td>fff</td>
											<td>fff</td>
											<td>fff</td>
											<td>fff</td>
										</tr>
										<tr>
											<td>dfdf</td>
											<td>dfdf</td>
											<td>dfdf</td>
											<td>dfdf</td>
											<td>dfdf</td>
										</tr>
										<tr>
											<td>dfdf</td>
											<td>dfdf</td>
											<td>dfdf</td>
											<td>dfdf</td>
											<td>dfdf</td>
										</tr>
										<tr>
											<td>dfdfd</td>
											<td>dfdfd</td>
											<td>dfdfd</td>
											<td>dfdfd</td>
											<td>dfdfd</td>
										</tr>
										</tbody>
									</table>

								</td>
								<td>22.10.2018/20:42</td>
								<td colspan="2">
										<span style="border: none;padding-top: 5px;cursor: pointer;" data-id=""
											  id="edit_user_modal"
											  data-toggle="modal" class="float-left text-success"
											  data-target="#edit_users"
											  data-toggle2="tooltip"
											  data-placement="top"
											  title="edit"><i class="fas fa-edit"></i></span>

									<span style="border: none;cursor: pointer;" data-id="" id="delet_users_modal"
										  class="btn text-danger"
										  data-toggle2="tooltip"
										  data-placement="top"
										  title="delete"><i class="fas fa-trash"></i></span></td>
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
								<td colspan="2">
									<span style="border: none;padding-top: 5px;cursor: pointer;"
										  data-id=""
										  id="edit_user_modal"
										  data-toggle="modal" class="float-left text-success"
										  data-target="#edit_users"
										  data-toggle2="tooltip"
										  data-placement="top"
										  title="edit">
										<i class="fas fa-edit"></i>
									</span>
									<span style="border: none;cursor: pointer;" data-id=""
										  id="delet_user_modal"
										  class="btn text-danger"
										  data-toggle2="tooltip"
										  data-placement="top"
										  title="delete">
										<i class="fas fa-trash"></i>
									</span>
								</td>
							</tr>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<!--USERS END-->
