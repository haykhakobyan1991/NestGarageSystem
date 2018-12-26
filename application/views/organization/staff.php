<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<script src="<?= base_url('assets/js/bootstrap/typeahead.bundle.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/examples.css"/>
<?
$user_id = $this->session->user_id;
$folder = $this->session->folder;
$total = 0;
$active = 0;
$passive = 0;
foreach ($staff as $row) :

	$total++;



endforeach;
?>

<style>
	table#example2 thead tr th:last-child:after {
		content: '';
	}

	table#example2 thead tr th:last-child:before {
		content: '';
	}

	li.no-results {
		cursor: pointer;
	}
</style>
<!-- Staff Start -->
<div class="tab-pane fade show active" id="list-staff" role="tabpanel" aria-labelledby="list-staff-list">
	<div class="tab-pane fade show active" id="list-staff" role="tabpanel" style="padding-top: 10px;"
		 aria-labelledby="list-staff-list">

		<div class=" pt-2">

			<div class="container-fluid">
				<p class="display-5 font-weight-bold mb-0"><?= lang('staff') ?></p>
				<hr class="my-2">
			</div>


			<div class="container-fluid">

				<div class="row">
					<div class="col-sm-5 pt-2">
						<div class="row">
							<div class="col-sm-4">
								<p class="display-5 font-weight-bold float-left"
								   style="font-size: 12px;"><?= lang('total_staff') ?></p> <span
									class="ml-2 mt-1 badge badge-secondary badge-pill"><?= $total ?></span>
							</div>
						</div>
					</div>
					<div class="col-sm-7 text-right">
						<span class="text-capitalize btn btn-outline-success btn-sm float-right" data-toggle="modal"
							  data-target=".add_staff_modal"><?= lang('add_staff') ?>
							</span>
					</div>
				</div>

			</div>

			<div class="row ml-0 mr-0 mt-1">

				<!-- EDIT staff modal-->
				<div class="modal fade bd-example-modal-lg " id="edit_staff" tabindex="-1" role="dialog"
					 aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header bg-dark">
								<h6 class="text-white modal-title dar"><?= lang('staff1') ?></h6>
							</div>
							<div class="modal-body">
								<img style="height: 50px;margin: 0 auto;display: block;text-align: center;"
									 src="<?= base_url('assets/images/bars.svg') ?>"/>
							</div>
						</div>
					</div>
				</div>
				<!-- Edit staff modal end -->

				<!-- Add staff Modal Start  -->
				<form id="staff" enctype="multipart/form-data">
					<div class="modal fade add_staff_modal" tabindex="-1" role="dialog"
						 aria-labelledby="myLargeModalLabel" aria-hidden="true">

						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header bg-dark">

									<h6 class="text-white modal-title dar"><?= lang('new_staff') ?></h6>

								</div>
								<div class="modal-body">
									<!-- Error Message -->

									<div class="for_message">
										<div class="alert alert-success d-none" role="alert"></div>
										<div class="alert alert-danger  d-none" role="alert"></div>
										<div class="alert alert-info  d-none" role="alert"></div>
									</div>

									<div class="row">
										<div class="col-sm-12 col-md-6 col-6">
											<h5><?= lang('staff_information') ?></h5>
											<p><?= lang('fill_followings_fields') ?></p>
										</div>

										<div class="col-sm-12 col-md-6 col-6">
											<h5 style="padding-top: 10px;margin-left: 116px;float: none;display: unset;"><?= lang('picture') ?></h5>
											<div class="media">
												<img class="align-self-start mr-3"
													 id='img-upload2'
													 style="width: 100px;margin-top: -30px;" alt=""
													 src="<?= base_url('assets/images/no_choose_image.svg') ?>">
												<div class="media-body">
													<p style="margin-top: 3px;"><?= lang('upload_staff_picture'); ?></p>
													<div class="input-group ml-2 ml-md-2">
														<span class="input-group-btn">
															<span
																class="btn btn-outline-success btn-file"
																style="margin-top: -10px;font-size: 14px !important;line-height: 14px !important;padding: 12px 24px !important;font-weight: 500 !important;margin-left: -8px;">
																<?= lang('browse') ?> <input type="file" id="imgInp2"
																							 name="photo"
																							 onchange="readURL2(this);">
															</span>
														</span>
														<input type="text" class="form-control form-control-sm"
															   readonly
															   style="display: none;">

													</div>
												</div>
											</div>
										</div>
									</div>

									<hr class="my-2">

									<div class="row mt-1">

										<div class="col-sm-12 col-md-12 col-12  pl-md-4 pl-4 pr-md-4 pr-4">

											<div class="row">
												<div class="col-sm-6">
													<div class="row">
														<label
															class="col-sm-4 col-form-label"
															style="font-size: 15px;"><?= lang('first_name') ?>*</label>
														<div class="col-sm-8">
															<input type="text" class="form-control form-control-sm"
																   name="firstname"
																   placeholder="<?= lang('first_name') ?>">
														</div>
													</div>
													<div class="row mt-1">
														<label
															class="col-sm-4 col-form-label"><?= lang('last_name') ?>*</label>
														<div class="col-sm-8">
															<input type="text" class="form-control form-control-sm"
																   name="lastname"
																   placeholder="<?= lang('last_name') ?>">
														</div>
													</div>
													<div class="row mt-1">
														<label
															class="col-sm-4 col-form-label"
															style="font-size: 15px;"><?= lang('email') ?>*</label>
														<div class="col-sm-8">
															<input type="email" class="form-control form-control-sm"
																   name="email"
																   placeholder="<?= lang('email') ?>">
														</div>
													</div>
													<div class="row mt-1">
														<label
															class="col-sm-4 col-form-label"
															style="font-size: 15px;"><?= lang('department') ?>*</label>
														<div class="col-sm-8">
															<select name="department"
																	class="col selectpicker form-control form-control-sm"
																	data-size="5" id="department"
																	data-live-search="true"
																	title="<?= lang('select_department') ?>">
																<? foreach ($department as $row) : ?>
																	<option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
																<? endforeach; ?>
															</select>
														</div>
													</div>
													<div class="row" style="margin-top: .75rem!important;">
														<label
															class="col-sm-4 col-form-label"><?= lang('position') ?></label>
														<div id="default-suggestions"  class="col-sm-8">
															<input type="text" class="typeahead form-control form-control-sm"
																   name="position"
																   placeholder="<?= lang('position') ?>">
															<input type="hidden" name="head">
														</div>
													</div>
													<div class="row mt-1">
														<label
															class="col-sm-4 col-form-label"><?= lang('nest_card_id') ?></label>
														<div class="col-sm-8">
															<input type="text" class="form-control form-control-sm"
																   name="nest_card_id"
																   placeholder="<?= lang('nest_card_id') ?>">
														</div>
													</div>
												</div>


												<div class="col-sm-6">
													<div class="row">
														<label
															class="col-sm-4 col-form-label"><?= lang('country') ?></label>
														<div class="col-sm-8">
															<select name="country"
																	class="col selectpicker form-control form-control-sm"
																	data-size="5" id="country" data-live-search="true"
																	title="<?= lang('select_country') ?>">
																<option value=""><?= lang('select_country') ?>...
																</option>
																<? foreach ($country as $row) : ?>
																	<option
																		value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
																<? endforeach; ?>
															</select>
														</div>
													</div>
													<div class="row" style="margin-top: .75rem!important;">
														<label
															class="col-sm-4 col-form-label"
															style="font-size: 15px;"><?= lang('address') ?></label>
														<div class="col-sm-8">
															<input type="text" class="form-control form-control-sm"
																   name="address"
																   placeholder="<?= lang('address') ?>">
														</div>
													</div>
													<div class="row mt-1">
														<label
															class="col-sm-4 col-form-label"><?= lang('post_code') ?></label>
														<div class="col-sm-8">
															<input type="text" class="form-control form-control-sm"
																   name="post_code"
																   placeholder="<?= lang('post_code') ?>">
														</div>
													</div>
													<div class="row mt-1">
														<label class="col-sm-4 col-form-label"
															   style="font-size: 15px;"><?= lang('contact_number') ?></label>
														<div class="col-sm-8">
															<input type="text" class="form-control form-control-sm"
																   name="contact_1"
																   placeholder="<?= lang('contact_number') ?> 1">
														</div>
													</div>
													<div class="row mt-1">
														<label class="col-sm-4 col-form-label"></label>
														<div class="col-sm-8">
															<input type="text" class="form-control form-control-sm"
																   name="contact_2"
																   placeholder="<?= lang('contact_number') ?> 2">
														</div>
													</div>

												</div>
												<div class="col-sm-12 mt-1">
													<div class="row" style="margin-right: -1px;margin-left: -1px;">
															<textarea placeholder="<?= lang('other') ?>"
																	  class="form-control col-sm-12"
																	  id="exampleFormControlTextarea1"
																	  name="other"
																	  rows="2"></textarea>

													</div>
												</div>

												<div class="accordion col-sm-12 mt-1" id="accordionExample1">
													<div class="card">
														<div class="card-header p-0" id="headingOne">
															<h5 class="mb-0">
																<button class="btn btn-sm btn-link text-success"
																		type="button"
																		data-toggle="collapse"
																		data-target="#collapseOne"
																		aria-expanded="true"
																		aria-controls="collapseOne">
																	<?= lang('passport') ?>
																</button>
															</h5>
														</div>

														<div id="collapseOne" class="collapse show"
															 aria-labelledby="headingOne"
															 data-parent="#accordionExample1">
															<div class="card-body">
																<div class="add_new_items">
																	<div class="row">
																		<input type="hidden" name="document_1" value="<?= lang('passport') ?>" />
																		<div class="col-md-3">
																			<div class="form-group">
																				<label><?= lang('passport') ?></label>
																				<label style="width: 100%;min-width: 111px;
    font-size: 14px !important;
    line-height: 14px !important;
    padding: 10px 24px !important;
    font-weight: 400 !important;
    border-color: #ced4da !important;"
																					  class="btn btn-sm btn-outline-secondary">
																					<span><?= lang('browse') ?></span>
																					<input class="btn_input"
																						   name="file_1" type="file"
																						   hidden style="display: none;"
																						   value="">
																				</label>
																			</div>
																		</div>

																		<div class="col-md-3">
																			<div class="form-group">
																				<label><?= lang('reference') ?></label>
																				<input type="text"
																					   name="reference_1"
																					   class="form-control form-control-sm"
																					   placeholder="<?= lang('reference') ?>">
																			</div>
																		</div>
																		<div class="col-md-3">
																			<label><?= lang('expired_date') ?></label>
																			<input type="date" name="expiration_1"
																				   max="3000-12-31"
																				   min="1000-01-01"

																				   class="form-control form-control-sm">
																		</div>
																		<div class="col-md-3">
																			<div class="form-group">
																				<label><?= lang('note') ?></label>
																				<input type="text"
																					   name="note_1"
																					   class="form-control form-control-sm"
																					   placeholder="<?= lang('note') ?>">
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="card">
														<div class="card-header p-0" id="headingTwo">
															<h5 class="mb-0">
																<button
																	class="btn btn-sm btn-link collapsed text-success"
																	type="button"
																	data-toggle="collapse"
																	data-target="#collapseTwo"
																	aria-expanded="false"
																	aria-controls="collapseTwo">
																	<?= lang('social_card') ?>
																</button>
															</h5>
														</div>
														<div id="collapseTwo" class="collapse"
															 aria-labelledby="headingTwo"
															 data-parent="#accordionExample1">
															<div class="card-body">
																<div class="add_new_items">
																	<div class="row">
																		<input type="hidden" name="document_2" value="<?= lang('social_card') ?>" />
																		<div class="col-md-3">
																			<div class="form-group">
																				<label><?= lang('social_card') ?></label>
																				<label style="width: 100%;min-width: 111px;
    font-size: 14px !important;
    line-height: 14px !important;
    padding: 10px 24px !important;
    font-weight: 400 !important;
    border-color: #ced4da !important;"
																					  class="btn btn-sm btn-outline-secondary">
																					<span><?= lang('browse') ?></span>
																					<input class="btn_input"
																						   name="file_2" type="file"
																						   hidden style="display: none;"
																						   value="">
																				</label>
																			</div>
																		</div>
																		<div class="col-md-3">
																			<div class="form-group">
																				<label><?= lang('reference') ?></label>
																				<input type="text"
																					   name="reference_2"
																					   class="form-control form-control-sm"
																					   placeholder="<?= lang('reference') ?>">
																			</div>
																		</div>
																		<div class="col-md-3">
																			<label><?= lang('expired_date') ?></label>
																			<input type="date" name="expiration_2"
																				   max="3000-12-31"
																				   min="1000-01-01"
																				   class="form-control form-control-sm">
																		</div>
																		<div class="col-md-3">
																			<div class="form-group">
																				<label><?= lang('note') ?></label>
																				<input type="text"
																					   name="note_2"
																					   class="form-control form-control-sm"
																					   placeholder="<?= lang('note') ?>">
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="card">
														<div class="card-header p-0" id="headingThree">
															<h5 class="mb-0">
																<button
																	class="btn btn-sm btn-link collapsed text-success"
																	type="button"
																	data-toggle="collapse"
																	data-target="#collapseThree"
																	aria-expanded="false"
																	aria-controls="collapseThree">
																	<?= lang('driving_license') ?>
																</button>
															</h5>
														</div>
														<div id="collapseThree" class="collapse"
															 aria-labelledby="headingThree"
															 data-parent="#accordionExample1">
															<div class="card-body">
																<div class="add_new_items">
																	<div class="row">
																		<input type="hidden" name="document_3" value="<?= lang('driving_license') ?>" />

																		<div class="col-md-3">
																			<div class="form-group">
																				<label><?= lang('driving_license') ?></label>
																				<label style="width: 100%;min-width: 111px;
    font-size: 14px !important;
    line-height: 14px !important;
    padding: 10px 24px !important;
    font-weight: 400 !important;
    border-color: #ced4da !important;"
																					  class="btn btn-sm btn-outline-secondary">
																					<span><?= lang('browse') ?></span>
																					<input class="btn_input"
																						   name="file_3" type="file"
																						   hidden style="display: none;"
																						   value="">
																				</label>
																			</div>
																		</div>

																		<div class="col-md-3">
																			<div class="form-group">
																				<label><?= lang('reference') ?></label>
																				<input type="text"
																					   name="reference_3"
																					   class="form-control form-control-sm"
																					   placeholder="<?= lang('reference') ?>">
																			</div>
																		</div>
																		<div class="col-md-3">
																			<label><?= lang('expired_date') ?></label>
																			<input type="date" name="expiration_3"
																				   max="3000-12-31"
																				   min="1000-01-01"

																				   class="form-control form-control-sm">
																		</div>
																		<div class="col-md-3">
																			<div class="form-group">
																				<label><?= lang('note') ?></label>
																				<input type="text"
																					   name="note_3"
																					   class="form-control form-control-sm"
																					   placeholder="<?= lang('note') ?>">
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<div class="card">
														<div class="card-header p-0" id="headingFour">
															<h5 class="mb-0">
																<button
																	class="btn btn-sm btn-link collapsed text-success"
																	type="button"
																	data-toggle="collapse"
																	data-target="#collapseFour"
																	aria-expanded="false"
																	aria-controls="collapseThree">
																	<?= lang('technical_passport') ?>
																</button>
															</h5>
														</div>
														<div id="collapseFour" class="collapse"
															 aria-labelledby="headingFour"
															 data-parent="#accordionExample1">
															<div class="card-body">
																<div class="add_new_items">
																	<div class="row">
																		<input type="hidden" name="document_4" value="<?= lang('technical_passport') ?>" />
																		<div class="col-md-3">
																			<div class="form-group">
																				<label><?= lang('technical_passport') ?></label>
																				<label style="width: 100%;min-width: 111px;
    font-size: 14px !important;
    line-height: 14px !important;
    padding: 10px 24px !important;
    font-weight: 400 !important;
    border-color: #ced4da !important;"
																					  class="btn btn-sm btn-outline-secondary">
																					<span><?= lang('browse') ?></span>
																					<input class="btn_input"
																						   name="file_4" type="file"
																						   hidden style="display: none;"
																						   value="">
																				</label>
																			</div>
																		</div>
																		<div class="col-md-3">
																			<div class="form-group">
																				<label><?= lang('reference') ?></label>
																				<input type="text"
																					   name="reference_4"
																					   class="form-control form-control-sm"
																					   placeholder="<?= lang('reference') ?>">
																			</div>
																		</div>
																		<div class="col-md-3">
																			<label><?= lang('expired_date') ?></label>
																			<input type="date" name="expiration_4"
																				   max="3000-12-31"
																				   min="1000-01-01"

																				   class="form-control form-control-sm">
																		</div>
																		<div class="col-md-3">
																			<div class="form-group">
																				<label><?= lang('note') ?></label>
																				<input type="text"
																					   name="note_4"
																					   class="form-control form-control-sm"
																					   placeholder="<?= lang('note') ?>">
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer pb-0 col-sm-12 mt-1" style="padding-right: 24px;">
											<button id="add_staff" type="button"
													class="btn btn-outline-success cancel_btn"><?= lang('save') ?>
											</button>
											<button style="height: 40px !important; width: 93px !important;" id="load"
													class="btn btn-sm btn-outline-success cancel_btn d-none"><img
													style="height: 20px;margin: 0 auto;display: block;text-align: center;"
													src="<?= base_url() ?>assets/images/bars2.svg"/></button>
											<button type="button" class="cancel_btn close btn btn-sm"
													data-dismiss="modal"
													aria-label="Close">
												<?= lang('cancel') ?>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
				</form>
				<!-- Add User Modal End -->

			</div>
			<hr class="my-2">

			<div class="row  m-0 col-sm-12 col-md-12"
				 style="background: #fff;padding-top: 10px; padding-bottom: 10px; overflow-x: auto;">


				<table id="example2" class="table table-striped table-borderless"
					   style="width:100%">
					<thead style="background: #fff;
