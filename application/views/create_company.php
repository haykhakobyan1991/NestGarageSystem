<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>

	<title>Create Company</title>
	<!--// Stylesheets //-->
	<link rel="shortcut icon" href="<?= base_url() ?>assets/img/" type="image/png">
	<link href="<?= base_url() ?>assets/css/reset.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/all.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css"/>
	<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
	<script rel="stylesheet" src="<?= base_url() ?>assets/js/all.js"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
	<script src="<?= base_url() ?>assets/js/table.js"></script>


	<script src="<?= base_url() ?>assets/js/main.js"></script>


	<script>
		$(document).ready(function () {
			$('#example').DataTable();
		});

		$(document).ready(function () {
			$('#example2').DataTable();
		});
	</script>

	<style>
		.btn-file {
			position: relative;
			overflow: hidden;
		}

		.btn-file input[type=file] {
			position: absolute;
			top: 0;
			right: 0;
			min-width: 100%;
			min-height: 100%;
			font-size: 100px;
			text-align: right;
			filter: alpha(opacity=0);
			opacity: 0;
			outline: none;
			background: white;
			cursor: inherit;
			display: block;
		}

		#example_wrapper {
			width: 100%;
		}

		#img-upload {
			width: 100%;
		}

		.list-group-item.active {
			z-index: 2;
			color: #fff;
			background-color: #8e8f90;
			border-color: #8e8f90;
		}

		.page-item.active .page-link {
			background: #545b62;
			border: 1px solid #545b62;
		}

		.nav-link {
			color: #333;
		}


	</style>
</head>
<body>


<nav class="navbar navbar-light bg-light fixed-top"
	 style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
	<a class="navbar-brand" href="#">NestGarageSystem</a>
	<button class="btn btn-outline-dark">
		<i class="fas fa-sign-out-alt"></i>
	</button>
</nav>


