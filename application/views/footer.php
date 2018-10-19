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


	var i = 1;





	$(document).ready(function () {

		var k = 4;

		$(document).on('click', '.add_new_row', function () {


			$('.add_new_items').append('<div class="row">\n' +
				'<div class="col-md-2">\n' +
				'<div>\n' +
				'<div class="media" style="position: relative;margin-top: 5px;">\n' +
				'<img mr-1\n' +
				'class="align-self-start mt-3 mt-md-3"\n' +
				' id="img-upload' + k + '"\n' +
				' style="width: 100%;height:100px;margin-right:0 !important;margin-top:0 !important;"\n' +
				' alt=""\n' +
				' src="">\n' +
				'<div class="media-body" style="position: absolute;left: 0;top: 0;height: 100%;width: 100%;">\n' +
				'<div\n' +
				'class="input-group" style="position: absolute;left: 0;top: 0;width: 100%;height: 100%;">\n' +
				'<span class="input-group-btn" style="position: absolute;left: 0;top: 0;height: 100%;width: 100%;">\n' +
				'<span\n' +
				'class="btn btn-secondary btn-file btn-sm" style="    position: absolute;left: 0;top: 0;border: none;padding-top: 38px;width: 100%;height: 100%;background: #0000001f;">\n' +
				'Browse… <input type="file" onchange="readURL' + k + '(this);"\n' +
				'   id="imgInp' + k + '">\n' +
				'</span>\n' +
				'</span>\n' +
				'<input type="text"\n' +
				'  class="form-control"\n' +
				'   readonly\n' +
				'  style="display: none;">\n' +
				'</div>\n' +
				'</div>\n' +
				'</div>\n' +
				'</div>\n' +
				'</div>\n' +
				'<div class="col-md-3">\n' +
				'<div class="form-group">\n' +
				'<label>Number</label>\n' +
				'<input type="text" class="form-control"\n' +
				'   placeholder="Number">\n' +
				'</div>\n' +
				'</div>\n' +
				'<div class="col-md-3">\n' +
				'<label>Epired Date</label>\n' +
				'<input type="date" name="bday"\n' +
				'   max="3000-12-31"\n' +
				'   min="1000-01-01"\n' +
				'   class="form-control">\n' +
				'</div>\n' +
				'<div class="col-md-3">\n' +
				'<div class="form-group">\n' +
				'<label>Issued</label>\n' +
				'<input type="text" class="form-control"\n' +
				'   placeholder="Issued">\n' +
				'</div>\n' +
				'</div>\n' +
				'<div class="col-md-1 mt-4 mt-md-4">\n' +
				'<button type="button" style="border:none;" class="remove_document btn btn-outline-secondary mt-3 mt-md-3">\n' +
				'<i class="fa fa-trash"></i>\n' +
				'</button>\n' +
				'</div>\n' +
				'</div>');


			$('.brows_image_dynamicle').append('<script>' +
				'function readURL' + k + '(input) {\n' +
				'\t\t\tif (input.files && input.files[0]) {\n' +
				'\t\t\t\tvar reader = new FileReader();\n' +
				'\n' +
				'\t\t\t\treader.onload = function (e) {\n' +
				'\t\t\t\t\t$("#img-upload' + k + '").attr("src", e.target.result);\n' +
				'\t\t\t\t}\n' +
				'\n' +
				'\t\t\t\treader.readAsDataURL(input.files[0]);\n' +
				'\t\t\t}\n' +
				'}<' +
				'/script>');

			k++

		})

	})


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
	// create company
	$(document).on('click', '#create_company', function (e) {

		var url = '<?=base_url('Main/create_company_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#company')[0]);
		$('small.text-muted').addClass('d-none');

		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: form_data,
			contentType: false,
			cache: false,
			processData:false,
			success: function (data) {
				if (data.success == '1') {

					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()).'/create_company')?>"; //todo
					$(location).attr('href',url);

				} else {

					if ($.isArray(data.error.elements)) {

						// scroll_top();

						$('p#success').addClass('d-none');
						$.each(data.error.elements, function( index ) {

							$.each(data.error.elements[index], function( index, value  ) {

								if(value != '') {

									$('#'+index+' > p').text(value);
									$('#'+index).removeClass('d-none');

								} else {
									$('#'+index+' > p').text('');
									$('#'+index).addClass('d-none');
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



<div class="brows_image_dynamicle"></div>

</body>

