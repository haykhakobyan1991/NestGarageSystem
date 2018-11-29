<script src="<?= base_url() ?>assets/js/excelexportjs.js"></script>

<?
$folder = $this->session->folder;
?>
<div class="tab-content mt-3" id="nav-tabContent-car" style="display: none">

	<div class="tab-pane fade show active" id="nav-car" role="tabpanel" aria-labelledby="nav-car-tab">
		<div class="container-fluid ">
			<div class="row"><?
				if (!empty($result)) {
					foreach ($result as $row) {
						?>
						<div class="col-sm-4 " style="border: 5px solid #dee2e6 !important;">
						<div class="row bg-secondary">
							<div class="col-sm-4 p-2  w-auto">
								<p class="text-white-50 small driver_info">Make: <span
										class="text-white ml-2"><?= $row['brand'] ?></span></p>
								<p class="text-white-50 small driver_info">Color: <span class="ml-2 text-white"
																						style="width: 25px;height: 10px;background: <?= $row['color'] ?>;border: 1px solid #efefef;display: inline-block;"> </span>
								</p>
								<p class="small text-white-50 driver_info">Engine: <span
										class="text-white ml-2"><?= $row['engine_power'] ?></span></p>
								<p class="small text-white-50 driver_info">Model: <span
										class="text-white ml-2"><?= $row['model'] ?></span></p>
								<p class="small text-white-50 driver_info">Year: <span
										class="text-white ml-2"><?= $row['production_date'] ?></span></p>
								<p class="small text-white-50 driver_info">VIN: <span
										class="text-white ml-2"><?= $row['vin_code'] ?></span></p>
								<p class="small text-white-50 driver_info">Type of Vehicle: <span
										class="text-white ml-2"><?= $row['fleet_type'] ?></span></p>
								<p class="small text-white-50 driver_info">Department: <span
										class="text-white ml-2"><?= $row['department'] ?></span></p>
							</div>
							<div class="col-sm-4 p-2  w-auto">
								<p class="small text-white-50 driver_info">Կցված: <span
										class="text-white ml-2"><?= $row['first_name'] . ' ' . $row['last_name'] ?></span>
								</p>
								<p class="small text-white-50 driver_info">Հաշվառման համարանիշ: <span
										class="text-white ml-2"><?= $row['fleet_plate_number'] ?></span></p>
								<p class="small text-white-50 driver_info">Վառելիք։ <span
										class="text-white ml-2"><?= $row['fuel'] ?></span></p>
								<p class="small text-white-50 driver_info">Միջին ծաղսը 100 կմ․ ։<span
										class="text-white ml-2"><?= $row['fuel_avg_consumption'] ?></span></p>
								<p class="small text-white-50 driver_info">Օրեկան․ ։<span
										class="text-white ml-2"><?= $row['value1_day'] ?> կմ․</span></p>
								<p class="small text-white-50 driver_info">Վազք։<span
										class="text-white ml-2"><?= $row['mileage'] ?></span></p>
								<p class="small text-white-50 driver_info">Հոռոգռաֆ։<span
										class="text-white ml-2"><?= $row['odometer'] ?></span></p>
								<p class="small text-white-50 driver_info">GPS Exsist?։<span
										class="text-white ml-2"><?= ($row['gps_tracker_exists'] == 1 ? 'Yes' : 'No') ?></span>
								</p>
								<p class="small text-white-50 driver_info">GPS Tracker IMEI։<span
										class="text-white ml-2"><?= $row['gps_tracker_imei'] ?></span>
								</p>
							</div>
							<div class="col-sm-4 p-2  w-auto">
								<p class="small text-white-50 driver_info">Հաշվառման Հասցե։<span
										class="text-white ml-2"><?= $row['regitered_address'] ?></span></p>
								<p class="small text-white-50 driver_info">Ապահովագրություն: <span
										class="text-white ml-2"><?= $row['insurance_type'] ?></span></p>
								<p class="small text-white-50 driver_info">Ուժի մեջ է: <span
										class="text-white ml-2"><?= $row['insurance_expiration_1'] ?></span></p>
							</div>
							<!--				<div class="p-2 w-auto ml-2">-->
							<!--					<div id="container" class="w-100"></div>-->
							<!--				</div>-->
							<!--				<div class="p-2 w-auto">-->
							<!--					<div id="container2" class="w-100"></div>-->
							<!--				</div>-->
						</div>
						</div><?
					}
				}
				if (!empty($result_driver)) {
					foreach ($result_driver as $row_d) {
						?>

						<div class="col-sm-4" style="border: 5px solid #dee2e6 !important;">
						<div class="row bg-secondary">
							<div class="col-sm-6 p-2  w-auto">
								<p class="text-white-50 small driver_info">First name:
									<span class="text-white ml-2"><?= $row_d['first_name'] ?></span>
								</p>
								<p class="text-white-50 small driver_info">Last Name:
									<span class="text-white ml-2"><?= $row_d['last_name'] ?></span>
								</p>

								<p class="text-white-50 small driver_info">Contact Number 1:
									<span class="text-white ml-2"><?= $row_d['contact_1'] ?></span>
								</p>
								<p class="small text-white-50 driver_info">Contact Number 2:
									<span class="text-white ml-2"><?= $row_d['contact_2'] ?></span>
								</p>
								<p class="small text-white-50 driver_info">Email: <span
										class="text-white ml-2"><?= $row_d['email'] ?></span></p>
								<p class="small text-white-50 driver_info">Leave Country: <span
										class="text-white ml-2"><?= $row_d['country'] ?></span></p>
								<p class="small text-white-50 driver_info">Address: <span
										class="text-white ml-2"><?= $row_d['address'] ?></span></p>
								<p class="small text-white-50 driver_info">Post Code:
									<span class="text-white ml-2"><?= $row_d['post_code'] ?></span>
								</p>
								<p class="small text-white-50 driver_info">Department: <span
										class="text-white ml-2"><?= $row_d['department'] ?></span></p>
							</div>
							<div class="col-sm-6 p-2  w-auto">
								<p class="small text-white-50 driver_info">Position:
									<span class="text-white ml-2"><?= $row_d['position'] ?></span>
								</p>
								<p class="small text-white-50 driver_info">Nest Card ID:
									<span class="text-white ml-2"><?= $row_d['nest_card_id'] ?></span>
								</p>
								<p class="small text-white-50 driver_info m-2">
									<img width="100px"
										 src="<?= base_url('uploads/' . $folder . '/staff/original/' . $row_d['photo']) ?>"
										 alt="">
								</p>
							</div>
						</div>
						</div><?
					}
				}
				?>
			</div>
			<div class="container-fluid">
				<button id="export" class="btn btn-sm btn-outline-danger cancel_btn float-right mb-2 mt-2">Export</button>
			</div>
		</div>
	</div>

	<div class="tab-pane fade" id="nav-driver" role="tabpanel" aria-labelledby="nav-driver-tab">
		<div class="container-fluid bg-secondary">
			<div class="row">
				<div class="p-2  w-auto mr-3">
					<p class="text-white-50 small driver_info">First name:
						<span class="text-white ml-2"><?= $row['first_name'] ?></span>
					</p>
					<p class="text-white-50 small driver_info">Last Name:
						<span class="text-white ml-2"><?= $row['last_name'] ?></span>
					</p>

					<p class="text-white-50 small driver_info">Contact Number 1:
						<span class="text-white ml-2"><?= $row['contact_1'] ?></span>
					</p>
					<p class="small text-white-50 driver_info">Contact Number 2:
						<span class="text-white ml-2"><?= $row['contact_2'] ?></span>
					</p>
					<p class="small text-white-50 driver_info">Email: <span
							class="text-white ml-2"><?= $row['email'] ?></span></p>
					<p class="small text-white-50 driver_info">Leave Country: <span
							class="text-white ml-2"><?= $row['country'] ?></span></p>
					<p class="small text-white-50 driver_info">Address: <span
							class="text-white ml-2"><?= $row['address'] ?></span></p>
					<p class="small text-white-50 driver_info">Post Code:
						<span class="text-white ml-2"><?= $row['post_code'] ?></span>
					</p>
					<p class="small text-white-50 driver_info">Department: <span
							class="text-white ml-2"><?= $row['department'] ?></span></p>
				</div>
				<div class="p-2  w-auto">
					<p class="small text-white-50 driver_info">Position:
						<span class="text-white ml-2"><?= $row['position'] ?></span>
					</p>
					<p class="small text-white-50 driver_info">Nest Card ID:
						<span class="text-white ml-2"><?= $row['nest_card_id'] ?></span>
					</p>
					<p class="small text-white-50 driver_info m-2">
						<img width="100px"
							 src="<?= base_url('uploads/' . $folder . '/staff/original/' . $row['photo']) ?>" alt="">
					</p>
				</div>
			</div>
		</div>
	</div>
</div>




