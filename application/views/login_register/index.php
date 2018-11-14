<html xmlns:*="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta name="google-site-verification" content="F6R3icS6TcxQtKPU5VVWy-L3">
	<meta name="google-signin-client_id"
		  content="441989444698-u6fl3a44q4njbsogqdvc53kt5bgv1n48.apps.googleusercontent.com">

	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
	<title></title>
	<!--// Stylesheets //-->
	<link rel="shortcut icon" href="<?= base_url('assets/img/') ?>" type="image/png">
	<link href="<?= base_url('assets/css/reset.css') ?>" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
		  integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap/bootstrap.min.css') ?>"/>
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap/bootstrap-select.css') ?>"/>
	<link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css"/>
	<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/main.js') ?>"></script>
	<script src="<?= base_url('assets/js/base.js') ?>"></script>

</head>
<body>

<style>
	li.active > a {
		color: #5e1017;
	}

	.loader {
		position: absolute;
		width: 100%;
		height: 100%;
		left: 0;
		z-index: 99;
		top: 0;
		background: #fff;
	}

	.loader_svg {
		width: 10em;
		margin-left: 10em;
		position: absolute;
		left: calc(50% - 14em);
		top: 50%;
		z-index: 999;
		margin-top: -10em;
	}

	.captchaImg {
		padding: 4px;
	}

	#captchaDiv {
		margin: 0 auto;
	}

</style>





