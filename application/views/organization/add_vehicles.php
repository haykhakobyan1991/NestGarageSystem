<style>
	label {
		font-size: 11px !important;
	}

	.st_inp::before {
		content: "";
		margin-left: -3px;
		margin-top: -3px;
		height: 23px;
		width: 23px;
		border: 3px solid #8c8c8c;
		border-radius: 50%;
		display: inline-block;
		opacity: 1 !important;
	}
	.dropdown.bootstrap-select.col.form-control.form-control-sm.col-sm-7 {
		margin-left: 87px;
	}
	i {
		margin-left: 15px;
	}

	::-webkit-input-placeholder {
		color: peachpuff;
		font-size: 13px;
	}
	::-moz-placeholder {
		color: peachpuff;
		font-size: 13px;
	}
	:-ms-input-placeholder {
		color: peachpuff;
		font-size: 13px;
	}
	::placeholder {
		color: peachpuff;
		font-size: 13px;
	}
</style>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-colorpicker.min.css"/>
<script src="<?= base_url() ?>assets/js/bootstrap-colorpicker.min.js"></script>

<div class="tab-pane fade show active" id="list-company" role="tabpanel" style="padding-top: 10px;padding-bottom: 10px;"
	 aria-labelledby="list-company-list">
	<div class="for_message">
		<div class="alert alert-success d-none " role="alert"></div>
		<div class="alert alert-info d-none " role="alert"></div>
		<div class="alert alert-danger d-none " role="alert"></div>
	</div>
	<form>
		<!-- Error Message -->
		<div class="container-fluid">
			<div class="row">

				<div class="col-sm-8">
					<h5><?= lang('vehicles_information') ?></h5>
					<p><?= lang('fill_followings_fields')   ?></p>
				</div>
				<div class="col-sm-4">
					<div class="row">
						<div class="col-sm-12">
							<div class="row">
								<label class="pl-3 col-form-label col-sm-5 text-right" style="padding-left: 45px !important;
	font-size: 15px !important;"><?=lang('GPS_Exist')?></label>
								<input style="margin-top: 13px;width: 18px;height: 18px;" class="" type="checkbox" name="gps_exist"  value="1" id="fleet_type"/>

								<div class="col-sm-6">
									<input value="" name="gps_tracker_imei" type="text" class="form-control form-control-sm" placeholder="<?=lang('GPS_Tracker_IMEI')?>">
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
			<hr class="my-2" style="margin-top: -10px !important;">
		</div>

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-4">
					<div class="row getChild"
						 data-url="<?= base_url('System_main/get_child') ?>"
						 data-result="model_div"
						 data-response="model"
						 data-res_type="select"
						 data-lang="<?= $lang ?>"
						 id="brand">

						<label class="col-sm-4 col-form-label"><?=lang('brand')?> * </label>
						<select name="brand"
								class="col-sm-7 selectpicker form-control form-control-sm "
								data-size="5" id="brand" data-live-search="true"
								title="<?=lang('select_car_brand')?>">
							<? foreach ($brand as $row) : ?>
								<option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
							<? endforeach; ?>
						</select>
					</div>

					<div class="row" id="model_div" style="margin-top: .75rem;">
						<label
							class=" col-form-label col-sm-2"><?=lang('model')?> *</label>

						<select name="model"
								class="col selectpicker form-control form-control-sm col-sm-7"
								data-size="5" id="model" data-live-search="true"
								title="<?=lang('select_car_model')?>">

						</select>
					</div>

					<div class="row" style="margin-top: .75rem!important;">
						<label class="col-sm-4 col-form-label"><?=lang('type')?> *</label>

						<select name="fleet_type"
								class="col-sm-7 currency form-control form-control-sm selectpicker"
								data-size="5" id="fleet_type" data-live-search="true"
								title="<?=lang('select_car_type')?>"
						>
							<? foreach ($fleet_type as $row) : ?>
								<option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
							<? endforeach; ?>
						</select>
					</div>
					<div class="row" style="margin-top: .75rem!important;">
						<label class="col-form-label col-sm-4"><?=lang('year')?> *</label>

						<select name="production_date"
								class="currency form-control form-control-sm selectpicker col-sm-7"
								data-size="5"
								data-live-search="true"
								title="<?=lang('choose')?>..."
						>
							<?php for ($i = 1980; $i <= date('Y'); $i++) : ?>
								<option value="<?= $i ?>"><?= $i ?></option>
							<?php endfor; ?>

						</select>
					</div>
					<div class="row" style="margin-top: .75rem!important;">
						<label class="pl-3 col-form-label col-sm-4" style="font-size: 15px;"><?=lang('engine_power')?></label>
						<input value="" min="0" step="0.1" name="engine_power" type="number"
							   class="form-control form-control-sm col-sm-7"
							   placeholder="<?=lang('engine_power')?>">
					</div>
				</div>

				<div class="col-sm-4">
					<div class="row">
						<label class="pl-3 col-form-label col-sm-4" style="font-size: 15px;"><?=lang('fuel')?></label>
						<select name="fuel"
								class="form-control form-control-sm selectpicker col-sm-7"
								data-size="5" id="fleet_type" data-live-search="true"
								title="<?=lang('fuel_type')?>"
						>
							<? foreach ($fuel as $row) : ?>
								<option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
							<? endforeach; ?>
						</select>
					</div>
					<div class="row" style="margin-top: .75rem!important;">
						<label class="col-sm-4 pl-3 col-form-label" style="font-size: 15px;"><?=lang('average_expense_100_km')?></label>
						<input value="" min="0" name="fuel_avg_consumption" type="number"
							   class="form-control form-control-sm col-sm-7"
							   placeholder="<?=lang('average_expense_100_km')?>">
					</div>
					<div class="row mt-1">
						<label
							class="pl-3 col-form-label col-sm-4" style="font-size: 15px;"><?=lang('running')?></label>
						<input value="" min="0" name="mileage" type="number"
							   class="form-control form-control-sm col-sm-7"
							   placeholder="<?=lang('running')?>">
					</div>
					<div class="row mt-1">
						<label
							class="pl-3 col-form-label col-sm-4" style="font-size: 15px;"><?=lang('odometer')?></label>
						<input value="" name="odometer" type="text" class="form-control form-control-sm col-sm-7"
							   placeholder="<?=lang('odometer')?>">
					</div>

				</div>

				<div class="col-sm-3">
					<div class="row">
						<div id="cp2" class="input-group colorpicker-component col-sm-12">
							<label class="pl-3 col-form-label col-sm-3"
								   style="font-size: 15px;padding: 6px;margin-left: -9px;"><?=lang('color')?></label>
							<input name="color" type="text" value="#00AABB" class="form-control selected_color_value"/>
							<span class="input-group-addon col-sm-5"><i
									style="padding: 18px;margin-left: 10px;border-radius: 50%;"></i></span>
						</div>
					</div>
					<div class="row mt-1">
						<label class="pl-4 col-form-label col-sm-3" style="font-size: 15px;"><?=lang('vin')?></label>
						<input value="" name="vin" type="text" class="form-control form-control-sm col-sm-7"
							   placeholder="VIN">
					</div>

					<div class="row mt-1">
						<label class="pl-4 col-form-label col-sm-3"><?=lang('attached')?>*</label>
						<div class="col-sm-7 p-0">
							<select name="staff[]"
									class="col  selectpicker form-control form-control-sm"
									id="staff"
									multiple data-live-search="true"
									title="<?=lang('select_a_staff')?>">
								<? foreach ($staff_for_select as $row) : ?>
									<option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
								<? endforeach; ?>
							</select>
						</div>
					</div>


				</div>

			</div>
			<hr class="my-2">
		</div>

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-2">
					<div class="row">
						<label
							class="col-sm-3 col-form-label pl-3 text-center" style="font-size: 15px;padding-top: 10px;"><?=lang('car_number_abbr')?></label>
						<input value="" name="fleet_plate_number" type="text"
							   class="form-control form-control-sm col-sm-9"
							   placeholder="<?=lang('car_number')?>">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="row">
						<label
							class="col-form-label col-sm-5 text-right" style="font-size: 15px;padding-top: 10px;"><?=lang('registration_address')?></label>
						<input value="" name="regitered_address" type="text"
							   class="col-sm-7 form-control form-control-sm"
							   placeholder="<?=lang('registration_address')?>">
					</div>
				</div>
				<div class="col-sm-3">
					<div class="row">
						<label class="col-sm-5 col-form-label text-right" style="font-size: 15px;padding-top: 10px;"><?=lang('owner')?></label>
						<input style="" value="" name="owner" type="text"
							   class="form-control form-control-sm col-sm-7"
							   placeholder="<?=lang('owner')?>">
						<input name="owner_id" type="hidden">
					</div>
				</div>
				<div class="col-sm-4">
					<label class="col-sm-6 col-form-label text-right" style="font-size: 15px;padding-top: 10px;"><?=lang('appendix_copy')?></label>
					<label
						style="margin-left: 30px;font-size: 14px !important;line-height: 14px !important;padding: 12px 24px !important;font-weight: 500 !important;min-width: 111px; max-width: 111px;"
						class="btn btn-sm btn-outline-success">
						<span><?=lang('browse')?></span>
						<input type="file"
							   name="regitered_file"
							   class="d-none form-control-file btn_input"
							   hidden style="display: none;"
							   id="exampleFormControlFile1">
					</label>
				</div>
			</div>
			<hr class="my-2">
		</div>

		<div class="container-fluid">
			<textarea name="other" rows="2" class="form-control form-control-sm col-sm-12" placeholder="<?=lang('other')?>"></textarea>
		</div>
		<div class="container-fluid">
			<div class="row">
				<label class="col-sm-3 col-form-label"><?=lang('status_make_passive') ?></label>
				<div class="col-sm-1">
					<input style="width: 18px;height: 18px;margin-left: -210px;margin-top: 7px;" value="-1"
						   name="status" type="checkbox"
						   class="form-control form-control-sm ">
				</div>
			</div>

		</div>
		<div class="container-fluid">
			<div class="row">
				<label class="col-sm-3 col-form-label"><?=lang('send_email_to_new_driver')?></label>
				<div class="col-sm-1">
					<input style="width: 18px;height: 18px;margin-left: -90px;margin-top: 7px;" name="mail_to"
						   value="1" type="checkbox"
						   class="form-control form-control-sm ">
				</div>
			</div>
			<hr class="my-2">
		</div>




		<div class="row">
			<div class="col-md-12 col-md-6 ">

				<!-- Main Start -->
				<!-- Main End -->

				<!-- Info Star -->
				<div class="">

					<!-- Acardion -->
					<div class="row">

						<div class="accordion  col-sm-8" id="accordionExample_info" style="padding-left: 30px;">

							<div class="card">
								<div class="card-header p-0" id="heading_info1">
									<h5 class="mb-0">
										<button class="btn btn-link collapsed" type="button"
												data-toggle="collapse" data-target="#collapse_info1"
												aria-expanded="false" aria-controls="collapse_info1">
											N/D
										</button>
									</h5>
								</div>
								<div id="collapse_info1" class="collapse show" aria-labelledby="heading_info1"
									 data-parent="#accordionExample_info">
									<div class="card-body">
										<div class="add_new_items">
											<div class="row">

												<div class="col-md-2">
													<div class="form-group">
														<label><?=lang('company')?></label>
														<input type="text"
															   name="company[1]"
															   class="form-control form-control-sm"
															   placeholder="<?=lang('company')?>">
													</div>
												</div>

												<div class="col-1">
													<div class="form-group">
														<label
															style="margin-left: -22px;width: 95px;margin-top: 23px;font-size: 14px !important;line-height: 14px !important;padding: 10px 15px !important;font-weight: 500 !important;"
															class="btn btn-sm btn-outline-secondary">
															<span><?=lang('browse')?></span>
															<input class="btn_input"
																   name="file_1" type="file"
																   hidden style="display: none;"
																   value="">
														</label>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label><?=lang('reference')?></label>
														<input type="text"
															   name="reference[1]"
															   class="form-control form-control-sm"
															   placeholder="<?=lang('reference')?>">
													</div>
												</div>

												<div class="col-md-3">
													<label><?=lang('expiry_date')?></label>
													<input type="date" name="expiration[1]"
														   max="3000-12-31"
														   min="1000-01-01"

														   class="form-control form-control-sm">
												</div>

												<div class="col-sm-3">
													<label
														class="col-form-label"
														style="font-size: 12px;margin-top: -10px;"><?=lang('type')?></label>
													<div class="">
														<select name="type[1]"
																class="selectpicker form-control form-control-sm dif_meter"
																data-live-search="true"
																data-size="5"
																title="<?=lang('incurance_taype')?>"
														>
															<? foreach ($insurance_type as $row) : ?>
																<option
																	value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
															<? endforeach; ?>
														</select>
													</div>
												</div>

											</div>


										</div>
									</div>
								</div>
							</div>

							<div class="card">
								<div class="card-header p-0" id="heading_info2">
									<h5 class="mb-0">
										<button class="btn btn-link collapsed" type="button"
												data-toggle="collapse" data-target="#collapse_info2"
												aria-expanded="false" aria-controls="collapse_info2">
											N/D
										</button>
									</h5>
								</div>
								<div id="collapse_info2" class="collapse" aria-labelledby="heading_info2"
									 data-parent="#accordionExample_info">
									<div class="card-body">
										<div class="add_new_items">
											<div class="row">

												<div class="col-md-2">
													<div class="form-group">
														<label><?=lang('company')?></label>
														<input type="text"
															   name="company[2]"
															   class="form-control form-control-sm"
															   placeholder="<?=lang('company')?>">
													</div>
												</div>

												<div class="col-1">
													<div class="form-group">
														<label
															style="margin-left: -22px;width: 95px;margin-top: 23px;font-size: 14px !important;line-height: 14px !important;padding: 10px 15px !important;font-weight: 500 !important;"
															class="btn btn-sm btn-outline-secondary">
															<span><?=lang('browse')?></span>
															<input class="btn_input"
																   name="file_2" type="file"
																   hidden style="display: none;"
																   value="">
														</label>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label>Reference</label>
														<input type="text"
															   name="reference[2]"
															   class="form-control form-control-sm"
															   placeholder="<?=lang('reference')?>">
													</div>
												</div>

												<div class="col-md-3">
													<label><?=lang('expiry_date')?></label>
													<input type="date" name="expiration[2]"
														   max="3000-12-31"
														   min="1000-01-01"

														   class="form-control form-control-sm">
												</div>

												<div class="col-sm-3">
													<label
														class="col-form-label"
														style="font-size: 12px;margin-top: -10px;"><?=lang('type')?></label>
													<div class="">
														<select name="type[2]"
																class="selectpicker form-control form-control-sm dif_meter"
																data-live-search="true"
																data-size="5"
																title="<?=lang('incurance_taype')?>"
														>
															<? foreach ($insurance_type as $row) : ?>
																<option
																	value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
															<? endforeach; ?>
														</select>
													</div>
												</div>

											</div>


										</div>
									</div>
								</div>
							</div>

							<div class="card">
								<div class="card-header p-0" id="heading_info3">
									<h5 class="mb-0">
										<button class="btn btn-link collapsed" type="button"
												data-toggle="collapse" data-target="#collapse_info3"
												aria-expanded="false" aria-controls="collapse_info3">
											N/D
										</button>
									</h5>
								</div>
								<div id="collapse_info3" class="collapse" aria-labelledby="heading_info3"
									 data-parent="#accordionExample_info">
									<div class="card-body">
										<div class="add_new_items">
											<div class="row">

												<div class="col-md-2">
													<div class="form-group">
														<label><?=lang('company')?></label>
														<input type="text"
															   name="company[3]"
															   class="form-control form-control-sm"
															   placeholder="<?=lang('company')?>">
													</div>
												</div>

												<div class="col-1">
													<div class="form-group">
														<label
															style="margin-left: -22px;width: 95px;margin-top: 23px;font-size: 14px !important;line-height: 14px !important;padding: 10px 15px !important;font-weight: 500 !important;"
															class="btn btn-sm btn-outline-secondary">
															<span><?=lang('browse')?></span>
															<input class="btn_input"
																   name="file_3" type="file"
																   hidden style="display: none;"
																   value="">
														</label>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label><?=lang('reference')?></label>
														<input type="text"
															   name="reference[3]"
															   class="form-control form-control-sm"
															   placeholder="<?=lang('reference')?>">
													</div>
												</div>

												<div class="col-md-3">
													<label><?=lang('expiry_date')?></label>
													<input type="date" name="expiration[3]"
														   max="3000-12-31"
														   min="1000-01-01"

														   class="form-control form-control-sm">
												</div>

												<div class="col-sm-3">
													<label
														class="col-form-label"
														style="font-size: 12px;margin-top: -10px;"><?=lang('type')?></label>
													<div class="">
														<select name="type[3]"
																class="selectpicker form-control form-control-sm dif_meter"
																data-live-search="true"
																data-size="5"
																title="<?=lang('incurance_taype')?>"
														>
															<? foreach ($insurance_type as $row) : ?>
																<option
																	value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
															<? endforeach; ?>
														</select>
													</div>
												</div>

											</div>


										</div>
									</div>
								</div>
							</div>

							<div class="card">
								<div class="card-header p-0" id="heading_info4">
									<h5 class="mb-0">
										<button class="btn btn-link collapsed" type="button"
												data-toggle="collapse" data-target="#collapse_info4"
												aria-expanded="false" aria-controls="collapse_info4">
											N/D
										</button>
									</h5>
								</div>
								<div id="collapse_info4" class="collapse" aria-labelledby="heading_info4"
									 data-parent="#accordionExample_info">
									<div class="card-body">
										<div class="add_new_items">
											<div class="row">

												<div class="col-md-2">
													<div class="form-group">
														<label><?=lang('company')?></label>
														<input type="text"
															   name="company[4]"
															   class="form-control form-control-sm"
															   placeholder="<?=lang('company')?>">
													</div>
												</div>

												<div class="col-1">
													<div class="form-group">
														<label
															style="margin-left: -22px;width: 95px;margin-top: 23px;font-size: 14px !important;line-height: 14px !important;padding: 10px 15px !important;font-weight: 500 !important;"
															class="btn btn-sm btn-outline-secondary">
															<span><?=lang('browse')?></span>
															<input class="btn_input"
																   name="file_4" type="file"
																   hidden style="display: none;"
																   value="">
														</label>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label><?=lang('reference')?></label>
														<input type="text"
															   name="reference[4]"
															   class="form-control form-control-sm"
															   placeholder="<?=lang('reference')?>">
													</div>
												</div>

												<div class="col-md-3">
													<label><?=lang('expiry_date')?></label>
													<input type="date" name="expiration[4]"
														   max="3000-12-31"
														   min="1000-01-01"

														   class="form-control form-control-sm">
												</div>

												<div class="col-sm-3">
													<label
														class="col-form-label"
														style="font-size: 12px;margin-top: -10px;"><?=lang('type')?></label>
													<div class="">
														<select name="type[4]"
																class="selectpicker form-control form-control-sm dif_meter"
																data-live-search="true"
																data-size="5"
																title="<?=lang('incurance_taype')?>"
														>
															<? foreach ($insurance_type as $row) : ?>
																<option
																	value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
															<? endforeach; ?>
														</select>
													</div>
												</div>

											</div>


										</div>
									</div>
								</div>
							</div>

						</div>

						<div class="col-sm-4">
							<h6 class="ml-2 mb-md-2 mb-2"><?= lang('kilometer_per_day'); ?></h6>
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-6">
										<label
											class="col-form-label"
											style="font-size: 12px;"><?= lang('type_of_meter') ?></label>
										<select name="value_1"
												class="selectpicker form-control form-control-sm dif_meter"
												data-size="5"
												title="<?= lang('choose') ?>..."
										>
											<?
											foreach ($value as $row) :
												if ($row['type'] == 1) :
													?>
													<option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
												<?
												endif;
											endforeach;
											?>
										</select>
									</div>

									<div class="col-sm-4 mt-4">
										<div class="row">
											<input name="value1_day" type="number" class="mt-2 form-control form-control-sm col-sm-7" placeholder=""/>
											<p style="margin-left: 10px;margin-top: 13px;" col-sm-4><span class="dif_meter_text"></span>/<?= lang('day') ?></p>
										</div>


									</div>
								</div>

								<div class="form-group form-check  mb-1">
									<input name="auto_increment" value="1" type="checkbox" class="form-check-input"
										   id="exampleCheck1">
									<label class="form-check-label"
										   for="exampleCheck1"><?= lang('auto_increment'); ?></label>
								</div>


							</div>




							<div class="col-sm-12">
								<div class="card">
									<h6 class="card-header"><?= lang('secondary_meter') ?></h6>
									<div class="form-group form-check ml-md-3 ml-3 mt-md-2 mt-2">
										<input name="use_of_secondary_meter" value="1" type="checkbox"
											   class="form-check-input"
											   id="exampleCheck11">
										<label class="form-check-label"
											   for="exampleCheck11"><?= lang('Use_of_secondary_meter') ?></label>
									</div>
									<div class="card-body pt-0">
										<div class="form-group  mb-0">

											<label
												class="col-form-label"
												style="font-size: 12px;"><?= lang('type_of_meter') ?></label>
											<div>
												<select name="value_2"
														class="selectpicker form-control form-control-sm "
														data-size="5"
														title="<?= lang('choose') ?>..."
												>
													<?
													$convert = '';
													foreach ($value as $row) :
														if ($row['type'] == 1) :
															$convert .= '<input type="hidden" name="convert[' . $row['id'] . ']" value="' . $row['convert'] . '">';
															?>
															<option value="<?= $row['id'] ?>">
																<?= $row['title'] ?>
															</option>

														<?
														endif;
													endforeach;
													?>
												</select>
												<?= $convert ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="container-fluid">
						<hr class="my-2">
						<h5 class="mt-2 mb-1"><?=lang('other_info')?></h5>
						<table class="vehicle table table-striped table-hover">
							<thead>
							<tr>
								<th scope="col"><?=lang('item_name')?> *</th>
								<th scope="col"><?=lang('value')?> *
									<small>(<?=lang('KM\Days\Months')?>)</small>
								</th>
								<th scope="col"><?=lang('explotation')?> *</th>
								<th scope="col"><?=lang('per_day')?> *</th>
								<th scope="col"><?=lang('more_info')?></th>
								<th scope="col"><?=lang('day_before')?> *</th>
								<th scope="col"><?=lang('start_alarm_day')?> *</th>
								<th scope="col"></th>
							</tr>
							</thead>
							<tbody class="new_items_tbody">
							<tr>
								<td>
									<input name="item[1]" class="form-control form-control-sm" type="text"
										   placeholder="<?=lang('item_name')?>"
										   value="">
								</td>
								<td>
									<select name="value[1]"
											class="selectpicker form-control form-control-sm dif_meter"
											data-live-search="true"
											data-size="5"
											title="<?=lang('select_value')?>"
									>
										<? foreach ($value as $row) : ?>
											<option
												value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
										<? endforeach; ?>
									</select>
								</td>
								<td>
									<input name="avg_exploitation[1]" class="form-control form-control-sm"
										   type="number"
										   placeholder="<?=lang('explotation')?>" value=""/>
								</td>

								<td>
									<input name="per_days[1]" class="form-control form-control-sm"
										   type="number"
										   placeholder="<?=lang('per_day')?>" value=""/>
								</td>
								<td>
									<input name="more_info[1]" class="form-control form-control-sm"
										   type="text"
										   placeholder="<?=lang('more_info')?>" value=""/>
								</td>
								<td>
									<input name="remind_before[1]" class="form-control form-control-sm"
										   type="number"
										   placeholder="<?=lang('day_before')?>"/>
								</td>
								<td>
									<input name="start_alarm_date[1]" class="form-control form-control-sm" type="date"
										   value=""/>
								</td>
								<td>
									<button type="button" class="btn btn-outline-success btn-sm add_new_item" style="font-size: 14px !important;line-height: 14px !important;padding: 7px 8px !important;
    font-weight: 500 !important;"><i style="margin: 0 !important;" class="fa fa-plus"></i></button>

								</td>
							</tr>
							</tbody>
						</table>

						<hr class="my-2">

					</div>
				</div>
				<!-- Info End -->
			</div>
		</div>
	</form>
