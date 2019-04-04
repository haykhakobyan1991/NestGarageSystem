<style>
	table.table {
		height: 100vh;
		max-height: 82%;
		min-height: 72%;
	}

	.table th {
		text-align: center;
		vertical-align: top !important;
	}

	.table td {
		max-width: 120px;
		min-width: 120px;
		text-align: center;
		vertical-align: top !important;

	}

	span.today {
		border-radius: 50%;
		background: #007bff;
		width: 25px;
		height: 25px;
		display: inline-block;
		padding: 2px;
		color: #fff;
	}

	.card {
		width: max-content;
		min-width: 100%;
		z-index: 999;
		right: 0;
		color: #000;
		position: absolute;
		display: none;
		box-shadow: 0 24px 38px 3px rgba(0, 0, 0, 0.14), 0 9px 46px 8px rgba(0, 0, 0, 0.12), 0 11px 15px -7px rgba(0, 0, 0, 0.2);
	}

	.btn-small {
		padding: .25rem .5rem !important;
		font-size: .875rem !important;
		border-radius: .2rem;
	}

	.btn-google {
		background-color: #007bff;
		color: #fff;
	}

	.modal_add > span {
		-webkit-transition: all ease-in-out .3s;
		-moz-transition: all ease-in-out .3s;
		-ms-transition: all ease-in-out .3s;
		-o-transition: all ease-in-out .3s;
		transition: all ease-in-out .3s;
	}

	.modal_add:hover > span {
		opacity: 1 !important;
	}

	#today {
		border: 1px solid rgb(255, 122, 89) !important;
		color: #fff !important;
		background: rgb(255, 122, 89) !important;
		transition: all .3s ease-in-out;
	}

	.fas.fa-angle-left {
		color: rgb(255, 122, 89) !important;
		font-size: 16px;
	}

	.fas.fa-angle-right {
		color: rgb(255, 122, 89) !important;
		font-size: 16px;
	}

	button.btn.btn-outline-secondary.border-left-0 {
		padding: 0 !important;
	}


</style>

<!--DatetimePicker-->
<script src="<?= base_url('assets/js/datepicker/gijgo.min.js') ?>" type="text/javascript"></script>
<link href="<?= base_url('assets/css/datepicker/gijgo.min.css') ?>" rel="stylesheet" type="text/css"/>


<?= $calendar ?>


<script>
	$(document).ready(function () {
		$('td.current .modal_add').each(function () {
			$(this).attr('data-day', $('input[name="ym"]').val() + '-' + $(this).parent('td').children('span:first-child').text());
		})
	})
</script>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
	 aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">New Event</h5>
			</div>
			<div class="modal-body">
				<form id="event_add">
					<div class="form-group">
						<label><?= lang('date') ?></label>
						<div class="container">
							<div class="row">
								<input
									name="day"
									class="datepickerFrom form-control date">
								<input
									name="to"
									class="datepickerTo form-control date">
							</div>
						</div>

					</div>
					<div class="form-group">
						<label><?= lang('item_name') ?></label>
						<input placeholder="<?= lang('item_name') ?>" name="title" type="text" class="form-control"
							   value="">
					</div>
					<div class="form-group">
						<label><?= lang('description') ?></label>
						<textarea name="description" class="form-control" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label><?= lang('staff') ?></label>
						<select title="<?= lang('choose') ?>" data-live-search="true"
								class="col selectpicker form-control form-control-sm" name="staff" id="">
							<? foreach ($result_staffs as $staff) : ?>
								<option value="<?= $staff['id'] ?>"><?= $staff['name'] ?></option>
							<? endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label><?= lang('vehicle') ?></label>
						<select title="<?= lang('choose') ?>" data-live-search="true"
								class="col selectpicker form-control form-control-sm" name="fleet" id="">
							<? foreach ($result_fleets as $fleet) : ?>
								<option value="<?= $fleet['id'] ?>"><?= $fleet['brand_model'] ?></option>
							<? endforeach; ?>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button id="add_event" type="button"
						class="btn btn-outline-success cancel_btn"><?= lang('save') ?>
				</button>
				<button id="load1" class="btn btn-sm btn-outline-success cancel_btn d-none"
						style="max-height: 40px; min-width: 93px;"><img
						style="height: 20px;margin: 0 auto;display: block;text-align: center;"
						src="<?= base_url() ?>assets/images/bars2.svg"/></button>
				<button id="cancel_btn" type="button" class="cancel_btn close btn btn-sm clean"
						data-dismiss="modal"
						aria-label="Close">
					<?= lang('cancel') ?>
				</button>

			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Event</h5>
			</div>
			<div class="modal-body" id="modal-body">

			</div>
			<div class="modal-footer">

				<button
					id="edit_event" type="button"
					class="btn  btn-outline-success cancel_btn"><?= lang('save') ?>
				</button>
				<button id="load_2" class="btn btn-sm btn-outline-success cancel_btn d-none"
						style="max-height: 40px; min-width: 93px;"><img
						style="height: 20px;margin: 0 auto;display: block;text-align: center;"
						src="<?= base_url() ?>assets/images/bars2.svg"/></button>
				<button id="cancel_btn" type="button" class="cancel_btn close btn btn-sm clean"
						data-dismiss="modal"
						aria-label="Close">
					<?= lang('cancel') ?>
				</button>


			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-sm" id="delMod" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
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
    font-weight: 500 !important;" type="button" id="delete_event"
							class="btn btn-outline-danger  cancel_btn"><?= lang('yes') ?>
					</button>
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" class=" btn btn-outline-success yes_btn "
							data-dismiss="modal"><?= lang('cancel') ?></button>

					<input type="hidden" name="delete_event_id">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Delete Modal End -->

