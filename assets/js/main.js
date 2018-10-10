$(document).ready(function () {
	/**
	 * Sign In Validation AND AJAX
	 * Start
	 */
	$('.signUp').click(function () {

		var region = $(".region option:selected").val()

		if ($('.firstname').val() == '') {
			$('#firstNameHelp').removeClass('d-none')
		}
		$('.firstname').focus(function () {
			$('#firstNameHelp').addClass('d-none')
		});

		if ($('.lastname').val() == '') {
			$('#LastNameHelp').removeClass('d-none')
		}
		$('.lastname').focus(function () {
			$('#LastNameHelp').addClass('d-none')
		});

		if ($('.email').val() == '') {
			$('#emailHelp').removeClass('d-none')
		}
		$('.email').focus(function () {
			$('#emailHelp').addClass('d-none')
		});

		if ($('.country_code').val() == '') {
			$('#CountryCodeHelp').removeClass('d-none')
		}
		$('.country_code').focus(function () {
			$('#CountryCodeHelp').addClass('d-none')
		});

		if ($('.phone_number').val() == '') {
			$('#PhoneNumberHelp').removeClass('d-none')
		}
		$('.phone_number').focus(function () {
			$('#PhoneNumberHelp').addClass('d-none')
		});

		if ($('.password').val() == '') {
			$('#PasswordHelp').removeClass('d-none')
		}
		$('.password').focus(function () {
			$('#PasswordHelp').addClass('d-none')
		});

		if ($('.confirm_password').val() == '') {
			$('#confirm_passwordHelp').removeClass('d-none')
		}
		$('.confirm_password').focus(function () {
			$('#confirm_passwordHelp').addClass('d-none')
			$('.conf_pass').addClass('d-none');
		});


		if ($('.firstname').val() != '' && $('.lastname').val() != '' && $('.email').val() != '' && $('.country_code').val() != '' && $('.phone_number').val() != '') {

			if ($('.password').val() != $('.confirm_password').val()) {

				$('.conf_pass').removeClass('d-none');

			}

		}


	});

	/**
	 * Sign In Validation
	 * END
	 */


});

