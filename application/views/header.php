
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>

	<title>Create Company</title>
	<!--// Stylesheets //-->
	<link rel="shortcut icon" href="<?= base_url() ?>assets/img/" type="image/png">
	<link href="<?= base_url() ?>assets/css/reset.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/all.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap/bootstrap-select.css') ?>"/>
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css"/>

	<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
	<script rel="stylesheet" src="<?= base_url() ?>assets/js/all.js"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
	<script src="<?= base_url() ?>assets/js/table.js"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap/popper.min.js"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="<?= base_url('assets/js/bootstrap/bootstrap-select.js') ?>"></script>
	<script src="<?= base_url() ?>assets/js/fontawesome.min.js"></script>
	<script src="<?= base_url() ?>assets/js/main.js"></script>

	<!-- Tables Start -->
	<script>
		$(document).ready(function () {
			$('#example').DataTable();
			$('#example2').DataTable();
			$('#example3').DataTable();
		});
	</script>
	<!-- Tables End -->

	<!-- Some CSS Start-->
	<style>

		.btn-file {
			position: relative;
			overflow: hidden;
		}

		.btn-file input[type=file] {
			position: absolute;
			top: 0;
			right: 0;
			min-width: 100%;
			min-height: 100%;
			font-size: 100px;
			text-align: right;
			filter: alpha(opacity=0);
			opacity: 0;
			outline: none;
			background: white;
			cursor: inherit;
			display: block;
		}

		#example_wrapper, #example2_wrapper, #example3_wrapper {
			width: 100%;
		}

		#img-upload {
			width: 100%;
		}

		.list-group-item.active {
			z-index: 2;
			color: #fff;
			background-color: #8e8f90;
			border-color: #8e8f90;
		}

		.page-item.active .page-link {
			background: #545b62;
			border: 1px solid #545b62;
		}

		.nav-link {
			color: #333;
		}

		li.active>a {
			color: #8e8f90;
			font-weight: 700;
		}


	</style>
	<!-- Some CSS end -->
</head>
<body>

<!-- Navbar Start -->
<nav class="navbar navbar-light bg-light fixed-top"
	 style="box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
	<a class="navbar-brand" href="#">NestGarageSystem</a>

	<div class="langs ml-auto mr-5">
		<ul class="mr-auto" data-url="<?=base_url('change_lang')?>">
			<li class="float-left  <?=(($this->uri->segment(1) == 'hy' or $this->uri->segment(1) == '') ? 'active' : '')?>" data-lang="hy"><a class="nav-link" href="javascript:void(0)">Հայ</a></li>
			<li class="float-left   <?=($this->uri->segment(1) == 'ru' ? 'active' : '')?>" data-lang="ru"><a class="nav-link" href="javascript:void(0)">Рус</a></li>
		</ul>
	</div>

	<a href="<?= base_url('User/logout') ?>">
		<button class="btn btn-outline-dark">
			<i class="fas fa-sign-out-alt"></i>
		</button>
	</a>
</nav>
<!-- Navbar End -->
