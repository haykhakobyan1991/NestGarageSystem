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


	<!-- Add Vehicle Modal Start -->

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

								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Գույն</label>
									<div class="col-sm-6">
										<p style="margin-bottom: 0;">Standart Colors</p>
										<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">

											<div class="btn-group mr-2" role="group" aria-label="First group">
												<button type="button" class="btn color_check_btn" data-value="#ffffff" style="background: #ffffff;"></button>
												<button type="button" class="btn color_check_btn" data-value="#c0c0c0" style="background: #c0c0c0;"></button>
												<button type="button" class="btn color_check_btn" data-value="#000000" style="background: #000000;"></button>
												<button type="button" class="btn color_check_btn" data-value="#696969" style="background: #696969;"></button>
												<button type="button" class="btn color_check_btn" data-value="#0000ff" style="background: #0000ff;"></button>
												<button type="button" class="btn color_check_btn" data-value="#ff0000" style="background: #ff0000;"></button>
												<button type="button" class="btn color_check_btn" data-value="#d2b48c" style="background: #d2b48c;"></button>
												<button type="button" class="btn color_check_btn" data-value="#008000" style="background: #008000;"></button>
												<button type="button" class="btn color_check_btn" data-value="#ffd0d0" style="background: #ffd0d0;"></button>
											</div>
										</div>
										<p style="margin-bottom: 0;"><i class="fas fa-palette"></i> Mor Fill Colors ...</p>
										<input type="color" class="btn color_check_btn more_color" value="" />
									</div>
									<div class="col-sm-4">
										<p style="margin-bottom: 0;">Selected Color</p>
										<input type="hidden" value="#ffffff" class="selected_color_value" />
										<div class="selected-color" style="background: #ffffff;"></div>
									</div>
								</div>


								<div class="form-group row">
									<label
										class="col-sm-2 col-form-label">Հաշվառման համարանիշ</label>
									<div class="col-sm-10">
										<input value="" name="" type="text" class="form-control" placeholder="Հաշվառման համարանիշ">
									</div>
								</div>

								<div class="form-group row">
									<label
										class="col-sm-2 col-form-label">VIN</label>
									<div class="col-sm-10">
										<input value="" name="vin" type="text" class="form-control" placeholder="VIN">
									</div>
								</div>

								<div class="form-group row">
									<label
										class="col-sm-2 col-form-label">Շարժիչի հզորություն</label>
									<div class="col-sm-10">
										<input value="" name="" type="text" class="form-control mt-2" placeholder="Շարժիչի հզորություն">
									</div>
								</div>


								<div class="form-group row">
									<label
										class="col-sm-2 col-form-label">Վառելիք</label>
									<div class="col-sm-10">
										<select value=""
												class="form-control form-control-sm">
											<option>Վառելիքի տեսակը</option>
											<option>GAS</option>
											<option>DIESEL</option>
											<option>PETROL</option>
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
