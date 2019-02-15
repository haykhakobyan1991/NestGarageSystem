<?php
$user_id = $this->session->user_id;
$folder = $this->session->folder;
$i = '';
?>

<style>
	input::-webkit-input-placeholder {
		font-size: 14px !important;
	}
</style>

<!--  Company  Start-->
<div class="tab-pane fade show active" id="list-company" role="tabpanel"
	 aria-labelledby="list-company-list">

	<!-- Error Message -->

	<div class="for_message">
		<div class="alert alert-success d-none" role="alert"></div>
		<div class="alert alert-danger d-none" role="alert"></div>
		<div class="alert alert-info d-none" role="alert"></div>

	</div>

	<form id="company">
		<div class="jumbotron jumbotron-fluid pt-2" style="background: #fff;margin-bottom: 0;">
			<div class="container">
				<p class="display-5 font-weight-bold mb-0"><?= lang('Basic_information') ?></p>
				<hr class="my-2">
			</div>

			<div class="container">
				<div class="row">
					<div class="col-sm-7">

						<div class="row">
							<div class="col-sm-5">
								<div class="row">
									<label
										class="col-form-label col-sm-5"
										style="font-size: 15px;"><?= lang('company_name') ?> *</label>
									<input value="<?= $company['name'] ?>"
										   name="company_name"
										   type="text"
										   class="form-control col-sm-7"
										   placeholder="<?= lang('company_name') ?>">
								</div>
							</div>

							<div class="col-sm-7">
								<div class="row" style="margin-top: -2px;">
									<label class="col-form-label col-sm-5"><?= lang('company_type') ?></label>
									<select name="company_type"
											class="selectpicker form-control form-control-sm  col-sm-7"
											data-size="5" id="company_type" data-live-search="true"
											title="<?= lang('company_type') ?>">
										<? foreach ($company_type as $item) : ?>
											<option <?= ($company['company_type_id'] == $item['id'] ? 'selected' : '') ?>
												value="<?= $item['id'] ?>">
												<?= $item['title'] ?>
											</option>
										<? endforeach; ?>
									</select>
								</div>


							</div>
						</div>

						<div class="row mt-1">
							<div class="col-sm-5">
								<div class="row">
									<label class="col-form-label col-sm-5"><?= lang('tin') ?></label>
									<input value="<?= $company['tin'] ?>" name="tin" type="text"
										   class="form-control form-control-sm col-sm-7"
										   placeholder="<?= lang('tin') ?>">
								</div>

							</div>

							<div class="col-sm-7">
								<div class="row" style="margin-top: 1px;">
									<label class="col-form-label col-sm-5"><?= lang('web_address') ?></label>
									<input value="<?= $company['web_address'] ?>"
										   name="web_address"
										   type="text" class="form-control form-control-sm col-sm-7"
										   placeholder="<?= lang('web_address') ?>">
								</div>
							</div>
						</div>


					</div>


					<div class="col-sm-3">
						<h5 style="margin-left: 64px;float: none;display: unset;"><?= lang('logo') ?></h5>
						<div class="media">
							<img class="align-self-start" id='img-upload'
								 style="width: 50px;margin-top: -16px;"
								 alt=""
								 src="<?= ($company['logo'] != '' ? base_url('uploads/' . $folder . '/company/' . $company['logo']) : base_url('assets/images/no_choose_image.svg')) ?>">
							<div class="media-body" style="margin-top: 25px;">
								<p style="float: left;margin-top: -20px;margin-left:15px;"><?= lang('upload_logo'); ?></p>
								<div class="input-group ml-2 ml-md-2" style="display: inline-block;width: auto;">
															<span class="input-group-btn">
																<span
																	class="btn btn-sm btn-outline-success btn-file mr-1 span_button_uploade">
																	<?= lang('browse') ?> <input type="file" id="imgInp"
																								 name="photo"
																								 accept='image/png'
																	>
																</span>
															</span>
									<input type="text" class="form-control form-control-sm" readonly
										   style="display: none;" title=""/>
									<input type="hidden" name="u_logo"
										   value="<?= ($company['logo'] != '' ? base_url('uploads/' . $folder . '/company/' . $company['logo']) : base_url('assets/images/no_choose_image.svg')) ?>">

								</div>
							</div>
						</div>
					</div>


				</div>

				<hr class="my-2 mt-1">

				<div class="row mt-3">


					<div class="col-sm-6">
						<label
							class="col-sm-6 col-form-label"
							style="padding-left: 0;"><?= lang('address_1') ?></label>

						<div class="form-row">
							<select name="activity_country"
									class="col selectpicker form-control form-control-sm selectpicker_1"
									data-size="5" id="country" data-live-search="true"
									title="<?= lang('select_country'); ?>">
								<option value=""><?= lang('Activity_Region') ?></option>
								<? foreach ($country as $row) : ?>
									<option <?= ($company['activity_country_id'] == $row['id'] ? 'selected' : '') ?>
										value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
								<? endforeach; ?>
							</select>
							<div class="col">
								<input name="activity_state_region"
									   value="<?= $company['activity_state_region'] ?>"
									   type="text" class="form-control form-control-sm"
									   placeholder="<?= lang('Activity_Region') ?>">
							</div>
						</div>

						<div class="form-row mt-md-1 mt-1">
							<div class="col">
								<input name="activity_city"
									   value="<?= $company['activity_city'] ?>"
									   type="text" class="form-control form-control-sm"
									   placeholder="<?= lang('Activity_City') ?>">
							</div>
							<div class="col">
								<input name="activity_zip_code"
									   value="<?= $company['activity_zip_code'] ?>"
									   type="text" class="form-control form-control-sm"
									   placeholder="<?= lang('zip_code') ?>">
							</div>
						</div>

						<div class="form-group mt-md-1 mt-1 mb-0">
							<div class="col" style="padding-left: 0;padding-right: 0;">
								<input name="activity_address"
									   value="<?= $company['activity_address'] ?>"
									   type="text" class="form-control form-control-sm"
									   placeholder="<?= lang('Activity_address') ?>">
							</div>


						</div>

						<div class="row mt-1">
							<label class="col-sm-4 col-form-label"><?= lang('email') ?></label>
							<div class="col-sm-8">
								<input value="<?= $company['email'] ?>" name="email" type="text"
									   class="form-control form-control-sm" placeholder="<?= lang('email') ?>">
							</div>
						</div>

						<div class="row mt-1">
							<label
								class="col-sm-4 col-form-label"><?= lang('phone_number') ?></label>
							<div class="col-sm-8">
								<input value="<?= $company['phone_number'] ?>"
									   name="phone_number" type="text" class="form-control form-control-sm"
									   placeholder="<?= lang('phone_number') ?>">
							</div>
						</div>

					</div>


					<div class="col-sm-6">
						<label
							class="w-100 col-form-label"
							style="padding-left: 0;"><?= lang('address_2') ?>
							<button type="button"
									class="btn btn-sm btn-outline-success float-right  copy_btn">
								<?= lang('Same_as') ?>
							</button>
						</label>
						<div class="form-row">
							<select name="legal_country"
									class="col selectpicker form-control form-control-sm selectpicker_2"
									data-size="5" id="country" data-live-search="true"
									title="<?= lang('select_country'); ?>">
								<option value=""><?= lang('Activity_Region') ?></option>
								<? foreach ($country as $row) : ?>
									<option <?= ($company['legal_country_id'] == $row['id'] ? 'selected' : '') ?>
										value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
								<? endforeach; ?>
							</select>
							<div class="col">
								<input name="legal_state_region"
									   value="<?= $company['legal_state_region'] ?>"
									   type="text" class="form-control form-control-sm"
									   placeholder="<?= lang('legal_region') ?>">
							</div>
						</div>

						<div class="form-row mt-md-1 mt-1">
							<div class="col">
								<input name="legal_city"
									   value="<?= $company['legal_city'] ?>" type="text"
									   class="form-control form-control-sm"
									   placeholder="<?= lang('Activity_City') ?>">
							</div>
							<div class="col">
								<input name="legal_zip_code"
									   value="<?= $company['legal_zip_code'] ?>"
									   type="text" class="form-control form-control-sm"
									   placeholder="<?= lang('zip_code') ?>">
							</div>
						</div>

						<div class="form-group mt-md-1 mt-1 mb-0">
							<div class="col" style="padding-left: 0;padding-right: 0;">
								<input name="legal_address"
									   value="<?= $company['legal_address'] ?>"
									   type="text" class="form-control form-control-sm"
									   placeholder="<?= lang('Activity_address') ?>">
							</div>
						</div>


					</div>


				</div>

				<div class="row">
					<div class="col-md-12 col-md-6 ddddd">

						<p class="font-weight-bold display-5 mt-3"><?= lang('general_information') ?></p>
						<hr class="my-2">

						<div class="row">
							<div class="col-sm-5">
								<div class="row">
									<label class="col-sm-3 col-form-label"
										   style="font-size: 15px;"><?= lang('owner_firstname') ?></label>
									<div class="col-sm-8">
										<input value="<?= $company['owner_firstname'] ?>"
											   name="owner_firstname" type="text" class="form-control form-control-sm"
											   placeholder="<?= lang('owner_firstname') ?>">
									</div>
								</div>


							</div>

							<div class="col-sm-4">
								<div class="row">
									<label class="col-sm-3 col-form-label"
										   style="font-size: 15px;"><?= lang('phone_number') ?></label>
									<div class="col-sm-8">
										<input value="<?= $company['owner_contact_number'] ?>"
											   name="owner_contact_number" type="text"
											   class="form-control form-control-sm"
											   placeholder="<?= lang('contact_number') ?>">
									</div>
								</div>
							</div>


							<!--							<div class="col-sm-4">-->
							<!--								<div class="row">-->
							<!--									<label class="col-sm-3 col-form-label"-->
							<!--										   style="font-size: 15px;">-->
							<? //= lang('owner_position') ?><!--</label>-->
							<!--									<div class="col-sm-8">-->
							<!--										<input value="-->
							<? //= $company['owner_position'] ?><!--"-->
							<!--											   name="owner_position" type="text" class="form-control form-control-sm"-->
							<!--											   placeholder="-->
							<? //= lang('owner_position') ?><!--">-->
							<!--									</div>-->
							<!--								</div>-->
							<!--							</div>-->
						</div>

						<div class="row mt-1">
							<div class="col-sm-5">
								<div class="row">
									<label class="col-sm-3 col-form-label"
										   style="font-size: 15px;"><?= lang('owner_lastname') ?></label>
									<div class="col-sm-8">
										<input value="<?= $company['owner_lastname'] ?>"
											   name="owner_lastname" type="text" class="form-control form-control-sm"
											   placeholder="<?= lang('owner_lastname') ?>">
									</div>
								</div>

							</div>


							<div class="col-sm-4">
								<div class="row">
									<label class="col-sm-3 col-form-label"
										   style="font-size: 15px;"><?= lang('owner_email') ?></label>
									<div class="col-sm-8">
										<input value="<?= $company['owner_email'] ?>" name="owner_email"
											   type="email" class="form-control form-control-sm"
											   placeholder="<?= lang('owner_email') ?>">
									</div>
								</div>

							</div>


						</div>


					</div>

					<div class="container mt-1">


						<p style="float: left;margin-top: 30px;"
						   class="display-5 font-weight-bold mb-0"><?= lang('account_type') ?></p>


						<hr class="my-2" style="clear: both;">
					</div>
					<div class="col-sm-12 tab-content col-sm-6 col-12" id="nav-tabContent">

						<div class="accordion" id="accordionExample">
							<div class="card">
								<div class="card-header" id="headingOne">
									<h5 class="mb-0">
										<button class="btn btn-sm btn-link text-success p-0" type="button"
												data-toggle="collapse"
												data-target="#collapseOne" aria-expanded="true"
												aria-controls="collapseOne">
											<?= ($company['account_name_1'] != '' ? $company['account_name_1'] : 'N/D') ?>
										</button>
									</h5>
								</div>

								<div id="collapseOne" class="collapse hide"
									 aria-labelledby="headingOne"
									 data-parent="#accordionExample">
									<div class="card-body">
										<div class="row">
											<div class="form-group row mb-1 col-sm-4">
												<label
													class="col-sm-5 col-form-label text-right"><?= lang('account_type') ?></label>
												<div class="col-sm-7">
													<input
														value="<?= $company['account_name_1'] ?>"
														name="account_name_1"
														type="text"
														class="account_number form-control form-control-sm"
														placeholder="<?= lang('account_type') ?>">
												</div>
											</div>

											<div class="form-group row mb-1 col-sm-4">
												<label
													class="col-sm-5 col-form-label text-right"><?= lang('account_number') ?></label>
												<div class="col-sm-7">
													<input
														value="<?= $company['account_number_1'] ?>"
														name="account_number_1"
														type="text"
														class="account_number form-control form-control-sm"
														placeholder="<?= lang('account_number') ?>">
												</div>
											</div>

											<div class="form-group row mb-1 col-sm-4">
												<label
													class="col-sm-6 col-form-label text-right"><?= lang('Correspondent_Bank') ?></label>
												<div class="col-sm-6 p-0">
													<input type="text"
														   name="correspondent_bank_1"
														   class="form-control form-control-sm correspondent_bank"
														   value="<?= $company['correspondent_bank_1'] ?>"
														   placeholder="<?= lang('Correspondent_Bank') ?>">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="form-group row mb-1 col-sm-4">
												<label
													class="col-sm-5 col-form-label text-right"><?= lang('swift_code') ?></label>
												<div class="col-sm-7">
													<input type="text" name="swift_code_1"
														   class="form-control form-control-sm swift_code"
														   value="<?= $company['swift_code_1'] ?>"
														   placeholder="<?= lang('swift_code') ?>">
												</div>
											</div>

											<div class="form-group row mb-1 col-sm-4">
												<label
													class="col-sm-5 col-form-label account_label text-right"><?= lang('account') ?></label>
												<div class="col-sm-7">
													<input type="text"
														   value="<?= $company['account_1'] ?>"
														   name="account_1"
														   class="form-control form-control-sm account"
														   placeholder="<?= lang('account') ?>">
												</div>
											</div>
										</div>


									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-header" id="headingTwo">
									<h5 class="mb-0">
										<button class="btn btn-sm btn-link collapsed text-success p-0" type="button"
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
										<div class="row">
											<div class="form-group row mb-1 col-sm-4">
												<label
													class="col-sm-5 col-form-label"><?= lang('account_type') ?></label>
												<div class="col-sm-7">
													<input
														value="<?= $company['account_name_2'] ?>"
														name="account_name_2"
														type="text"
														class="account_number form-control form-control-sm"
														placeholder="<?= lang('account_type') ?>">
												</div>
											</div>
											<div class="form-group row mb-1 col-sm-4">
												<label
													class="col-sm-5 col-form-label"><?= lang('account_number') ?></label>
												<div class="col-sm-7">
													<input
														value="<?= $company['account_number_2'] ?>"
														name="account_number_2"
														type="text"
														class="account_number form-control form-control-sm"
														placeholder="<?= lang('account_number') ?>">
												</div>
											</div>
											<div class="form-group row mb-1 col-sm-4">
												<label
													class="col-sm-6 col-form-label"><?= lang('Correspondent_Bank') ?></label>
												<div class="col-sm-6 p-0">
													<input type="text"
														   name="correspondent_bank_2"
														   class="form-control form-control-sm correspondent_bank"
														   value="<?= $company['correspondent_bank_2'] ?>"
														   placeholder="<?= lang('Correspondent_Bank') ?>">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="form-group row mb-1 col-sm-4">
												<label class="col-sm-5 col-form-label"><?= lang('swift_code') ?></label>
												<div class="col-sm-7">
													<input type="text"
														   name="swift_code_2"
														   class="form-control form-control-sm swift_code"
														   value="<?= $company['swift_code_2'] ?>"
														   placeholder="<?= lang('swift_code') ?>">
												</div>
											</div>
											<div class="form-group row mb-1 col-sm-4">
												<label
													class="col-sm-5 account_label col-form-label"><?= lang('account') ?></label>
												<div class="col-sm-7">
													<input type="text"
														   name="account_2"
														   class="form-control form-control-sm account"
														   value="<?= $company['account_2'] ?>"
														   placeholder="<?= lang('account') ?>">
												</div>
											</div>
										</div>


	</form>
