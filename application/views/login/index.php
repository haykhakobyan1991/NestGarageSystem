<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="google-site-verification" content="Mkn03uHs8mUwOONukPy8p_CkkddQG5hgj9HTsHf2mKs"/>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">

	<meta name="description" content=""/>
	<meta name="keywords" content=""/>

	<meta name="google-signin-client_id"
		  content="910091284932-5pijqpe8si37k424m4h2e1teqdkucthe.apps.googleusercontent.com">


	<title></title>
	<!--// Stylesheets //-->
	<link rel="shortcut icon" href="<?= base_url() ?>assets/img/" type="image/png">

	<link href="<?= base_url() ?>assets/css/reset.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
		  integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap/bootstrap.min.css"/>
	<link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" type="text/css"/>

	<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
	<script src="<?= base_url() ?>assets/js/main.js"></script>
	<script src="<?= base_url() ?>assets/js/base.js"></script>

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

	<!--Sign up modal-->
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
										   placeholder="Email Address" name="up_email" value="">
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
										   placeholder="Password" name="up_password" value="">
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

								<div id="country" class="form-group getChild" data-url="<?=base_url()?>System_main/get_marz" data-result="marz">

									<select class="form-control form-control-sm sel"  name="country">
										<option value="">Select Country ... </option>
										<? foreach ($country as $row) : ?>
											<option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
										<? endforeach; ?>
									</select>
									<small id="RegionHelp" class="form-text text-muted d-none"><p class="text-danger">
											Field must be filled in</p></small>

								</div>

								<div class="form-group getChild Child d-none" id="marz" data-url="<?=base_url()?>System_main/get_region"  data-result="region" ></div>

								<div class="form-group d-none lastChild" id="region" ></div>


							</form>

							<button id="sign_up" type="submit" class="btn btn-outline-success btn-block signUp">Join</button>

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


						<div class="g-signin2" data-onsuccess="onSignIn"></div>
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


				console.log(response);

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

		var firstname = $('input[name="firstname"]').val();
		var lastname = $('input[name="lastname"]').val();
		var up_email = $('input[name="up_email"]').val();
		var country_code = $('input[name="country_code"]').val();
		var phone_number = $('input[name="phone_number"]').val();
		var up_password = $('input[name="up_password"]').val();
		var confirm_password = $('input[name="confirm_password"]').val();
		var country = $('input[name="country"]').val();
		var marz = $('input[name="marz"]').val();
		var region = $('input[name="region"]').val();

		$.ajax({
			url: '<?=base_url() . 'User/signUp_ax'?>',
			type: 'POST',
			data: {
				firstname: firstname,
				lastname: lastname,
				email: up_email,
				country_code: country_code,
				phone_number: phone_number,
				password: up_password,
				confirm_password: confirm_password,
				country: country,
				marz: marz,
				region: region
			},
			cache: false,
			dataType: 'json',
			success: function (data, textStatus, jqXHR) {
				if (typeof data.error === 'undefined') {
					// Success so call function to process the form
					console.log('SUCCESS: ' + data.success);
				} else {
					// Handle errors here
					console.log(data.error.elements);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				// Handle errors here
				console.log('ERRORS-: ' + textStatus);
			},
			complete: function () {

			}
		});
	});



</script>

</body>
</html>