<div class="container">
	<div class="loader"></div>

	<img class="loader_svg" src="<?= base_url('assets/images/puff.svg') ?>"/>
	<div class="row">

		<div class="col-sm-3"></div>
		<div class="col-sm-12 col-md-6 mt-md-3 mt-3">

			<p class="lead text-success left">Have an Account? <span style="cursor:pointer;"
																	 class="text-warning" data-toggle="modal"
																	 data-target="#exampleModal"
																	 data-whatever="@mdo">Sign In</span>

			<div class="langs mr-5" style="margin-top: -52px;text-align: right;">
				<ul class="" data-url="<?= base_url('change_lang') ?>">
					<li style="display: inline-block;margin-right: -25px;"
						class=" <?= (($this->uri->segment(1) == 'hy' or $this->uri->segment(1) == '') ? 'active' : '') ?>"
						data-lang="hy"><a style="font-weight: 600;" class="nav-link" href="javascript:void(0)">Հայ</a>
					</li>
					<li style="display: inline-block;margin-right: -60px;"
						class="  <?= ($this->uri->segment(1) == 'ru' ? 'active' : '') ?>" data-lang="ru"><a
							class="nav-link" style="font-weight: 600;" href="javascript:void(0)">Рус</a></li>
				</ul>
			</div>

			</p>

			<div class="jumbotron pt-3 pb-3 my_jumbotron">
				<p class="lead">Join 2,776,007 Founders & Startups Always free - connect now</p>
				<hr class="my-4">
				<div class="text-center">

					<div id="fb" class="mb-2 mb-md-2"
						 style="background: #3d5a98; cursor: pointer; width: 240px; height: 40px; margin: 0 auto; box-shadow: 0 3px 6px rgba(61, 90, 152, 0.67), 0 3px 6px rgba(27, 53, 104, 0.88);">
						<img style="float: left; margin: 4px;" src="<?=base_url('assets/img/fb.png')?>">
						<span style="color: #fff; font-size: 14px;  line-height: 38px;">Continue with Facebook</span>
					</div>


					<div id="my-signin2" onclick="ClickLogin()" class="mt-2 mt-md-2 g-signin2" data-width="240"
						 style="display: inline-block;  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);"></div>
				</div>


				<p style="cursor:pointer;" class="text-center  small text-success mt-md-2 mt-3 ml-2" data-toggle="modal"
				   data-target=".bd-example-modal-lg">Or use Email</p>
			</div>


			<div class="jumbotron pt-3 pb-3 my_jumbotron">
				<p class="lead">By Joining F6S and providing your personal information, you
					confirm your agree to us using it to provide our services and to
					keep in touch regarding information we think may interest you.
					You also confirm agreement to the Terms Service and Privacy Policy. You can change mind about
					receiving information from us as se out polices.</p>
				<hr class="my-4">


			</div>

		</div>

	</div>

	<!--Sign up modal-->
	<div id="reg_modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
		 aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><?= lang('register') ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>


				<div class="row content_area">

					<div class="col-sm-12 col-md-6 mt-md-3 mt-3">

						<div class="jumbotron pt-3 pb-3 my_jumbotron" style="background: #fff;">
							<h1 class="text-left text-success" style="font-size: 1.5em;">Wellcome to F6S</h1>
							<p class="lead">F6S is where help eachother grow with deals, programs, founding and
								jobs.</p>
							<hr class="my-4">
							<p>For new users, your public profile/basic information will be used to create a profile.
								we will never post without your permission.</p>

							<hr class="my-4">

							<p style="font-size: 1em;" class="lead">By Joining F6S and providing your personal
								information, you
								confirm your agree to us using it to provide our services and to
								keep in touch regarding information we think may interest you.
								You also confirm agreement to the Terms Service and Privacy Policy. You can change mind
								about
								receiving information from us as se out polices.</p>
						</div>


					</div>


					<div class="col-md-6 mt-md-3 mt-3">
						<div class="alert-danger mb-2 p-2 mr-2 d-none">fsdfd fsd s fsd fsddfd</div>
						<div class="jumbotron pt-3 pb-3 my_jumbotron" style="background: #fff">



							<form id="register">
								<div class="form-group">
									<input type="text" class="form-control form-control-sm firstname"
										   placeholder="First Name" name="firstname" value="">

								</div>

								<div class="form-group">
									<input type="text" class="form-control form-control-sm lastname"
										   placeholder="Last Name" name="lastname" value="">

								</div>

								<div class="form-group">
									<input type="email" class="form-control form-control-sm email"
										   placeholder="Email Address" name="up_email" value="">

								</div>

								<div class="form-group">
									<input type="text" class="form-control form-control-sm country_code"
										   placeholder="Country Code" name="country_code" value="">

								</div>

								<div class="form-group">
									<input type="text" class="form-control form-control-sm phone_number"
										   placeholder="Phone Number" name="phone_number" value="">

								</div>

								<div class="form-group">
									<input type="password" class="form-control form-control-sm password"
										   placeholder="Password" name="up_password" value="">

								</div>

								<div class="form-group">
									<input type="password" class="form-control form-control-sm confirm_password"
										   placeholder="Confirm Password" name="confirm_password" value="">

								</div>

								<div class="form-group">

									<select name="up_country" class="selectpicker form-control form-control-sm"
											id="country" data-container="body" data-live-search="true"
											title="Select a country">
										<option value="">Select Country ...</option>
										<? foreach ($country as $row) : ?>
											<option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
										<? endforeach; ?>
									</select>


								</div>


							</form>

							<button id="sign_up" type="submit" class="btn btn-success btn-block signUp">Join
							</button>

							<button id="load" class="btn btn-block  btn-success d-none"><img
									style="height: 20px;margin: 0 auto;display: block;text-align: center;"
									src="<?= base_url() ?>assets/images/bars2.svg"/></button>

						</div>
					</div>
				</div>
			</div>


		</div>
	</div>
</div>