<div class="container-fluid" style="margin-top: 5rem;">
	<!-- Nav tabs -->
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

				<!-- Content Start -->
				<div class="col-sm-12 col-md-9">

					<!--  Company  Start-->
					<div class="tab-content" id="nav-tabContent">


						<div class="tab-pane fade show active" id="list-company" role="tabpanel"
							 aria-labelledby="list-company-list">

							<div class="jumbotron jumbotron-fluid pb-2 pt-2">
								<div class="container">
									<p class="display-5 font-weight-bold mb-0">Section: Company</p>
								</div>
							</div>

							<div class="jumbotron jumbotron-fluid pb-2 pt-2">
								<div class="container">
									<p class="display-5 font-weight-bold">Կարգավիճակ</p>
									<hr class="my-4">
									<div class="row">
										<table class="table table-hover table-secondary col-sm-12 col-md-5">
											<tbody>
											<tr>
												<td>Իրավաբանական Անձ</td>
												<td><input style="width: 20px;height: 20px;" type="radio" name="type"
														   aria-label="Checkbox for following text input"
														   class="btn btn-primary">
												</td>
											</tr>
											<tr>
												<td>Ֆիզիկական Անձ</td>
												<td><input style="width: 20px;height: 20px;" type="radio" name="type"
														   aria-label="Checkbox for following text input"
														   class="btn btn-primary">
												</td>
											</tr>
											<tr>
												<th scope="row">Չձևակերպված</th>
												<td colspan="2"><input style="width: 20px;height: 20px;" type="radio"
																	   name="type"
																	   aria-label="Checkbox for following text input"
																	   class="btn btn-primary">
												</td>
											</tr>
											</tbody>
										</table>

										<div class="form-group col-sm-12 col-md-6">

											<div class="media">
												<img class="align-self-start mr-3 mt-3 mt-md-3" id='img-upload'
													 style="width: 100px;" alt="company logo"
													 src="<?= base_url() ?>assets/img/logo_default.png">
												<div class="media-body">
													<h5 class="mt-0">LOGO</h5>
													<p>Upload your company LOGO</p>
													<div class="input-group ml-2 ml-md-2">
											<span class="input-group-btn">
												<span class="btn btn-secondary btn-file mr-1">
													Browse… <input type="file" id="imgInp">
												</span>
											</span>
														<input type="text" class="form-control" readonly
															   style="display: none;">

													</div>
												</div>
											</div>


										</div>


									</div>


									<div class="row">


										<form class="col-sm-12 col-md-6">

											<p class="font-weight-bold display-5 mt-3">Հիմնական տվյալներ</p>
											<hr class="my-4">

											<div class="form-group row">


												<label class="col-sm-4 col-form-label">Անվանում</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" placeholder="Անվանում">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label">Գործունեության հասցե</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"
														   placeholder="Գործունեության հասցե">
												</div>
											</div>

											<div class="form-group row">
												<label class="col-sm-4 col-form-label">Իրավաբանական հասցե</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"
														   placeholder="Իրավաբանական հասցե">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label">ՀՎՀՀ</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" placeholder="ՀՎՀՀ">
												</div>
											</div>

											<div class="form-group row">
												<label class="col-sm-4 col-form-label">Հեռախոսահամար</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" placeholder="Հեռախոսահամար">
												</div>
											</div>

											<div class="form-group row">
												<label class="col-sm-4 col-form-label">Էլ․ Հասցե</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" placeholder="Էլ․ Հասցե">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-4 col-form-label">Առցանց Հասցե</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" placeholder="Առցանց Հասցե">
												</div>
											</div>
										</form>

										<div class="tab-content col-sm-6 col-12" id="nav-tabContent">
											<div class="tab-pane fade show active" id="list-home" role="tabpanel"
												 aria-labelledby="list-home-list">

												<div class="jumbotron jumbotron-fluid pb-2 pt-2"
													 style="margin-top: 30px;">


													<hr class="my-4 mt-4">
													<div class="card bg-light mb-3"
													">
													<div class="card-header">Բանկային տվյալներ
														<button style="border:none;"
																class="add_new_banck_account btn btn-outline-secondary float-right">
															<i class="fas fa-plus"></i></i></button>
													</div>
													<div class="card-body">
														<form class="banck_account">
															<div class="form-group row mb-0">

																<label class="col-sm-4 col-form-label">Հաշվի
																	տեսակը</label>
																<select value=""
																		class="currency form-control form-control-sm col-sm-8">
																	<option>Դրամական Հաշիվ</option>
																	<option>Դոլարային Հաշիվ</option>
																</select>

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
																<label class="col-sm-4 col-form-label">Account</label>
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

												<div class="accordion" id="accordionExample">

												</div>


											</div>
										</div>
									</div>

								</div>
								<div class="text-right pb-2">
									<button class="btn btn-secondary">Save</button>
									<button class="btn btn-secondary ml-2">Cancel</button>
								</div>


							</div>
						</div>
					</div>
					<!-- Company End -->

					<!-- Department Start -->
					<div class="tab-pane fade" id="list-department" role="tabpanel"
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
									<p class="display-5 font-weight-bold float-left">Ստորաբաժանումների քանակ</p> <span
										class="ml-2 mt-1 badge badge-secondary badge-pill">4</span>
									<button class="btn btn-secondary float-right" data-toggle="modal"
											data-target=".bd-example-modal-lg">Ստեղծել Ստորաբաժանում
									</button>
									<hr class="my-4">
									<div class="row col-sm-12 col-md-12" style="background: #fff; padding: 10px;">


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
											</tr>
											</thead>
											<tbody>
											<tr>
												<td>Tiger Nixon</td>
												<td>System Architect</td>
												<td>Edinburgh</td>
												<td>61</td>
												<td>2011/04/25</td>
												<td>$320,800</td>
												<td>$320,800</td>
												<td>$320,800</td>
											</tr>
											<tr>
												<td>Garrett Winters</td>
												<td>Accountant</td>
												<td>Tokyo</td>
												<td>63</td>
												<td>2011/07/25</td>
												<td>$170,750</td>
												<td>$170,750</td>
												<td>$170,750</td>
											</tr>
											<tr>
												<td>Ashton Cox</td>
												<td>Junior Technical Author</td>
												<td>San Francisco</td>
												<td>66</td>
												<td>2009/01/12</td>
												<td>$86,000</td>
												<td>$86,000</td>
												<td>$86,000</td>
											</tr>
											<tr>
												<td>Cedric Kelly</td>
												<td>Senior Javascript Developer</td>
												<td>Edinburgh</td>
												<td>22</td>
												<td>2012/03/29</td>
												<td>$433,060</td>
												<td>$433,060</td>
												<td>$433,060</td>
											</tr>

										</table>


									</div>


									<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
										 aria-labelledby="myLargeModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header bg-dark">
													<h5 class="text-white modal-title dar">New Department</h5>
													<button type="button" class="text-white close" data-dismiss="modal"
															aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<p>Fill in the following fields</p>

													<form class="new_department">

														<div class="form-group row">

															<label class="col-sm-4 col-form-label">Անվանում</label>
															<div class="col-sm-8">
																<select value=""
																		class="currency form-control">
																	<option>Անվանում 1</option>
																	<option>Անվանում 2</option>
																</select>
															</div>
														</div>


														<div class="form-group row">
															<label class="col-sm-4 col-form-label">Մանրամասն</label>
															<div class="col-sm-8">
																<input value="" type="text"
																	   class=" form-control"
																	   placeholder="Մանրամասն">
															</div>
														</div>

														<div class="form-group row">
															<label class="col-sm-4 col-form-label">Ղեկավար
																Bank</label>
															<div class="col-sm-8">
																<input type="text"
																	   class=" form-control"
																	   value=""
																	   placeholder="Ղեկավար">
															</div>
														</div>
													</form>

												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary"
															data-dismiss="modal">
														Close
													</button>
													<button type="button" class="btn btn-secondary">Save</button>
												</div>
											</div>

										</div>
									</div>


									<div class="text-right mt-4 pb-2">
										<button class="btn btn-secondary">Save</button>
										<button class="btn btn-secondary ml-2">Cancel</button>
									</div>


								</div>
							</div>
						</div>

					</div>
					<!-- Department End -->


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
																		 style="width: 100px;" alt="company logo"
																		 src="<?= base_url() ?>assets/img/logo_default.png">
																	<div class="media-body">
																		<div class="input-group ml-2 ml-md-2">
																		<span class="input-group-btn">
																			<span
																				class="btn btn-secondary btn-file mr-1">
																				Browse… <input type="file" id="imgInp2">
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
																		class="col-sm-2 col-form-label">Contact Number
																		1</label>
																	<div class="col-sm-10">
																		<input type="text" class="form-control"
																			   placeholder="Contact Number 1">
																	</div>
																</div>
																<div class="form-group row">
																	<label
																		class="col-sm-2 col-form-label">Contact Number
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
																	<textarea placeholder="Other" class="form-control"
																			  id="exampleFormControlTextarea1"
																			  rows="3"></textarea>
																</div>

																<div class="form-group row">
																	<label
																		class="col-sm-10 col-form-label">Status make a
																		Passive?</label>
																	<div class="col-sm-2">
																		<input checked type="checkbox"
																			   class="form-control">
																	</div>
																</div>
																<div class="add_new_items">


																	<div class="row">
																		<div class="col-md-3">
																			<div>
																				<div class="media">
																					<img mr-1
																						 class="align-self-start mr-3 mt-3 mt-md-3"
																						 id='img-upload3'
																						 style="width: 64px; height: 64px;"
																						 alt="company logo"
																						 src="<?= base_url() ?>assets/img/logo_default.png">
																					<div class="media-body">
																						<div
																							class="input-group ml-2 ml-md-2">
																		<span class="input-group-btn">
																			<span
																				class="btn btn-secondary btn-file btn-sm mt-2 mt-md-4">
																				Browse… <input type="file" onchange="readURL3(this);" id="imgInp3">
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
																				<input type="text" class="form-control"
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
																				<input type="text" class="form-control"
																					   placeholder="Issued">
																			</div>
																		</div>
																	</div>


																	<div class="row">
																		<div class="col-md-3">
																			<div>
																				<div class="media">
																					<img
																						class="align-self-start mr-3 mt-3 mt-md-3"
																						id='img-upload4'
																						style="width: 64px;height: 64px;"
																						alt="company logo"
																						src="<?= base_url() ?>assets/img/logo_default.png">
																					<div class="media-body">
																						<div
																							class="input-group ml-2 ml-md-2">
																		<span class="input-group-btn">
																			<span
																				class="btn btn-secondary btn-file btn-sm mt-2 mt-md-4">
																				Browse… <input type="file" onchange="readURL4(this);" id="imgInp4">
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
																				<input type="text" class="form-control"
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
																				<input type="text" class="form-control"
																					   placeholder="Issued">
																			</div>
																		</div>
																	</div>


																	<div class="row">
																		<div class="col-md-3">
																			<div>
																				<div class="media">
																					<img
																						class="align-self-start mr-3 mt-3 mt-md-3"
																						id='img-upload5'
																						style="width: 64px;height: 64px;"
																						alt="company logo"
																						src="<?= base_url() ?>assets/img/logo_default.png">
																					<div class="media-body">
																						<div
																							class="input-group ml-2 ml-md-2">
																		<span class="input-group-btn">
																			<span
																				class="btn btn-secondary btn-file btn-sm mt-2 mt-md-4">
																				Browse… <input onchange="readURL5(this);" type="file" id="imgInp5">
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
																				<input type="text" class="form-control"
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
																				<input type="text" class="form-control"
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

												</div>
											</div>
										</div>

										<!-- Add User Modal End -->

									</div>
									<hr class="my-4">

									<div class="row col-sm-12 col-md-12" style="background: #fff; padding: 10px;">


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
															class="mr-3" src="<?= base_url() ?>assets/img/user_img.jpg"
															alt="Generic placeholder image">
														<div class="media-body">
															Daniel Smith
															<small class="phone_number form-text text-muted">+375
																556690
															</small>
														</div>
													</div>
												</td>
												<td class="text-center">
													<div class="bg-success"
														 style="margin-top: 44%; display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
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
												<td class="text-center">
													<div class="bg-success"
														 style="margin-top: 44%; display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
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
															class="mr-3" src="<?= base_url() ?>assets/img/user_img.jpg"
															alt="Generic placeholder image">
														<div class="media-body">
															Kaylee Rodgers
															<small class="phone_number form-text text-muted">+375
																556690
															</small>
														</div>
													</div>
												</td>
												<td class="text-center">
													<div class="bg-danger"
														 style="margin-top: 44%; display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
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


					<div class="tab-pane fade" id="list-settings" role="tabpanel"
						 aria-labelledby="list-settings-list">Vehicles
					</div>


				</div>


			</div>

			<!-- Content End -->
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


