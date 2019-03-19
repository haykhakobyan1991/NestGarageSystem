<? $folder = $this->session->folder; ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css"/>
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
	i {
		margin-left: 15px;
	}
	.card-header {
		padding: 0 !important;
	}
	button.btn.dropdown-toggle.bs-placeholder {
		height: 39px;
		background: rgb(255, 255, 255);
		color: rgb(108, 117, 125);
		border: 1px solid rgb(206, 212, 218);
	}
	.btn.dropdown-toggle {
		height: 37px !important;
	}
	.a_ext > i {
		font-size: 27px;
		padding-top: 5px !important;
		margin-right: 40px !important;
	}
	#model_div label {
		flex: 0 0 33.333333%;
		max-width: 33.333333%;
	}
	.a_ext1 > i {
		font-size: 27px;
		padding-top: 27px !important;
	}
</style>

<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-colorpicker.min.css"/>
<script src="<?= base_url() ?>assets/js/bootstrap-colorpicker.min.js"></script>
<div class="tab-pane fade show active" id="list-company" role="tabpanel" style="padding-top: 10px;padding-bottom: 10px;"
	 aria-labelledby="list-company-list">
	<form>

		<div class="for_message">
			<div class="alert alert-success d-none " role="alert"></div>
			<div class="alert alert-danger d-none " role="alert"></div>
			<div class="alert alert-info d-none " role="alert"></div>
		</div>
		<input type="hidden" name="fleet_id" value="<?= $fleet['id'] ?>">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-8">
					<h5><?= lang('vehicles_information') ?></h5>
					<p><?= lang('fill_followings_fields') ?></p>
				</div>
				<div class="col-sm-4">
					<div class="row">

						<div class="col-sm-12">

							<div class="row">
								<label class="pl-3 col-form-label col-sm-5 text-right" style="padding-left: 45px !important;
    font-size: 15px !important;"><?= lang('GPS_Exist') ?></label>
								<input style="margin-top: 13px;width: 18px;height: 18px;" type="checkbox"
									   name="gps_exist"
									   value="1" <?= $fleet['gps_tracker_exists'] == 1 ? 'checked' : '' ?>
									   id="fleet_type"/>
								<div class="col-sm-6">
									<input value="<?= $fleet['gps_tracker_imei'] ?>" name="gps_tracker_imei" type="text"
										   class="form-control form-control-sm"
										   placeholder="<?= lang('GPS_Tracker_IMEI') ?>">
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
					<div class="row">
						<div class="w-100 getChild" style="padding-right: 6px;"
							 data-url="<?= base_url($lang.'/System_main/get_child') ?>"
							 data-result="model_div"
							 data-response="model"
							 data-res_type="select"
							 data-lang="<?= $lang ?>"
							 id="brand"
						>
							<label class="col-sm-4 col-form-label"><?= lang('brand') ?> * </label>
							<select name="brand"
									class="col-sm-7 selectpicker form-control form-control-sm "
									data-size="5" id="brand" data-live-search="true"
									title="<?= lang('select_car_brand') ?>">
								<? foreach ($brand as $row) : ?>
									<option
										value="<?= $row['id'] ?>"
										<?= ($fleet['brand_id'] == $row['id'] ? 'selected' : '') ?>
									>
										<?= $row['title'] ?>
									</option>
								<? endforeach; ?>
							</select>
						</div>
					</div>

					<div class="row" id="model_div" style="margin-top: .75rem;">
						<label class=" col-form-label col-sm-2"><?= lang('model') ?>*</label>

						<select name="model"
								class="col selectpicker form-control form-control-sm col-sm-7"
								data-size="5" id="model" data-live-search="true"
								title="<?= lang('select_car_model') ?>">
							<? foreach ($model as $row) : ?>
								<option
									value="<?= $row['id'] ?>"
									<?= ($fleet['model_id'] == $row['id'] ? 'selected' : '') ?>
								>
									<?= $row['title'] ?>
								</option>
							<? endforeach; ?>
						</select>
					</div>
					<div class="row" style="margin-top: .75rem!important;">
						<label
							class="col-sm-4 col-form-label"><?= lang('type') ?> *</label>

						<select name="fleet_type"
								class="currency form-control form-control-sm selectpicker col-sm-7"
								data-size="5" id="fleet_type" data-live-search="true"
								title="<?= lang('select_car_type') ?>"
						>

							<? foreach ($fleet_type as $row) : ?>
								<option class="fleet_type"
										value="<?= $row['id'] ?>"
									<?= ($fleet['fleet_type_id'] == $row['id'] ? 'selected' : '') ?>
								>
									<?= $row['title'] ?>
								</option>
							<? endforeach; ?>
						</select>
					</div>
					<div class="row" style="margin-top: .75rem!important;">
						<label
							class="col-form-label col-sm-4"><?= lang('year') ?> *</label>

						<select name="production_date"
								class="currency form-control form-control-sm selectpicker col-sm-7"
								data-size="5"
								data-live-search="true"
								title="<?= lang('choose') ?>..."
						>
							<?php for ($i = 1985; $i <= date('Y'); $i++) : ?>
								<option
									value="<?= $i ?>"
									<?= ($fleet['production_date'] == $i ? 'selected' : '') ?>
								>
									<?= $i ?>
								</option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="row" style="margin-top: .75rem!important;">
						<label class="col-sm-4 col-form-label"><?= lang('engine_power') ?></label>
						<input value="<?= $fleet['engine_power'] ?>" min="0" step="0.1" name="engine_power"
							   type="number" class="form-control form-control-sm col-sm-7"
							   placeholder="<?= lang('engine_power') ?>">
					</div>
				</div>
				<div class="col-sm-4">
					<div class="row">

						<label
							class="col-sm-5 col-form-label"><?= lang('fuel') ?></label>

						<select name="fuel"
								class="form-control form-control-sm selectpicker col-sm-7"
								data-size="5" id="fleet_type" data-live-search="true"
								title="<?= lang('fuel_type') ?>"
						>
							<? foreach ($fuel as $row) : ?>
								<option
									value="<?= $row['id'] ?>"
									<?= ($fleet['fuel_id'] == $row['id'] ? 'selected' : '') ?>
								>
									<?= $row['title'] ?>
								</option>
							<? endforeach; ?>
						</select>
					</div>
					<div class="row" style="margin-top: .75rem!important;">

						<label class="col-sm-5 col-form-label"><?= lang('average_expense_100_km') ?></label>

						<input value="<?= $fleet['fuel_avg_consumption'] ?>" min="0" name="fuel_avg_consumption"
							   type="number" class="form-control form-control-sm col-sm-7"
							   placeholder="<?= lang('average_expense_100_km') ?>">

					</div>

					<div class="row" id="second" style="margin-top: .5rem!important; <?=(($fleet['fuel_id'] == 5 || $fleet['fuel_id'] == 6) ? 'display: flex' : 'display: none')?>">

						<label class="col-sm-5 col-form-label"><?= lang('average_expense_100_km') ?></label>

						<input value="<?= $fleet['fuel_avg_consumption_second'] ?>" min="0" name="fuel_avg_consumption_second"
							   type="number" class="form-control form-control-sm col-sm-7"
							   placeholder="<?= lang('average_expense_100_km') ?>">

					</div>

					<div class="row" style="margin-top: .4rem !important;">
						<label class="pl-3 col-form-label col-sm-5"
							   style="font-size: 15px;"><?= lang('running') ?></label>
						<input value="<?= $fleet['mileage'] ?>" min="0" name="mileage" type="number"
							   class="form-control form-control-sm col-sm-5" placeholder="<?= lang('running') ?>">
						<select name="mileage_value"
								class="form-control form-control-sm selectpicker mt_custom-1 col-sm-2" data-size="5"><?
							foreach ($value as $row) :
								if ($row['type'] == 1) :?>
									<option <?= $fleet['mileage_value_id'] == $row['id'] ? 'selected' : '' ?>
										value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
								<?
								endif;
							endforeach; ?>
						</select>
					</div>
					<!--					<div class="row mt-1">-->
					<!--						<label class="pl-3 col-form-label col-sm-4" style="font-size: 15px;">-->
					<? //= lang('odometer') ?><!--</label>-->
					<!--						<input value="-->
					<? //= $fleet['odometer'] ?><!--" name="odometer" type="text" class="form-control form-control-sm col-sm-7" placeholder="-->
					<? //= lang('odometer') ?><!--">-->
					<!--					</div>-->
					<!--					todo-->

				</div>

				<div class="col-sm-3">
					<div class="row">
						<label class="pl-4 col-form-label col-sm-4"
							   style="font-size: 15px;"><?= lang('color') ?> *</label>
						<select name="color" class="selectpicker form-control form-control-sm col-sm-7" id="staff"
								data-size="5"
								data-live-search="true" title="<?= lang('color') ?>">
							<? foreach ($fleet_color as $row) : ?>
								<option <?= ($fleet['color'] == $row['color_code'] ? 'selected' : '') ?>
									value="<?= $row['color_code'] ?>"><?= $row['title'] ?></option>
							<? endforeach; ?>
						</select>

					</div>
					<!--<div class="row">-->
					<!--<div id="cp2" class="input-group colorpicker-component col-sm-12">-->
					<!--<label class="pl-3 col-form-label col-sm-3"-->
					<!--style="font-size: 15px;padding: 6px;margin-left: -9px;">--><? //=lang('color')?><!--</label>-->
					<!--<input name="color" type="text" value="--><? //= $fleet['color'] ?><!--"-->
					<!--class="form-control selected_color_value"/>-->
					<!--<span class="input-group-addon col-sm-5"><i-->
					<!--style="padding: 18px;margin-left: 10px;border-radius: 50%;"></i></span>-->
					<!--</div>-->
					<!--</div>-->
					<div class="row" style="margin-top: .75rem;">
						<label class="pl-4 col-form-label col-sm-4" style="font-size: 15px;"><?= lang('vin') ?></label>
						<input value="<?= $fleet['vin_code'] ?>" name="vin" type="text"
							   class="form-control form-control-sm col-sm-7"
							   placeholder="<?= lang('vin') ?>">
					</div>

					<div class="row" style="margin-top: .4rem !important;">
						<label class=" col-form-label col-sm-4"><?= lang('attached') ?> *</label>
						<div class="col-sm-7 p-0">
							<select name="staff[]"
									class="col  selectpicker form-control form-control-sm"
									id="staff"
									multiple data-live-search="true"
									title="<?= lang('select_a_staff') ?>">
								<? foreach ($staff_for_select as $row) : ?>
									<option
										value="<?= $row['id'] ?>"
										<?= (($fleet['staff_ids'] != '' && in_array($row['id'], explode(',', $fleet['staff_ids']))) ? 'selected' : '') ?>
									>
										<?= $row['name'] ?>
									</option>
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
							class="col-sm-3 col-form-label pl-3 text-center"
							style="font-size: 15px;padding-top: 10px;"><?= lang('car_number_abbr') ?>*</label>
						<input value="<?= $fleet['fleet_plate_number'] ?>" name="fleet_plate_number" type="text"
							   class="form-control form-control-sm col-sm-8"
							   placeholder="<?= lang('car_number') ?>">
					</div>
				</div>

				<div class="col-sm-3" style="position:relative;">
					<label class="col-sm-5 col-form-label text-right"
						   style="font-size: 15px;padding-top: 10px;"><?= lang('appendix_copy') ?></label>
					<label
						style="font-size: 14px !important;line-height: 14px !important;padding: 10px 24px !important;font-weight: 500 !important;min-width: 111px; max-width: 111px;"
						class="btn btn-sm btn-outline-success mb-0">
						<span><?= lang('browse') ?></span>
						<input type="file"
							   name="regitered_file"
							   class="d-none form-control-file btn_input"
							   hidden style="display: none;"
							   id="exampleFormControlFile1">
					</label><?
					if ($fleet['regitered_file'] != '') : ?>
					<a
						style="position: absolute;"
						target=""
						class="a_ext"
						download="<?= $fleet['regitered_file'] ?>"
						href="<?= base_url('uploads/' . $folder . '/fleet/regitered_file/') . $fleet['regitered_file'] ?>">
						<?

						$ext = explode('.', $fleet['regitered_file']);
						echo $this->select_ext($ext[1]);

						?>
						</a><?
					endif; ?>
				</div>

				<div class="col-sm-3 ">
					<div class="row">
						<label class="col-form-label col-sm-5 text-right"
							   style="font-size: 15px;padding-top: 10px;"><?= lang('owner') ?></label>
						<input value="<?= $fleet['owner'] ?>" name="owner" type="text"
							   class="col-sm-7 form-control form-control-sm"
							   placeholder="<?= lang('owner') ?>">
						<input value="<?= $fleet['owner_staff_id'] ?>" name="owner_id" type="hidden">
					</div>
				</div>


				<div class="col-sm-3" style="position:relative;">
					<label class="col-sm-6 col-form-label text-right col-width"
						   style="font-size: 15px;padding-top: 10px;"><?= lang('owner_passport') ?></label>
					<label
						style="font-size: 14px !important;line-height: 14px !important;padding: 10px 24px !important;font-weight: 500 !important;min-width: 111px; max-width: 111px;"
						class="btn btn-sm btn-outline-success mb-0 col-width_m">
						<span><?= lang('browse') ?></span>
						<input type="file" name="owners_passport" class="d-none form-control-file btn_input" hidden
							   style="display: none;" id="exampleFormControlFile1">
					</label><?
					if ($fleet['owners_passport'] != '') : ?>
					<a  style="position: absolute;top: 2px;"
						target=""
						class="a_ext"
						download="<?= $fleet['owners_passport'] ?>"
						href="<?= base_url('uploads/' . $folder . '/fleet/owners_passport/') . $fleet['owners_passport'] ?>">
						<?

						$ext = explode('.', $fleet['owners_passport']);
						echo $this->select_ext($ext[1]);

						?>
					</a><?
					endif; ?>
				</div>
			</div>
			<hr class="my-2">
		</div>

		<div class="container-fluid">
			<textarea name="other" rows="2" class="form-control form-control-sm col-sm-12"
					  placeholder="<?= lang('other') ?>"><?= $fleet['other'] ?></textarea>
		</div>


		<div class="row">


			<!-- Acardion -->

			<div class="accordion col-sm-12 mt-2" id="accordionExample_info"
				 style="padding-left: 30px; padding-right: 30px;">

				<div class="card">
					<div class="card-header" id="heading_info1">
						<h5 class="mb-0">
							<button class="btn btn-link collapsed text-success" type="button"
									data-toggle="collapse" data-target="#collapse_info1"
									aria-expanded="false" aria-controls="collapse_info1">
								<?= lang('insurance1') ?>։
								<? foreach ($insurance_type as $row) :
									if ($fleet['insurance_type_id_1'] == $row['id']) :
										echo $row['title'];
									endif;
								endforeach; ?>
							</button>
						</h5>
					</div>
					<div id="collapse_info1" class="collapse show" aria-labelledby="heading_info1"
						 data-parent="#accordionExample_info">
						<div class="card-body">
							<div class="add_new_items">
								<div class="row">
									<div class="col-sm-3" style="margin-top: -7px;">
										<label
											class="col-form-label"
											style="font-size: 12px;"><?= lang('insurance_type') ?></label>
										<div class="">
											<select name="type[1]"
													class="selectpicker form-control form-control-sm dif_meter"
													data-live-search="true"
													data-size="5"
													title="<?= lang('insurance_type') ?>"
											>
												<? foreach ($insurance_type as $row) : ?>
													<option
														value="<?= $row['id'] ?>"
														<?= ($fleet['insurance_type_id_1'] == $row['id'] ? 'selected' : '') ?>
													>
														<?= $row['title'] ?>
													</option>
												<? endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label><?= lang('company') ?></label>
											<input type="text"
												   value="<?= $fleet['insurance_company_1'] ?>"
												   name="company[1]"
												   class="form-control form-control-sm"
												   placeholder="<?= lang('company') ?>">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label><?= lang('reference') ?></label>
											<input type="text"
												   value="<?= $fleet['insurance_referance_1'] ?>"
												   name="reference[1]"
												   class="form-control form-control-sm"
												   placeholder="<?= lang('reference') ?>">
										</div>
									</div>
									<div
										class="<?= ($fleet['insurance_ext_1'] == '' ? 'col-md-2' : 'col-md-2') ?>">
										<label><?= lang('expiry_date') ?></label>
										<input type="date"
											   value="<?= $fleet['insurance_expiration_1'] ?>"
											   name="expiration[1]"
											   max="3000-12-31"
											   min="1000-01-01"
											   class="form-control form-control-sm">
									</div>
									<div class="col-sm-3">
										<div class="form-group float-left col-sm-7">
											<label><?= lang('insurance_data') ?></label>
											<label
												style="margin-left: -3px;width: 170px;font-size: 14px !important;line-height: 14px !important;padding: 10px 15px !important;font-weight: 500 !important;"
												class="btn btn-sm btn-outline-secondary">
												<span><?= lang('browse') ?></span>
												<input class="btn_input"
													   name="file_1" type="file"
													   hidden style="display: none;"
													   value="">
											</label>
										</div>
										<div class="ml-5 float-left"><?
											if ($fleet['insurance_ext_1'] != '') : ?>
												<a
													class="a_ext1"
													target=""
													download="<?= $fleet['insurance_file_1'] . '.' . $fleet['insurance_ext_1'] ?>"
													href="<?= base_url('uploads/' . $folder . '/fleet/insurance/') . $fleet['insurance_file_1'] . '.' . $fleet['insurance_ext_1'] ?>">
													<?

													echo $this->select_ext($fleet['insurance_ext_1']);

													?>
												</a>
											<? endif; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-header" id="heading_info2">
						<h5 class="mb-0">
							<button class="btn btn-link collapsed text-success" type="button"
									data-toggle="collapse" data-target="#collapse_info2"
									aria-expanded="false" aria-controls="collapse_info2">
								<?= lang('insurance1') ?>։
								<? foreach ($insurance_type as $row) :
									if ($fleet['insurance_type_id_2'] == $row['id']) :
										echo $row['title'];
									endif;
								endforeach; ?>
							</button>
						</h5>
					</div>
					<div id="collapse_info2" class="collapse " aria-labelledby="heading_info2"
						 data-parent="#accordionExample_info">
						<div class="card-body">
							<div class="add_new_items">
								<div class="row">

									<div class="col-sm-3" style="margin-top: -7px;">
										<label
											class="col-form-label"
											style="font-size: 12px;"><?= lang('insurance_type') ?></label>
										<div class="">
											<select name="type[2]"
													class="selectpicker form-control form-control-sm dif_meter"
													data-live-search="true"
													data-size="5"
													title="<?= lang('insurance_type') ?>"
											>
												<? foreach ($insurance_type as $row) : ?>
													<option
														value="<?= $row['id'] ?>"
														<?= ($fleet['insurance_type_id_2'] == $row['id'] ? 'selected' : '') ?>
													>
														<?= $row['title'] ?>
													</option>
												<? endforeach; ?>
											</select>
										</div>
									</div>


									<div class="col-md-2">
										<div class="form-group">
											<label><?= lang('company') ?></label>
											<input type="text"
												   value="<?= $fleet['insurance_company_2'] ?>"
												   name="company[2]"
												   class="form-control form-control-sm"
												   placeholder="<?= lang('company') ?>">
										</div>
									</div>


									<div class="col-md-2">
										<div class="form-group">
											<label><?= lang('reference') ?></label>
											<input type="text"
												   value="<?= $fleet['insurance_referance_2'] ?>"
												   name="reference[2]"
												   class="form-control form-control-sm"
												   placeholder="<?= lang('reference') ?>">
										</div>
									</div>

									<div
										class="<?= ($fleet['insurance_ext_2'] == '' ? 'col-md-2' : 'col-md-2') ?>">
										<label><?= lang('expiry_date') ?></label>
										<input type="date"
											   value="<?= $fleet['insurance_expiration_2'] ?>"
											   name="expiration[2]"
											   max="3000-12-31"
											   min="1000-01-01"
											   class="form-control form-control-sm">
									</div>


									<div class="col-sm-3">
										<div class="form-group float-left col-sm-7">
											<label><?= lang('insurance_data') ?></label>
											<label
												style="margin-left: -3px;width: 170px;font-size: 14px !important;line-height: 14px !important;padding: 10px 15px !important;font-weight: 500 !important;"
												class="btn btn-sm btn-outline-secondary">
												<span><?= lang('browse') ?></span>
												<input class="btn_input"
													   name="file_2" type="file"
													   hidden style="display: none;"
													   value="">
											</label>
										</div>
										<div class="ml-2 float-left">
											<? if ($fleet['insurance_ext_2'] != '') : ?>
												<a
													class="a_ext1"
													target=""
													download="<?= $fleet['insurance_file_2'] . '.' . $fleet['insurance_ext_2'] ?>"
													href="<?= base_url('uploads/' . $folder . '/fleet/insurance/') . $fleet['insurance_file_2'] . '.' . $fleet['insurance_ext_2'] ?>">
													<? echo $this->select_ext($fleet['insurance_ext_2']); ?>
												</a>
											<? endif; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<hr class="my-2">
			<div class="container-fluid">
				<hr class="my-2">
				<h5 class="mt-2 mb-1 ml-2"><?= lang('other_info') ?></h5>
				<table class="vehicle table table-striped table-hover">
					<thead>
					<tr>
						<th scope="col"><?= lang('item_name') ?> *</th>
						<th scope="col"><?= lang('value') ?> *
							<small>(<?= lang('KM\Days\Months') ?>)</small>
						</th>
						<th scope="col"><?= lang('explotation') ?> *</th>
						<th scope="col"><?= lang('per_day') ?> *</th>
						<th scope="col"><?= lang('more_info') ?></th>
						<th scope="col"><?= lang('day_before') ?> *</th>
						<th scope="col"><?= lang('start_alarm_day') ?> *</th>
						<th scope="col"><span class="btn bnt-sm btn-outline-success"><i style="margin: 0 !important;"
																						class="add_new_item fa fa-plus"></i>
						</th>
					</tr>
					</thead>
					<tbody class="new_items_tbody">
					<?
					$count = 0;
					foreach ($fleet_details as $values) :
						$count++;
						?>
						<tr>
							<td>
								<input name="item[<?= $count ?>]" class="form-control form-control-sm" type="text"
									   placeholder="<?= lang('item_name') ?>"
									   value="<?= $values['items'] ?>">
							</td>
							<td>
								<select name="value[<?= $count ?>]"
										class="selectpicker form-control form-control-sm dif_meter"
										data-live-search="true"
										data-size="5"
										title="<?= lang('select_value') ?>"
								>
									<? foreach ($value as $row) : ?>
										<option
											value="<?= $row['id'] ?>"
											<?= ($values['value_id'] == $row['id'] ? 'selected' : '') ?>
										>
											<?= $row['title'] ?>
										</option>
									<? endforeach; ?>
								</select>
							</td>
							<td>
								<input name="avg_exploitation[<?= $count ?>]" class="form-control form-control-sm"
									   type="number"
									   placeholder="<?= lang('explotation') ?>"
									   value="<?= $values['avg_exploitation'] ?>"/>
							</td>

							<td>
								<input name="per_days[<?= $count ?>]" class="form-control form-control-sm"
									   type="number"
									   placeholder="<?= lang('per_day') ?>"
									   value="<?= $values['per_days'] ?>"/>
							</td>
							<td>
								<input name="more_info[<?= $count ?>]" class="form-control form-control-sm"
									   type="text"
									   placeholder="<?= lang('more_info') ?>" value="<?= $values['more_info'] ?>"/>
							</td>
							<td>
								<input name="remind_before[<?= $count ?>]" class="form-control form-control-sm"
									   type="number"
									   placeholder="<?= lang('day_before') ?>"
									   value="<?= $values['reminde_me'] ?>"/>
							</td>
							<td>
								<input name="start_alarm_date[<?= $count ?>]" class="form-control form-control-sm"
									   type="date"
									   value="<?= $values['start_alarm_date'] ?>"/>
							</td>
							<td>
								<? if ($count != 1) : ?>
									<button type="button" class="btn btn-sm btn-light del_items_from_table">
										<i style="margin: 0 !important;" class="fa fa-trash"></i>
									</button>
								<? endif; ?>
							</td>
						</tr>
					<? endforeach; ?>
					</tbody>
				</table>
			</div>
	</form>
