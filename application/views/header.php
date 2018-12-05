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
	<script src="<?= base_url() ?>assets/js/generate_password.js"></script>

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


	</style>
	<!-- Some CSS end -->
</head>
<body>
<?
$controller = $this->router->fetch_class();
$page = $this->router->fetch_method();
?>

<?
$user_id = $this->session->user_id;
$row = $this->db->select('CONCAT_WS(" ", user.first_name, user.last_name) AS name')
	->from('user')
	->where('id', $user_id)
	->get()
	->row_array();
?>

<!-- Navbar Start -->
<nav class="navbar navbar-light bg-light fixed-top"
	 style="box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);margin-bottom: 20px;">
	<a class="navbar-brand" href="#">NestGarageSystem</a>
	<div class="ml-4">

		<a class="nav_a mr-2 <?= ($controller == 'Organization' ? 'active' : '') ?>  btn btn-sm btn-outline-success2"
		   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/company') ?>"><?= lang('organization') ?></a>

		<a class="nav_a btn btn-sm btn-outline-success2 <?= ($controller == 'Structure' ? 'active' : '') ?> "
		   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/structure1') ?>"><?= lang('structure') ?></a>


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

	<a href="<?= base_url('User/logout') ?>">
		<button class="btn btn-outline-dark">
			<i class="fas fa-sign-out-alt"></i>
		</button>
	</a>
</nav>
<!-- Navbar End -->

<div class="res_cont_fl container-fluid" style="margin-top: 5rem;"><?
	if ($controller == 'Organization') { ?>
	<div class="tab-content">

		<div class="tab-pane container-fluid mt-3 mt-md-3 active" id="organization">

			<div class="row">
				<!-- Vertical Tabs Start-->
				<div class="col-sm-12 col-md-2">
					<div class="list-group" id="list-tab" role="tablist"
						 style="box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
						<a class="list-group-item list-group-item-action <?= ($page == 'company' ? 'active' : '') ?>"
						   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/company') ?>"
						   role="tab" aria-controls="company"><?= lang('company') ?>
						</a>
						<a class="list-group-item list-group-item-action <?= ($page == 'department' ? 'active' : '') ?>"
						   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/department') ?>"
						   role="tab" aria-controls="department"><?= lang('department') ?>
							<span class="float-right">4</span>
						</a>
						<a class="list-group-item list-group-item-action <?= ($page == 'staff' ? 'active' : '') ?>"
						   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/staff') ?>"
						   role="tab" aria-controls="staff"><?= lang('staff') ?>
							<span class="float-right">2</span></a>
						<a class="list-group-item list-group-item-action <?= (($page == 'vehicles' || $page == 'add_vehicles' || $page == 'edit_vehicles') ? 'active' : '') ?>"
						   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/vehicles') ?>"
						   role="tab" aria-controls="settings"><?= lang('vehicle') ?>
							<span class="float-right"></span>
						</a>
						<a class="list-group-item list-group-item-action <?= ($page == 'user' ? 'active' : '') ?>"
						   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/user') ?>"
						   role="tab" aria-controls="user"><?= lang('user') ?>
							<span class="float-right"></span>
						</a>
					</div>
				</div>
				<!-- Vertical Tabs End-->


				<div class="<?= ($controller == 'Organization' ? 'col' : 'container') ?>"
					 style="box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);margin-bottom: 20px; padding-left: 0; padding-right: 0;">
					<div class="tab-content" id="nav-tabContent" style="position:relative;background: ">

						<div class="loader"></div>
						<img class="loader_svg" src="<?= base_url('assets/images/puff.svg') ?>"/><?

						} elseif ($controller == 'Structure' || $controller == 'Fleet_history') { ?>

							<div class="content m-1">
								<div class="nav nav-tabs" id="nav-tab" role="tablist">
									<a class="info-type nav-item nav-link nav_a mr-2 btn btn-sm btn-outline-success2 showed <?=$controller == 'Structure' && $this->uri->segment(3) == '' ? 'active show' : '' ?> "
									   data-id="1"
									   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/' . ($controller == 'Structure' ? $page : 'structure1')) ?>"
									   role="tab">
										<i class="fas fa-info"></i> Ինֆորմացիա
									</a>

									<a class="info-type nav-item nav-link nav_a mr-2 btn btn-sm btn-outline-success2 showed  <?= $this->uri->segment(3) == 'add_expenses' ? 'active show' : '' ?> "
									   data-id="2"
									   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/' . ($controller == 'Structure' ? $page : 'structure1') . '/add_expenses') ?>"
									   role="tab">
										<i class="fas fa-plus"></i> Ավելացնել ծախսեր
									</a>

									<a class="info-type nav-item nav-link nav_a mr-2  btn btn-sm btn-outline-success2 showed <?= $this->uri->segment(3) == 'fleet_history' ? 'active show' : '' ?> "
									   data-id="3"
									   data-toggle=""
									   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) .  '/' . ($controller == 'Structure' ? $page : 'structure1') . '/fleet_history') ?>"
									   role="tab">
										<i class="fas fa-clipboard-list"></i> Ծախսերի պատմություն
									</a>

									<a class="info-type nav-item nav-link nav_a mr-2  btn btn-sm btn-outline-success2 showed <?= $page == 'expenses_history' ? 'active show' : '' ?> "
									   data-id="3"
									   data-toggle=""
									   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/expenses_history') ?>"
									   role="tab">
										<i class="fas fa-history"></i> Կազմակերպությնա ընդհանուր ծախսեր
									</a><?
									if ($controller == 'Structure') {
										?>
										<div class="btn-group ml-auto">

										<a href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/structure1/'.$this->uri->segment(3)) ?>">
											<button type="button"
													style="width: 40px;height: 40px;padding: 0 !important;"
													class="m-1 btn btn-outline-secondary btn-sm <?= ($page == 'structure1' ? 'active' : '') ?>">
												<img width="20" src="<?= base_url('assets/images/trees1.svg') ?>">
											</button>
										</a>
										<a href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/structure2/'.$this->uri->segment(3)) ?>">
											<button type="button"
													style="width: 40px;height: 40px;padding: 0 !important;"
													class="m-1 btn btn-outline-secondary btn-group-sm <?= ($page == 'structure2' ? 'active' : '') ?>">
												<img width="20" src="<?= base_url('assets/images/trees2.svg') ?>">
											</button>
										</a>
										<a href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/structure3/'.$this->uri->segment(3)) ?>">
											<button type="button"
													style="width: 40px;height: 40px;padding: 0 !important;"
													class="m-1 btn btn-outline-secondary <?= ($page == 'structure3' ? 'active' : '') ?>"
													style="">
												<img width="20" src="<?= base_url('assets/images/trees3.svg') ?>">
											</button>
										</a>

										</div><?
									}
									?>

								</div>


							</div>


							<div class=""><?
								if($page == 'structure1') {
									?>
									<div class="row btn-group mt-2 mt-md-2"
										 style=" right: 46px; z-index: 999;position: absolute;">
									<input class="form-control col-7" type="search" id="mySearch" onkeypress="if (event.keyCode === 13) searchDiagram()">
									<a class="nav_a btn btn-sm btn-outline-success2 active ml-2" onclick="searchDiagram()">Search</a>
								</div>
								<?}?>
							</div><?
						} ?>
