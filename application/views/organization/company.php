<?php
$user_id = $this->session->user_id;
$folder = $this->session->folder;
$i = '';
?>

<!--  Company  Start-->
<div class="tab-pane fade show active" id="list-company" role="tabpanel" style="padding-top: 10px;"
	 aria-labelledby="list-company-list">

	<!-- Error Message -->

	<div class="for_message">
		<div class="alert alert-success d-none" role="alert"></div>
		<div class="alert alert-danger d-none" role="alert"></div>
		<div class="alert alert-info d-none" role="alert"></div>

	</div>


	<div class="jumbotron jumbotron-fluid pb-2 pt-2">


		<div class="container">
			<p class="display-5 font-weight-bold mb-0">Section: Company</p>
		</div>


	</div>

	<form id="company">
		<div class="jumbotron jumbotron-fluid pb-2 pt-2" style="background: #fff">
			<div class="container">

				<p class="display-5 font-weight-bold"><?= lang('status') ?></p>

				<hr class="my-4">
				<div class="row">
					<table class="table table-hover table-secondary col-sm-12 col-md-5" style="background: #fff;">
						<tbody>
						<? foreach ($company_type as $item) : ?>
							<tr>
								<td style="border: none;"><?= $item['title'] ?> *</td>
								<td style="border: none;"><input style="width: 20px;height: 20px;"
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
								 src="<?= ($company['logo'] != '' ? base_url('uploads/'.$folder.'/company/' . $company['logo']) : base_url('assets/images/no_choose_image.svg')) ?>">
							<div class="media-body">
								<h5 class="mt-0">LOGO</h5>
								<p>Upload your company LOGO</p>
								<div class="input-group ml-2 ml-md-2">
															<span class="input-group-btn">
																<span class="btn btn-outline-success btn-file mr-1">
																	Browse… <input type="file" id="imgInp" name="photo">
																</span>
															</span>
									<input type="text" class="form-control form-control-sm" readonly
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

						<div class="row">

							<label
								class="col-sm-2 col-form-label"
								style="font-size: 15px;"><?= lang('company_name') ?> *</label>
							<div class="col-sm-4">
								<input value="<?= $company['name'] ?>" name="company_name"
									   type="text" class="form-control"
									   placeholder="<?= lang('company_name') ?>">
							</div>


							<label class="col-sm-2 col-form-label" style="font-size: 15px;">Owner Firstname</label>
							<div class="col-sm-4">
								<input value="<?= $company['owner_firstname'] ?>"
									   name="owner_firstname" type="text" class="form-control form-control-sm"
									   placeholder="Owner Firstname">
							</div>
						</div>

						<div class="row mt-1">


							<label class="col-sm-2 col-form-label" style="font-size: 15px;">Owner Lastname</label>
							<div class="col-sm-4">
								<input value="<?= $company['owner_lastname'] ?>"
									   name="owner_lastname" type="text" class="form-control form-control-sm"
									   placeholder="Owner Lastname">
							</div>


							<label class="col-sm-2 col-form-label" style="font-size: 15px;">Owner Position</label>
							<div class="col-sm-4">
								<input value="<?= $company['owner_position'] ?>"
									   name="owner_position" type="text" class="form-control form-control-sm"
									   placeholder="Owner Position">
							</div>


						</div>

						<div class="row mt-1">


							<label class="col-sm-2 col-form-label" style="font-size: 15px;">Owner Contact Number</label>
							<div class="col-sm-4">
								<input value="<?= $company['owner_contact_number'] ?>"
									   name="owner_contact_number" type="text"
									   class="form-control form-control-sm" placeholder="Owner Contact Number">
							</div>


							<label class="col-sm-2 col-form-label" style="font-size: 15px;">Owner Email</label>
							<div class="col-sm-4">
								<input value="<?= $company['owner_email'] ?>" name="owner_email"
									   type="email" class="form-control form-control-sm"
									   placeholder="Owner Email">
							</div>


						</div>

						<div class="row mt-5">


							<div class="col-sm-6">
								<label
									class="col-sm-6 col-form-label"
									style="padding-left: 0;"><?= lang('activity_address') ?></label>
								<button type="button"
										class="btn btn-sm btn-outline-success float-right  copy_btn">
									copy
								</button>
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
											   type="text" class="form-control form-control-sm"
											   placeholder="Activity State Region">
									</div>
								</div>

								<div class="form-row mt-md-2 mt-2">
									<div class="col">
										<input name="activity_city"
											   value="<?= $company['activity_city'] ?>"
											   type="text" class="form-control form-control-sm"
											   placeholder="Activity City">
									</div>
									<div class="col">
										<input name="activity_zip_code"
											   value="<?= $company['activity_zip_code'] ?>"
											   type="text" class="form-control form-control-sm"
											   placeholder="Zip Code">
									</div>
								</div>

								<div class="form-group mt-md-2 mt-2">
									<div class="col" style="padding-left: 0;padding-right: 0;">
										<input name="activity_address"
											   value="<?= $company['activity_address'] ?>"
											   type="text" class="form-control form-control-sm"
											   placeholder="Activity Address">
									</div>
								</div>


							</div>


							<div class="col-sm-6">
								<label
									class="col-sm-6 col-form-label"
									style="padding-left: 0;"><?= lang('legal_address') ?></label>
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
											   type="text" class="form-control form-control-sm"
											   placeholder="Legal Region">
									</div>
								</div>

								<div class="form-row mt-md-2 mt-2">
									<div class="col">
										<input name="legal_city"
											   value="<?= $company['legal_city'] ?>" type="text"
											   class="form-control form-control-sm" placeholder="Legal City">
									</div>
									<div class="col">
										<input name="legal_zip_code"
											   value="<?= $company['legal_zip_code'] ?>"
											   type="text" class="form-control form-control-sm"
											   placeholder="Zip Code">
									</div>
								</div>

								<div class="form-group mt-md-2 mt-2">
									<div class="col" style="padding-left: 0;padding-right: 0;">
										<input name="legal_address"
											   value="<?= $company['legal_address'] ?>"
											   type="text" class="form-control form-control-sm"
											   placeholder="Legal Address">
									</div>
								</div>
							</div>


						</div>

						<div class="row mt-4">


							<label class="col-sm-2 col-form-label"><?= lang('tin') ?></label>
							<div class="col-sm-4">
								<input value="<?= $company['tin'] ?>" name="tin" type="text"
									   class="form-control form-control-sm" placeholder="<?= lang('tin') ?>">
							</div>


							<label
								class="col-sm-2 col-form-label"><?= lang('phone_number') ?></label>
							<div class="col-sm-4">
								<input value="<?= $company['phone_number'] ?>"
									   name="phone_number" type="text" class="form-control form-control-sm"
									   placeholder="<?= lang('phone_number') ?>">
							</div>


						</div>

						<div class="row mt-1">


							<label class="col-sm-2 col-form-label"><?= lang('email') ?></label>
							<div class="col-sm-4">
								<input value="<?= $company['email'] ?>" name="email" type="text"
									   class="form-control form-control-sm" placeholder="<?= lang('email') ?>">
							</div>


							<label
								class="col-sm-2 col-form-label"><?= lang('web_address') ?></label>
							<div class="col-sm-4">
								<input value="<?= $company['web_address'] ?>" name="web_address"
									   type="text" class="form-control form-control-sm"
									   placeholder="<?= lang('web_address') ?>">
							</div>


						</div>
					</div>


					<div class="col-sm-12 tab-content col-sm-6 col-12 mt-4" id="nav-tabContent">

						<div class="accordion" id="accordionExample">
							<div class="card">
								<div class="card-header" id="headingOne">
									<h5 class="mb-0">
										<button class="btn btn-sm btn-link text-success" type="button"
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
										<button class="btn btn-sm btn-link collapsed text-success" type="button"
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
			<button class="btn btn-sm btn-link collapsed text-success" type="button"
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
			<button class="btn btn-sm btn-link collapsed text-success" type="button"
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
	<span id="create_company" class="btn btn-sm btn-success">Save</span>
	<span id="load" class="btn btn-sm btn-success d-none"><img
			style="height: 20px;margin: 0 auto;display: block;text-align: center;"
			src="<?= base_url() ?>assets/images/bars2.svg"/></span>
