<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="google-site-verification" content="Mkn03uHs8mUwOONukPy8p_CkkddQG5hgj9HTsHf2mKs"/>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
	<script src="https://apis.google.com/js/api:client.js"></script>
	<meta name="description" content="<?= $result_web[$lng]['meta_desc'] ?>"/>
	<meta name="keywords" content="<?= $result_web[$lng]['key_word'] ?>"/>
	<meta name="google-signin-client_id"
		  content="82081657311-g280saltmlb2khrnlijd8pj95cp8kbj0.apps.googleusercontent.com">
	<title><?= $result_web[$lng]['website_name'] ?></title>
	<!--// Stylesheets //-->
	<link rel="shortcut icon" href="<?= base_url() ?>assets/img/<?= $result_web[$lng]['favicon'] ?>" type="image/png">
	<link href="<?= base_url() ?>assets/css/reset.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
		  integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap/bootstrap.min.css"/>
	<link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" type="text/css"/>
	<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
	<script src="<?= base_url() ?>assets/js/main.js"></script>
	<script src="https://apis.google.com/js/platform.js" async defer></script>

</head>
<body>


<!-- Sign In With FACEBOOK  -->

<script>
	window.fbAsyncInit = function () {
		FB.init({
			appId: '494657070944267',
			cookie: true,
			xfbml: true,
			version: 'v3.1'
		});

		FB.AppEvents.logPageView();

	};

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


	FB.getLoginStatus(function (response) {
		statusChangeCallback(response);
	});


	function checkLoginState() {
		FB.getLoginStatus(function (response) {
			statusChangeCallback(response);
		});
	}

	function onSuccess(googleUser) {
		console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
	}
	function onFailure(error) {
		console.log(error);
	}
	function renderButton() {
		gapi.signin2.render('my-signin2', {
			'scope': 'profile email',
			'width': 240,
			'height': 50,
			'longtitle': true,
			'theme': 'dark',
			'onsuccess': onSuccess,
			'onfailure': onFailure
		});
	}
</script>

<!-- Sign In with Google -->
<script>
	var googleUser = {};
	var startApp = function() {
		gapi.load('auth2', function(){
			// Retrieve the singleton for the GoogleAuth library and set up the client.
			auth2 = gapi.auth2.init({
				client_id: 'YOUR_CLIENT_ID.apps.googleusercontent.com',
				cookiepolicy: 'single_host_origin',
				// Request scopes in addition to 'profile' and 'email'
				//scope: 'additional_scope'
			});
			attachSignin(document.getElementById('customBtn'));
		});
	};

	function attachSignin(element) {
		console.log(element.id);
		auth2.attachClickHandler(element, {},
			function(googleUser) {
				document.getElementById('name').innerText = "Signed in: " +
					googleUser.getBasicProfile().getName();
			}, function(error) {
				alert(JSON.stringify(error, undefined, 2));
			});
	}
</script>

