var passwordGenerator = (function () {
	var generateRandomNum = function (max) {
		var crypto = window.crypto || window.msCrypto;
		if (!crypto) {
			throw new Error('Unsupported browser.');
		}
		// http://stackoverflow.com/a/18230432
		var array = new Uint8Array(1);
		crypto.getRandomValues(array);
		var range = max + 1;
		var max_range = 256;
		if (array[0] >= Math.floor(max_range / range) * range)
			return generateRandomNum(max);
		return (array[0] % range);
	};
	var generatePassword = function (options) {
		var uppercase = "ABCDEFGHJKMNPQRSTUVWXYZ";
		var lowercase = "abcdefghjkmnpqrstuvwxyz";
		var numbers = "23456789";
		var special = "!@#$%&*?";
		var candidates = '';

		candidates += uppercase;
		candidates += lowercase;
		candidates += numbers;
		candidates += special;

		var password = "";
		for (var i = 0; i < options.passwordLength; i++) {
			var randomNum = generateRandomNum(candidates.length);
			password += candidates.substring(randomNum, randomNum + 1);
		}
		return password;
	};
	return {
		generatePassword: generatePassword
	};
})();
(function () {
	'use strict';

	function getOptions() {
		return {
			passwordLength: '6',
			includeUppercaseChars: true,
			includeLowercaseChars: true,
			includeNumbers: true,
			includeSpecialChars: true,
		};
	}

	function outputGeneratedPassword() {
		var password;
		try {
			password = passwordGenerator.generatePassword(getOptions());
		} catch (error) {
			$("#unsupported-browser-alert").show();
			return;
		}
		$("#password-input, input#password_edit").val(password);
	}

	$(function () {
		//outputGeneratedPassword();
		$("#generate-password-button").click(outputGeneratedPassword);
		$(document).on('click', "button#generate-password-button_edit", function () {
			outputGeneratedPassword();
		});
	});
})();
