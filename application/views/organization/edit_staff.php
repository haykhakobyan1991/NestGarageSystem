<?
$user_id = $this->session->user_id;
?>
<form id="staff_edit" enctype="multipart/form-data">
	<input type="hidden" name="staff_id" value="<?= $id ?>">
	<div class="for_message">
		<div class="alert alert-success d-none" role="alert"></div>
		<div class="alert alert-danger  d-none" role="alert"></div>
	</div>

	<div class="row">
		<div class="col-sm-12 col-md-6 col-6">
			<h2>Staff Infprmation</h2>
			<p>Fill in the following fields</p>
		</div>

		<div class="col-sm-12 col-md-6 col-6">
			<div class="media">
				<img class="align-self-start mr-3"
					 id='img-upload2'

					 style="width: 100px;" alt=""
					 src="<?= ($photo == '' ? base_url('assets/images/no_choose_image.svg') : base_url('uploads/user_'.$user_id.'/staff/original/'.$photo)) ?>">
				<div class="media-body">
					<div class="input-group ml-2 ml-md-2">
														<span class="input-group-btn">
															<span
																class="btn btn-outline-success btn-file mr-1">
																Browse… <input type="file" id="imgInp2"
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

	<div class="row">
		<div
			class="col-sm-12 col-md-12 col-12  mt-md-5 mt-5 pl-md-4 pl-4 pr-md-4 pr-4">
			<div class="form-group row">
				<label
					class="col-sm-2 col-form-label">First
					Name *</label>
				<div class="col-sm-10">
					<input type="text" class="form-control form-control-sm"
						   name="firstname"
						   value="<?=$first_name?>"
						   placeholder="First Name">
				</div>
			</div>
			<div class="form-group row">
				<label
					class="col-sm-2 col-form-label">Last
					Name *</label>
				<div class="col-sm-10">
					<input type="text" class="form-control form-control-sm"
						   name="lastname"
						   value="<?=$last_name?>"
						   placeholder="Last Name">
				</div>
			</div>
			<div class="form-group row">
				<label
					class="col-sm-2 col-form-label">Contact
					Number
					1</label>
				<div class="col-sm-10">
					<input type="text" class="form-control form-control-sm"
						   name="contact_1"
						   value="<?=$contact_1?>"
						   placeholder="Contact Number 1">
				</div>
			</div>
			<div class="form-group row">
				<label
					class="col-sm-2 col-form-label">Contact
					Number
					2</label>
				<div class="col-sm-10">
					<input type="text" class="form-control form-control-sm"
						   name="contact_2"
						   value="<?=$contact_2?>"
						   placeholder="Contact Number 2">
				</div>
			</div>

			<div class="form-group row">
				<label
					class="col-sm-2 col-form-label">Email</label>
				<div class="col-sm-10">
					<input type="email" class="form-control form-control-sm"
						   name="email"
						   value="<?=$email?>"
						   placeholder="Email">
				</div>
			</div>

			<div class="form-group row">
				<label
					class="col-sm-2 col-form-label">Leave Country</label>
				<div class="col-sm-10">
					<select name="country"
							class="col selectpicker form-control form-control-sm"
							data-size="5" id="country" data-live-search="true"
							title="Select a Country">
						<option value="">Select a Country ...</option>
						<? foreach ($country as $row) : ?>
							<option <?=($country_id == $row['id'] ? 'selected' : '')?> value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
						<? endforeach; ?>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label
					class="col-sm-2 col-form-label">Address
					Leave</label>
				<div class="col-sm-10">
					<input type="text" class="form-control form-control-sm"
						   name="address"
						   value="<?=$address?>"
						   placeholder="Address">
				</div>
			</div>


			<div class="form-group row">
				<label
					class="col-sm-2 col-form-label">Post
					Code</label>
				<div class="col-sm-10">
					<input type="text" class="form-control form-control-sm"
						   name="post_code"
						   value="<?=$post_code?>"
						   placeholder="Post Code">
				</div>
			</div>


			<div class="form-group row ">

				<label
					class="col-sm-2 col-form-label">Department</label>
				<div class="col-sm-10">
					<select name="department[]"
							class="col  selectpicker form-control form-control-sm"
							id="department"
							multiple data-live-search="true"
							title="Select a Department">
						<? foreach ($department as $row) : ?>
							<option <?=(in_array( $row['id'], $department_id) ? 'selected' : '')?>
								value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
						<? endforeach; ?>

					</select>
				</div>

			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Position</label>
				<div class="col-sm-10">
					<input type="text" class="form-control form-control-sm"
						   name="position"
						   value="<?=$position?>"
						   placeholder="Position">
				</div>
			</div>


			<div class="form-group mt-md-2 mt-2">
				<label
					for="exampleFormControlTextarea1">Other</label>
				<textarea placeholder="Other"
						  class="form-control"
						  id="exampleFormControlTextarea1"
						  name="other"
						  rows="3"><?=$other?></textarea>
			</div>

			<div class="form-group row">
				<label
					class="col-sm-10 col-form-label">Status make
					a
					Passive?</label>
				<div class="col-sm-2">
					<input name="status"
						   value="-1"
						   <?=($status == '-1' ? 'checked' : '')?>
						   type="checkbox"
						   class="form-control form-control-sm">
				</div>
			</div>


			<div class="accordion" id="accordionExample1">
				<div class="card">
					<div class="card-header" id="headingOne">
						<h5 class="mb-0">
							<button class="btn btn-sm btn-link text-success" type="button"
									data-toggle="collapse"
									data-target="#collapseOne"
									aria-expanded="true"
									aria-controls="collapseOne">
								<?=($document_1 != '' ? $document_1 : 'N/D')?>
							</button>
						</h5>
					</div>

					<div id="collapseOne" class="collapse show"
						 aria-labelledby="headingOne"
						 data-parent="#accordionExample1">
						<div class="card-body">
							<div class="add_new_items">
								<div class="row">

									<div class="col-md-2">
										<div class="form-group">
											<label>Document</label>
											<input type="text"
												   name="document_1"
												   value="<?=$document_1?>"
												   class="form-control form-control-sm"
												   placeholder="Document">
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">

												<label style="margin-top: 30px;"
													   class="btn btn-sm btn-outline-success">
													<span>Brows file</span>
													<input class="btn_input"
														   name="file_1" type="file"
														   hidden style="display: none;"
														   value="">


												</label>
												<a style="margin-top: 4px"
												   target="_blank"
												   href="<?= ($ext_1 != '' ? base_url('uploads/user_'.$user_id.'/staff/files/'). $file_1. '.' . $ext_1 : 'javascript:void(0)' )  ?>">
													<?= $this->select_ext($ext_1); ?>
												</a>


										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label>Reference</label>
											<input type="text"
												   name="reference_1"
												   value="<?=$reference_1?>"
												   class="form-control form-control-sm"
												   placeholder="Reference">
										</div>
									</div>
									<div class="col-md-3">
										<label>Epired Date</label>
										<input type="date" name="expiration_1"
											   max="3000-12-31"
											   min="1000-01-01"
											   value="<?=$expiration_1?>"
											   class="form-control form-control-sm">
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Note</label>
											<input type="text"
												   name="note_1"
												   value="<?=$note_1?>"
												   class="form-control form-control-sm"
												   placeholder="Note">
										</div>
									</div>

								</div>


							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingTwo">
						<h5 class="mb-0">
							<button class="btn btn-sm btn-link collapsed text-success"
									type="button"
									data-toggle="collapse"
									data-target="#collapseTwo"
									aria-expanded="false"
									aria-controls="collapseTwo">
								<?=($document_2 != '' ? $document_2 : 'N/D')?>
							</button>
						</h5>
					</div>
					<div id="collapseTwo" class="collapse"
						 aria-labelledby="headingTwo"
						 data-parent="#accordionExample1">
						<div class="card-body">
							<div class="add_new_items">
								<div class="row">

									<div class="col-md-2">
										<div class="form-group">
											<label>Document</label>
											<input type="text"
												   name="document_2"
												   value="<?=$document_2?>"
												   class="form-control form-control-sm"
												   placeholder="Document">
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">

											<label style="margin-top: 30px;"
												   class="btn btn-sm btn-outline-success">
												<span>Brows file</span>
												<input class="btn_input"
													   name="file_2" type="file"
													   hidden style="display: none;"
													   value="">


											</label>
											<a style="margin-top: 4px"
											   target="_blank"
											   href="<?= ($ext_2 != '' ? base_url('uploads/user_'.$user_id.'/staff/files/'). $file_2. '.' . $ext_2 : 'javascript:void(0)' )  ?>">
												<?= $this->select_ext($ext_2); ?>
											</a>


										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label>Reference</label>
											<input type="text"
												   name="reference_2"
												   value="<?=$reference_2?>"
												   class="form-control form-control-sm"
												   placeholder="Reference">
										</div>
									</div>
									<div class="col-md-3">
										<label>Epired Date</label>
										<input type="date" name="expiration_2"
											   max="3000-12-31"
											   min="1000-01-01"
											   value="<?=$expiration_2?>"
											   class="form-control form-control-sm">
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Note</label>
											<input type="text"
												   name="note_2"
												   value="<?=$note_2?>"
												   class="form-control form-control-sm"
												   placeholder="Note">
										</div>
									</div>

								</div>


							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingThree">
						<h5 class="mb-0">
							<button class="btn btn-sm btn-link collapsed text-success"
									type="button"
									data-toggle="collapse"
									data-target="#collapseThree"
									aria-expanded="false"
									aria-controls="collapseThree">
								<?=($document_3 != '' ? $document_3 : 'N/D')?>
							</button>
						</h5>
					</div>
					<div id="collapseThree" class="collapse"
						 aria-labelledby="headingThree"
						 data-parent="#accordionExample1">
						<div class="card-body">
							<div class="add_new_items">
								<div class="row">

									<div class="col-md-2">
										<div class="form-group">
											<label>Document</label>
											<input type="text"
												   name="document_3"
												   value="<?=$document_3?>"
												   class="form-control form-control-sm"
												   placeholder="Document">
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">

											<label style="margin-top: 30px;"
												   class="btn btn-sm btn-outline-success">
												<span>Brows file</span>
												<input class="btn_input"
													   name="file_3" type="file"
													   hidden style="display: none;"
													   value="">


											</label>
											<a style="margin-top: 4px"
											   target="_blank"
											   href="<?= ($ext_3 != '' ? base_url('uploads/user_'.$user_id.'/staff/files/'). $file_3. '.' . $ext_3 : 'javascript:void(0)' )  ?>">
												<?= $this->select_ext($ext_3); ?>
											</a>


										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label>Reference</label>
											<input type="text"
												   name="reference_3"
												   value="<?=$reference_3?>"
												   class="form-control form-control-sm"
												   placeholder="Reference">
										</div>
									</div>
									<div class="col-md-3">
										<label>Epired Date</label>
										<input type="date" name="expiration_3"
											   max="3000-12-31"
											   min="1000-01-01"
											   value="<?=$expiration_3?>"
											   class="form-control form-control-sm">
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Note</label>
											<input type="text"
												   name="note_3"
												   value="<?=$note_3?>"
												   class="form-control form-control-sm"
												   placeholder="Note">
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-header" id="headingFour">
						<h5 class="mb-0">
							<button class="btn btn-sm btn-link collapsed text-success"
									type="button"
									data-toggle="collapse"
									data-target="#collapseFour"
									aria-expanded="false"
									aria-controls="collapseThree">
								<?=($document_4 != '' ? $document_4 : 'N/D')?>
							</button>
						</h5>
					</div>
					<div id="collapseFour" class="collapse"
						 aria-labelledby="headingFour"
						 data-parent="#accordionExample1">
						<div class="card-body">
							<div class="add_new_items">
								<div class="row">

									<div class="col-md-2">
										<div class="form-group">
											<label>Document</label>
											<input type="text"
												   name="document_4"
												   value="<?=$document_4?>"
												   class="form-control form-control-sm"
												   placeholder="Document">
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">

											<label style="margin-top: 30px;"
												   class="btn btn-sm btn-outline-success">
												<span>Brows file</span>
												<input class="btn_input"
													   name="file_4" type="file"
													   hidden style="display: none;"
													   value="">


											</label>
											<a style="margin-top: 4px"
											   target="_blank"
											   href="<?= ($ext_4 != '' ? base_url('uploads/user_'.$user_id.'/staff/files/'). $file_4. '.' . $ext_4 : 'javascript:void(0)' )  ?>">
												<?= $this->select_ext($ext_4); ?>
											</a>


										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<label>Reference</label>
											<input type="text"
												   name="reference_4"
												   value="<?=$reference_4?>"
												   class="form-control form-control-sm"
												   placeholder="Reference">
										</div>
									</div>
									<div class="col-md-3">
										<label>Epired Date</label>
										<input type="date" name="expiration_4"
											   max="3000-12-31"
											   min="1000-01-01"
											   value="<?=$expiration_4?>"
											   class="form-control form-control-sm">
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Note</label>
											<input type="text"
												   name="note_4"
												   value="<?=$note_4?>"
												   class="form-control form-control-sm"
												   placeholder="Note">
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
	<div class="text-right mt-4 pb-2">
		<span id="edit_staff" class="btn btn-outline-success">Save</span>
	</div>
</form>

<script>
	$('#department').selectpicker('refresh');
	$('#country').selectpicker('refresh');


	$('.selectpicker').parent('div').children('button').css({'background': '#fff', 'color': '#000', 'border': '1px solid #ced4da'});
	$('.selectpicker').parent('div').children('button').removeClass('btn-light');
</script>

