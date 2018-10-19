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
