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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
		  integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css"/>


	<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
	<script src="<?= base_url() ?>assets/js/main.js"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
	<script src="<?= base_url() ?>assets/js/table.js"></script>

	<script>
		$(document).ready(function () {
			$('#example').DataTable();
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
													<button type="button" class="btn btn-danger" data-dismiss="modal">
														Close
													</button>
													<button type="button" class="btn btn-success">Save</button>
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

<script>
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
	});

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
</script>
</body>
</html>