color: #545b62;">
					<tr>
						<th style="font-size: 12px !important;font-weight:500;"><?= lang('name_lastname') ?></th>
						<th style="font-size: 12px !important;font-weight:500;"><?= lang('status') ?></th>
						<th style="font-size: 12px !important;font-weight:500;"><?= lang('position') ?></th>
						<th style="font-size: 12px !important;font-weight:500;"><?= lang('section') ?></th>
						<th style="font-size: 12px !important;font-weight:500;"><?= lang('head') ?></th>
						<th style="font-size: 12px !important;font-weight:500;"><?= lang('Created_Date') ?></th>
						<th style="font-size: 12px !important;font-weight:500;"><?= lang('by_whom') ?></th>
						<th style="font-size: 12px !important;font-weight:500;"><?= lang('document') ?></th>
						<th style="font-size: 12px !important;font-weight:500;min-width: 50px !important;"></th>
					</tr>
					</thead>
					<tbody>
					<? foreach ($staff as $row) : ?>
						<tr>
							<td>
								<div class="media">
									<img
										style="-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 36px; height: 36px;"
										class="mr-3"
										src="<?= ($row['photo'] != '' ? base_url('uploads/' . $folder . '/staff/thumbs/' . $row['photo']) : base_url('assets/img/b.jpg')) ?>"
										alt="Generic placeholder image">
									<div class="media-body">
										<?= $row['first_name'] . ' ' . $row['last_name'] ?>
										<small class="phone_number form-text text-muted">
											<?= $row['contact_1'] ?>
										</small>
									</div>
								</div>
							</td>
							<td class="text-center">
								<? if ($row['status'] == 1) { ?>
									<div class="bg-success"
										 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
								<? } else { ?>
									<div class="bg-danger"
										 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
								<? } ?>
							</td>
							<td><?= $row['position'] ?></td>
							<td><?= $row['department'] ?></td>
							<td><?= $row['head_staff'] ?></td>
							<td><?= $row['registration_date'] ?></td>
							<td><?= $row['user_name'] ?></td>

							<td>

								<? if ($row['document_1'] != '' && $row['ext_1'] != '') { ?>
									<a style="color: #fff;font-size: 12px;margin: 1px; padding: 5px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;"
									   target="_blank"
									   class="bg-info"
									   href="<?= ($row['ext_1'] != '' ? base_url('uploads/' . $folder . '/staff/files/') . $row['file_1'] . '.' . $row['ext_1'] : 'javascript:void(0)') ?>">
										<?= $row['document_1'] ?>
									</a>

								<? }
								if ($row['document_2'] != '' && $row['ext_2'] != '') { ?>
									<a style="color: #fff;font-size: 12px;margin: 1px; padding: 5px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;"
									   target="_blank"
									   class="bg-info"
									   href="<?= ($row['ext_2'] != '' ? base_url('uploads/' . $folder . '/staff/files/') . $row['file_2'] . '.' . $row['ext_2'] : 'javascript:void(0)') ?>">
										<?= $row['document_2'] ?>
									</a>

								<? }
								if ($row['document_3'] != '' && $row['ext_3'] != '') { ?>
									<a style="color: #fff;font-size: 12px;margin: 1px; padding: 5px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;"
									   target="_blank"
									   class="bg-info"
									   href="<?= ($row['ext_3'] != '' ? base_url('uploads/' . $folder . '/staff/files/') . $row['file_3'] . '.' . $row['ext_3'] : 'javascript:void(0)') ?>">
										<?= $row['document_3'] ?>
									</a>

								<? }
								if ($row['document_4'] != '' && $row['ext_4'] != '') { ?>
									<a style="color: #fff;font-size: 12px;margin: 1px; padding: 5px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;"
									   target="_blank"
									   class="bg-info"
									   href="<?= ($row['ext_4'] != '' ? base_url('uploads/' . $folder . '/staff/files/') . $row['file_4'] . '.' . $row['ext_4'] : 'javascript:void(0)') ?>">
										<?= $row['document_4'] ?>
									</a>

								<? } ?>

							</td>

							<td colspan="2">
										<span style="border: none;padding-top: 5px;cursor: pointer;"
											  data-id="<?= $row['id'] ?>" id="edit_staff_modal"
											  data-toggle="modal" class="float-left text-success"
											  data-target="#edit_staff"
											  data-toggle2="tooltip"
											  data-placement="top"
											  title="edit"><i class="fas fa-edit"></i></span>

								<span style="border: none; cursor:pointer;" data-toggle="modal"
									  id="delete_staff_modal"
									  class="text-secondary btn"
									  data-target=".bd-example-modal-sm" data-id="<?= $row['id'] ?>"
									  data-toggle2="tooltip"
									  data-placement="top"
									  title="delete"><i class="fas fa-trash"></i></span></td>
							</td>
						</tr>
					<? endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</div>

