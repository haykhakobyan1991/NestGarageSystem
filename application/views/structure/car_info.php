<div class="tab-content mt-3" id="nav-tabContent">

	<div class="tab-pane fade show active" id="nav-car" role="tabpanel" aria-labelledby="nav-car-tab">
		<div class="container-fluid bg-secondary">
			<div class="row">
				<div class="p-2  w-auto mr-3">
					<p class="text-white-50 small driver_info">Make: <span
							class="text-white ml-2"><?= $result['brand'] ?></span></p>
					<p class="text-white-50 small driver_info">Color: <span class="ml-2 text-white"
																			style="width: 25px;height: 10px;background: <?= $result['color'] ?>;border: 1px solid #efefef;display: inline-block;"> </span>
					</p>
					<p class="small text-white-50 driver_info">Engine: <span
							class="text-white ml-2"><?= $result['engine_power'] ?></span></p>
					<p class="small text-white-50 driver_info">Model: <span
							class="text-white ml-2"><?= $result['model'] ?></span></p>
					<p class="small text-white-50 driver_info">Year: <span
							class="text-white ml-2"><?= $result['production_date'] ?></span></p>
					<p class="small text-white-50 driver_info">VIN: <span
							class="text-white ml-2"><?= $result['vin_code'] ?></span></p>
					<p class="small text-white-50 driver_info">Type of Vehicle: <span
							class="text-white ml-2"><?= $result['fleet_type'] ?></span></p>
					<p class="small text-white-50 driver_info">Department: <span
							class="text-white ml-2"><?= $result['department'] ?></span></p>
				</div>
				<div class="p-2  w-auto">
					<p class="small text-white-50 driver_info">Կցված: <span
							class="text-white ml-2"><?= $result['first_name']. ' '. $result['last_name'] ?></span></p>
					<p class="small text-white-50 driver_info">Հաշվառման համարանիշ: <span
							class="text-white ml-2"><?= $result['fleet_plate_number'] ?></span></p>
					<p class="small text-white-50 driver_info">Վառելիք։ <span
							class="text-white ml-2"><?= $result['fuel'] ?></span></p>
					<p class="small text-white-50 driver_info">Միջին ծաղսը 100 կմ․ ։<span
							class="text-white ml-2"><?= $result['fuel_avg_consumption'] ?></span></p>
					<p class="small text-white-50 driver_info">Օրեկան․ ։<span
							class="text-white ml-2"><?= $result['value1_day'] ?> կմ․</span></p>
					<p class="small text-white-50 driver_info">Վազք։<span
							class="text-white ml-2"><?= $result['mileage'] ?></span></p>
					<p class="small text-white-50 driver_info">Հոռոգռաֆ։<span
							class="text-white ml-2"><?= $result['odometer'] ?></span></p>
					<p class="small text-white-50 driver_info">GPS Exsist?։<span class="text-white ml-2"><?=($result['gps_tracker_exists'] == 1 ? 'Yes' : 'No')?></span></p>
					<p class="small text-white-50 driver_info">GPS Tracker IMEI։<span class="text-white ml-2"><?=$result['gps_tracker_imei']?></span>
					</p>
				</div>
				<div class="p-2  w-auto">
					<p class="small text-white-50 driver_info">Հաշվառման Հասցե։<span
							class="text-white ml-2"><?= $result['regitered_address'] ?></span></p>
					<p class="small text-white-50 driver_info">Ապահովագրություն: <span
							class="text-white ml-2"><?= $result['insurance_type'] ?></span></p>
					<p class="small text-white-50 driver_info">Ուժի մեջ է: <span
							class="text-white ml-2"><?= $result['insurance_expiration_1'] ?></span></p>
				</div>
				<div class="p-2 w-auto ml-2">
					<div id="container" class="w-100"></div>
				</div>
				<div class="p-2 w-auto">
					<div id="container2" class="w-100"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="tab-pane fade" id="nav-driver" role="tabpanel" aria-labelledby="nav-driver-tab">
		<div class="container-fluid bg-secondary">
			<div class="row">
				<div class="p-2  w-auto mr-3">
					<p class="text-white-50 small driver_info">First name:
						<span class="text-white ml-2"><?= $result['first_name'] ?></span>
					</p>
					<p class="text-white-50 small driver_info">Last Name:
						<span class="text-white ml-2"><?= $result['last_name'] ?></span>
					</p>

					<p class="text-white-50 small driver_info">Contact Number 1:
						<span class="text-white ml-2"><?= $result['contact_1'] ?></span>
					</p>
					<p class="small text-white-50 driver_info">Contact Number 2:
						<span class="text-white ml-2"><?= $result['contact_2'] ?></span>
					</p>
					<p class="small text-white-50 driver_info">Email: <span
							class="text-white ml-2"><?= $result['email'] ?></span></p>
					<p class="small text-white-50 driver_info">Leave Country: <span
							class="text-white ml-2"><?= $result['country'] ?></span></p>
					<p class="small text-white-50 driver_info">Address: <span
							class="text-white ml-2"><?= $result['address'] ?></span></p>
					<p class="small text-white-50 driver_info">Post Code:
						<span class="text-white ml-2"><?= $result['post_code'] ?></span>
					</p>
					<p class="small text-white-50 driver_info">Department: <span
							class="text-white ml-2"><?= $result['department'] ?></span></p>
				</div>
				<div class="p-2  w-auto">
					<p class="small text-white-50 driver_info">Position:
						<span class="text-white ml-2"><?= $result['position'] ?></span>
					</p>
					<p class="small text-white-50 driver_info">Nest Card ID:
						<span class="text-white ml-2">-?-</span></p>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {

		Highcharts.chart('container', {
			chart: {
				style: {color: '#FFFFFF'},
				type: 'area',
				width: 400,
				height: 250,
				backgroundColor: 'rgba(255, 255, 255, 0.0)'
			},
			title: {
				style: {color: '#FFFFFF', fontSize: '14px'},
				text: 'US and USSR nuclear stockpiles'
			},
			xAxis: {

				allowDecimals: false,
				labels: {
					style: {color: '#FFFFFF'},
					formatter: function () {
						return this.value;
					}
				}
			},
			yAxis: {
				title: {
					style: {color: '#FFFFFF'},
					text: 'Nuclear weapon states'
				},
				labels: {
					style: {color: '#FFFFFF'},
					formatter: function () {
						return this.value / 1000 + 'k';
					}
				}
			},
			tooltip: {
				pointFormat: '{series.name} had stockpiled <b>{point.y:,.0f}</b><br/>warheads in {point.x}'
			},
			plotOptions: {
				style: {color: '#FFFFFF'},
				area: {
					pointStart: 1940,
					marker: {
						enabled: false,
						symbol: 'circle',
						radius: 2,
						states: {
							hover: {
								enabled: true
							}
						}
					}
				}
			},
			series: [{
				data: [
					8795, 8144, 6632, 8077, 523, 12725, 4752, 7558, 8126, 10280, 3512, 8791,
					250, 11963, 8156, 12983, 5740, 5963, 7815, 2310, 13466, 6526, 7994, 10768,
					12045, 12320, 9363, 13528, 7866, 9137, 3767, 10254, 4771, 12599, 10510, 8527,
					13692, 2995, 11461, 2459, 6232, 3123, 5165, 14504, 1722, 10490, 6102, 5571,
					3006, 1085, 9520, 29, 7933, 384, 8639, 2215, 2715, 2236, 6269, 5117, 9037,
					13819, 13910, 2070, 973, 4051, 3958, 4955, 9845, 7323, 565, 7653, 12746, 9398,
					4141, 5796, 610, 6198, 6481, 510, 2650, 6186, 13478, 8547, 6236, 2461, 2239,
					1469, 3190, 9629, 530, 1510, 13038, 10266, 2389, 6505, 14913, 14953, 4639,
					6403, 4715, 6623, 595, 12661, 10400, 7678, 6291, 12732, 6029, 7419, 1777,
					6106, 8617, 8671, 2717, 11073, 10631, 14098, 5766, 14528, 7314, 5004, 2014
				]
			}]
		});
		//Chart 2
		Highcharts.chart('container2', {
			chart: {
				style: {color: '#FFFFFF'},
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie',
				width: 350,
				height: 250,
				backgroundColor: 'rgba(255, 255, 255, 0.0)'
			},
			title: {
				style: {
					color: '#FFFFFF',
					fontSize: '14px'
				},
				text: 'Browser market shares in January'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				style: {color: '#FFFFFF'},
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						style: {
							color: '#FFFFFF',
							fontSize: '10px,',
							fontWeight: '300'
						},
					}
				}
			},
			series: [{
				name: 'Brands',
				colorByPoint: true,
				data: [
					{name: 'Chrome', y: 61.41},
					{name: 'Internet Explorer', y: 11.84},
					{name: 'Firefox', y: 10.85},
					{name: 'Edge', y: 15.67},
					{name: 'Safari', y: 20.18}
				]
			}]
		});






	});


</script>