</div>
</div>
</div>
<div class="card">
	<div class="card-header" id="headingThree">
		<h5 class="mb-0">
			<button class="btn btn-sm btn-link collapsed text-success p-0" type="button"
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

			<div class="row">
				<div class="form-group row mb-1 col-sm-4">
					<label
						class="col-sm-5 col-form-label"><?= lang('account_type') ?></label>
					<div class="col-sm-7">
						<input
							value="<?= $company['account_name_3'] ?>"
							type="text"
							name="account_name_3"
							class="account_number form-control form-control-sm"
							placeholder="<?= lang('account_type') ?>">
					</div>
				</div>


				<div class="form-group row mb-1 col-sm-4">
					<label class="col-sm-5 col-form-label"><?= lang('account_number') ?></label>
					<div class="col-sm-7">
						<input
							value="<?= $company['account_number_3'] ?>"
							type="text"
							name="account_number_3"
							class="account_number form-control form-control-sm"
							placeholder="<?= lang('account_number') ?>">
					</div>
				</div>

				<div class="form-group row mb-1 col-sm-4">
					<label class="col-sm-6 col-form-label"><?= lang('Correspondent_Bank') ?></label>
					<div class="col-sm-6 p-0">
						<input type="text"
							   name="correspondent_bank_3"
							   class="form-control form-control-sm correspondent_bank"
							   value="<?= $company['correspondent_bank_3'] ?>"
							   placeholder="<?= lang('Correspondent_Bank') ?>">
					</div>
				</div>

			</div>
			<div class="row">
				<div class="form-group row mb-1 col-sm-4">
					<label class="col-sm-5 col-form-label"><?= lang('swift_code') ?></label>
					<div class="col-sm-7">
						<input type="text"
							   name="swift_code_3"
							   class="form-control form-control-sm swift_code"
							   value="<?= $company['swift_code_3'] ?>"
							   placeholder="<?= lang('swift_code') ?>">
					</div>
				</div>

				<div class="form-group row mb-1 col-sm-4">
					<label
						class="col-sm-5 account_label col-form-label"><?= lang('account') ?></label>
					<div class="col-sm-7">
						<input type="text"
							   name="account_3"
							   class="form-control form-control-sm account"
							   value="<?= $company['account_3'] ?>"
							   placeholder="<?= lang('account') ?>">
					</div>
				</div>
			</div>


		</div>
	</div>
