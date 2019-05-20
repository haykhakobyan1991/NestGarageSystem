</div>
</div>

<!-- LOGOUT MODAL START -->
<div
	class="modal fade"
	id="dd"
	tabindex="-1"
	role="dialog"
	aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div
		class="modal-dialog"
		role="document">
		<div
			class="modal-dialog modal-sm">
			<div
				class="modal-content">
				<div
					class="modal-header">
					<h6 class="modal-title text-secondary text-center"
						id="exampleModalLabel"
						style="font-size: 12px;"><?= lang('Are_you_sure_to_logout') ?></h6>
				</div>
				<div
					class="modal-footer text-center">
					<div
						class="mt-0 mb-0 ml-auto mr-auto">
						<a href="<?= base_url('User/logout') ?>">
							<button
								style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;"
								type="button"
								class="btn btn-outline-danger cancel_btn">
								<?= lang('yes') ?>
							</button>
						</a>
						<button
							style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;"
							type="button"
							class=" btn btn-outline-success yes_btn "
							data-dismiss="modal"><?= lang('cancel') ?></button>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- LOGOUT MODAL END -->


<script
	src="<?= base_url() ?>assets/js/main.js"></script>

<script
	class="">
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
	});

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


$('input[name="phone_number"], input[name="owner_contact_number"], input[name="account_number_1"], input[name="account_number_2"], input[name="account_number_3"], input[name="account_number_4"], input[name="contact_number"], input[name="contact_1"], input[name="contact_2"]')
	.keyup(function () {

	var val_numeric = $(this).val();

	/* if value.length = 1  And value == + or value numeric */
	if (val_numeric.length == 1 && val_numeric == "+" || $.isNumeric(val_numeric)) {

		$(this).parent('label').children('.invalid-feedback').css('display', 'none');

	} else {

		$(this).parent('label').children('.invalid-feedback').css('display', 'block');

	}


	/* if value.length > 1 first charackter  == + and other charachters are numeric */
	if (val_numeric.length > 1) {

		first_charackter = val_numeric.slice(0, 1);
		second_part_of_string = val_numeric.substring(1);

		if (first_charackter == '+' && $.isNumeric(second_part_of_string)) {

			$(this).parent('label').children('.invalid-feedback').css('display', 'none');

		} else {

			$(this).parent('label').children('.invalid-feedback').css('display', 'block');

		}

	}

	/* if value.length > 1 and value are numeric*/
	if(val_numeric.length > 1){

		if ($.isNumeric(val_numeric)) {

			$(this).parent('label').children('.invalid-feedback').css('display', 'none');

		}

	}

	if (val_numeric == '') {

		$(this).parent('label').children('.invalid-feedback').css('display', 'none')

	}

});




</script>

</body>

