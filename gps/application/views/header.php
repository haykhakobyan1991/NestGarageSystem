<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content=""/>
	<meta name="keywords" content="fleet car garage fleetManagement"/>
	<title><?= $title ?></title>
	<!--// Stylesheets //-->
	<link rel="shortcut icon" href="<?= base_url() ?>assets/img/" type="image/png">
	<link href="<?= base_url() ?>assets/css/reset.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/all.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap/bootstrap.min.css"/>
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap/bootstrap-select.css') ?>"/>
	<? if ($this->router->fetch_class() == 'Structure') : ?>
		<link rel="stylesheet" href="<?= base_url() ?>assets/css/structure1.css"/>
	<? endif; ?>
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css"/>
	<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
	<script src="<?= base_url() ?>assets/js/base.js"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap/popper.min.js"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="<?= base_url('assets/js/bootstrap/bootstrap-select.js') ?>"></script>
	<script src="<?= base_url() ?>assets/js/fontawesome.min.js"></script>
	<!--	<script src="--><? //= base_url() ?><!--assets/js/generate_password.js"></script>-->


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

		li.active > a {
			color: #6c757d;
			font-weight: 700;
		}

		sub {
			font-size: 50% !important;
		}


	</style>
	<!-- Some CSS end -->
</head>
<body>
<?
$controller = $this->router->fetch_class();
$page = $this->router->fetch_method();
$token = $this->session->token;
?>



