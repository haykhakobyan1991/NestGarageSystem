<script src="<?= base_url() ?>assets/js/excelexportjs.js"></script>

<?
$folder = $this->session->folder;
?>
<div class="tab-content mt-3" id="nav-tabContent-car" style="display: none">

	<div class="tab-pane fade show active" id="nav-car" role="tabpanel" aria-labelledby="nav-car-tab">
		<div class="container-fluid ">
			<div class="row"><?

				if (!empty($result)) {
					$staff_id = '';
					foreach ($result as $row) {
						if ($row['staff_id'] != $staff_id) :
							?>
							<div class="col-sm-12 p-0">
								<div class="col-sm-3" style="border: 1px solid #dee2e6 !important; min-width: 32%;">
									<div class="row bg-white">
										<div class="p-2  w-auto " style="min-width: 47%;">
											<p class="text-black small driver_info"><?= lang('first_name') ?>:
												<span class="text-black ml-2"><?= $row['first_name'] ?></span>
											</p>
											<p class="text-black small driver_info"><?= lang('last_name') ?>:
												<span class="text-black ml-2"><?= $row['last_name'] ?></span>
											</p>

											<p class="text-black small driver_info"><?= lang('contact_number') ?> 1:
												<span class="text-black ml-2"><?= $row['contact_1'] ?></span>
											</p>
											<p class="small text-black driver_info"><?= lang('contact_number') ?> 2:
												<span class="text-black ml-2"><?= $row['contact_2'] ?></span>
											</p>
											<p class="small text-black driver_info"><?= lang('email') ?>: <span
													class="text-black ml-2"><?= $row['email'] ?></span></p>
											<p class="small text-black driver_info"><?= lang('country') ?>: <span
													class="text-black ml-2"><?= $row['country'] ?></span></p>
											<p class="small text-black driver_info"><?= lang('address') ?>: <span
													class="text-black ml-2"><?= $row['address'] ?></span></p>
											<p class="small text-black driver_info"><?= lang('post_code') ?>:
												<span class="text-black ml-2"><?= $row['post_code'] ?></span>
											</p>
											<p class="small text-black driver_info"><?= lang('department') ?>: <span
													class="text-black ml-2"><?= $row['department'] ?></span></p>
										</div>
										<div class="p-2  w-auto" style="min-width: 47%;">
											<p class="small text-black driver_info"><?= lang('position') ?>:
												<span class="text-black ml-2"><?= $row['position'] ?></span>
											</p>
											<p class="small text-black driver_info"><?= lang('nest_card_id') ?>:
												<span class="text-black ml-2"><?= $row['nest_card_id'] ?></span>
											</p>
											<p class="small text-black driver_info m-2">

												<img width="100px"
													 src="<?= base_url('uploads/' . $folder . '/staff/original/' . $row['photo']) ?>"
													 alt="">
											</p>
										</div>
										<div class="text-center" style="background: #c3c3c3;min-width: 6%; position:relative;">
											<img class="open_menu" style="padding-top: 10px;width: 22px;"
												 src="<?= base_url('assets/img/staff.svg') ?>" alt="" title=""/><?=($row['head_staff_id'] == $row['staff_id'] ? '&#x2191;' : '' )?>
											<i style="display: block;"
											   class="open_menu text-white fas fa-ellipsis-h"></i>

											<div class="dropdown-menu" style="position:absolute;top: 27px;left: 20px;">
												<a class="dropdown-item" target="_blank" href="<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()).'/staff/?id='.$row['staff_id'])?>">
													<i class="pr-2 fas fa-edit"></i><?=lang('edit')?>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="ml-5"></div><?
						endif;
						$staff_id = $row['staff_id'];
						?>

						<div class="col-sm-3 mb-1 mt-1" style="border: 1px solid silver !important; min-width: 32%;">
						<div class="row bg-white" style="position:relative;">
							<div class=" p-2 mt-1 w-auto" style="min-width: 47%">
								<p class="text-black small driver_info"><?= lang('brand') ?>: <span
										class="text-black ml-2"><?= $row['brand'] ?></span></p>
								<p class="text-black small driver_info"><span style="float: left;"><?= lang('color') ?>:</span> <span
										class="ml-2 text-black"
										style="-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 15px;height: 15px;background: <?= $row['color'] ?>;border: 1px solid #efefef;display: inline-block;"> </span>
								</p>
								<p class="small text-black driver_info" style="clear: both;"><?= lang('engine') ?>: <span
										class="text-black ml-2"><?= $row['engine_power'] ?></span></p>
								<p class="small text-black driver_info"><?= lang('model') ?>: <span
										class="text-black ml-2"><?= $row['model'] ?></span></p>
								<p class="small text-black driver_info"><?= lang('year') ?>: <span
										class="text-black ml-2"><?= $row['production_date'] ?></span></p>
								<p class="small text-black driver_info"><?= lang('vin') ?>: <span
										class="text-black ml-2"><?= $row['vin_code'] ?></span></p>
								<p class="small text-black driver_info"><?= lang('vehicle_type') ?>: <span
										class="text-black ml-2"><?= $row['fleet_type'] . ($row['other'] != '' ? ' ('.$row['other'].')' : '')?></span></p>
								<p class="small text-black driver_info"><?= lang('department') ?>: <span
										class="text-black ml-2"><?= $row['department'] ?></span></p>
								<p class="small text-black driver_info"><?= lang('registration_address') ?>։<span
										class="text-black ml-2"><?= $row['regitered_address'] ?></span></p>
								<p class="small text-black driver_info"><?= lang('insurance') ?>: <span
										class="text-black ml-2"><?= $row['insurance_type'] ?></span></p>
							</div>
							<div class=" p-2 mb-1 mt-1 w-auto" style="min-width: 47%;">
								<p class="small text-black driver_info"><?= lang('attached') ?>: <span
										class="text-black ml-2"><?= $row['first_name'] . ' ' . $row['last_name'] ?></span>
								</p>
								<p class="small text-black driver_info"><?= lang('car_number') ?>: <span
										class="text-black ml-2"><?= $row['fleet_plate_number'] ?></span></p>
								<p class="small text-black driver_info"><?= lang('fuel_type') ?>։ <span
										class="text-black ml-2"><?= $row['fuel'] ?></span></p>
								<p class="small text-black driver_info"><?= lang('average_expense_100_km') ?> ։<span
										class="text-black ml-2"><?= $row['fuel_avg_consumption'] ?></span></p>
<!--								<p class="small text-black driver_info">--><?//= lang('in_day') ?><!-- ։<span-->
<!--										class="text-black ml-2">--><?//= $row['value1_day'] ?><!-- կմ․</span></p>-->
								<p class="small text-black driver_info"><?= lang('running') ?>։<span
										class="text-black ml-2"><?= $row['mileage'].' '.($row['mileage'] != '' ? $row['value'] : '')?></span></p>

								<p class="small text-black driver_info"><?= lang('GPS_Exist') ?>։<span
										class="text-black ml-2"><?= ($row['gps_tracker_exists'] == 1 ? lang('yes') : lang('no')) ?></span>
								</p>
								<p class="small text-black driver_info"><?= lang('GPS_Tracker_IMEI') ?>։<span
										class="text-black ml-2"><?= $row['gps_tracker_imei'] ?></span>
								</p>
								<p class="small text-black driver_info"><?= lang('in_force') ?>: <span
										class="text-black ml-2"><?= $row['insurance_expiration_1'] ?></span></p>
							</div>

							<div class="text-center "
								 style="background: #c3c3c3; min-width: 6%; position:absolute; right: 0;height: 100%;">
								<img class="open_menu" style="width: 23px;" src="<?= base_url('assets/img/car.svg') ?>"
									 alt="" title=""/>
								<i style="display: block;margin-top: -5px;"
								   class="open_menu text-white fas fa-ellipsis-h"></i>

								<div class="dropdown-menu" style="position:absolute;top: 27px;left: 20px;">
									<a class="dropdown-item" target="_blank" href="<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()).'/edit_vehicles/'.$row['id'])?>"><i class="pr-2 fas fa-edit"></i><?=lang('edit')?></a>

									<?= ($row['gps_tracker_exists'] == '1' ? '<a class="dropdown-item" target="_blank" href="'.base_url("gps/".($this->uri->segment(1) != "" ? $this->uri->segment(1) : $this->load->default_lang())."/gps_tracking") .'"><i class="pr-2 fas fa-map-marker-alt"></i>GPS</a>' : '') ?>

								</div>
							</div>
						</div>
						</div><?
					}
				}

				?>
			</div>

		</div>
	</div>




</div>

<script>
	$(".open_menu").contextmenu(function (e) {

		$('.dropdown-menu').fadeOut(200);
		$(this).parent('div').children('div').css('display', 'block');

		e.preventDefault(e)
	});

	function closeMenu() {
		$('.dropdown-menu').fadeOut(200);
	}

	$(document.body).click(function (e) {
		closeMenu();
	});

	$(".dropdown-menu").click(function (e) {
		e.stopPropagation();
	});


</script>


