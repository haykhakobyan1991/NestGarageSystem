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
<body >
<?
$controller = $this->router->fetch_class();
$page = $this->router->fetch_method();
$token = $this->session->token;

$unread = $this->session->unread;

if(!$unread) {

	$sql = "
				SELECT 
					gps.\"id\",
					gps.\"lat\",
					gps.\"long\",
					gps.\"speed\",
					gps.\"course\",
					gps.\"sos_visibility\",
					CONCAT_WS(' ',
						gps.\"date\",
						gps.\"time\"
					) datetime,
					gps.\"imei\",
					gps.\"fuel\"
				FROM 
				   gps
				WHERE sos = '1'
				ORDER BY imei, date, time
			";

	$query = $this->db->query($sql);
	$result = $query->result_array();

	$_datetime = '';
	$counter = 0;
	$unread = 0;

	foreach ($result as $row) {
		$counter++;
		if ($counter == 1) {
			$_datetime = new DateTime($row['datetime']);
		}

		// datetime 2 minute interval
		$datetime1 = new DateTime($row['datetime']);

		$interval = $datetime1->diff($_datetime);
		$elapsed = $interval->format('%i');

		if ($elapsed >= 2) {
			$_datetime = new DateTime($row['datetime']);
			if ($row['sos_visibility'] == -1) {
				$unread++;
			}
		}

	}
	$unread = $this->session->set_userdata('unread', $unread);
}


