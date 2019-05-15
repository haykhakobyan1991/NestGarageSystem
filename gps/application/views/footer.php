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
				if (log) console.log(log);
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


</script>


</body>

