<html xmlns:*="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="google-site-verification" content="Mkn03uHs8mUwOONukPy8p_CkkddQG5hgj9HTsHf2mKs"/>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">

	<meta name="description" content=""/>
	<meta name="keywords" content=""/>

	<meta name="google-signin-client_id" content="910091284932-5pijqpe8si37k424m4h2e1teqdkucthe.apps.googleusercontent.com">


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
	<script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>

</head>
<body>


<!-- Display login status -->
<div id="status"></div>

<!-- Facebook login or logout button -->
<a href="javascript:void(0);" onclick="fbLogin()" id="fbLink"><img src="fblogin.png"/></a>

<!-- Display user profile data -->
<div id="userData"></div>


<!--gooogllle-->

<!-- HTML for render Google Sign-In button -->
<div id="gSignIn"></div>
<!-- HTML for displaying user details -->
<div class="userContent"></div>

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
					<div style=" box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);"
						 class="mb-2 mb-md-2 fb-login-button fb-login-button" data-width="200" data-max-rows="1"
						 data-size="large" data-button-type="continue_with" data-show-faces="false"
						 data-auto-logout-link="false" data-use-continue-as="false"></div>


					<div class="mt-2 mt-md-2 g-signin2" data-width="240"
						 style="display: inline-block;  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);"
						 data-onsuccess="onSignIn"></div>
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
						<div class="jumbotron pt-3 pb-3 my_jumbotron" style="background: #fff">
							<form id="register">
								<div class="form-group">
									<input type="text" class="form-control form-control-sm firstname"
										   placeholder="First Name" name="firstname" value="">
									<small id="firstname" class="form-text text-muted d-none"><p
											class="text-danger"></p></small>
								</div>

								<div class="form-group">
									<input type="text" class="form-control form-control-sm lastname"
										   placeholder="Last Name" name="lastname" value="">
									<small id="lastname" class="form-text text-muted d-none"><p class="text-danger"></p>
									</small>
								</div>

								<div class="form-group">
									<input type="email" class="form-control form-control-sm email"
										   placeholder="Email Address" name="up_email" value="">
									<small id="up_email" class="form-text text-muted d-none"><p class="text-danger"></p>
									</small>
								</div>

								<div class="form-group">
									<input type="text" class="form-control form-control-sm country_code"
										   placeholder="Country Code" name="country_code" value="">
									<small id="country_code" class="form-text text-muted d-none"><p
											class="text-danger"></p></small>
								</div>

								<div class="form-group">
									<input type="text" class="form-control form-control-sm phone_number"
										   placeholder="Phone Number" name="phone_number" value="">
									<small id="phone_number" class="form-text text-muted d-none"><p
											class="text-danger"></p></small>
								</div>

								<div class="form-group">
									<input type="password" class="form-control form-control-sm password"
										   placeholder="Password" name="up_password" value="">
									<small id="up_password" class="form-text text-muted d-none"><p
											class="text-danger"></p></small>
								</div>

								<div class="form-group">
									<input type="password" class="form-control form-control-sm confirm_password"
										   placeholder="Confirm Password" name="confirm_password" value="">
									<small id="confirm_password" class="form-text text-muted d-none"><p
											class="text-danger"></p></small>

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
									<small id="up_country" class="form-text text-muted d-none"><p
											class="text-danger"></p></small>

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


					<div class="text-center">


						<div class="g-signin2" data-onsuccess="onSignIn"></div>
					</div>


					<p style="cursor:pointer;" class="text-center text-warning mt-2 mt-md-2" data-toggle="collapse"
					   data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Or use
						Email</p>


					<div class="collapse" id="collapseExample">
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
							</form>
							<button id="signIn" type="submit" class="btn btn-outline-success btn-block signIn">Sign In</button>
							<button id="load" type="submit" class="btn btn-outline-success btn-block signIn d-none">
								<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/bars2.svg" />
							</button>
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
	window.fbAsyncInit = function () {
		// FB JavaScript SDK configuration and setup
		FB.init({
			appId: '246213099402735', // FB App ID
			cookie: true,  // enable cookies to allow the server to access the session
			xfbml: true,  // parse social plugins on this page
			version: 'v2.8' // use graph api version 2.8
		});

		// Check whether the user already logged in
		FB.getLoginStatus(function (response) {
			if (response.status === 'connected') {
				//display user data
				getFbUserData();
			}
		});
	};

	// Load the JavaScript SDK asynchronously
	(function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s);
		js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

	// Facebook login with JavaScript SDK
	function fbLogin() {
		FB.login(function (response) {
			if (response.authResponse) {
				// Get and display the user profile data
				getFbUserData();
			} else {
				document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
			}
		}, {scope: 'email'});
	}

	// Fetch the user profile data from facebook
	function getFbUserData() {
		FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
			function (response) {


				console.log(response.locale);

				document.getElementById('fbLink').setAttribute("onclick", "fbLogout()");
				document.getElementById('fbLink').innerHTML = 'Logout from Facebook';
				document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.first_name + '!';
				document.getElementById('userData').innerHTML = '<p><b>FB ID:</b> ' + response.id + '</p><p><b>Name:</b> ' + response.first_name + ' ' + response.last_name + '</p><p><b>Email:</b> ' + response.email + '</p><p><b>Picture:</b> <img src="' + response.picture.data.url + '"/></p>';
			});
	}

	// Logout from facebook
	function fbLogout() {
		FB.logout(function () {
			document.getElementById('fbLink').setAttribute("onclick", "fbLogin()");
			document.getElementById('fbLink').innerHTML = '<img src="fblogin.png"/>';
			document.getElementById('userData').innerHTML = '';
			document.getElementById('status').innerHTML = 'You have successfully logout from Facebook.';
		});
	}
