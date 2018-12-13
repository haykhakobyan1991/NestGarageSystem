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
						if($row['staff_id'] != $staff_id) :
						?><div class="col-sm-12 p-0" >
							<div class="col-sm-3" style="border: 1px solid #dee2e6 !important; min-width: 32%;">
								<div class="row bg-white">
									<div class="p-2  w-auto " style="min-width: 45%;">
										<p class="text-black small driver_info"><?=lang('first_name')?>:
											<span class="text-black ml-2"><?= $row['first_name'] ?></span>
										</p>
										<p class="text-black small driver_info"><?=lang('last_name')?>:
											<span class="text-black ml-2"><?= $row['last_name'] ?></span>
										</p>

										<p class="text-black small driver_info"><?=lang('contact_number')?> 1:
											<span class="text-black ml-2"><?= $row['contact_1'] ?></span>
										</p>
										<p class="small text-black driver_info"><?=lang('contact_number')?> 2:
											<span class="text-black ml-2"><?= $row['contact_2'] ?></span>
										</p>
										<p class="small text-black driver_info"><?=lang('email')?>: <span
												class="text-black ml-2"><?= $row['email'] ?></span></p>
										<p class="small text-black driver_info"><?=lang('country')?>: <span
												class="text-black ml-2"><?= $row['country'] ?></span></p>
										<p class="small text-black driver_info"><?=lang('address')?>: <span
												class="text-black ml-2"><?= $row['address'] ?></span></p>
										<p class="small text-black driver_info"><?=lang('post_code')?>:
											<span class="text-black ml-2"><?= $row['post_code'] ?></span>
										</p>
										<p class="small text-black driver_info"><?=lang('department')?>: <span
												class="text-black ml-2"><?= $row['department'] ?></span></p>
									</div>
									<div class="p-2  w-auto" style="min-width: 45%;">
										<p class="small text-black driver_info"><?=lang('position')?>:
											<span class="text-black ml-2"><?= $row['position'] ?></span>
										</p>
										<p class="small text-black driver_info"><?=lang('nest_card_id')?>:
											<span class="text-black ml-2"><?= $row['nest_card_id'] ?></span>
										</p>
										<p class="small text-black driver_info m-2">
											<img width="100px"
												 src="<?= base_url('uploads/' . $folder . '/staff/original/' . $row['photo']) ?>"
												 alt="">
										</p>
									</div>
									<div class="text-center" style="background: #c3c3c3;min-width: 10%">
										<img style="padding-top: 10px;width: 35px;" src="<?=base_url('assets/img/staff.svg')?>" alt="" title="" />
										<img style="display: block;margin: 0 auto;" src="<?=base_url('assets/images/dots.svg')?>">
									</div>
								</div>
								</div>
							</div> <div class="ml-5"></div><?
						endif;
						$staff_id = $row['staff_id'];
						?>

						<div class="col-sm-3 mb-1 mt-1" style="border: 1px solid silver !important; min-width: 32%;">
						<div class="row bg-white">
							<div class=" p-2 mt-1 w-auto" style="min-width: 45%">
								<p class="text-black small driver_info"><?=lang('brand')?>: <span
										class="text-black ml-2"><?= $row['brand'] ?></span></p>
								<p class="text-black small driver_info"><?=lang('color')?>: <span class="ml-2 text-black"
																						style="width: 25px;height: 10px;background: <?= $row['color'] ?>;border: 1px solid #efefef;display: inline-block;"> </span>
								</p>
								<p class="small text-black driver_info"><?=lang('engine')?>: <span
										class="text-black ml-2"><?= $row['engine_power'] ?></span></p>
								<p class="small text-black driver_info"><?=lang('model')?>: <span
										class="text-black ml-2"><?= $row['model'] ?></span></p>
								<p class="small text-black driver_info"><?=lang('year')?>: <span
										class="text-black ml-2"><?= $row['production_date'] ?></span></p>
								<p class="small text-black driver_info"><?=lang('vin')?>: <span
										class="text-black ml-2"><?= $row['vin_code'] ?></span></p>
								<p class="small text-black driver_info"><?=lang('vehicle_type')?>: <span
										class="text-black ml-2"><?= $row['fleet_type'] ?></span></p>
								<p class="small text-black driver_info"><?=lang('department')?>: <span
										class="text-black ml-2"><?= $row['department'] ?></span></p>
								<p class="small text-black driver_info"><?=lang('registration_address')?>։<span
										class="text-black ml-2"><?= $row['regitered_address'] ?></span></p>
								<p class="small text-black driver_info"><?=lang('insurance')?>: <span
										class="text-black ml-2"><?= $row['insurance_type'] ?></span></p>
							</div>
							<div class=" p-2 mb-1 mt-1 w-auto" style="min-width: 45%;">
								<p class="small text-black driver_info"><?=lang('attached')?>: <span
										class="text-black ml-2"><?= $row['first_name'] . ' ' . $row['last_name'] ?></span>
								</p>
								<p class="small text-black driver_info"><?=lang('car_number')?>: <span
										class="text-black ml-2"><?= $row['fleet_plate_number'] ?></span></p>
								<p class="small text-black driver_info"><?=lang('fuel_type')?>։ <span
										class="text-black ml-2"><?= $row['fuel'] ?></span></p>
								<p class="small text-black driver_info"><?=lang('average_expense_100_km')?> ։<span
										class="text-black ml-2"><?= $row['fuel_avg_consumption'] ?></span></p>
								<p class="small text-black driver_info"><?=lang('in_day')?> ։<span
										class="text-black ml-2"><?= $row['value1_day'] ?> կմ․</span></p>
								<p class="small text-black driver_info"><?=lang('running')?>։<span
										class="text-black ml-2"><?= $row['mileage'] ?></span></p>
								<p class="small text-black driver_info"><?=lang('odometer')?>։<span
										class="text-black ml-2"><?= $row['odometer'] ?></span></p>
								<p class="small text-black driver_info"><?=lang('GPS_Exist')?>։<span
										class="text-black ml-2"><?= ($row['gps_tracker_exists'] == 1 ? lang('yes') : lang('no')) ?></span>
								</p>
								<p class="small text-black driver_info"><?=lang('GPS_Tracker_IMEI')?>։<span
										class="text-black ml-2"><?= $row['gps_tracker_imei'] ?></span>
								</p>
								<p class="small text-black driver_info"><?=lang('in_force')?>: <span
										class="text-black ml-2"><?= $row['insurance_expiration_1'] ?></span></p>
							</div>

							<div class="text-center" style="background: #c3c3c3; min-width: 10%;">
								<img style="width: 45px;" src="<?=base_url('assets/img/car.svg')?>" alt="" title="" />
								<img style="display: block;margin: 0 auto;margin-top: -10px;" src="<?=base_url('assets/images/dots.svg')?>">
							</div>
						</div>
						</div><?
					}
				}

				?>
			</div>

		</div>
	</div>

	<div class="tab-pane fade" id="nav-driver" role="tabpanel" aria-labelledby="nav-driver-tab">
		<div class="container-fluid">
			<div class="row">
				<div class="p-2  w-auto mr-3">
					<p class="text-black small driver_info">First name:
						<span class="text-black ml-2"><?= $row['first_name'] ?></span>
					</p>
					<p class="text-black small driver_info">Last Name:
						<span class="text-black ml-2"><?= $row['last_name'] ?></span>
					</p>

					<p class="text-black small driver_info">Contact Number 1:
						<span class="text-black ml-2"><?= $row['contact_1'] ?></span>
					</p>
					<p class="small text-black driver_info">Contact Number 2:
						<span class="text-black ml-2"><?= $row['contact_2'] ?></span>
					</p>
					<p class="small text-black driver_info">Email: <span
							class="text-black ml-2"><?= $row['email'] ?></span></p>
					<p class="small text-black driver_info">Leave Country: <span
							class="text-black ml-2"><?= $row['country'] ?></span></p>
					<p class="small text-black driver_info">Address: <span
							class="text-black ml-2"><?= $row['address'] ?></span></p>
					<p class="small text-black driver_info">Post Code:
						<span class="text-black ml-2"><?= $row['post_code'] ?></span>
					</p>
					<p class="small text-black driver_info">Department: <span
							class="text-black ml-2"><?= $row['department'] ?></span></p>
				</div>
				<div class="p-2  w-auto">
					<p class="small text-black driver_info">Position:
						<span class="text-black ml-2"><?= $row['position'] ?></span>
					</p>
					<p class="small text-black driver_info">Nest Card ID:
						<span class="text-black ml-2"><?= $row['nest_card_id'] ?></span>
					</p>
					<p class="small text-black driver_info m-2">
						<img width="100px"
							 src="<?= base_url('uploads/' . $folder . '/staff/original/' . $row['photo']) ?>" alt="">
					</p>
				</div>
			</div>
		</div>
	</div>
</div>