$row = json_decode($this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/get_user', array('token' => $token)), true); // todo url
$row_company = json_decode($this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/getCompanyName', array('token' => $token)), true); // todo url

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

<input type="hidden" name="company" value="<?=$row_company['name']?>">

<div class="res_cont_fl container-fluid" style="margin-top: 5rem;"><?
	if ($controller == 'Gps') { ?>

		<div class="container-fluid pl-0 pr-0" style="margin-top: -11px;margin-bottom: 5px;">
			<nav class="navbar navbar-expand-lg navbar-light bg-light pl-0 pr-0">
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav mr-auto">
						<a href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/trajectory') ?>">
							<button
								style="color:#00000080 !important;max-height: 40px;"
								class="btn btn-outline-secondary btn-sm  nav-item nav-link mr-1 <?= ($page == 'trajectory' ? 'active' : '') ?>"
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
<!--						<a href="--><?//= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/speed') ?><!--">-->
<!--							<button style="color:#00000080 !important;max-height: 40px;"-->
<!--									class="btn btn-outline-secondary btn-sm  nav-item nav-link mr-1"-->
<!--									href="#"-->
<!--									data-toggle="tooltip" data-placement="top"-->
<!--									title="--><?//= lang('speed') ?><!--">-->
<!--								<img-->
<!--									src="--><?//= base_url() ?><!--assets/images/gps_tracking/speedometer.svg"/>-->
<!--							</button>-->
<!--						</a>-->
						<a href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/fuel') ?>">
							<button
								style="color:#00000080 !important;max-height: 40px;"
								class="btn btn-outline-secondary btn-sm  nav-item nav-link mr-1 <?= ($page == 'fuel' ? 'active' : '') ?>"
								href="#"
								data-toggle="tooltip" data-placement="top"
								title="<?= lang('fuel') ?>">
								<img src="<?= base_url() ?>assets/images/gps_tracking/gas-station.svg"/>
							</button>
						</a>
<!--						<button-->
<!--							style="color:#00000080 !important;max-height: 40px;"-->
<!--							class="btn btn-outline-secondary btn-sm  nav-item nav-link mr-1 "-->
<!---->
<!--							href="#"-->
<!--							data-toggle="tooltip" data-placement="top"-->
<!--							title="--><?//= lang('engine') ?><!--">-->
<!--							<img src="--><?//= base_url() ?><!--assets/images/gps_tracking/engine.svg"/>-->
<!--						</button>-->
						<a href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/load') ?>">
						<button
							style="color:#00000080 !important;max-height: 40px;"
							class="btn btn-outline-secondary btn-sm  nav-item nav-link mr-1 <?= ($page == 'load' ? 'active' : '') ?>"
							href="#"
							data-toggle="tooltip" data-placement="top" title="<?= lang('cargo') ?>">
							<img src="<?= base_url() ?>assets/images/gps_tracking/box.svg"/>
						</button>
						</a>
						<a href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/sos') ?>">
						<button
							style="color:#00000080 !important;max-height: 40px;position: relative"
							class="btn btn-outline-secondary btn-sm nav-item nav-link mr-1 <?= ($page == 'sos' ? 'active' : '') ?>"
							href="#"
							data-toggle="tooltip" data-placement="top" title="<?= lang('sos') ?>">
							<img src="<?= base_url() ?>assets/images/gps_tracking/support.svg"/>
							<a href="#" style="position: absolute;color: #fff !important;background: rgb(255, 122, 89) !important;" class="badge count_unread"><?=$unread?></a>
						</button>
						</a>
						<button
							style="color:#00000080 !important;display: inline-block;max-height: 40px;"
							class="btn btn-outline-secondary btn-sm nav-item nav-link mr-1 ml-1"
							href="#"
							data-toggle="tooltip" data-placement="top"
							title="<?= lang('notification') ?>">
							<img src="<?= base_url() ?>assets/images/gps_tracking/notification.svg"/>
						</button>
						<a href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/event') ?>">
						<button
							style="color:#00000080 !important;display: inline-block;max-height: 40px;"
							class="btn btn-outline-secondary btn-sm nav-item nav-link mr-1 <?= ($page == 'event' ? 'active' : '') ?>"
							href="#"
							data-toggle="tooltip" data-placement="top" title="<?= lang('event') ?>">
							<img src="<?= base_url() ?>assets/images/gps_tracking/event.svg"/>
						</button>
						</a>
<!--						<button-->
<!--							style="color:#00000080 !important;display: inline-block;max-height: 40px;"-->
<!--							class="btn btn-outline-secondary btn-sm nav-item nav-link mr-1 "-->
<!--							href="#"-->
<!--							data-toggle="tooltip" data-placement="top"-->
<!--							title="--><?//= lang('statistics') ?><!--">-->
<!--							<img src="--><?//= base_url() ?><!--assets/images/gps_tracking/statistics.svg"/>-->
<!--						</button>-->
<!--						<label class="text-center col-sm-2"-->
<!--							   style="padding: 10px 6px 0px 10px;">--><?//= lang('update') ?><!--</label>-->
<!--						<select style="margin-top: 1px; width: 100px;" class="form-control form-control-sml;">-->
<!--							<option>1</option>-->
<!--							<option>2</option>-->
<!--							<option>3</option>-->
<!--							<option>5</option>-->
<!--							<option>10</option>-->
<!--							<option>15</option>-->
<!--							<option>20</option>-->
<!--							<option>25</option>-->
<!--						</select>-->
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

		$('.print-btn').click(function () {
			window.print();
		})
	</script>
	<!-- Settings Modal Start -->
	<?

		$lng = $this->load->lng();
		$token = $this->session->token;
		$company_id = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_companyId', array('token' => $token));

		$sql = "
			SELECT 
				id,
				nominal_speed,
				threshold_of_refueling,
				drain_threshold,
				parking_time
			FROM 
				config
			WHERE company_id = '".$company_id."'	
		";

		$query = $this->db->query($sql);
		$config = $query->row_array();

	?>

	<div class="modal fade settings_modal" tabindex="-1" role="dialog"
		 aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm ">
			<div class="modal-content settings_modal_content">
				<div class="modal-header bg-dark">
					<h6 class="modal-title text-white"><?= lang('settings') ?></h6>
				</div>
				<div class="modal-body">
					<div class="container-fluid">

							<div class="form-group row mb-0">
								<label class="col-sm-8 col-form-label"><?=lang('Nominal_speed')?></label>
								<div class="col-sm-4">
									<input type="number" name="nominal_speed" class="form-control"  value="<?=(isset($config['nominal_speed']) ? $config['nominal_speed'] : $this->config->item('nominal_speed'))?>">
								</div>
							</div>
							<div class="form-group row mb-0">

								<label class="col-sm-8 col-form-label"><?=lang('Threshold_of_refueling')?></label>
								<div class="col-sm-4">
									<input type="number" name="threshold_of_refueling" class="form-control"  value="<?=(isset($config['threshold_of_refueling']) ? $config['threshold_of_refueling'] : $this->config->item('threshold_of_refueling'))?>">
								</div>
							</div>
							<div class="form-group row mb-0">

								<label class="col-sm-8 col-form-label"><?=lang('Drain_threshold')?></label>
								<div class="col-sm-4">
									<input type="number" name="drain_threshold" class="form-control"  value="<?=(isset($config['drain_threshold']) ? $config['drain_threshold'] : $this->config->item('drain_threshold'))?>">
								</div>
							</div>
							<div class="form-group row mb-0">
								<label class="col-sm-8 col-form-label"><?=lang('parking_time')?></label>
								<div class="col-sm-4">
									<input type="number" name="parking_time" class="form-control"  value="<?=(isset($config['parking_time']) ? $config['parking_time'] : $this->config->item('parking_time'))?>">
								</div>
							</div>

					</div>
				</div>

				<div class="modal-footer pb-0" style="margin-right: 22px;">
					<button id="config" type="button"
							class="btn btn-outline-success cancel_btn mb-2"><?= lang('save') ?>
					</button>
					<button id="load" style="height: 40px !important; width: 90px !important;"
							class="btn btn-sm btn-outline-success cancel_btn d-none"><img
							style="height: 20px;margin: 0 auto;display: block;text-align: center;"
							src="<?= base_url() ?>assets/images/bars2.svg"/></button>
					<button type="button" class="cancel_btn close btn btn-sm mb-2"
							data-dismiss="modal"
							aria-label="Close">
						<?= lang('cancel') ?>
					</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Settings Modal End -->


	<script>

		$(document).on('click', '#config', function (e) {

			var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/System_main/config_ax') ?>';
			e.preventDefault();

			var nominal_speed = $('input[name="nominal_speed"]').val();
			var threshold_of_refueling = $('input[name="threshold_of_refueling"]').val();
			var drain_threshold = $('input[name="drain_threshold"]').val();
			var parking_time = $('input[name="parking_time"]').val();

			var form_data = new FormData();

			form_data.append('nominal_speed', nominal_speed);
			form_data.append('threshold_of_refueling', threshold_of_refueling);
			form_data.append('drain_threshold', drain_threshold);
			form_data.append('parking_time', parking_time);



			$('input').removeClass('border border-danger');
			$('input').parent('td').removeClass('border border-danger');
			$('select').removeClass('border border-danger');
			loading('start', 'add_department_btn');

			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data: form_data,
				contentType: false,
				cache: false,
				processData: false,
				beforeSend: function () {
					scroll_top();
					close_message();
					loading('start', 'config');
					$('.alert-info').removeClass('d-none');
					$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');
				},
				success: function (data) {
					if (data.success == '1') {
						close_message();


						$('.alert-success').removeClass('d-none');
						$('.alert-success').text(data.message);

						loading('stop', 'config');


						var url = "<?=current_url()?>";

						$(location).attr('href', url);


					} else {
						close_message();
						loading('stop', 'config');

						if ($.isArray(data.error.elements)) {
							scroll_top();
							loading('stop', 'config');
							errors = '';
							tmp = '';
							$.each(data.error.elements, function (index) {
								$.each(data.error.elements[index], function (index, value) {
									if (value != '') {
										$('input[name="' + index + '"]').addClass('border border-danger');
										$('select[name="' + index + '"]').parent('div').children('button').addClass('border border-danger');
										close_message();
										$('.alert-danger').removeClass('d-none');

										if (value != tmp) {
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
		})


	</script>