</div>


<div class="pos_abs_div fixed-bottom text-left pb-2 mt-md-2 mt-2">
	<span id="submit" class="save_cancel_btn btn btn-success"><?= lang('save') ?></span>
	<span id="load" class="btn save_cancel_btn btn-success d-none">

		<svg id="loading_svg" width="80" height="20" viewBox="0 0 135 140" xmlns="http://www.w3.org/2000/svg"
			 fill="rgb(255, 122, 89)">
			<rect y="10" width="15" height="120" rx="6"><animate attributeName="height" begin="0.5s" dur="1s"
																 values="120;110;100;90;80;70;60;50;40;140;120"
																 calcMode="linear" repeatCount="indefinite"/><animate
					attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
					repeatCount="indefinite"/></rect><rect x="30" y="10" width="15" height="120" rx="6"><animate
					attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120"
					calcMode="linear" repeatCount="indefinite"/><animate attributeName="y" begin="0.25s" dur="1s"
																		 values="10;15;20;25;30;35;40;45;50;0;10"
																		 calcMode="linear"
																		 repeatCount="indefinite"/></rect><rect x="60"
																												width="15"
																												height="140"
																												rx="6"><animate
					attributeName="height" begin="0s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120"
					calcMode="linear" repeatCount="indefinite"/><animate attributeName="y" begin="0s" dur="1s"
																		 values="10;15;20;25;30;35;40;45;50;0;10"
																		 calcMode="linear"
																		 repeatCount="indefinite"/></rect><rect x="90"
																												y="10"
																												width="15"
																												height="120"
																												rx="6"><animate
					attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120"
					calcMode="linear" repeatCount="indefinite"/><animate attributeName="y" begin="0.25s" dur="1s"
																		 values="10;15;20;25;30;35;40;45;50;0;10"
																		 calcMode="linear"
																		 repeatCount="indefinite"/></rect><rect x="120"
																												y="10"
																												width="15"
																												height="120"
																												rx="6"><animate
					attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120"
					calcMode="linear" repeatCount="indefinite"/><animate attributeName="y" begin="0.5s" dur="1s"
																		 values="10;15;20;25;30;35;40;45;50;0;10"
																		 calcMode="linear"
																		 repeatCount="indefinite"/></rect>
		</svg>

	</span>

	<button class="dont_save btn btn-primary"><?= lang('cancel') ?></button>
	<span style="color: #8c8c8c;" class="pl-3"><?= lang('changed_property') ?></span>
