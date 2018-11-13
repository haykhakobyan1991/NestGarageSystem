$(document).ready(function () {
	/**
	 * Sign In Validation
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



	// Generate a password string
	function randString(id) {
		var dataSet = $(id).attr('data-character-set').split(',');
		var possible = '';
		if ($.inArray('a-z', dataSet) >= 0) {
			possible += 'abcdefghijklmnopqrstuvwxyz';
		}
		if ($.inArray('A-Z', dataSet) >= 0) {
			possible += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		}
		if ($.inArray('0-9', dataSet) >= 0) {
			possible += '0123456789';
		}
		if ($.inArray('#', dataSet) >= 0) {
			possible += '![]{}()%&*$#^<>~@|';
		}
		var text = '';
		for (var i = 0; i < $(id).attr('data-size'); i++) {
			text += possible.charAt(Math.floor(Math.random() * possible.length));
		}
		return text;
	}

	// Create a new password on page load
	$('input[rel="gp"]').each(function () {
		$(this).val(randString($(this)));
	});

	// Create a new password
	$(".getNewPass").click(function () {
		var field = $(this).closest('div').find('input[rel="gp"]');
		field.val(randString(field));
	});

	// Auto Select Pass On Focus
	$('input[rel="gp"]').on("click", function () {
		$(this).select();
	});


	$(document).on('click', '#ok', function () {
		alert("hi");
	});

	$('.btn-open-popover').popover();

	// //popover option
	$("#a-popover").popover({
		title: 'Dang ki thong tin',
		content: $('#divContentHTML').html(),
		placement: 'right',
		html: true
	});

	$(".modal").on('hidden.bs.modal', function () {
		location.reload();
	});

	$(function () {
		$('[data-toggle2="tooltip"]').tooltip()
	});


});

$(document).on('click', '.hide_password', function () {
	if ($(this).hasClass('hidden')) {
		$('#password-input').attr('type', 'text');
		$(this).removeClass('hidden');
	} else {
		$('#password-input').attr('type', 'password');
		$(this).addClass('hidden');
	}

});

$(window).on('load', function () {
	$('.loader_svg').fadeOut('slow');
	$('.loader').fadeOut('slow');

	$('.selectpicker_1').parent('div').children('button').addClass('btn-sm');
	$('.selectpicker_2').parent('div').children('button').addClass('btn-sm');
	$('.selectpicker').parent('div').children('button').css({
		'background': '#fff',
		'color': '#6c757d',
		'border': '1px solid #ced4da'
	});
	$('.selectpicker').parent('div').children('button').removeClass('btn-light');
});

$(document).on('click', '.langs > ul > li', function () {
	var lang = $(this).data('lang');
	var url = $(this).parent('ul').data('url');
	var current_url = window.location.href;  //todo if firefox document.URL
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


function scroll_top() {
	$('.modal, body').animate({scrollTop: $('.modal, body').offset().top}, 700);
}

function close_message() {
	//setTimeout(function () {
		$('.alert-success, .alert-danger').addClass('d-none');
	//}, 5000);
	$('.alert-info').addClass('d-none');
}

function loading(e = 'start', id = '', load = 'load') {
	if (e == 'start') {
		$('#'+id).addClass('d-none');
		$(id).addClass('d-none');
		$('#'+load).removeClass('d-none');
	} else {
		$('#'+id).removeClass('d-none');
		$(id).removeClass('d-none');
		$('#'+load).addClass('d-none');
	}
}