<!-- Sign In Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><?= lang('sign_in') ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="jumbotron pt-3 pb-3 my_jumbotron">


					<div class="jumbotron pt-3 pb-3 my_jumbotron" style="margin-bottom: 0;">
						<h1 class="text-left text-success" style="font-size: 1.25em;">Wellcome to F6S</h1>
						<p class="lead">F6S is where help eachother grow with deals, programs, founding and
							jobs. </p>
						<hr class="my-4">
						<p style="font-size: 0.9em; ">For new users, your public profile/basic information will be used
							to create a profile.
							we will never post without your permission.</p>


					</div>


					<p style="cursor:pointer;" class="text-center text-warning mt-2 mt-md-2" data-toggle="collapse"
					   data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Or use
						Email</p>


					<div class="collapse active show" id="collapseExample">
						<div class="card card-body">
							<form id="login">

								<div class="form-group">
									<input type="email" class="form-control form-control-sm email"
										   placeholder="Email Address" name="email" value="">
									<small id="email" class="form-text text-muted d-none"><p class="text-danger">
											Field must be filled in</p></small>
								</div>

								<div class="form-group">
									<input type="password" class="form-control form-control-sm password"
										   placeholder="Password" name="password" value="">
									<small id="password" class="form-text text-muted d-none"><p class="text-danger">
											Field must be filled in</p></small>
								</div>

								<div class="form-group">
									<input placeholder="Captcha" name="captcha" class="form-control form-control-sm"
										   type="text"/>
									<small id="captcha" class="form-text text-muted d-none"><p class="text-danger">
											Field must be filled in</p></small>
									<div id = "captchaDiv"
										 class="w-50 text-center mt-3 bg-secondary"><span id="captImg" ><?= $captcha['image'] ?></span><a
											href="javascript:void(0);" title="Can't read the image? click to refresh." class="text-white refreshCaptcha"><i
												class="fas fa-redo-alt"></i></a></div>

								</div>
							</form>
							<button id="signIn" type="submit" class="btn btn-outline-success btn-block signIn">Sign In</button>
							<button id="load2" class="btn btn-block  btn-success d-none"><img
									style="height: 20px;margin: 0 auto;display: block;text-align: center;"
									src="<?= base_url() ?>assets/images/bars2.svg"/></button>
						</div>
					</div>


					<p style="font-size: 0.9em;" class="lead mt-2 mt-md-2">By Joining F6S and providing your personal
						information, you
						confirm your agree to us using it to provide our services and to
						keep in touch regarding information we think may interest you.
						You also confirm agreement to the Terms Service and Privacy Policy. You can change mind about
						receiving information from us as se out polices.</p>

				</div>


			</div>
		</div>
	</div>
</div>
<script src="<?= base_url('assets/js/bootstrap/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/js/fontawesome.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap/bootstrap-select.js') ?>"></script>





<!-- Sign In With FACEBOOK  -->
<script>
	// This is called with the results from from FB.getLoginStatus().
	function statusChangeCallback(response) {
		console.log('f2');
		if (response.status === 'connected') {
			console.log('f2.1');
			// Logged into your app and Facebook.
			loginAPI();
		} else {
			// The person is not logged into your app or we are unable to tell.
			console.log('Please log into this app.');
		}
	}

	// This function is called when someone finishes with the Login
	// Button.  See the onlogin handler attached to it in the sample
	// code below.
	function checkLoginState() {
		console.log('f1');
		FB.getLoginStatus(function (response) {
			statusChangeCallback(response);
		});
	}

	window.fbAsyncInit = function () {
		FB.init({
			appId: '291881248095311',
			cookie: true,
			xfbml: true,
			version: 'v3.1'
		});

	};

	// Load the SDK asynchronously
	(function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {
			return;
		}
		js = d.createElement(s);
		js.id = id;
		js.src = "https://connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));


	function loginAPI() {

		var url = '/me?fields=name,email,first_name,last_name,picture';
		FB.api(url, function (response) {
			login_width_fb(response);
		});
	}


	function login_width_fb(response) {


		var post_url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->default_lang()) . '/User/login_fb_ax')?>';
		var request_method = 'POST';
		var form_data = {
			'fb_id': response.id,
			'first_name': response.first_name,
			'last_name': response.last_name,
			'fb_photo': response.picture.data.url,
			'email': response.email
		};


		$.ajax({
			url: post_url,
			type: request_method,
			dataType: "json",
			data: form_data
		}).done(function (e) {

			if (e.success == '1') {

				var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->default_lang()) . '/company')?>";
				$(location).attr('href', url);

			} else {

				console.log(e.error)

			}
		});
	}


	function fb_logout() { //todo
		FB.logout(function (response) {
			console.log(response);
		});

		$.post('<?=base_url('Main/logout_ax') ?>');
	}


	document.getElementById('fb').addEventListener('click', function () {
		//do the login
		console.log('f0');
		FB.login(checkLoginState, {scope: 'email,public_profile', return_scopes: true});
	}, false);
</script>