<script>

	$(document).on('click', '#delete_event_modal', function () {
		event_id = $(this).data('id');
		$('input[name="department_id"]').val(department_id);
	});

	$(document).on('click', '#delete_event', function () {
		var id = $('input[name="delete_event_id"]').val();
		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Gps/delete_event/')?>';

		$.post(url, {event_id, id}, function (result) {
			location.reload();
		});
	});


	const $menu = $('.card');

	$(document).mouseup(function (e) {
		if (!$menu.is(e.target) // if the target of the click isn't the container...
			&& $menu.has(e.target).length === 0) // ... nor a descendant of the container
		{
			$menu.fadeOut();
		}
	});


	$(document).on('click', '#add_event', function (e) {

		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Gps/add_event_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#event_add')[0]);

		$('input').removeClass('border border-danger');
		$('input').parent('td').removeClass('border border-danger');
		$('select').removeClass('border border-danger');
		loading('start', 'add_event');

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
				loading('start', 'add_event', 'load1');
				$('.alert-info').removeClass('d-none');
				$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');
			},
			success: function (data) {
				if (data.success == '1') {
					close_message();


					$('.alert-success').removeClass('d-none');
					$('.alert-success').text(data.message);

					loading('stop', 'add_event', 'load1');


					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/event/' . $this->uri->segment(3) . '/' . $this->uri->segment(4))?>";

					$(location).attr('href', url);


				} else {
					close_message();
					loading('stop', 'add_event', 'load1');

					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'add_event', 'load1');
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

	$('.modal_add').click(function () {
		var day = $(this).data('day');
		console.log(day);
		$('input[name="day"]').val(day);
	});


	$('.event').click(function () {
		$(this).children('.card').fadeIn()
	});


	$('#cancel_btn').click(function () {
		$('input[name="title"]').val('');
		$('textarea[name="description"]').val('');
		$('input[name="from"]').val('00:01');
		$('input[name="to"]').val('23:59');
	});

	$(document).ready(function () {
		width = $('td').width();
		$('.card').css('left', width)
	});


	$(document).on('click', '#edit_event_modal', function () {
		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Gps/edit_event_modal_ax/')?>' + $(this).data('id');
		$.get(url, function (result) {

			// update modal content
			$('#modal-body').html(result);

			// show modal
			$('#myModal').modal('show');
		});

	});


	$(document).on('click', '#edit_event', function (e) {


		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Gps/edit_event_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form.edit_event')[0]);

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


				loading('start', 'edit_event', 'load_2');

			},
			success: function (data) {
				if (data.success == '1') {


					loading('stop', 'edit_event', 'load_2');


					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/event/' . $this->uri->segment(3) . '/' . $this->uri->segment(4))?>";

					$(location).attr('href', url);


				} else {
					close_message();
					loading('stop', 'edit_event', 'load_2');

					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'edit_event', 'load_2');
						errors = '';
						tmp = '';
						$.each(data.error.elements, function (index) {
							$.each(data.error.elements[index], function (index, value) {
								if (value != '') {
									$('input[name="' + index + '"]').addClass('border border-danger');
									$('textarea[name="' + index + '"]').addClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').children('button').addClass('border border-danger');
									close_message();
									$('.alert-danger').removeClass('d-none');

									if (value != tmp) {
										errors += value;
									}
									tmp = value;

								} else {
									$('input[name="' + index + '"]').removeClass('border border-danger');
									$('textarea[name="' + index + '"]').removeClass('border border-danger');
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


	$('.datepickerFrom').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd',
		iconsLibrary: 'fontawesome'
	});

	$('.datepickerTo').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd',
		iconsLibrary: 'fontawesome'
	});


	$('input.date').parent('div').addClass('col-sm-6 p-0');


</script>
