<?
$user_id = $this->session->user_id;
$folder = $this->session->folder;
?>
<style>
	.a_ext > i {
		font-size: 27px;
		padding-top: 5px !important;
	}
</style>
<form id="staff_edit" enctype="multipart/form-data">
	<input type="hidden" name="staff_id" value="<?= $id ?>">
	<div class="for_message">
		<div class="alert alert-success d-none" role="alert"></div>
		<div class="alert alert-danger  d-none" role="alert"></div>
		<div class="alert alert-info  d-none" role="alert"></div>
	</div>

	<div class="row">
		<div class="col-sm-12 col-md-6 col-6">
			<h5><?= lang('staff_information') ?></h5>
		</div>
		<div class="col-sm-12 col-md-6 col-6">
			<h5 style="padding-top: 10px;margin-left: 116px;float: none;display: unset;"><?= lang('picture') ?></h5>
			<div class="media">
				<img class="align-self-start mr-3"
					 id='img-upload2'
					 style="width: 100px;margin-top: -30px;" alt=""
					 src="<?= ($photo == '' ? base_url('assets/images/no_choose_image.svg') : base_url('uploads/' . $folder . '/staff/thumbs/' . $photo)) ?>">
				<div class="media-body col-sm-12" style="position: relative;padding: 0;">
					<p style="margin-top: 3px;"><?= lang('upload_staff_picture'); ?></p>
					<div class="input-group ml-2 ml-md-2">
						<span class="input-group-btn"
									 style="position:absolute; right: 18px;">
							<span id="remove_picture2"
								  class="btn btn-sm btn-outline-secondary mr-3"><i
									class="fas fa-times"></i></span>
							<span
								class="btn btn-outline-success btn-file"
								style="margin-top: -10px;font-size: 14px !important;line-height: 14px !important;padding: 12px 24px !important;font-weight: 500 !important;margin-left: -8px;">
								<?= lang('browse') ?> <input type="file" id="imgInp2"
															 name="photo"
															 accept='image/png'
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
							class="col-sm-4 col-form-label"><?= lang('first_name') ?>*</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm"
								   name="firstname"
								   value="<?= $first_name ?>"
								   placeholder="<?= lang('first_name') ?>">
						</div>
					</div>
					<div class="row mt-1">
						<label
							class="col-sm-4 col-form-label"><?= lang('last_name') ?>*</label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm"
								   name="lastname"
								   value="<?= $last_name ?>"
								   placeholder="<?= lang('last_name') ?>">
						</div>
					</div>
					<div class="row mt-1">
						<label
							class="col-sm-4 col-form-label"><?= lang('email') ?>*</label>
						<div class="col-sm-8">
							<input type="email" class="form-control form-control-sm"
								   name="email"
								   value="<?= $email ?>"
								   placeholder="<?= lang('email') ?>">
						</div>
					</div>
					<div class="row mt-1">
						<label
							class="col-sm-4 col-form-label"><?= lang('department') ?>*</label>
						<div class="col-sm-8">
							<select name="department"
									class="col  selectpicker form-control form-control-sm"
									id="department"
									data-live-search="true"
									title="<?= lang('select_department') ?>">
								<? foreach ($department as $row) : ?>
									<option <?= (in_array($row['id'], $department_id) ? 'selected' : '') ?>
										value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
								<? endforeach; ?>
							</select>
						</div>
					</div>
					<div class="row" style="margin-top: .75rem!important;">
						<label class="col-sm-4 col-form-label"><?= lang('position') ?></label>
						<div id="default-suggestions" class="col-sm-8">
							<input type="text" class="typeahead trd form-control form-control-sm"
								   name="position"
								   value="<?= $position ?>"
								   placeholder="<?= lang('position') ?>">
							<input type="hidden" name="head" value="<?= ($position == lang('head') ? '1' : '') ?>">
						</div>
					</div>
					<div class="row mt-1">
						<label class="col-sm-4 col-form-label"><?= lang('nest_card_id') ?></label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm"
								   name="nest_card_id"
								   VALUE="<?= $nest_card_id ?>"
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
								<option value=""><?= lang('select_country') ?> ...</option>
								<? foreach ($country as $row) : ?>
									<option <?= ($country_id == $row['id'] ? 'selected' : '') ?>
										value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
								<? endforeach; ?>
							</select>
						</div>
					</div>
					<div class="row" style="margin-top: .75rem!important;">
						<label
							class="col-sm-4 col-form-label"><?= lang('address') ?></label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm"
								   name="address"
								   value="<?= $address ?>"
								   placeholder="<?= lang('address') ?>">
						</div>
					</div>
					<div class="row mt-1">
						<label
							class="col-sm-4 col-form-label"><?= lang('post_code') ?></label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm"
								   name="post_code"
								   value="<?= $post_code ?>"
								   placeholder="<?= lang('post_code') ?>">
						</div>
					</div>
					<div class="row mt-1">
						<label
							class="col-sm-4 col-form-label"><?= lang('contact_number') ?></label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm"
								   name="contact_1"
								   value="<?= $contact_1 ?>"
								   placeholder="<?= lang('contact_number') ?> 1">
						</div>
					</div>
					<div class="row mt-1">
						<label
							class="col-sm-4 col-form-label"></label>
						<div class="col-sm-8">
							<input type="text" class="form-control form-control-sm"
								   name="contact_2"
								   value="<?= $contact_2 ?>"
								   placeholder="<?= lang('contact_number') ?> 2">
						</div>
					</div>
				</div>

				<div class="col-sm-12 mt-1">
					<div class="row" style="    margin-right: -1px;
    margin-left: -1px;">
						<textarea placeholder="<?= lang('other') ?>" class="form-control"
								  id="exampleFormControlTextarea1" name="other" rows="3"><?= $other ?></textarea>
					</div>
				</div>
			</div>


			<div class="accordion mt-1" id="accordionExample1">
				<div class="card">
					<div class="card-header p-0" id="headingOne">
						<h5 class="mb-0">
							<button class="btn btn-sm btn-link text-success" type="button"
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
									<input type="hidden" name="document_1" value="<?= lang('passport') ?>"/>
									<div class="col-md-3">
										<div class="form-group">
											<label for=""><?= lang('passport') ?></label>
											<label
												style="width: 80%;min-width: 85px;font-size: 14px !important;line-height: 14px !important;padding: 10px 10px !important;font-weight: 400 !important;"
												class="btn btn-sm btn-outline-secondary">
												<span><?= lang('browse') ?></span>
												<input class="btn_input"
													   name="file_1" type="file"
													   hidden style="display: none;"
													   value="">


											</label>
											<a style="margin-top: 4px"
											   class="a_ext"
											   target="_blank"
											   href="<?= ($ext_1 != '' ? base_url('uploads/' . $folder . '/staff/files/') . $file_1 . '.' . $ext_1 : 'javascript:void(0)') ?>">
												<?= $this->select_ext($ext_1); ?>
											</a>


										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label><?= lang('reference') ?></label>
											<input type="text"
												   name="reference_1"
												   value="<?= $reference_1 ?>"
												   class="form-control form-control-sm"
												   placeholder="<?= lang('reference') ?>">
										</div>
									</div>
									<div class="col-md-3">
										<label><?= lang('expired_date') ?></label>
										<input type="date" name="expiration_1"
											   max="3000-12-31"
											   min="1000-01-01"
											   value="<?= $expiration_1 ?>"
											   class="form-control form-control-sm">
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label><?= lang('note') ?></label>
											<input type="text"
												   name="note_1"
												   value="<?= $note_1 ?>"
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
							<button class="btn btn-sm btn-link collapsed text-success"
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
									<input type="hidden" name="document_2" value="<?= lang('social_card') ?>"/>
									<div class="col-md-3">
										<div class="form-group">
											<label for=""><?= lang('social_card') ?></label>
											<label
												style="width: 80%;min-width: 85px;font-size: 14px !important;line-height: 14px !important;padding: 10px 10px !important;font-weight: 400 !important;"
												class="btn btn-sm btn-outline-secondary">
												<span><?= lang('browse') ?></span>
												<input class="btn_input"
													   name="file_2" type="file"
													   hidden style="display: none;"
													   value="">


											</label>
											<a style="margin-top: 4px"
											   class="a_ext"
											   target="_blank"
											   href="<?= ($ext_2 != '' ? base_url('uploads/' . $folder . '/staff/files/') . $file_2 . '.' . $ext_2 : 'javascript:void(0)') ?>">
												<?= $this->select_ext($ext_2); ?>
											</a>


										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label><?= lang('reference') ?></label>
											<input type="text"
												   name="reference_2"
												   value="<?= $reference_2 ?>"
												   class="form-control form-control-sm"
												   placeholder="<?= lang('reference') ?>">
										</div>
									</div>
									<div class="col-md-3">
										<label><?= lang('expired_date') ?></label>
										<input type="date" name="expiration_2"
											   max="3000-12-31"
											   min="1000-01-01"
											   value="<?= $expiration_2 ?>"
											   class="form-control form-control-sm">
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label><?= lang('note') ?></label>
											<input type="text"
												   name="note_2"
												   value="<?= $note_2 ?>"
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
							<button class="btn btn-sm btn-link collapsed text-success" type="button"
									data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
									aria-controls="collapseThree"><?= lang('driving_license') ?></button>
						</h5>
					</div>
					<div id="collapseThree" class="collapse"
						 aria-labelledby="headingThree"
						 data-parent="#accordionExample1">
						<div class="card-body">
							<div class="add_new_items">
								<div class="row">
									<input type="hidden" name="document_3" value="<?= lang('driving_license') ?>"/>
									<div class="col-md-3">
										<div class="form-group">
											<label for=""><?= lang('driving_license') ?></label>
											<label
												style="width: 80%;min-width: 85px;font-size: 14px !important;line-height: 14px !important;padding: 10px 10px !important;font-weight: 400 !important;"
												class="btn btn-sm btn-outline-secondary">
												<span><?= lang('browse') ?></span>
												<input class="btn_input" name="file_3" type="file" hidden
													   style="display: none;" value="">
											</label>
											<a style="margin-top: 4px"
											   class="a_ext"
											   target="_blank"
											   href="<?= ($ext_3 != '' ? base_url('uploads/' . $folder . '/staff/files/') . $file_3 . '.' . $ext_3 : 'javascript:void(0)') ?>">
												<?= $this->select_ext($ext_3); ?>
											</a>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label><?= lang('reference') ?></label>
											<input type="text" name="reference_3" value="<?= $reference_3 ?>"
												   class="form-control form-control-sm"
												   placeholder="<?= lang('reference') ?>">
										</div>
									</div>
									<div class="col-md-3">
										<label><?= lang('expired_date') ?></label>
										<input type="date" name="expiration_3" max="3000-12-31" min="1000-01-01"
											   value="<?= $expiration_3 ?>" class="form-control form-control-sm">
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label><?= lang('note') ?></label>
											<input type="text" name="note_3" value="<?= $note_3 ?>"
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
							<button class="btn btn-sm btn-link collapsed text-success" type="button"
									data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
									aria-controls="collapseThree">
								<?= lang('health_insurance') ?>
							</button>
						</h5>
					</div>
					<div id="collapseFour" class="collapse"
						 aria-labelledby="headingFour"
						 data-parent="#accordionExample1">
						<div class="card-body">
							<div class="add_new_items">
								<div class="row">

									<input type="hidden" name="document_4" value="<?= lang('health_insurance') ?>"/>
									<div class="col-md-3">
										<div class="form-group">
											<label><?= lang('health_insurance') ?></label>
											<label
												style="width: 80%;min-width: 85px;font-size: 14px !important;line-height: 14px !important;padding: 10px 10px !important;font-weight: 400 !important;"
												class="btn btn-sm btn-outline-secondary">
												<span><?= lang('browse') ?></span>
												<input class="btn_input" name="file_4" type="file" hidden
													   style="display: none;" value="">
											</label>
											<a style="margin-top: 4px" class="a_ext" target="_blank"
											   href="<?= ($ext_4 != '' ? base_url('uploads/' . $folder . '/staff/files/') . $file_4 . '.' . $ext_4 : 'javascript:void(0)') ?>">
												<?= $this->select_ext($ext_4); ?>
											</a>
										</div>
									</div>

									<div class="col-md-3">
										<div class="form-group">
											<label><?= lang('reference') ?></label>
											<input type="text" name="reference_4" value="<?= $reference_4 ?>"
												   class="form-control form-control-sm"
												   placeholder="<?= lang('reference') ?>">
										</div>
									</div>
									<div class="col-md-3">
										<label><?= lang('expired_date') ?></label>
										<input type="date" name="expiration_4" max="3000-12-31" min="1000-01-01"
											   value="<?= $expiration_4 ?>" class="form-control form-control-sm">
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label><?= lang('note') ?></label>
											<input type="text" name="note_4" value="<?= $note_4 ?>"
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
	<div class="modal-footer pb-0 col-sm-12 mt-1" style="padding-right: 9px !important;">
		<button id="edit_staff_btn" type="button"
				class="btn btn-outline-success cancel_btn"><?= lang('save') ?>
		</button>
		<button style="max-height: 40px; height: 40px !important; " id="load"
				class="cancel_btn close btn btn-sm d-none">
			<img style="height: 25px; padding-bottom: 10px; margin-bottom: 10px; display: block; text-align: center;"
				 src="<?= base_url() ?>assets/images/bars2.svg"/>
		</button>
		<button type="button" class="cancel_btn close btn btn-sm"
				data-dismiss="modal"
				aria-label="Close">
			<?= lang('cancel') ?>
		</button>
	</div>
