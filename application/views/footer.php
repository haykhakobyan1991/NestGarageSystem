<script class="">
	$(document).ready(function () {
		$(document).on('change', '.btn-file :file', function () {
			var input = $(this),
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function (event, label) {

			var input = $(this).parents('.input-group').find(':text'),
				log = label;

			if (input.length) {
				input.val(log);
			} else {
				if (log) alert(log);
			}

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


		/*Staff img uploade end*/
	});

	/* Staff image Uploade Start*/
	function readURL2(input) {

		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#img-upload2').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	/* Staff Passport Image Uploade Start*/
	function readURL3(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#img-upload3').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	/*Staff Password image uploade end*/


	$(document).on('click', '.remove_document', function () {
		$(this).parent('div').parent('div').remove();
	});

	$('.add_new_row').click(function () {
		var l = 2;
		$('.first_row').append('<div class="form-group row" style="position: relative;">\n' +
			'<label\n' +
			'class="col-sm-2 col-form-label"></label>\n' +
			'<div class="col-sm-9">\n' +
			'<select value="" class="currency form-control form-control-sm">\n' +
			'<option>opton 1</option>\n' +
			'<option>option 2</option>\n' +
			'</select>\n' +
			'</div>\n' +
			'<div class="col-1">\n' +
			'<button type="button" style="border:none;"\n' +
			'class="remove_new_row btn btn-outline-secondary float-right">\n' +
			'<i class="fas fa-trash"></i></i></button>\n' +
			'</div>\n' +
			'</div>');
		l++;
	});

	$(document).on('click', '.remove_new_row', function () {
		$(this).parent('div').parent('div').remove();
	});
</script>

<!--todo add to main.js-->
<script>
	$(document).on('click', '.langs > ul > li', function () {
		var lang = $(this).data('lang');
		var url = $(this).parent('ul').data('url');
		var current_url = window.location.href;  //todo if firefox document.URL;
		$.ajax({
			type: 'POST',
			url: url,
			data: {lang: lang, current_url: current_url},
			success: function (url) {
				if (url != '') {
					$(location).attr('href', url);
				}
			}
		});
	});
</script>

<script>
	function scroll_top() {
		$('.modal, body').animate({ scrollTop: $('.modal, body').offset().top }, 700);
	}

	function close_message() {
		setTimeout(function(){ $('.alert-success, .alert-danger').addClass('d-none'); }, 3000);
	}
</script>

<script>
	// create company
	$(document).on('click', '#create_company', function (e) {

		var url = '<?=base_url('Main/create_company_ax') ?>';
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
			success: function (data) {
				if (data.success == '1') {

					scroll_top();

					$('.alert-success').removeClass('d-none');
					$('.alert-danger').addClass('d-none');
					$('.alert-success').text(data.message);

					close_message();
					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/create_company')?>"; //todo

					$(location).attr('href', url);

				} else {

					if ($.isArray(data.error.elements)) {
						scroll_top();


						$.each(data.error.elements, function (index) {

							$.each(data.error.elements[index], function (index, value) {

								if (value != '') {

									$('input[name="' + index + '"]').addClass('border border-danger');
									$('select[name="' + index + '"]').addClass('border border-danger');
									$('input[name="' + index + '"]').parent('td').addClass('border border-danger');

									$('.alert-danger').removeClass('d-none');
									$('.alert-danger').text('* - ով դաշտերը պարտադիր են');

								} else {
									$('input[name="' + index + '"]').removeClass('border border-danger');
									$('select[name="' + index + '"]').removeClass('border border-danger');
									$('input[name="' + index + '"]').parent('td').removeClass('border border-danger');
								}

							});


						});

					}

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


</script>


<script>
	// create company
	$(document).on('click', '#add_staff', function (e) {

		var url = '<?=base_url('Main/add_staff_ax') ?>';
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
			success: function (data) {
				if (data.success == '1') {

					scroll_top();

					$('.alert-success').removeClass('d-none');
					$('.alert-danger').addClass('d-none');
					$('.alert-success').text(data.message);

					close_message();


					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/create_company')?>"; //todo

					$(location).attr('href', url);

					$(location).attr('href', url + '#staff');

				} else {

					if ($.isArray(data.error.elements)) {
						scroll_top();

						$('.alert-danger').addClass('d-none');
						$('.alert-success').addClass('d-none');

						$.each(data.error.elements, function (index) {

							$.each(data.error.elements[index], function (index, value) {

								if (value != '') {

									$('input[name="' + index + '"]').addClass('border border-danger');
									$('select[name="' + index + '"]').addClass('border border-danger');
									$('input[name="' + index + '"]').parent('td').addClass('border border-danger');


									$('.alert-danger').removeClass('d-none');
									$('.alert-danger').text('* - ով դաշտերը պարտադիր են');

								} else {
									$('input[name="' + index + '"]').removeClass('border border-danger');
									$('select[name="' + index + '"]').removeClass('border border-danger');
									$('input[name="' + index + '"]').parent('td').removeClass('border border-danger');


								}

							});


						});

					}

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


</script>

<script>
	// create department
	$(document).on('click', '#add_department', function (e) {

		var url = '<?=base_url('Main/add_department_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#department')[0]);

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
			success: function (data) {
				if (data.success == '1') {

					scroll_top();

					$('.alert-success').removeClass('d-none');
					$('.alert-danger').addClass('d-none');
					$('.alert-success').text(data.message);

					close_message();


					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/create_company')?>"; //todo

					$(location).attr('href', url);


				} else {

					if ($.isArray(data.error.elements)) {
						scroll_top();

						$('.alert-danger').addClass('d-none');
						$('.alert-success').addClass('d-none');

						$.each(data.error.elements, function (index) {

							$.each(data.error.elements[index], function (index, value) {

								if (value != '') {

									$('input[name="' + index + '"]').addClass('border border-danger');
									$('select[name="' + index + '"]').addClass('border border-danger');
									$('input[name="' + index + '"]').parent('td').addClass('border border-danger');


									$('.alert-danger').removeClass('d-none');
									$('.alert-danger').text('* - ով դաշտերը պարտադիր են');

								} else {
									$('input[name="' + index + '"]').removeClass('border border-danger');
									$('select[name="' + index + '"]').removeClass('border border-danger');
									$('input[name="' + index + '"]').parent('td').removeClass('border border-danger');


								}

							});


						});

					}

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


</script>


<script type="text/javascript">

	<!-- Colors -->
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

	$(window).on('load', function () {
		$('button.dropdown-toggle.bs-placeholder').removeClass('btn-light');
		var count = 0;
		$('form#company input,select').each(function () {
			if ($(this).val() == '') {
				count++;
			}
		});

		console.log(count);
	})


	// sidebar
	var c_url = '<?=current_url()?>';

	var url = window.location.href;

	$('#list-department-list').click(function () {
		$(location).attr('href', c_url + '#department');
	});

	$('#list-staff-list').click(function () {
		$(location).attr('href', c_url + '#staff');
	});

	$('#list-company-list').click(function () {
		$(location).attr('href', c_url + '#company');
	});

	$('#list-settings-list').click(function () {
		$(location).attr('href', c_url + '#settings');
	});

	if (url.indexOf('#staff') != -1) {

		$('#list-staff-list').trigger('click');
	}

	if (url.indexOf('#department') != -1) {

		$('#list-department-list').trigger('click');
	}

	if (url.indexOf('#company') != -1) {

		$('#list-company-list').trigger('click');
	}

	if (url.indexOf('#settings') != -1) {

		$('#list-company-list').trigger('click');
	}


	$('.add_new_item').click(function(){
		$('.new_items_tbody').append('<tr>\n' +
			'<td>\n' +
			'<input class="form-control form-control-sm" type="text" placeholder="Item" value="">\n' +
			'</td>\n' +
			'<td>\n' +
			'<input class="form-control form-control-sm" type="text" placeholder="Minimum (time)" value=""/>\n' +
			'</td>\n' +
			'<td>\n' +
			'<input class="form-control form-control-sm" type="text" placeholder="Remind Me  days before" value=""/>\n' +
			'</td>\n' +
			'<td>\n' +
			'<input class="form-control form-control-sm" type="date" value="" />\n' +
			'</td>\n' +
			'</tr>');
	});


	$('.dif_meter').on('change', function(){
		$('.dif_meter_text').text($(this).val());
	});


	$('.copy_btn').click(function () {
		var activity_state_region = $('input[name="activity_state_region"]').val();
		var activity_city = $('input[name="activity_city"]').val();
		var activity_zip_code = $('input[name="activity_zip_code"]').val();
		var activity_address = $('input[name="activity_address"]').val();

		$('input[name="legal_state_region"]').val(activity_state_region);
		$('input[name="legal_city"]').val(activity_city);
		$('input[name="legal_zip_code"]').val(activity_zip_code);
		$('input[name="legal_address"]').val(activity_address);

	});

</script>


<!--<div class="brows_image_dynamicle"></div>-->
<!---->
</body>