</div>
</div>
</div>
</div>
<!-- Company End -->
</div>
</div>
</div>
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
<script src="<?= base_url('assets/js/go.js') ?>"></script>
<script>
	// create company
	$(document).on('click', '#create_company', function (e) {

		var url = '<?=base_url($this->uri->segment(1).'/Organization/company_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#company')[0]);
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
				loading('start', 'create_company');
				$('.alert-info').removeClass('d-none');
				$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');
			},
			success: function (data) {
				if (data.success == '1') {
					close_message();
					$('.alert-success').removeClass('d-none');
					$('.alert-success').text(data.message);
					loading('stop', 'create_company');
					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/company')?>";
					$(location).attr('href', url);

				} else {
					$('.alert-info').addClass('d-none');

					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'create_company');
						errors = '';
						tmp = '';
						$.each(data.error.elements, function (index) {
							$.each(data.error.elements[index], function (index, value) {
								if (value != '') {
									$('input[name="' + index + '"]').addClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').children('button').addClass('border border-danger');
									$('input[name="' + index + '"]').parent('td').addClass('border border-danger');
									close_message();
									$('.alert-danger').removeClass('d-none');

									if(value != tmp) {
										errors += value;
									}
									tmp = value;

								} else {
									$('input[name="' + index + '"]').removeClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').children('button').removeClass('border border-danger');
									$('input[name="' + index + '"]').parent('td').removeClass('border border-danger');
								}
							});
						});
					}

					$('.alert-danger').html(errors);
				}
			},
			error: function (jqXHR, textStatus) {
				// Handle errors here
				close_message();
				console.log('ERRORS: ' + textStatus);
			},
			complete: function () {
			}
		});
	});


	$(document).on('click', '.copy_btn', function () {
		var activity_state_region = $('input[name="activity_state_region"]').val();
		var activity_city = $('input[name="activity_city"]').val();
		var activity_zip_code = $('input[name="activity_zip_code"]').val();
		var activity_address = $('input[name="activity_address"]').val();
		$('input[name="legal_state_region"]').val(activity_state_region);
		$('input[name="legal_city"]').val(activity_city);
		$('input[name="legal_zip_code"]').val(activity_zip_code);
		$('input[name="legal_address"]').val(activity_address);
		var sel_county_name = $('.selectpicker_1').parent('div').children('button').text();
		$('.selectpicker_2').parent('div').children('button').children('div').children('div').text(sel_county_name);
		var value = $("#country option:selected").val();
		$("#country option[value='" + value + "']").attr('selected', 'selected');
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

</script>