<div class="container">
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-12 col-md-6 mt-md-3 mt-3">

			<p class="lead text-success text-center ">Have an Account? <span style="cursor:pointer;"
																			 class="text-warning" data-toggle="modal"
																			 data-target="#exampleModal"
																			 data-whatever="@mdo">Sign In</span></p>

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


	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
		 aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Sign Up</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>


				<div class="row">


					<div class="col-sm-12 col-md-6 mt-md-3 mt-3">

						<div class="jumbotron pt-3 pb-3 my_jumbotron">
							<h1 class="text-left text-success" style="font-size: 1.5em;">Wellcome to F6S</h1>
							<p class="lead">F6S is where help eachother grow with deals, programs, founding and
								jobs.</p>
							<hr class="my-4">
							<p>For new users, your public profile/basic information will be used to create a profile.
								we will never post without your permission.</p>

							<hr clss="my-4">

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
						<div class="jumbotron pt-3 pb-3 my_jumbotron">


							<form>
								<div class="form-group">
									<input type="text" class="form-control form-control-sm firstname"
										   placeholder="First Name" name="firstname" value="">
									<small id="firstNameHelp" class="form-text text-muted d-none"><p
											class="text-danger">Field must be filled in</p></small>
								</div>

								<div class="form-group">
									<input type="text" class="form-control form-control-sm lastname"
										   placeholder="Last Name" name="lastname" value="">
									<small id="LastNameHelp" class="form-text text-muted d-none"><p class="text-danger">
											Field must be filled in</p></small>
								</div>

								<div class="form-group">
									<input type="email" class="form-control form-control-sm email"
										   placeholder="Email Address" name="email" value="">
									<small id="emailHelp" class="form-text text-muted d-none"><p class="text-danger">
											Field must be filled in</p></small>
								</div>

								<div class="form-group">
									<input type="text" class="form-control form-control-sm country_code"
										   placeholder="Country Code" name="country_code" value="">
									<small id="CountryCodeHelp" class="form-text text-muted d-none"><p
											class="text-danger">Field must be filled in</p></small>
								</div>

								<div class="form-group">
									<input type="text" class="form-control form-control-sm phone_number"
										   placeholder="Phone Number" name="phone_number" value="">
									<small id="PhoneNumberHelp" class="form-text text-muted d-none"><p
											class="text-danger">Field must be filled in</p></small>
								</div>

								<div class="form-group">
									<input type="password" class="form-control form-control-sm password"
										   placeholder="Password" name="password" value="">
									<small id="PasswordHelp" class="form-text text-muted d-none"><p class="text-danger">
											Field must be filled in</p></small>
								</div>

								<div class="form-group">
									<input type="password" class="form-control form-control-sm confirm_password"
										   placeholder="Confirm Password" name="confirm_password" value="">
									<small id="confirm_passwordHelp" class="form-text text-muted d-none"><p
											class="text-danger">Field must be filled in</p></small>

									<small id="RegionHelp" class="form-text text-muted conf_pass d-none"><p
											class="text-danger">Password dont match</p></small>
								</div>

								<div class="form-group">
									<label for="exampleFormControlSelect1">Select Region</label>
									<select class="form-control form-control-sm region" id="exampleFormControlSelect1">
										<option value="1">Yerevan, AM</option>
										<option value="2">Vanadzor, AM</option>
										<option value="3">Tavush, AM</option>
									</select>
									<small id="RegionHelp" class="form-text text-muted d-none"><p class="text-danger">
											Field must be filled in</p></small>

								</div>

							</form>

							<button type="submit" class="btn btn-outline-success btn-block signUp">Join</button>

						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
				<h5 class="modal-title" id="exampleModalLabel">Sign In</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<div class="jumbotron pt-3 pb-3 my_jumbotron">


					<div class="jumbotron pt-3 pb-3 my_jumbotron" style="margin-bottom: 0;">
						<h1 class="text-left text-success" style="font-size: 1.25em;">Wellcome to F6S</h1>
						<p class="lead">F6S is where help eachother grow with deals, programs, founding and
							jobs.</p>
						<hr class="my-4">
						<p style="font-size: 0.9em; ">For new users, your public profile/basic information will be used
							to create a profile.
							we will never post without your permission.</p>


					</div>


					<div class="text-center">
						<div style=" box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);"
							 class="mb-2 mb-md-2 fb-login-button fb-login-button" data-width="200" data-max-rows="1"
							 data-size="large" data-button-type="continue_with" data-show-faces="false"
							 data-auto-logout-link="false" data-use-continue-as="false"></div>

						<div class="mt-2 mt-md-2 g-signin2" data-width="240"
							 style="display: inline-block;  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);"
							 data-onsuccess="onSignIn"></div>
					</div>


					<p style="cursor:pointer;" class="text-center text-warning mt-2 mt-md-2" data-toggle="collapse"
					   data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Or use
						Email</p>


					<div class="collapse" id="collapseExample">
						<div class="card card-body">
							<form>
								<div class="form-group">
									<input type="email" class="form-control form-control-sm email"
										   placeholder="Email Address" name="email" value="">
									<small id="emailHelp" class="form-text text-muted d-none"><p class="text-danger">
											Field must be filled in</p></small>
								</div>

								<div class="form-group">
									<input type="password" class="form-control form-control-sm password"
										   placeholder="Password" name="password" value="">
									<small id="PasswordHelp" class="form-text text-muted d-none"><p class="text-danger">
											Field must be filled in</p></small>
								</div>
							</form>
							<button type="submit" class="btn btn-outline-success btn-block signIn">Sign In</button>
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
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url() ?>assets/js/bootstrap/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/fontawesome.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap/bootstrap.min.js"></script>
<script>
</script>
</body>
</html>