</form>

<script>
	$('#department').selectpicker('refresh');
	$('#country').selectpicker('refresh');


	$('.selectpicker').parent('div').children('button').css({
		'background': '#fff',
		'color': '#000',
		'border': '1px solid #ced4da'
	});
	$('.selectpicker').parent('div').children('button').removeClass('btn-light');


	$('#department').selectpicker({
		noneResultsText: '<?=lang('add')?> {0}'
	});

	function nflTeamsWithDefaults(q, sync) {
		if (q === '') {
			var text = [{'team': '<?=lang('head')?>'}];
			sync(text);
		} else if (q != '<?=lang('head')?>') {
			$('input[name="head"]').val('');
		} else if (q == '<?=lang('head')?>') {
			$('input[name="head"]').val('1');
		}
	}


	$('#default-suggestions .typeahead.trd').typeahead({
			minLength: 0,
			highlight: true
		},
		{
			name: 'nfl-teams',
			display: 'team',
			source: nflTeamsWithDefaults
		});

	$('#default-suggestions .typeahead.trd').on('typeahead:selected', function (evt, item) {
		$('input[name="head"]').val('1');
	});

	$('#remove_picture2').click(function () {
		$('#img-upload2').attr('src', '<?= base_url('assets/images/no_choose_image.svg') ?>');
		$('#imgInp2').val('');
	})
</script>