</div>

<div class="card">
	<div class="card-header" id="headingFour">
		<h5 class="mb-0">
			<button class="btn btn-sm btn-link collapsed text-success p-0" type="button"
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

			<div class="row">

				<div class="form-group row mb-1 col-sm-4">
					<label
						class="col-sm-5 col-form-label"><?= lang('account_type') ?></label>
					<div class="col-sm-7">
						<input
							value="<?= $company['account_name_4'] ?>"
							type="text"
							name="account_name_4"
							class="account_number form-control form-control-sm"
							placeholder="<?= lang('account_type') ?>">
					</div>
				</div>

				<div class="form-group row mb-1 col-sm-4">
					<label class="col-sm-5 col-form-label"><?= lang('account_number') ?></label>
					<div class="col-sm-7">
						<input
							value="<?= $company['account_number_4'] ?>"
							type="text"
							name="account_number_4"
							class="account_number form-control form-control-sm"
							placeholder="<?= lang('account_number') ?>">
					</div>
				</div>

				<div class="form-group row mb-1 col-sm-4">
					<label class="col-sm-6 col-form-label"><?= lang('Correspondent_Bank') ?></label>
					<div class="col-sm-6 p-0">
						<input type="text"
							   name="correspondent_bank_4"
							   class="form-control form-control-sm correspondent_bank"
							   value="<?= $company['correspondent_bank_4'] ?>"
							   placeholder="<?= lang('Correspondent_Bank') ?>">
					</div>
				</div>

			</div>
			<div class="row">
				<div class="form-group row mb-1 col-sm-4">
					<label class="col-sm-5 col-form-label"><?= lang('swift_code') ?></label>
					<div class="col-sm-7">
						<input type="text"
							   name="swift_code_4"
							   class="form-control form-control-sm swift_code"
							   value="<?= $company['swift_code_4'] ?>"
							   placeholder="<?= lang('swift_code') ?>">
					</div>
				</div>

				<div class="form-group row mb-1 col-sm-4">
					<label
						class="col-sm-5 account_label col-form-label"><?= lang('account') ?></label>
					<div class="col-sm-7">
						<input type="text"
							   name="account_4"
							   class="form-control form-control-sm account"
							   value="<?= $company['account_4'] ?>"
							   placeholder="<?= lang('account') ?>">
					</div>
				</div>
			</div>


		</div>
	</div>
