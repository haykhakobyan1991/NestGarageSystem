<!-- Add Vehicle Modal Start -->




			<div class="modal-header bg-dark">
				<h5 class="text-white modal-title dar">New Staff</h5>
				<button type="button" class="text-white close"
						data-dismiss="modal"
						aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<!-- Error Message -->

				<div class="for_message">
					<div class="alert alert-success" role="alert">
						A simple success alert—check it out!
					</div>
					<div class="alert alert-danger" role="alert">
						A simple success alert—check it out!
					</div>
				</div>

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
						   aria-selected="true"
						   style="border: 1px solid #dee2e6 !important;">MAIN</a>
						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
						   href="#nav-profile" role="tab" aria-controls="nav-profile"
						   aria-selected="false"
						   style="border: 1px solid #dee2e6 !important;">INFO</a>
					</div>
				</nav>


					<!-- Tab MAIN Start -->


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
											<button type="button" class="btn color_check_btn" data-value="#ffffff"
													style="background: #ffffff;"></button>
											<button type="button" class="btn color_check_btn" data-value="#c0c0c0"
													style="background: #c0c0c0;"></button>
											<button type="button" class="btn color_check_btn" data-value="#000000"
													style="background: #000000;"></button>
											<button type="button" class="btn color_check_btn" data-value="#696969"
													style="background: #696969;"></button>
											<button type="button" class="btn color_check_btn" data-value="#0000ff"
													style="background: #0000ff;"></button>
											<button type="button" class="btn color_check_btn" data-value="#ff0000"
													style="background: #ff0000;"></button>
											<button type="button" class="btn color_check_btn" data-value="#d2b48c"
													style="background: #d2b48c;"></button>
											<button type="button" class="btn color_check_btn" data-value="#008000"
													style="background: #008000;"></button>
											<button type="button" class="btn color_check_btn" data-value="#ffd0d0"
													style="background: #ffd0d0;"></button>
										</div>
									</div>
									<p style="margin-bottom: 0;"><i class="fas fa-palette"></i> Mor Fill Colors ...
									</p>
									<input type="color" class="btn color_check_btn more_color" value=""/>
								</div>
								<div class="col-sm-4">
									<p style="margin-bottom: 0;">Selected Color</p>
									<input type="hidden" value="#ffffff" class="selected_color_value"/>
									<div class="selected-color" style="background: #ffffff;"></div>
								</div>
							</div>


							<div class="form-group row">
								<label
									class="col-sm-2 col-form-label">Հաշվառման համարանիշ</label>
								<div class="col-sm-10">
									<input value="" name="" type="text" class="form-control form-control-sm"
										   placeholder="Հաշվառման համարանիշ">
								</div>
							</div>

							<div class="form-group row">
								<label
									class="col-sm-2 col-form-label">VIN</label>
								<div class="col-sm-10">
									<input value="" name="vin" type="text" class="form-control form-control-sm" placeholder="VIN">
								</div>
							</div>

							<div class="form-group row">
								<label
									class="col-sm-2 col-form-label">Շարժիչի հզորություն</label>
								<div class="col-sm-10">
									<input value="" name="" type="text" class="form-control form-control-sm mt-2"
										   placeholder="Շարժիչի հզորություն">
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

							<div class="form-group row">
								<label
									class="col-sm-2 col-form-label">Վազք</label>
								<div class="col-sm-10">
									<input value="" name="vin" type="text" class="form-control form-control-sm" placeholder="Վազք">
								</div>
							</div>

							<div class="form-group row">
								<label
									class="col-sm-2 col-form-label">Հոդոգռաֆ</label>
								<div class="col-sm-10">
									<input value="" name="" type="text" class="form-control form-control-sm mt-2"
										   placeholder="Հոդոգռաֆ">
								</div>
							</div>

							<div class="form-group row">
								<label
									class="col-sm-2 col-form-label">Այլ</label>
								<div class="col-sm-10">
									<input value="" name="" type="text" class="form-control form-control-sm mt-2" placeholder="Այլ">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-10 col-form-label">Status make
									a
									Passive?</label>
								<div class="col-sm-2">
									<input checked="" type="checkbox" class="form-control form-control-sm">
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-10 col-form-label">Send a notification mail to the
									drivers</label>
								<div class="col-sm-2">
									<input checked="" type="checkbox" class="form-control form-control-sm">
								</div>
							</div>




							<!-- Tab INFO Start -->
							<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

								<form class="mt-3 mt-md-3">
									<div class="accordion" id="accordionExample_info">
										<div class="card">
											<div class="card-header" id="heading_info1">
												<h5 class="mb-0">
													<button class="btn btn-link" type="button" data-toggle="collapse"
															data-target="#collapse_info1" aria-expanded="true"
															aria-controls="collapse_info1">
														Հաշվառման Համարանիշ
													</button>
												</h5>
											</div>

											<div id="collapse_info1" class="collapse show" aria-labelledby="heading_info1"
												 da.add_veichls_modalta-parent="#accordionExample_info">
												<div class="card-body">
													<div class="form-group row mb-0">
														<label
															class="col-sm-2 col-form-label" style="font-size: 12px;">Սեփականատեր</label>
														<div class="col-sm-6">
															<input style="" value="" name="" type="text"
																   class="form-control form-control-sm"
																   placeholder="Սեփականատեր">
														</div>
														<div class="col-sm-4">
															<div class="form-group">
																<label for="exampleFormControlFile1"></label>
																<input type="file"
																	   class="form-control-file"
																	   id="exampleFormControlFile1">
															</div>
														</div>
													</div>

													<div class="form-group row mb-0">
														<label
															class="col-sm-2 col-form-label" style="font-size: 12px;">Հաշվառման
															հասցե</label>
														<div class="col-sm-6">
															<input value="" name="" type="text"
																   class="form-control form-control-sm mt-2"
																   placeholder="Հաշվառման հասցե">
														</div>
													</div>

													<div class="form-group row mb-0">
														<label style="font-size: 12px;"
															   class="col-sm-2 col-form-label">Հաշվառման համար</label>
														<div class="col-sm-6">
															<input value="" name="" type="text"
																   class="form-control form-control-sm mt-2"
																   placeholder="Հաշվառման համար">
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
														Ապահովագրություն
													</button>
												</h5>
											</div>
											<div id="collapse_info2" class="collapse" aria-labelledby="heading_info2"
												 data-parent="#accordionExample_info">
												<div class="card-body">
													<div class="form-group row mb-0">
														<label
															class="col-sm-2 col-form-label" style="font-size: 12px;">Կազմակերպություն</label>
														<div class="col-sm-6">
															<input style="" value="" name="" type="text"
																   class="form-control form-control-sm"
																   placeholder="Կազմակերպություն">
														</div>
														<div class="col-sm-4">
															<div class="form-group">
																<label for="exampleFormControlFile1"></label>
																<input type="file"
																	   class="form-control-file"
																	   id="exampleFormControlFile1">
															</div>
														</div>
													</div>

													<div class="form-group row mb-0">
														<label
															class="col-sm-2 col-form-label" style="font-size: 12px;">Հաշվառման
															համար</label>
														<div class="col-sm-6">
															<input value="" name="" type="text"
																   class="form-control form-control-sm mt-2"
																   placeholder="Հաշվառման համար">
														</div>
													</div>

													<div class="form-group row mb-0">
														<label style="font-size: 12px;"
															   class="col-sm-2 col-form-label">Տեսակ</label>
														<div class="col-sm-6">
															<select value=""
																	class=" form-control form-control-sm">
																<option> Ընտրել տեսակը․․․</option>
																<option>տեսակը 1</option>
																<option>տեսակը 2</option>
															</select>

														</div>
													</div>

													<div class="form-group row mb-0">
														<label
															class="col-sm-2 col-form-label"
															style="font-size: 12px;">Վավեր</label>
														<div class="col-sm-6">
															<input value="" name="" type="date"
																   class="form-control form-control-sm mt-2" placeholder="">
														</div>
													</div>
												</div>
											</div>
										</div>

									</div>

									<h5 class="mt-2 mb-1">Այլ տվյալներ</h5>


									<table class="table table-striped table-hover">
										<thead>
										<tr>
											<th scope="col">Item Name</th>
											<th scope="col">Minimum (time)</th>
											<th scope="col">Remind Me days before</th>
											<th scope="col">Next Alarm Date</th>
											<th scope="col">Delete</th>
										</tr>
										</thead>
										<tbody class="new_items_tbody">

										<tr>
											<td>
												<input name="item_1" class="form-control form-control-sm" type="text"
													   placeholder="Item"
													   value="">
											</td>
											<td>
												<input name="minimum_1" class="form-control form-control-sm" type="text"
													   placeholder="Minimum (time)" value=""/>
											</td>
											<td>
												<input name="remind_before_1" class="form-control form-control-sm"
													   type="text"
													   placeholder="Remind Me  days before" value=""/>
											</td>
											<td>
												<input name="date_1" class="form-control form-control-sm" type="date"
													   value=""/>
											</td>
											<td>
												<button type="button" class="btn btn-sm btn-light del_items_from_table">
													<i class="fa fa-trash"></i>
												</button>
											</td>
										</tr>


										</tbody>


									</table>
									<button type="button" class="btn btn-outline-success btn-sm add_new_item"><i
											class="fa fa-plus"></i></button>

									<hr class="my-4">

									<h5 class="mt-md-3 mt-3 mb-md-2 mb-2">kilometers per day</h5>

									<div class="form-group row mb-0 mt-4">
										<label
											class="col-sm-2 col-form-label"
											style="font-size: 12px;">Type of meter</label>
										<div class="col-sm-6">
											<select value=""
													class=" form-control form-control-sm dif_meter">
												<option>km</option>
												<option>mile</option>
											</select>
										</div>
									</div>
									<div class="container mt-md-3 mt-3">
										<div class="row">
											<div class="form-group form-check mt-md-3 mt-3 col-sm-4">
												<input type="checkbox" class="form-check-input" id="exampleCheck1">
												<label class="form-check-label" for="exampleCheck1">auto increment?</label>
											</div>
											<div class="col-sm-3 mt-3">
												<input type="text" class="orm-control form-control-sm" placeholder=""/>
											</div>
											<div class="col-sm-3 mt-3"><p><span class="dif_meter_text">km</span>/day</p>
											</div>
										</div>
									</div>

									<div class="card">
										<h5 class="card-header">Secondary meter</h5>
										<div class="form-group form-check ml-md-3 ml-3 mt-md-2 mt-2">
											<input type="checkbox" class="form-check-input" id="exampleCheck11">
											<label class="form-check-label" for="exampleCheck11">Use of secondary
												meter</label>
										</div>
										<div class="card-body">
											<div class="form-group row mb-0">
												<label
													class="col-sm-2 col-form-label"
													style="font-size: 12px;">Type of meter</label>
												<div class="col-sm-6">
													<select value="" class=" form-control form-control-sm">
														<option>km</option>
														<option>mile</option>
													</select>
												</div>
											</div>
										</div>
									</div>

								</form>

							</div>
							<!-- Tab INFO End -->

						</form>



					<!-- Tab MAIN End -->




				<div class="text-right mt-4 pb-2">
					<button class="btn btn-outline-success">Save</button>
					<button class="btn btn-outline-success ml-2" data-dismiss="modal">
						Cancel
					</button>
				</div>
			</div>



<!-- Add Veichls Modal End -->

<script>
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
		$('.new_items_tbody').append('<tr>\n' +
			'<td>\n' +
			'<input name="item_' + n + '" class="form-control form-control-sm" type="text" placeholder="Item" value="">\n' +
			'</td>\n' +
			'<td>\n' +
			'<input name="minimum_' + n + '" class="form-control form-control-sm" type="text" placeholder="Minimum (time)" value=""/>\n' +
			'</td>\n' +
			'<td>\n' +
			'<input name="remind_before_' + n + '" class="form-control form-control-sm" type="text" placeholder="Remind Me  days before" value=""/>\n' +
			'</td>\n' +
			'<td>\n' +
			'<input name="date_' + n + '" class="form-control form-control-sm" type="date" value="" />\n' +
			'</td>\n' +
			'<td>\n' +
			'<button type="button" class="btn btn-sm btn-light del_items_from_table"><i class="fa fa-trash"></i></button>\n' +
			'</td>\n' +
			'</tr>');

		n++;
	});

	$(document).on('click', '.del_items_from_table', function () {
		$(this).parent('td').parent('tr').remove();
	});
	$('.dif_meter').on('change', function () {
		$('.dif_meter_text').text($(this).val());
	});

</script>