<?
$row = json_decode($this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/get_user', array('token' => $token)), true);


?>

<!-- Navbar Start -->
<nav class="navbar navbar-light bg-light fixed-top"
	 style="box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);margin-bottom: 20px;">
	<a class="navbar-brand" href="#">NestGarageSystem<sub>beta</sub></a>
	<div class="ml-4">

		<a class="nav_a mr-2 <?= ($controller == 'Organization' ? 'active' : '') ?>  btn btn-sm btn-outline-success2"
		   href="<?= $this->load->old_baseUrl() . (($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/company') ?>"><?= lang('organization') ?></a>

		<a class="nav_a btn btn-sm btn-outline-success2 mr-2 <?= ($controller == 'Structure' ? 'active' : '') ?> "
		   href="<?= $this->load->old_baseUrl() . (($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/structure1') ?>"><?= lang('structure') ?></a>

		<a class="nav_a btn btn-sm btn-outline-success2 <?= ($controller == 'Gps' ? 'active' : '') ?> "
		   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/gps_tracking') ?>">GPS</a>

	</div>


	<div class="ml-auto mr-5">
		<strong><?= lang('welcome') ?></strong> / <span class="username_login"><a href="#"
																				  style="color: #333;"><?= $row['name'] ?></a></span>
	</div>

	<div class="langs mr-5">
		<ul class="mr-auto" data-url="<?= base_url('change_lang') ?>">
			<li class="float-left  <?= (($this->uri->segment(1) == 'hy' or $this->uri->segment(1) == '') ? 'active' : '') ?>"
				data-lang="hy"><a class="nav-link" href="javascript:void(0)">Հայ</a></li>
			<li class="float-left   <?= ($this->uri->segment(1) == 'ru' ? 'active' : '') ?>" data-lang="ru"><a
					class="nav-link" href="javascript:void(0)">Рус</a></li>
		</ul>
	</div>

	<a href="<?= $this->load->old_baseUrl() . 'User/logout' ?>">
		<button class="btn btn-outline-dark">
			<i class="fas fa-sign-out-alt"></i>
		</button>
	</a>
</nav>
<!-- Navbar End -->

<div class="res_cont_fl container-fluid" style="margin-top: 5rem;"><?
	if ($controller == 'Gps') { ?>

		<div class="container-fluid pl-0 pr-0" style="margin-top: -11px;margin-bottom: 5px;">
			<nav class="navbar navbar-expand-lg navbar-light bg-light pl-0 pr-0">
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav mr-auto">
						<a href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/trajectory') ?>">
							<button
								style="color:#00000080 !important;max-height: 40px;"
								class="btn btn-outline-secondary btn-sm  nav-item nav-link mr-1"
								data-toggle="tooltip" data-placement="top"
								title="<?= lang('trajectory') ?>">
								<img src="<?= base_url() ?>assets/images/gps_tracking/satellite.svg"/>
							</button>
						</a>
						<!--											<a href="-->
						<? //= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/geofences') ?><!--">-->
						<!--												<button-->
						<!--													style="color:#00000080 !important;max-height: 40px;"-->
						<!--													class="btn btn-outline-secondary btn-sm nav-item nav-link mr-1"-->
						<!--													data-toggle="tooltip" data-placement="top"-->
						<!--													title="-->
						<? //= lang('geofences') ?><!--">-->
						<!--													<i style="font-size: 20px;" class="fas fa-draw-polygon"></i>-->
						<!--												</button>-->
						<!--											</a>-->
						<a href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/speed') ?>">
							<button style="color:#00000080 !important;max-height: 40px;"
									class="btn btn-outline-secondary btn-sm  nav-item nav-link mr-1"
									href="#"
									data-toggle="tooltip" data-placement="top"
									title="<?= lang('speed') ?>">
								<img
									src="<?= base_url() ?>assets/images/gps_tracking/speedometer.svg"/>
							</button>
						</a>
						<a href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/fuel') ?>">
							<button
								style="color:#00000080 !important;max-height: 40px;"
								class="btn btn-outline-secondary btn-sm  nav-item nav-link mr-1"
								href="#"
								data-toggle="tooltip" data-placement="top"
								title="<?= lang('fuel') ?>">
								<img
									src="<?= base_url() ?>assets/images/gps_tracking/gas-station.svg"/>
							</button>
						</a>
						<button
							style="color:#00000080 !important;max-height: 40px;"
							class="btn btn-outline-secondary btn-sm  nav-item nav-link mr-1 "
							href="#"
							data-toggle="tooltip" data-placement="top"
							title="<?= lang('engine') ?>">
							<img src="<?= base_url() ?>assets/images/gps_tracking/engine.svg"/>
						</button>
						<button
							style="color:#00000080 !important;max-height: 40px;"
							class="btn btn-outline-secondary btn-sm  nav-item nav-link mr-1 "
							href="#"
							data-toggle="tooltip" data-placement="top" title="<?= lang('cargo') ?>">
							<img src="<?= base_url() ?>assets/images/gps_tracking/box.svg"/>
						</button>
						<button
							style="color:#00000080 !important;max-height: 40px;"
							class="btn btn-outline-secondary btn-sm nav-item nav-link mr-1 "
							href="#"
							data-toggle="tooltip" data-placement="top" title="<?= lang('sos') ?>">
							<img src="<?= base_url() ?>assets/images/gps_tracking/support.svg"/>
						</button>
						<button
							style="color:#00000080 !important;display: inline-block;max-height: 40px;"
							class="btn btn-outline-secondary btn-sm nav-item nav-link mr-1 ml-1"
							href="#"
							data-toggle="tooltip" data-placement="top"
							title="<?= lang('notification') ?>">
							<img
								src="<?= base_url() ?>assets/images/gps_tracking/notification.svg"/>
						</button>
						<button
							style="color:#00000080 !important;display: inline-block;max-height: 40px;"
							class="btn btn-outline-secondary btn-sm nav-item nav-link mr-1 "
							href="#"
							data-toggle="tooltip" data-placement="top" title="<?= lang('event') ?>">
							<img src="<?= base_url() ?>assets/images/gps_tracking/event.svg"/>
						</button>
						<button
							style="color:#00000080 !important;display: inline-block;max-height: 40px;"
							class="btn btn-outline-secondary btn-sm nav-item nav-link mr-1 "
							href="#"
							data-toggle="tooltip" data-placement="top"
							title="<?= lang('statistics') ?>">
							<img src="<?= base_url() ?>assets/images/gps_tracking/statistics.svg"/>
						</button>
						<label class="text-center col-sm-2"
							   style="padding: 10px 6px 0px 10px;"><?= lang('update') ?></label>
						<select style="margin-top: 1px; width: 100px;" class="form-control form-control-sml;">
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>5</option>
							<option>10</option>
							<option>15</option>
							<option>20</option>
							<option>25</option>
						</select>


					</div>

					<div class="navbar-nav ml-auto">
						<a href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/geoferences') ?>">
							<button
								style="color:#00000080 !important;max-height: 40px;"
								class="btn btn-outline-secondary  nav-item nav-link mr-1 settings_btn"
								data-toggle="tooltip" data-placement="top"
								title="<?= lang('geofences') ?>">
								<i style="font-size: 20px;" class="fas fa-draw-polygon"></i>
							</button>
						</a>
						<!--											<button-->
						<!--												style="color:#00000080 !important;display: inline-block;max-height: 40px;padding: 7px 24px !important;"-->
						<!--												class="btn btn-outline-secondary  nav-item nav-link mr-1 set_square_btn"-->
						<!--												href="#"><img-->
						<!--													style="margin-right: 5px;margin-left: -15px;"-->
						<!--													src="-->
						<? //= base_url() ?><!--assets/images/gps_tracking/set-square.svg"-->
						<!--													class="ml-0 mr-0 "/>-->
						<!--											</button>-->
						<button
							style="color:#00000080 !important;display: inline-block;max-height: 40px;padding: 7px 24px !important;"
							class="btn btn-outline-secondary  nav-item nav-link mr-1 settings_btn"
							data-toggle="modal"
							data-target=".settings_modal" href="#">
							<img style="margin-right: 5px;margin-left: -15px;"
								 src="<?= base_url() ?>assets/images/gps_tracking/settings-work-tool.svg"
								 class="ml-0 mr-0 "/>
						</button>
						<button
							style="color:#00000080 !important;display: inline-block;max-height: 40px;padding: 7px 24px !important;"
							class="btn btn-outline-secondary  nav-item nav-link mr-1 print-btn"
							href="#"><img
								style="margin-right: 5px;margin-left: -15px;"
								src="<?= base_url() ?>assets/images/gps_tracking/print.svg"
								class="ml-0 mr-0 "/></button>
					</div>
				</div>
			</nav>
		</div>

	<? } ?>


	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