<script src="<?= base_url() ?>assets/js/bootstrap/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/fontawesome.min.js"></script>


<script class="">
	$(document).ready(function () {
		$(document).on('change', '.btn-file :file', function () {
			var input = $(this),
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function (event, label) {

			var input = $(this).parents('.input-group').find(':text'),
				log = label;

			if (input.length) {
				input.val(log);
			} else {
				if (log) alert(log);
			}

		});

		/* Company logo uploade start */

		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#img-upload').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}

		$("#imgInp").change(function () {
			readURL(this);
		});
		/* Company logo uploade end */

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

		/*Staff img uploade end*/
	});
		/* Staff Passport Image Uploade Start*/
		function readURL3(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#img-upload3').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}




		function readURL4(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#img-upload4').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}




		function readURL5(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#img-upload5').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}


		/*Staff Password image uploade end*/




	var i = 1;

	$('.add_new_banck_account').click(function () {
		var currency = $('.currency').val();
		var account_number = $('.account_number').val();
		var correspondent_bank = $('.correspondent_bank').val();
		var swift_code = $('.swift_code').val();
		var account = $('.account').val();


		$('#accordionExample').append('<div class="card">\n' +
			'<div class="card-header" style="background: #dee2e6;" id="heading' + i + '">\n' +
			'<h5 class="mb-0">\n' +
			'<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse' + i + '" aria-expanded="true" aria-controls="collapse' + i + '">' +
			'<input readonly style="box-shadow: none;border: none;outline: none; padding-left:5px;cursor: pointer;"  name="' + currency + '" value="' + currency + '" />' +
			'</button>\n' +
			'<button style="border:none;" class="remove_banck_account btn btn-outline-secondary float-right"><i class="fas fa-trash"></i></button>\n' +
			'</h5>\n' +
			'</div>\n' +
			'<div id="collapse' + i + '" class="collapse show" aria-labelledby="heading' + i + '" data-parent="#accordionExample">\n' +
			'<div class="card-body">\n' +
			'<form class="banck_account">\n' +
			'<div class="form-group row mb-0">\n' +
			'<label class="col-sm-4 col-form-label">Account Number</label>\n' +
			'<div class="col-sm-8">\n' +
			'<input type="text" class="form-control form-control-sm" readonly style="box-shadow: none;border: none;outline: none;" name="account_number' + i + '" value="' + account_number + '">\n' +
			'</div>\n' +
			'</div>\n' +
			'<div class="form-group row mb-0">\n' +
			'<label class="col-sm-4 col-form-label">Correspondent Bank</label>\n' +
			'<div class="col-sm-8">\n' +
			'<input type="text" class="form-control form-control-sm" readonly style="box-shadow: none;border: none;outline: none;" name="Correspondent' + i + '" value="' + correspondent_bank + '">\n' +
			'</div>\n' +
			'</div>\n' +
			'<div class="form-group row mb-0">\n' +
			'<label class="col-sm-4 col-form-label">Swift\n' +
			'Code</label>\n' +
			'<div class="col-sm-8">\n' +
			'<input type="text" class="form-control form-control-sm" readonly style="box-shadow: none;border: none;outline: none;" name="swift_code' + i + '" value="' + swift_code + '">\n' +
			'</div>\n' +
			'</div>\n' +
			'<div class="form-group row mb-0">\n' +
			'<label\n' +
			'class="col-sm-4 col-form-label">Account</label>\n' +
			'<div class="col-sm-8">\n' +
			'<input type="text" class="form-control form-control-sm" readonly style="box-shadow: none;border: none;outline: none;" name="account' + i + '" value="' + account + '">\n' +
			'</div>\n' +
			'</div>\n' +
			'</form>\n' +
			'</div>\n' +
			'</div>\n' +
			'</div>');

		i++;

	});

	$(document).on('click', '.remove_banck_account', function () {
		$(this).parent('h5').parent('div').parent('div').remove();
	});

	$(document).ready(function () {

		var k = 6;

		$(document).on('click', '.add_new_row', function () {


			$('.add_new_items').append('<div class="row">\n' +
				'<div class="col-md-3">\n' +
				'<div>\n' +
				'<div class="media">\n' +
				'<img class="align-self-start mr-3 mt-3 mt-md-3" id="img-upload'+k+'" style="width: 64px;height: 64px;" alt="company logo" src="assets/img/logo_default.png">\n' +
				'<div class="media-body">\n' +
				'<div class="input-group ml-2 ml-md-2">\n' +
				'<span class="input-group-btn">\n' +
				'<span class="btn btn-secondary btn-file btn-sm mt-2 mt-md-4">\n' +
				'Browse… <input type="file" onchange="readURL'+k+'(this);" id="imgInp'+k+'">\n' +
				'</span>\n' +
				'</span>\n' +
				'<input type="text" class="form-control" readonly style="display: none;">\n' +
				'</div>\n' +
				'</div>\n' +
				'</div>\n' +
				'</div>\n' +
				'</div>\n' +
				'<div class="col-md-3">\n' +
				'<div class="form-group">\n' +
				'<label>Number</label>\n' +
				'<input type="text" class="form-control" placeholder="Number">\n' +
				'</div>\n' +
				'</div>\n' +
				'<div class="col-md-3">\n' +
				'<label>Epired Date</label>\n' +
				'<input type="date" name="bday" max="3000-12-31"  min="1000-01-01" class="form-control">\n' +
				'</div>\n' +
				'<div class="col-md-3">\n' +
				'<div class="form-group">\n' +
				'<label>Issued</label>\n' +
				'<input type="text" class="form-control"  placeholder="Issued">\n' +
				'</div>\n' +
				'</div>\n' +
				'</div>');





				$('.brows_image_dynamicle').append('<script>' +
					'function readURL'+k+ '(input) {\n' +
					'\t\t\tif (input.files && input.files[0]) {\n' +
					'\t\t\t\tvar reader = new FileReader();\n' +
					'\n' +
					'\t\t\t\treader.onload = function (e) {\n' +
					'\t\t\t\t\t$("#img-upload'+k+'").attr("src", e.target.result);\n' +
					'\t\t\t\t}\n' +
					'\n' +
					'\t\t\t\treader.readAsDataURL(input.files[0]);\n' +
					'\t\t\t}\n' +
					'}<' +
					'/script>');

			k++

			//$('.brows_image_dynamicle').html($('.brows_image_dynamicle').text());

		})



	})
</script>


<div class="brows_image_dynamicle"></div>

</body>
</html>