<!-- Sign In with Google -->
<script>

	var clicked = false;

	function ClickLogin() {
		clicked = true;
	}

	function onSuccess(googleUser) {
		if (clicked) {
			var profile = googleUser.getBasicProfile();
			gapi.client.load('plus', 'v1', function () {
				var request = gapi.client.plus.people.get({
					'userId': 'me'
				});
				//Display the user details
				request.execute(function (resp) {
					update_user_data(resp);
					console.log(2);
				});
			});
			console.log(1);
		}
		console.log(0);
	}

	function onFailure(error) {
		console.log(error);
	}


	function update_user_data(profile) {

		var post_url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->default_lang()) . '/User/login_google_ax')?>';
		var request_method = 'POST';
		var form_data = {
			'google_id': profile.id,
			'first_name': profile.name.givenName,
			'last_name': profile.name.familyName,
			'google_photo': profile.image.url,
			'email': profile.emails[0].value
		};


		$.ajax({
			url: post_url,
			type: request_method,
			dataType: "json",
			data: form_data
		}).done(function (e) {

			if (e.success == '1') {

				var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->default_lang()) . '/company')?>";
				$(location).attr('href', url);

			} else {

				console.log(e.error)

			}
		});
	}


	function renderButton() {
		gapi.signin2.render('my-signin2', {
			'scope': 'profile email',
			'width': 240,
			'height': 40,
			'longtitle': true,
			'theme': 'dark',
			'onsuccess': onSuccess,
			'onfailure': onFailure
		});
	}

	function google_signOut() {
		var auth2 = gapi.auth2.getAuthInstance();
		auth2.signOut().then(function () {
			$('.log_modal').removeClass('d-none');
			$('.user_log').addClass('d-none');
			$.post('<?=base_url('User/logout_ax')?>');

		});
	}


</script>


<script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>

<script>
	// sign up
	$(document).on('click', '#sign_up', function () {

		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->default_lang()) . '/User/signUp_ax')?>';
		var form_data = $('#register').serialize();
		$('small.text-muted').addClass('d-none');

		$.ajax({
			url: url,
			type: 'POST',
			data: form_data,
			cache: false,
			dataType: 'json',
			beforeSend : function (){

				loading('start', 'sign_up');

			},
			success: function (data) {

				if (data.success == '1') {


					loading('stop', 'sign_up');

					$('.modal-header h5').text('your registration is successful');
					$('.modal-header h5').addClass('text-success');
					$('.content_area').removeClass('row');
					$('.content_area').html('<div class="container-fluid text-center" style="padding:20px;">\n' +
						'    <div class="alert alert-success" role="alert" style="\n' +
						'">\n' +
						'  Your Username and password we will send to Your email address\n' +
						'    </div>\n' +
						'    </div>');

					$('input, select').val('');


				} else {


					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'sign_up');
						errors = '';
						tmp = '';
						$.each(data.error.elements, function (index) {
							$.each(data.error.elements[index], function (index, value) {
								if (value != '') {
									$('input[name="' + index + '"]').addClass('border border-danger');
									$('select[name="' + index + '"]').parent('div').children('button').addClass('border border-danger');
									close_message();
									$('.alert-danger').removeClass('d-none');

									if(value != tmp) {
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


</script>


<script>
	// Sign In
	$(document).on('click', '#signIn', function () {

		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->default_lang()) . '/User/signIn_ax') ?>';
		var form_data = $('#login').serialize();
		$('small.text-muted').addClass('d-none');

		$.ajax({
			url: url,
			type: 'POST',
			data: form_data,
			cache: false,
			dataType: 'json',
			beforeSend: function () {

				close_message();
				$('button#signIn').addClass('bg-success2');
				loading('start', 'signIn','load2');

			},
			success: function (data) {
				if (data.success == '1') {
					loading('stop', 'signIn', 'load2');
					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->default_lang()) . '/company')?>";
					$(location).attr('href', url);

				} else {

					if ($.isArray(data.error.elements)) {

						// scroll_top();
						loading('stop', 'signIn', 'load2');
						$('button#signIn').removeClass('bg-success2');

						$('p#success').addClass('d-none');
						$.each(data.error.elements, function (index) {

							$.each(data.error.elements[index], function (index, value) {

								if (value != '') {

									$('#' + index + ' > p').text(value);
									$('#' + index).removeClass('d-none');

								} else {
									$('#' + index + ' > p').text('');
									$('#' + index).addClass('d-none');
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

	$(document).on('keypress', function (e) {
		var key = e.which;
		if(key == 13) {
			if($('#collapseExample').hasClass('show')) {
				$('#signIn').trigger('click');
			}
			if($('#reg_modal').hasClass('show')) {
				$('#sign_up').trigger('click');
			}
		}
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
	$(document).ready(function () {
		$('.refreshCaptcha').on('click', function () {
			$.get('<?=base_url('User/refresh'); ?>', function (data) {
				$('#captImg').html(data);
			});
		});
	});
</script>

</body>
</html>