</div>


<div id="scripts"></div>


<script src="<?= base_url('assets/js/bootstrap/typeahead.js') ?>"></script>
<script>

	// create company
	$(document).on('click', '#submit', function (e) {
		var url = '<?=base_url($this->uri->segment(1) . '/Organization/edit_vehicles_ax') ?>';
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
				scroll_top();

				$(this).html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/bars2.svg" />');
				$(this).addClass('bg-success2');
				$('.alert-info').removeClass('d-none');
				$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');
			},
			success: function (data) {
				if (data.success == '1') {
					close_message();
					$('.alert-success').removeClass('d-none');
					$('.alert-success').html(data.message);
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
										errors += value + '<br>';
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

	$('.color_check_btn').on('click', function () {
		var sel_color = $(this).data('value');

		$('.selected_color_value').val(sel_color);
		$('.selected-color').attr('style', 'background: ' + sel_color + ';');

		$('.more_color').on('change', function () {
			var sel_color = $(this).val();

			$('.selected_color_value').val(sel_color);
			$('.selected-color').attr('style', 'background: ' + sel_color + ';');
		});

	});
	var n = <?=$count?>;
	$('.add_new_item').click(function () {

		n++;
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
			'title="<?=lang('select_value')?>">\n' +
			'<? foreach ($value as $row) : ?>\n' +
			'<option\n' +
			'value="<?= $row['id'] ?>"><?= $row['title'] ?></option>\n' +
			'<? endforeach; ?>\n' +
			'</select>' +
			'</td>\n' +
			'<td>\n' +
			'<input name="avg_exploitation[' + n + ']" class="form-control form-control-sm"\n' +
			'type="number"\n' +
			'placeholder="<?=lang('explotation')?>" />\n' +
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
			'   placeholder="<?=lang('more_info')?>" value=""/>\n' +
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
			$(this).parent('label').children('span').text('Brows file');
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
	});


	$(window).on('load', function () {
		$(document).on('change keyup', 'input,select,textarea', function () {
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
			});
		});
	});

	$(document).on('click', '.btn.dropdown-toggle', function () {
		var ul = $('select[name="color"]').parent('div').children('div').children('div:nth-child(2)').children('ul').children('li');

		var i = 1;
		var li_class = 'color_';
		ul.each(function (e) {
			$(this).addClass('el_' + i);
			$(this).append('<style>.el_' + i + ':before{\n' +
				'\tcontent: \'\';\n' +
				'\tborder: 2px solid ' + $(this).data('value') + ';\n' +
				'\tdisplay: inline-block;\n' +
				'\twidth: 15px;\n' +
				'\theight: 15px;\n' +
				'\t-webkit-border-radius: 50%;\n' +
				'\t-moz-border-radius: 50%;\n' +
				'\tborder-radius: 50%;\n' +
				'\tposition: absolute;\n' +
				'\ttop: 9px;\n' +
				'\tleft: 5px;\n' +
				'\t-webkit-transition: all .3s ease-in-out;\n' +
				'\t-moz-transition: all .3s ease-in-out;\n' +
				'\t-ms-transition: all .3s ease-in-out;\n' +
				'\t-o-transition: all .3s ease-in-out;\n' +
				'\ttransition: all .3s ease-in-out;\n' +
				'}\n' +
				'.el_' + i + ':hover:before {\n' +
				'\tbackground: ' + $(this).data('value') + ';\n' +
				'}' +
				'</style>');
			i++;
		});
	});

	$(document).on('click', 'button.btn.dropdown-toggle', function () {
		var ul = $('select[name="fleet_type"]').parent('div').children('div').children('div:nth-child(2)').children('ul').children('li');
		var j = 1;
		ul.each(function (e) {
			$(this).addClass('fleet_type_' + j);
			j++;
		});

		$('.fleet_type_1 a span:nth-child(2)').append('<img src="<?= base_url() ?>assets/img/fleet_type/car.png">');
		$('.fleet_type_2 a span:nth-child(2)').append('<img src="<?= base_url() ?>assets/img/fleet_type/delivery-truck.png">');
		$('.fleet_type_3 a span:nth-child(2)').append('<img src="<?= base_url() ?>assets/img/fleet_type/construction-tool-vehicle-with-crane-lifting-materials.png">');
		$('.fleet_type_4 a span:nth-child(2)').append('<img src="<?= base_url() ?>assets/img/fleet_type/construction-truck.png">');
		$('.fleet_type_5 a span:nth-child(2)').append('<img src="<?= base_url() ?>assets/img/fleet_type/bus-side-view.png">');
		$('.fleet_type_6 a span:nth-child(2)').append('<img src="<?= base_url() ?>assets/img/fleet_type/minivan.png">');
		$('.fleet_type_7 a span:nth-child(2)').append('<img src="<?= base_url() ?>assets/img/fleet_type/car-with-trailer.png">');
	});

	$(document).on('change', function () {
		$('#model_div label').css('flex', '0 0 33.333333% !important');
		$('#model_div label').css('max-width', '33.333333% !important');
	});



	var text = $('input[name="fuel_avg_consumption"]').parent('div').children('label').text();

	$(document).on('change', 'select[name="fuel"]', function () {

		if($(this).children('option:selected').val() == '5' || $(this).children('option:selected').val() == '6') {
			$('#second').show();
			new_text = $(this).children('option:selected').text().split('/');
			$('input[name="fuel_avg_consumption"]').parent('div').children('label').html(text+ ' ('+new_text[0]+')');
			$('input[name="fuel_avg_consumption"]').attr('placeholder', text+ ' ('+new_text[0]+')');
			$('input[name="fuel_avg_consumption_second"]').parent('div').children('label').html(text+ ' ('+new_text[1]+')');
			$('input[name="fuel_avg_consumption_second"]').attr('placeholder', text+ ' ('+new_text[1]+')');
		} else {
			$('#second').hide();
			$('input[name="fuel_avg_consumption"]').parent('div').children('label').html(text+ ' ('+$(this).children('option:selected').text()+')');
			$('input[name="fuel_avg_consumption"]').attr('placeholder', text+ ' ('+$(this).children('option:selected').text()+')');
		}

	});

	$(window).on('load', function(){

		$('select[name="fuel"]').children('option:selected').each(function(){
			if($(this).val() == '5' || $(this).val() == '6') {
				new_text = $(this).text().split('/');
				$('input[name="fuel_avg_consumption"]').parent('div').children('label').html(text+ ' ('+new_text[0]+')');
				$('input[name="fuel_avg_consumption"]').attr('placeholder', text+ ' ('+new_text[0]+')');
				$('input[name="fuel_avg_consumption_second"]').parent('div').children('label').html(text+ ' ('+new_text[1]+')');
				$('input[name="fuel_avg_consumption_second"]').attr('placeholder', text+ ' ('+new_text[1]+')');
			} else {
				if($(this).val() != '') {
					$('input[name="fuel_avg_consumption"]').parent('div').children('label').html(text+ ' ('+$(this).text()+')');
					$('input[name="fuel_avg_consumption"]').attr('placeholder', text+ ' ('+$(this).text()+')');
				}
			}
		});

	});

	$(document).ready(function () {
		if($(window).width() > 1349){
			$('.col-width').removeClass('col-sm-6');
			$('.col-width').addClass('col-sm-7');
			$('label.btn.btn-sm.btn-outline-success.mb-0.col-width_m').css('margin-top', '0');
		}else{
			$('label.btn.btn-sm.btn-outline-success.mb-0.col-width_m').css('margin-top', '-20px');
		}
	})
</script>