</div>


<div id="scripts"></div>

<div class="pos_abs_div fixed-bottom text-left pb-2 mt-md-2 mt-2">
	<span id="submit" class="save_cancel_btn btn btn-success"><?= lang('save') ?></span>
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
<script src="<?= base_url('assets/js/bootstrap/typeahead.js') ?>"></script>
<script>

	// create company
	$(document).on('click', '#submit', function (e) {



		var url = '<?=base_url($this->uri->segment(1) . '/Organization/add_vehicles_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form')[0]);
		$('input').removeClass('border border-danger');
		$('select').parent('div').children('button').removeClass('border border-danger');
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function () {
				close_message();
				scroll_top();
				loading('start', 'submit');
				$('.alert-info').removeClass('d-none');
				$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');
			},
			success: function (data) {
				if (data.success == '1') {

					// scroll_top();
					$('.alert-success').removeClass('d-none');
					$('.alert-info').addClass('d-none');
					$('.alert-danger').addClass('d-none');
					$('.alert-success').text(data.message);
					close_message();
					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/vehicles')?>";
					$(location).attr('href', url);

				} else {
					$('.alert-info').addClass('d-none');

					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'submit');
						errors = '';
						tmp = '';
						$.each(data.error.elements, function (index) {
							$.each(data.error.elements[index], function (index, value) {
								if (value != '') {
									$('input[name="' + index + '"]').addClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').children('button').addClass('border border-danger');
									close_message();
									$('.alert-danger').removeClass('d-none');

									if (value != tmp) {
										errors += value;
									}
									tmp = value;

								} else {
									$('input[name="' + index + '"]').removeClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').children('button').removeClass('border border-danger');
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
				$('.alert-info').addClass('d-none');
				console.log('ERRORS: ' + textStatus);
			},
			complete: function () {
			}
		});
	});

	var n = 2;
	$('.add_new_item').click(function () {


		$('.new_items_tbody').append(
			'<tr>\n' +
			'<td>\n' +
			'<input name="item[' + n + ']" class="form-control form-control-sm" type="text"\n' +
			'   placeholder="<?=lang('item_name')?>"\n' +
			'   value="">\n' +
			'</td>\n' +
			'<td>\n' +
			'<select name="value[' + n + ']"\n' +
			'class="selectpicker form-control form-control-sm dif_meter"\n' +
			'data-live-search="true"\n' +
			'data-size="5"\n' +
			'title="Select a value">\n' +
			'<? foreach ($value as $row) : ?>\n' +
			'<option\n' +
			'value="<?= $row['id'] ?>"><?= $row['title'] ?></option>\n' +
			'<? endforeach; ?>\n' +
			'</select>' +
			'</td>\n' +
			'<td>\n' +
			'<input name="avg_exploitation[' + n + ']" class="form-control form-control-sm"\n' +
			'type="number"\n' +
			'placeholder="Avg. <?=lang('explotation')?>" />\n' +
			'</td>\n' +
			'\n' +
			'<td>\n' +
			'<input name="per_days[' + n + ']" class="form-control form-control-sm"\n' +
			'   type="number"\n' +
			'   placeholder="<?=lang('per_day')?>" value=""/>\n' +
			'</td>\n' +
			'<td>\n' +
			'<input name="more_info[' + n + ']" class="form-control form-control-sm"\n' +
			'   type="text"\n' +
			'   placeholder="<?=lang('more_info')?> value=""/>\n' +
			'</td>\n' +
			'<td>\n' +
			'<input name="remind_before[' + n + ']" class="form-control form-control-sm"\n' +
			'   type="number"\n' +
			'   placeholder="<?=lang('day_before')?>" value=""/>\n' +
			'</td>\n' +
			'<td>\n' +
			'<input name="start_alarm_date[' + n + ']" class="form-control form-control-sm" type="date"\n' +
			'   value=""/>\n' +
			'</td>\n' +
			'<td>\n' +
			'<button type="button" class="btn btn-sm btn-light del_items_from_table">\n' +
			'<i style="margin: 0 !important;" class="fa fa-trash"></i>\n' +
			'</button>\n' +
			'</td>\n' +
			'<script>' +
			'$(\'select[name="value[' + n + ']"]\').selectpicker(\'refresh\');' +
			'</' +
			'script>\n' +
			'</tr>'
		);


		$('.selectpicker').parent('div').children('button').css({
			'background': 'rgb(255, 255, 255)',
			'color': 'rgb(108, 117, 125)',
			'border': '1px solid rgb(206, 212, 218)'
		});


		n++;
	});


	$(document).on('click', '.del_items_from_table', function () {
		$(this).parent('td').parent('tr').remove();
	});
	$('.dif_meter').on('change', function () {
		$('.dif_meter_text').text($(this).children('option:selected').text());

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
			$(this).parent('label').children('span').text('<?=lang('browse')?>');
		} else {
			if (upload_file.length > 13) {
				var short_text = text_truncate(upload_file, 13, ' ...');
				$(this).parent('label').children('span').text(short_text);
			} else {
				$(this).parent('label').children('span').text(upload_file);
			}
		}

	});

	// search in staff
	var url_owner = '<?=base_url('System_main/search_owner/')?>';
	var user_id = '<?=$this->session->user_id?>';

	$.get(url_owner, {user_id: user_id}, function (data) {
		// use a data source with 'id' and 'name' keys
		$("input[name=\"owner\"]").typeahead({

			source: function (query, process) {
				objects = [];
				map = {};
				$.each(data, function (i, object) {
					map[object.name] = object;
					objects.push(object.name);
				});
				process(objects);

				$('input[name="owner_id"]').val('');
			},
			updater: function (item) {
				$('input[name="owner_id"]').val(map[item].id);
				return item;
			}
		});
	}, 'json');

	$(document).ready(function () {
		$('.sample-selector').colorpicker({/*options...*/});
		$(function () {
			$('#cp2').colorpicker();
		});

	})


$(window).on('load', function () {
	$(document).on('change keyup','input,select,textarea', function () {
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
		}, function () {
			location.reload();
		})
	});
})


</script>
