<style>
	label {font-size: 11px !important;}
</style>
<div class="tab-pane fade show active" id="list-company" role="tabpanel" style="padding-top: 10px;"
	 aria-labelledby="list-company-list">
	<form>
		<!-- Error Message -->
		<div class="jumbotron jumbotron-fluid pb-2 pt-2">
			<div class="container">
				<p class="display-5 font-weight-bold mb-0">Add Vehicles</p>
			</div>
		</div>
		<div class="for_message">
			<div class="alert alert-success d-none " role="alert"></div>
			<div class="alert alert-info d-none " role="alert"></div>
			<div class="alert alert-danger d-none " role="alert"></div>
		</div>
		<div class="row">
			<div class="col-md-12 col-md-6 ">

				<!-- Main Start -->
				<div class="mt-3 mt-md-3">

					<div class="row">

						<div class="form-group col-sm-2">
							<label class=" col-form-label"">Կցված *</label>
							<div class="">
								<select name="staff[]"
										class="col  selectpicker form-control form-control-sm"
										id="staff"
										multiple data-live-search="true"
										title="Select a Staff">
									<? foreach ($staff_for_select as $row) : ?>
										<option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
									<? endforeach; ?>

								</select>
							</div>
						</div>

						<div class="form-group col-sm-2 getChild"
							 data-url="<?= base_url('System_main/get_child') ?>"
							 data-result="model_div"
							 data-response="model"
							 data-res_type="select"
							 data-lang="<?= $lang ?>"
							 id="brand"
						>
							<label
								class=" col-form-label">Տ/մ տեսակ * </label>

							<select name="brand"
									class="col selectpicker form-control form-control-sm "
									data-size="5" id="brand" data-live-search="true"
									title="Select a brand">
								<? foreach ($brand as $row) : ?>
									<option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
								<? endforeach; ?>
							</select>

						</div>
						<div id="model_div" class="form-group col-sm-2"></div>

						<div class="form-group col-sm-2">
							<label
								class="col-form-label">Տիպար *</label>

							<select name="fleet_type"
									class="currency form-control form-control-sm selectpicker"
									data-size="5" id="fleet_type" data-live-search="true"
									title="Select a fleet type"
							>
								<? foreach ($fleet_type as $row) : ?>
									<option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
								<? endforeach; ?>
							</select>
						</div>


						<div class="form-group col-sm-2">
							<label
								class="col-form-label">Թողարկման
								տարեթիվ *</label>

							<select name="production_date"
									class="currency form-control form-control-sm selectpicker"
									data-size="5"
									data-live-search="true"
									title="Choose..."
							>
								<?php for ($i = 1980; $i <= date('Y'); $i++) : ?>
									<option value="<?= $i ?>"><?= $i ?></option>
								<?php endfor; ?>

							</select>

						</div>

						<div class="form-group col-sm-2">
							<label
								class=" col-form-label pl-3" style="font-size: 15px;">Հաշվառման համարանիշ*</label>
							<div class="col-sm-12">
								<input value="" name="fleet_plate_number" type="text"
									   class="form-control form-control-sm"
									   placeholder="Հաշվառման համարանիշ">
							</div>
						</div>
					</div>


					<div class="row mt-3">


						<div class="form-group col-sm-2">
							<label
								class="pl-3 col-form-label" style="font-size: 15px;">VIN</label>
							<div class="col-sm-12">
								<input value="" name="vin" type="text" class="form-control form-control-sm"
									   placeholder="VIN">
							</div>
						</div>
						<div class="form-group col-sm-2">
							<label
								class="pl-3 col-form-label" style="font-size: 15px;">Շարժիչի հզորություն</label>
							<div class="col-sm-12">
								<input value="" min="0" step="0.1" name="engine_power" type="number"
									   class="form-control form-control-sm"
									   placeholder="Շարժիչի հզորություն">
							</div>
						</div>

						<div class="form-group col-sm-2">
							<label
								class="pl-3 col-form-label" style="font-size: 15px;">Վառելիք</label>
							<div class="col-sm-12">
								<select name="fuel"
										class="form-control form-control-sm selectpicker"
										data-size="5" id="fleet_type" data-live-search="true"
										title="Select a fuel"
								>
									<? foreach ($fuel as $row) : ?>
										<option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
									<? endforeach; ?>
								</select>
							</div>
						</div>

						<div class="form-group col-sm-2">
							<label
								class="pl-3 col-form-label" style="font-size: 15px;">Միջին ծախս 100 կմ</label>
							<div class="col-sm-12">
								<input value="" min="0" name="fuel_avg_consumption" type="number"
									   class="form-control form-control-sm"
									   placeholder="Միջին ծախս 100 կմ">
							</div>
						</div>
						<div class="form-group col-sm-2">
							<label
								class="pl-3 col-form-label" style="font-size: 15px;">Վազք</label>
							<div class="col-sm-12">
								<input value="" min="0" name="mileage" type="number"
									   class="form-control form-control-sm"
									   placeholder="Վազք">
							</div>
						</div>

						<div class="form-group col-sm-2">
							<label
								class="pl-3 col-form-label" style="font-size: 15px;">Հոդոգռաֆ</label>
							<div class="col-sm-12">
								<input value="" name="odometer" type="text" class="form-control form-control-sm"
									   placeholder="Հոդոգռաֆ">
							</div>
						</div>

					</div>

					<div class="row mt-3">
						<div class="form-group col-sm-2">
							<label
								class="pl-3 col-form-label" style="font-size: 15px;">GPS Exist?</label>
							<div class="col-sm-12">
								<select name="fuel"
										class="form-control form-control-sm selectpicker"
										data-size="5" id="fleet_type" data-live-search="true"
										title="GPS Exist?"
								>

										<option value="yes">yes</option>
										<option value="no">no</option>

								</select>
							</div>
						</div>

						<div class="form-group col-sm-2">
							<label
								class="pl-3 col-form-label" style="font-size: 15px;">GPS Tracker IMEI</label>
							<div class="col-sm-12">
								<input value="" name="odometer" type="text" class="form-control form-control-sm"
									   placeholder="GPS Tracker IMEI">
							</div>
						</div>
					</div>


					<div class="row">
						<div class="form-group col-sm-4">
							<label
								class="pl-3 col-form-label" style="font-size: 15px;">Այլ</label>
							<div class="col-sm-12">
							<textarea name="other" rows="3" class="form-control form-control-sm mt-2"
									  placeholder="Այլ"></textarea>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="form-group row" style="margin-top: 40px;">
								<label class="col-sm-10 col-form-label">Status make
									a
									Passive?</label>
								<div class="col-sm-2">
									<input value="-1" name="status" type="checkbox"
										   class="form-control form-control-sm">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-10 col-form-label">Send a notification mail to the
									drivers</label>
								<div class="col-sm-2">
									<input name="mail_to" value="1" type="checkbox"
										   class="form-control form-control-sm">
								</div>
							</div>
						</div>

						<div class="col-sm-2">
							<label class="col-form-label">Գույն</label>
							<p style="margin-bottom: 0;">Standart Colors</p>
							<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">

								<div class="btn-group mr-2" role="group" aria-label="First group">
									<button type="button" class="btn btn-sm color_check_btn" data-value="#ffffff"
											style="background: #ffffff;"></button>
									<button type="button" class="btn btn-sm color_check_btn" data-value="#c0c0c0"
											style="background: #c0c0c0;"></button>
									<button type="button" class="btn btn-sm color_check_btn" data-value="#000000"
											style="background: #000000;"></button>
									<button type="button" class="btn btn-sm color_check_btn" data-value="#686868"
											style="background: #686868;"></button>
									<button type="button" class="btn btn-sm color_check_btn" data-value="#0000ff"
											style="background: #0000ff;"></button>
									<button type="button" class="btn btn-sm color_check_btn" data-value="#ff0000"
											style="background: #ff0000;"></button>
									<button type="button" class="btn btn-sm color_check_btn" data-value="#d2b48c"
											style="background: #d2b48c;"></button>
									<button type="button" class="btn btn-sm color_check_btn" data-value="#008000"
											style="background: #008000;"></button>
									<button type="button" class="btn btn-sm color_check_btn" data-value="#ffd0d0"
											style="background: #ffd0d0;"></button>
								</div>
							</div>
							<p style="margin-bottom: 0;"><i class="fas fa-palette"></i> Mor Fill Colors ...
							</p>
							<input title="" type="color" class="btn color_check_btn more_color" value=""/>
						</div>

						<div class="form-group row">

							<div class="col-sm-1">
								<p style="margin-bottom: 0;">Selected Color</p>
								<input name="color" type="hidden" value="#ffffff" class="selected_color_value"/>
								<div class="selected-color" style="background: #ffffff;"></div>
							</div>
						</div>

					</div>


				</div>
				<!-- Main End -->

				<!-- Info Star -->
				<div class="mt-3 mt-md-3">
					<div class="card">
						<div class="card-header">
							<h5 class="mb-0">
								<button class="btn btn-link" type="button">
									Հաշվառման Համարանիշ
								</button>
							</h5>
						</div>
						<div class="">
							<div class="card-body">

								<div class="row">

									<div class="col-sm-3">
										<label
											class=" col-form-label" style="font-size: 12px;">Սեփականատեր</label>
										<input style="" value="" name="owner" type="text"
											   class="form-control form-control-sm"
											   placeholder="Սեփականատեր">
										<input name="owner_id" type="hidden">
									</div>

									<div class="col-sm-3">
										<label
											class="col-form-label" style="font-size: 12px;">Հաշվառման
											հասցե</label>
										<input value="" name="regitered_address" type="text"
											   class="form-control form-control-sm mt-2"
											   placeholder="Հաշվառման հասցե">
									</div>

									<div class="col-sm-3">
										<label style="font-size: 12px;"
											   class="col-form-label">Հաշվառման համար</label>
										<input value="" name="regitered_number" type="text"
											   class="form-control form-control-sm mt-2"
											   placeholder="Հաշվառման համար">
									</div>
									<div class="col-sm-3" style="margin-top: 35px;">
										<div class="form-group">
											<label for="exampleFormControlFile1"></label>
											<input type="file"
												   name="regitered_file"
												   class="form-control-file"
												   id="exampleFormControlFile1">
										</div>
									</div>

								</div>


							</div>
						</div>
					</div>


					<!-- Acardion -->

					<div class="accordion mt-5" id="accordionExample_info">
						<div class="card">
							<div class="card-header" id="heading_info1">
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
													<label>Company</label>
													<input type="text"
														   name="company[1]"
														   class="form-control form-control-sm"
														   placeholder="Company">
												</div>
											</div>

											<div class="col-1">
												<div class="form-group">
													<label style="margin-top: 35px;"
														   class="btn btn-sm btn-outline-secondary">
														<span>Brows file</span>
														<input class="btn_input"
															   name="file_1" type="file"
															   hidden style="display: none;"
															   value="">
													</label>
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label>Reference</label>
													<input type="text"
														   name="reference[1]"
														   class="form-control form-control-sm"
														   placeholder="Reference">
												</div>
											</div>

											<div class="col-md-3">
												<label>Epired Date</label>
												<input type="date" name="expiration[1]"
													   max="3000-12-31"
													   min="1000-01-01"

													   class="form-control form-control-sm">
											</div>

											<div class="col-sm-3">
												<label
													class="col-form-label"
													style="font-size: 12px;">Type</label>
												<div class="">
													<select name="type[1]"
															class="selectpicker form-control form-control-sm dif_meter"
															data-live-search="true"
															data-size="5"
															title="Select a insurance type"
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
							<div class="card-header" id="heading_info2">
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
													<label>Company</label>
													<input type="text"
														   name="company[2]"
														   class="form-control form-control-sm"
														   placeholder="Company">
												</div>
											</div>

											<div class="col-1">
												<div class="form-group">
													<label style="margin-top: 35px;"
														   class="btn btn-sm btn-outline-secondary">
														<span>Brows file</span>
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
														   placeholder="Reference">
												</div>
											</div>

											<div class="col-md-3">
												<label>Epired Date</label>
												<input type="date" name="expiration[2]"
													   max="3000-12-31"
													   min="1000-01-01"

													   class="form-control form-control-sm">
											</div>

											<div class="col-sm-3">
												<label
													class="col-form-label"
													style="font-size: 12px;">Type</label>
												<div class="">
													<select name="type[2]"
															class="selectpicker form-control form-control-sm dif_meter"
															data-live-search="true"
															data-size="5"
															title="Select a insurance type"
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
							<div class="card-header" id="heading_info3">
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
													<label>Company</label>
													<input type="text"
														   name="company[3]"
														   class="form-control form-control-sm"
														   placeholder="Company">
												</div>
											</div>

											<div class="col-1">
												<div class="form-group">
													<label style="margin-top: 35px;"
														   class="btn btn-sm btn-outline-secondary">
														<span>Brows file</span>
														<input class="btn_input"
															   name="file_3" type="file"
															   hidden style="display: none;"
															   value="">
													</label>
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label>Reference</label>
													<input type="text"
														   name="reference[3]"
														   class="form-control form-control-sm"
														   placeholder="Reference">
												</div>
											</div>

											<div class="col-md-3">
												<label>Epired Date</label>
												<input type="date" name="expiration[3]"
													   max="3000-12-31"
													   min="1000-01-01"

													   class="form-control form-control-sm">
											</div>

											<div class="col-sm-3">
												<label
													class="col-form-label"
													style="font-size: 12px;">Type</label>
												<div class="">
													<select name="type[3]"
															class="selectpicker form-control form-control-sm dif_meter"
															data-live-search="true"
															data-size="5"
															title="Select a insurance type"
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
							<div class="card-header" id="heading_info4">
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
													<label>Company</label>
													<input type="text"
														   name="company[4]"
														   class="form-control form-control-sm"
														   placeholder="Company">
												</div>
											</div>

											<div class="col-1">
												<div class="form-group">
													<label style="margin-top: 35px;"
														   class="btn btn-sm btn-outline-secondary">
														<span>Brows file</span>
														<input class="btn_input"
															   name="file_4" type="file"
															   hidden style="display: none;"
															   value="">
													</label>
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label>Reference</label>
													<input type="text"
														   name="reference[4]"
														   class="form-control form-control-sm"
														   placeholder="Reference">
												</div>
											</div>

											<div class="col-md-3">
												<label>Epired Date</label>
												<input type="date" name="expiration[4]"
													   max="3000-12-31"
													   min="1000-01-01"

													   class="form-control form-control-sm">
											</div>

											<div class="col-sm-3">
												<label
													class="col-form-label"
													style="font-size: 12px;">Type</label>
												<div class="">
													<select name="type[4]"
															class="selectpicker form-control form-control-sm dif_meter"
															data-live-search="true"
															data-size="5"
															title="Select a insurance type"
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
					<h5 class="mt-2 mb-1">Այլ տվյալներ</h5>
					<table class="vehicle table table-striped table-hover">
						<thead>
						<tr>
							<th scope="col">Item Name *</th>
							<th scope="col">Value *
								<small>(KM\Days\Months)</small>
							</th>
							<th scope="col">Avg. exploitation *</th>
							<th scope="col">Per Days *</th>
							<th scope="col">More Info P\N</th>
							<th scope="col">Remind days before *</th>
							<th scope="col">Start Alarm Date *</th>
							<th scope="col">Delete</th>
						</tr>
						</thead>
						<tbody class="new_items_tbody">
						<tr>
							<td>
								<input name="item[1]" class="form-control form-control-sm" type="text"
									   placeholder="Item Name"
									   value="">
							</td>
							<td>
								<select name="value[1]"
										class="selectpicker form-control form-control-sm dif_meter"
										data-live-search="true"
										data-size="5"
										title="Select a value"
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
									   placeholder="Avg. exploitation" value=""/>
							</td>

							<td>
								<input name="per_days[1]" class="form-control form-control-sm"
									   type="number"
									   placeholder="Per days" value=""/>
							</td>
							<td>
								<input name="more_info[1]" class="form-control form-control-sm"
									   type="text"
									   placeholder="More Info P\N" value=""/>
							</td>
							<td>
								<input name="remind_before[1]" class="form-control form-control-sm"
									   type="number"
									   placeholder="Remind Me  days before"/>
							</td>
							<td>
								<input name="start_alarm_date[1]" class="form-control form-control-sm" type="date"
									   value=""/>
							</td>
							<td>

							</td>
						</tr>
						</tbody>
					</table>
					<button type="button" class="btn btn-outline-success btn-sm add_new_item"><i
							class="fa fa-plus"></i></button>
					<hr class="my-4">
					<h5 class="mt-md-3 mt-3 mb-md-2 mb-2">kilometers per day</h5>

					<div class="row">


							<div class="col-sm-3">
								<label
									class="col-form-label"
									style="font-size: 12px;">Type of meter</label>
								<select name="value_1"
										class="selectpicker form-control form-control-sm dif_meter"
										data-size="5"
										title="Choose..."
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

								<div class="form-group form-check mt-md-3 mt-3 mb-0">
									<input name="auto_increment" value="1" type="checkbox" class="form-check-input"
										   id="exampleCheck1">
									<label class="form-check-label" for="exampleCheck1">auto increment?</label>
								</div>


								<input name="value1_day" type="number" class="mt-2 form-control form-control-sm"
									   placeholder=""/>
								<div class=" mt-3"><p style="display: inline-block;margin-left: 15px;margin-top: -12px;"><span class="dif_meter_text"></span>/day</p>
								</div>
							</div>

						<div class="col-sm-3">
							<div class="card">
								<h5 class="card-header" style="padding: 2px 0 2px 5px !important;">Secondary meter</h5>
								<div class="form-group form-check ml-md-3 ml-3 mt-md-2 mt-2">
									<input name="use_of_secondary_meter" value="1" type="checkbox" class="form-check-input"
										   id="exampleCheck11">
									<label class="form-check-label" for="exampleCheck11">Use of secondary
										meter</label>
								</div>
								<div class="card-body">
									<div class="form-group  mb-0">

										<label
											class="col-form-label"
											style="font-size: 12px;">Type of meter</label>
										<div>
											<select name="value_2"
													class="selectpicker form-control form-control-sm "
													data-size="5"
													title="Choose..."
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
				<!-- Info End -->
				<div class="text-right mt-4 pb-2 ">
					<span id="submit" class="btn btn-outline-success">Save</span>
				</div>
			</div>
		</div>
	</form>