</div>
</div>
</div>
</div>

<div class="row" style="position: relative;">
	<div class="form-group mb-0" style="position: absolute;right: 20px;bottom: -60px;"
		 id="requisite">
		<a style="text-decoration: none; color: #1b1e21" target="_blank"
		   href="javascript:void(0)">
			<label
				style="font-weight: 400 !important;width: 100%;margin-top: 23px;font-size: 14px !important;line-height: 14px !important;padding: 10px 15px !important;"
				class="btn btn-sm btn-outline-success text_req">
				<?= lang('download_requisite') ?>
			</label>
		</a>
	</div>
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


<div class="pos_abs_div fixed-bottom text-left pb-2 mt-md-2 mt-2">
	<span id="create_company" class="save_cancel_btn btn btn-success"><?= lang('save') ?></span>
	<span id="load" class="btn save_cancel_btn btn-success d-none"><svg id="loading_svg" width="80" height="20"
																		viewBox="0 0 135 140"
																		xmlns="http://www.w3.org/2000/svg"
																		fill="rgb(255, 122, 89)">
    <rect y="10" width="15" height="120" rx="6">
        <animate attributeName="height"
				 begin="0.5s" dur="1s"
				 values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
				 repeatCount="indefinite"/>
        <animate attributeName="y"
				 begin="0.5s" dur="1s"
				 values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
				 repeatCount="indefinite"/>
    </rect>
    <rect x="30" y="10" width="15" height="120" rx="6">
        <animate attributeName="height"
				 begin="0.25s" dur="1s"
				 values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
				 repeatCount="indefinite"/>
        <animate attributeName="y"
				 begin="0.25s" dur="1s"
				 values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
				 repeatCount="indefinite"/>
    </rect>
    <rect x="60" width="15" height="140" rx="6">
        <animate attributeName="height"
				 begin="0s" dur="1s"
				 values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
				 repeatCount="indefinite"/>
        <animate attributeName="y"
				 begin="0s" dur="1s"
				 values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
				 repeatCount="indefinite"/>
    </rect>
    <rect x="90" y="10" width="15" height="120" rx="6">
        <animate attributeName="height"
				 begin="0.25s" dur="1s"
				 values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
				 repeatCount="indefinite"/>
        <animate attributeName="y"
				 begin="0.25s" dur="1s"
				 values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
				 repeatCount="indefinite"/>
    </rect>
    <rect x="120" y="10" width="15" height="120" rx="6">
        <animate attributeName="height"
				 begin="0.5s" dur="1s"
				 values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
				 repeatCount="indefinite"/>
        <animate attributeName="y"
				 begin="0.5s" dur="1s"
				 values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
				 repeatCount="indefinite"/>
    </rect>
