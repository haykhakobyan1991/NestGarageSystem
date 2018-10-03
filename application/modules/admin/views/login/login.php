<!DOCTYPE html>
<html>
<head>
	<title>Login page</title>
	<link href="<?= base_url() ?>assets/css/login.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap/bootstrap.min.css">
</head>
<body>


<div class="container">
	<div class="row">
		<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
			<div class="card card-signin my-5">
				<div class="card-body">
					<h5 class="card-title text-center">Log In</h5>
					<?php
					$attributes = array('class' => 'form-signin');
					echo form_open('admin/login', $attributes);
					?>
					<div class="form-label-group">
						<input type="text" id="inputUsername" class="form-control" placeholder="Username"
							   name="username" value="<?php echo $username ?>" required autofocus>
						<label for="inputEmail">Username</label>
					</div>

					<div class="form-label-group">
						<input type="password" id="inputPassword" class="form-control" placeholder="Password"
							   name="password" value="<?php echo $password ?>" required>
						<label for="inputPassword">Password</label>
					</div>

					<div class="custom-control custom-checkbox mb-3">
						<input type="checkbox" class="custom-control-input" id="customCheck1" name="remember_me">
						<label class="custom-control-label" for="customCheck1">Remember Me</label>
					</div>
					<button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Log in</button>
					<?php
					if ($error != '') {
						echo '<hr class="my-4">';
						echo '<div class="alert alert-danger center" role="alert">' . $error . '</div>';
					}

					echo form_close();
					?>
				</div>
			</div>
		</div>
	</div>
</div>


<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap/bootstrap.min.js"></script>
</body>
</html>