</div>

<!-- Staff End -->


<!-- Delete Modal Start -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title text-secondary text-center" id="exampleModalLabel"
					style="font-size: 15px;"><?= lang('are_you_sure_you_want_to_delete') ?></h6>
			</div>
			<div class="modal-footer text-center">
				<div style="margin: 0 auto;">
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" id="delete_staff"
							class="btn btn-outline-success cancel_btn"><?= lang('yes') ?>
					</button>
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" class="btn btn-outline-danger yes_btn"
							data-dismiss="modal"><?= lang('cancel') ?></button>

					<input type="hidden" name="staff_id">
				</div>
			</div>
		</div>

	</div>
</div>
<!-- Delete Modal End -->


<script>
	$(document).on('click', '#delete_staff_modal', function () {
		staff_id = $(this).data('id');
		$('input[name="staff_id"]').val(staff_id);
	});


	$(document).ready(function () {
		$('#example2').DataTable({
			language: {
				search: "<?=lang('search')?>",
				emptyTable: "<?=lang('no_data')?>",
				info: "<?=lang('total')?> _TOTAL_ <?=lang('data')?>",
				infoEmpty: "<?=lang('total')?> 0 <?=lang('data')?>",
				infoFiltered: "(<?=lang('is_filtered')?> _MAX_ <?=lang('total_record')?>)",
				lengthMenu: "<?=lang('showing2')?> _MENU_ <?=lang('record2')?>",
				zeroRecords: "<?=lang('no_matching_records')?>",
				paginate: {
					first: "<?=lang('first')?>",
					last: "<?=lang('last')?>",
					next: "<?=lang('next')?>",
					previous: "<?=lang('prev')?>"
				}
			}
		});
	});


	$(document).on('click', '#delete_staff', function () {
		var id = $('input[name="staff_id"]').val();
		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()).'/Organization/delete_staff/')?>';

		$.post(url, {staff_id: id}, function (result) {
			location.reload();
		});
	});


	$(document).on('click', '#add_staff', function (e) {

		var url = '<?=base_url($this->uri->segment(1) . '/Organization/add_staff_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#staff')[0]);

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
				loading('start', 'add_staff');
				$('.alert-info').removeClass('d-none');
				$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');
			},
			success: function (data) {
				if (data.success == '1') {

					close_message();
					$('.alert-success').removeClass('d-none');
					$('.alert-success').text(data.message);
					loading('stop', 'add_staff');

					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/staff')?>";

					$(location).attr('href', url);

					$(location).attr('href', url + '#staff');

				} else {

					$('.alert-info').addClass('d-none');

					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'add_staff');
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
				$('p#success').addClass('d-none');
				console.log('ERRORS: ' + textStatus);
			},
			complete: function () {

			}
		});
	});


	$(document).on('click', '#edit_staff_btn', function (e) {


		var url = '<?=base_url($this->uri->segment(1) . '/Organization/edit_staff_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#staff_edit')[0]);

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
				loading('start', 'edit_staff_btn');
				$('.alert-info').removeClass('d-none');
				$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');
			},
			success: function (data) {
				if (data.success == '1') {

					close_message();
					$('.alert-success').removeClass('d-none');
					$('.alert-success').html(data.message);
					loading('stop', 'edit_staff_btn');


					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/staff')?>";

					$(location).attr('href', url);


				} else {
					$('.alert-info').addClass('d-none');

					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'edit_staff_btn');
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
				$('p#success').addClass('d-none');
				console.log('ERRORS: ' + textStatus);
			},
			complete: function () {

			}
		});
	});


	$(document).on('click', '#edit_staff_modal', function () {

		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Organization/edit_staff_modal_ax/')?>' + $(this).data('id');
		$.get(url, function (result) {

			// update modal content
			$('.modal-body').html(result);

			// show modal
			$('#myModal').modal('show');
		});

	});


	$(window).on('load', function () {
		<?if($this->input->get('id') != '') {?>
		$('#edit_staff_modal[data-id="<?=$this->input->get('id')?>"]').trigger('click');
		<?}?>

		$('#department').selectpicker({
			noneResultsText: '<?=lang('add')?> {0}'
		});
	});


	/* Staff image Uploade Start*/
	function readURL2(input) {

		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#img-upload2').attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}

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




	function nflTeamsWithDefaults(q, sync) {
		if (q === '') {
			var text = [{'team' :'<?=lang('head')?>'}];
			sync(text);
		} else if(q != '<?=lang('head')?>'){
			$('input[name="head"]').val('');
		} else if (q == '<?=lang('head')?>') {
			$('input[name="head"]').val('1');
		}
	}

	$('#default-suggestions .typeahead').typeahead({
			minLength: 0,
			highlight: true
		},
		{
			name: 'nfl-teams',
			display: 'team',
			source: nflTeamsWithDefaults
		});

	$('#default-suggestions .typeahead').on('typeahead:selected', function(evt, item) {
		$('input[name="head"]').val('1');
	});


	$(document).on('click', 'li.no-results', function () {
		var new_option = $(this).text().split('"')[1];

		if(new_option != '') {
			var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Organization/add_department_select_ax') ?>';
			$.post(url, {title: new_option}, function(e) {
				$("#department")
					.append('<option value="'+e+'" selected>'+ new_option +'</option>')
					.selectpicker('refresh');
			});
		}

	});
</script>