</svg></span>

	<button class="dont_save btn btn-primary"><?= lang('cancel') ?></button>
	<span style="color: #8c8c8c;" class="pl-3"><?= lang('changed_property') ?></span>
</div>


<script src="<?= base_url('assets/js/go.js') ?>"></script>
<script>
	// create company
	$(document).on('click', '#create_company', function (e) {

		var url = '<?=base_url($this->uri->segment(1) . '/Organization/company_ax') ?>';
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

									if (value != tmp) {
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

	$('input,select,textarea').on('change keyup', function () {
		if (!$('.pos_abs_div').hasClass('animated')) {
			$('.pos_abs_div').animate({
				bottom: "+=60",
			});
			$('.pos_abs_div').addClass('animated');
		}
	});

	$('.dont_save').on('click', function () {
		$('.pos_abs_div').removeClass('animated');
		$('.pos_abs_div').animate({
			bottom: "-=60"
		})
	});

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
			$(this).parent('label').children('span').text('<?=lang('download_requisite')?>');
		} else {
			if (upload_file.length > 18) {
				var short_text = text_truncate(upload_file, 18, ' ...');
				$(this).parent('label').children('span').text(short_text);
			} else {
				$(this).parent('label').children('span').text(upload_file);
			}
		}

	});

</script>

<!--reference/-->
<script>

	$(document).on('click', '#requisite', function (e) {

		var url = '<?=base_url($this->uri->segment(1) . '/System_main/reference') ?>';
		e.preventDefault();
		var data = new FormData($('form#company')[0]);


		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'html',
			data: data,
			processData: false,
			contentType: false,
			beforeSend: function () {

				var loadText = '<?=lang('PleaseWait');?>';
				$('.text_req').html(loadText + ' . . .');

			},
			success: function (data, textStatus, jQxhr) {
				window.downloadPDF = function downloadPDF() {
					var dlnk = document.getElementById('dwnldLnk');
					dlnk.href = data;
					dlnk.click();
				};

				downloadPDF();
				$('.text_req').html('<?= lang('download_requisite') ?>');
			},
			error: function (jqXhr, textStatus, errorThrown) {
				console.log('/*/' + errorThrown);
			}
		})
	})

</script>
<a id="dwnldLnk" download="reference.pdf" target="_blank" style="display:none;"/>
<!--end /-->

<script>
	$(".account_number").keydown(function () {
		var label_text = $(this).parent('div').parent('div').parent('div').parent('div').find('.account_label')
		label_text.text('<?= lang("account") ?>*');
	});
</script>