</script>

<!-- Sign In with Google -->
<script>


	function onSuccess(googleUser) {
		var profile = googleUser.getBasicProfile();
		gapi.client.load('plus', 'v1', function () {
			var request = gapi.client.plus.people.get({
				'userId': 'me'
			});
			//Display the user details
			request.execute(function (resp) {
				var profileHTML = '<div class="profile"><div class="head">Welcome ' + resp.name.givenName + '! <a href="javascript:void(0);" onclick="signOut();">Sign out</a></div>';
				profileHTML += '<img src="' + resp.image.url + '"/><div class="proDetails"><p>' + resp.displayName + '</p><p>' + resp.emails[0].value + '</p><p>' + resp.gender + '</p><p>' + resp.id + '</p><p><a href="' + resp.url + '">View Google+ Profile</a></p></div></div>';
				$('.userContent').html(profileHTML);
				$('#gSignIn').slideUp('slow');
			});
		});
	}

	function onFailure(error) {
		//alert(error);
		console.log(error);
	}

	function renderButton() {
		gapi.signin2.render('gSignIn', {
			'scope': 'profile email',
			'width': 240,
			'height': 50,
			'longtitle': true,
			'theme': 'dark',
			'onsuccess': onSuccess,
			'onfailure': onFailure
		});
	}

	function signOut() {
		var auth2 = gapi.auth2.getAuthInstance();
		auth2.signOut().then(function () {
			$('.userContent').html('');
			$('#gSignIn').slideDown('slow');
		});
	}


</script>


<script>
	// sign up
	$(document).on('click', '#sign_up', function () {

		var url = '<?=base_url('User/signUp_ax')?>';
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
				// todo urish divov

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
						loading('stop', 'sign_up');

						// scroll_top();

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
	// Sign In
	$(document).on('click', '#signIn', function () {

		var url = '<?=base_url('User/signIn_ax') ?>';
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
				loading('start', 'signIn');

			},
			success: function (data) {
				if (data.success == '1') {

					var url = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->default_lang()) . '/company')?>";
					$(location).attr('href', url);

				} else {

					if ($.isArray(data.error.elements)) {

						// scroll_top();
						loading('stop', 'signIn');
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

</body>
</html>