</div>


<div id="scripts"></div>


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
				scroll_top();
				loading('start', 'submit');
				$(this).addClass('bg-success2');
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
	var n = 2;
	$('.add_new_item').click(function () {


		$('.new_items_tbody').append(
			'<tr>\n' +
			'<td>\n' +
			'<input name="item[' + n + ']" class="form-control form-control-sm" type="text"\n' +
			'   placeholder="Item Name"\n' +
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
			'placeholder="Avg. exploitation" />\n' +
			'</td>\n' +
			'\n' +
			'<td>\n' +
			'<input name="per_days[' + n + ']" class="form-control form-control-sm"\n' +
			'   type="number"\n' +
			'   placeholder="Per days" value=""/>\n' +
			'</td>\n' +
			'<td>\n' +
			'<input name="more_info[' + n + ']" class="form-control form-control-sm"\n' +
			'   type="text"\n' +
			'   placeholder="More Info P\\N" value=""/>\n' +
			'</td>\n' +
			'<td>\n' +
			'<input name="remind_before[' + n + ']" class="form-control form-control-sm"\n' +
			'   type="number"\n' +
			'   placeholder="Remind Me  days before" value=""/>\n' +
			'</td>\n' +
			'<td>\n' +
			'<input name="start_alarm_date[' + n + ']" class="form-control form-control-sm" type="date"\n' +
			'   value=""/>\n' +
			'</td>\n' +
			'<td>\n' +
			'<button type="button" class="btn btn-sm btn-light del_items_from_table">\n' +
			'<i class="fa fa-trash"></i>\n' +
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


</script>
