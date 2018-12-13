<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/gps_tracking/gps_tracking.css"/>
<script src="https://www.gstatic.com/firebasejs/5.6.0/firebase.js"></script>
<script src="https://api-maps.yandex.ru/2.1/?apikey=624e82b8-f673-476e-ada3-3c68555422b9&lang=ru_RU"
		type="text/javascript"></script>
<script>
	// Initialize Firebase
	var config = {
		apiKey: "AIzaSyCXe53OPy3WBeXRud_Muy3jfHqMlcgFsh0",
		authDomain: "mapdraw-303a9.firebaseapp.com",
		databaseURL: "https://mapdraw-303a9.firebaseio.com",
		projectId: "mapdraw-303a9",
		storageBucket: "mapdraw-303a9.appspot.com",
		messagingSenderId: "169827754958"
	};
	firebase.initializeApp(config);
</script>

<div class="container-fluid pl-0 pr-0" style="margin-top: -11px;margin-bottom: 5px;">
	<nav class="navbar navbar-expand-lg navbar-light bg-light pl-0 pr-0">
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav mr-auto">
				<button style="color:#00000080 !important;min-width: 120px;max-height: 40px;"
						class="btn btn-outline-secondary  nav-item nav-link mr-1" href="#"><img
						style="margin-right: 5px;margin-left: -15px;"
						src="<?= base_url() ?>assets/images/gps_tracking/satellite.svg"/><?= lang('trajectory') ?>
				</button>
				<button style="color:#00000080 !important;max-height: 40px;"
						class="btn btn-outline-secondary  nav-item nav-link mr-1" href="#"><img
						style="margin-right: 5px;margin-left: -15px;"
						src="<?= base_url() ?>assets/images/gps_tracking/speedometer.svg"/><?= lang('speed') ?></button>
				<button style="color:#00000080 !important;min-width: 120px;max-height: 40px;"
						class="btn btn-outline-secondary  nav-item nav-link mr-1" href="#"><img
						style="margin-right: 5px;margin-left: -15px;"
						src="<?= base_url() ?>assets/images/gps_tracking/gas-station.svg"/><?= lang('fuel') ?></button>
				<button style="color:#00000080 !important;min-width: 120px;max-height: 40px;"
						class="btn btn-outline-secondary  nav-item nav-link mr-1 " href="#"><img
						style="margin-right: 5px;margin-left: -15px;"
						src="<?= base_url() ?>assets/images/gps_tracking/engine.svg"/><?= lang('engine') ?></button>
				<button style="color:#00000080 !important;min-width: 120px;max-height: 40px;"
						class="btn btn-outline-secondary  nav-item nav-link mr-1 " href="#"><img
						style="margin-right: 5px;margin-left: -15px;"
						src="<?= base_url() ?>assets/images/gps_tracking/box.svg"/><?= lang('cargo') ?></button>
				<button style="color:#00000080 !important;min-width: 120px;max-height: 40px;"
						class="btn btn-outline-secondary  nav-item nav-link mr-1 " href="#"><img
						style="margin-right: 5px;margin-left: -15px;"
						src="<?= base_url() ?>assets/images/gps_tracking/support.svg"/><?= lang('sos') ?></button>

				<button style="color:#00000080 !important;min-width: 120px;display: inline-block;max-height: 40px;"
						class="btn btn-outline-secondary  nav-item nav-link mr-1 ml-1"
						href="#"><img
						style="margin-right: 5px;margin-left: -15px;"
						src="<?= base_url() ?>assets/images/gps_tracking/notification.svg"/><?= lang('notification') ?>
				</button>
				<button style="color:#00000080 !important;display: inline-block;max-height: 40px;"
						class="btn btn-outline-secondary  nav-item nav-link mr-1 "
						href="#"><img
						style="margin-right: 5px;margin-left: -15px;"
						src="<?= base_url() ?>assets/images/gps_tracking/event.svg"/><?= lang('event') ?></button>
				<button style="color:#00000080 !important;display: inline-block;max-height: 40px;"
						class="btn btn-outline-secondary  nav-item nav-link mr-1 "
						href="#"><img
						style="margin-right: 5px;margin-left: -15px;"
						src="<?= base_url() ?>assets/images/gps_tracking/statistics.svg"/><?= lang('statistics') ?>
				</button>


				<label style="padding: 10px 6px 0px 10px;"><?= lang('update') ?></label>
				<select style="margin-top: 1px" class="form-control form-control-sml">
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
				<button
					style="color:#00000080 !important;display: inline-block;max-height: 40px;padding: 7px 24px !important;"
					class="btn btn-outline-secondary  nav-item nav-link mr-1 settings_btn" href="#"><img
						style="margin-right: 5px;margin-left: -15px;"
						src="<?= base_url() ?>assets/images/gps_tracking/settings-work-tool.svg" class="ml-0 mr-0 "/>
				</button>
				<button
					style="color:#00000080 !important;display: inline-block;max-height: 40px;padding: 7px 24px !important;"
					class="btn btn-outline-secondary  nav-item nav-link mr-1 print-btn" href="#"><img
						style="margin-right: 5px;margin-left: -15px;"
						src="<?= base_url() ?>assets/images/gps_tracking/print.svg" class="ml-0 mr-0 "/></button>
			</div>
		</div>
	</nav>
</div>


<div class="container-fluid pl-0 pr-0" style="outline: 1px solid #ccc;">
	<div class="row">
		<div class="col-sm-5">
			<div class="row">
				<div class="col-sm-12 m-2">

					<fieldset class="scheduler-border" style="width: 50%;">
						<legend class="scheduler-border" style="font-size: 16px;"><?= lang('group') ?></legend>
						<div class="control-group">
							<div class="controls bootstrap-timepicker">
								<div class="row">
									<div class="col-sm-6">
										<select style="margin-top: 1px;max-width: 220px;"
												class="form-control form-control-sml">
											<option>group 1</option>
											<option>group 2</option>
											<option>group 3</option>
											<option>group 4</option>
										</select>
									</div>
									<div class="col-sm-6" style="padding-top: 4px;">
										<button class="btn btn-sm btn-outline-secondary plus_btn mr-3"
												data-toggle="modal" data-target=".bd-example-modal-lg"
												style="width: 20px;padding: 2px !important;"><img
												style="margin-right: 5px;margin-left: -15px;"
												src="<?= base_url() ?>assets/images/gps_tracking/plus-black-symbol.svg"
												class="ml-0 mr-0 "/></button>
										<button class="btn btn-sm btn-outline-secondary set_btn mr-3"
												style="width: 20px;padding: 2px !important;"><img
												style="margin-right: 5px;margin-left: -15px;"
												src="<?= base_url() ?>assets/images/gps_tracking/settings-work-tool.svg"
												class="ml-0 mr-0 "/></button>
										<button class="btn btn-sm btn-outline-secondary delete_btn"
												style="width: 20px;padding: 2px !important;"><img
												style="margin-right: 5px;margin-left: -15px;"
												src="<?= base_url() ?>assets/images/gps_tracking/delete.svg"
												class="ml-0 mr-0 "/></button>
									</div>
								</div>
							</div>
						</div>
					</fieldset>

					<table id="example11" class="table table-bordered" style="width:100%">
						<thead>
						<tr>
							<th style="font-size: 12px !important;font-weight: 500;">
								<input class="sel_all_checkbox" style="margin-left: 5px;" type="checkbox"/>
							</th>
							<th style="font-size: 12px !important;font-weight: 500;"><i
									class="fas fa-sort-alpha-down"></i></th>
							<th style="font-size: 12px !important;font-weight: 500;"><i
									class="fas fa-map-marker-alt"></i></th>
							<th class="text-center"
								style="font-size: 12px !important;font-weight: 500;"><?= lang('status') ?></th>
							<th style="font-size: 12px !important;font-weight: 500;"><i class="fas fa-user"></i></th>
							<th style="font-size: 12px !important;font-weight: 500;"><?= lang('department') ?></th>
							<th style="font-size: 12px !important;font-weight: 500;"><i class="fas fa-gas-pump"></i>
							</th>
							<th style="font-size: 12px !important;font-weight: 500;"><i class="fas fa-wifi"></i></th>
							<th style="font-size: 12px !important;font-weight: 500;"><?= lang('last_activity') ?></th>
							<th style="font-size: 12px !important;font-weight: 500;"><i class="fas fa-ellipsis-v"></i>
							</th>

						</tr>
						</thead>
						<tbody>

						<tr>
							<td><input type="checkbox"/></td>
							<td>
								mercedes benz
								<small class="form-text text-muted">433xx33</small>
							</td>
							<td>street 34/56</td>
							<td class="text-center"><i class="text-warning fas fa-parking"></i></td>
							<td>
								anun azganun
								<small class="form-text text-muted">+37444443344</small>
							</td>
							<td>
								department
							</td>
							<td>

								<div class="border-danger fuel_wrapper">
									<div class="fuel_first"></div>
								</div>
								<div class="border-danger fuel_wrapper ">
									<div class="fuel_seccond bg-danger"></div>
								</div>


							</td>
							<td>
								<div class="bg-warning"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td>
								12.12.2018
								<small class="form-text text-muted">19:32</small>
							</td>
							<td>
								<i class="fas fa-play-circle" style="cursor: pointer;"></i>
							</td>

						</tr>
						<tr>
							<td><input type="checkbox"/></td>
							<td>
								mercedes benz
								<small class="form-text text-muted">433xx33</small>
							</td>
							<td>street 34/56</td>
							<td class="text-center"><i class="text-warning fas fa-parking"></i></td>
							<td>
								anun azganun
								<small class="form-text text-muted">+37444443344</small>
							</td>
							<td>
								department
							</td>
							<td>
								<div class="border-success fuel_wrapper">
									<div class="h-100 bg_full fuel_first"></div>
								</div>
								<div class="border-success fuel_wrapper ">
									<div class="h-100 fuel_seccond bg_full"></div>
								</div>
							</td>
							<td>
								<div class="bg-danger"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td>
								12.12.2018
								<small class="form-text text-muted">19:32</small>
							</td>
							<td>
								<i class="fas fa-play-circle" style="cursor: pointer;"></i>
							</td>

						</tr>
						<tr>
							<td><input type="checkbox"/></td>
							<td>
								mercedes benz
								<small class="form-text text-muted">433xx33</small>
							</td>
							<td>street 34/56</td>
							<td class="text-center"><i class="text-danger fas fa-stop-circle"></i></td>
							<td>
								anun azganun
								<small class="form-text text-muted">+37444443344</small>
							</td>
							<td>
								department
							</td>
							<td>
								<div class="border-success fuel_wrapper">
									<div class="h-75 bg_full fuel_first"></div>
								</div>
								<div class="border-success fuel_wrapper ">
									<div class="h-100 fuel_seccond bg_full"></div>
								</div>
							</td>
							<td>
								<div class="bg-success"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td>
								12.12.2018
								<small class="form-text text-muted">19:32</small>
							</td>
							<td>
								<i class="fas fa-play-circle" style="cursor: pointer;"></i>
							</td>

						</tr>
						<tr>
							<td><input type="checkbox"/></td>
							<td>
								bmw
								<small class="form-text text-muted">433xx33</small>
							</td>
							<td>street 34/56</td>
							<td class="text-center"><i class="text-success fas fa-arrow-alt-circle-right"></i></td>
							<td>
								anun azganun
								<small class="form-text text-muted">+37444443344</small>
							</td>
							<td>
								department
							</td>
							<td>
								<div class="border-success fuel_wrapper">
									<div class="h-50 bg_full fuel_first"></div>
								</div>
								<div class="border-success fuel_wrapper ">
									<div class="h-100 fuel_seccond bg_full"></div>
								</div>
							</td>
							<td>
								<div class="bg-success"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td>
								12.12.2018
								<small class="form-text text-muted">19:32</small>
							</td>
							<td>
								<i class="fas fa-play-circle" style="cursor: pointer;"></i>
							</td>

						</tr>
						<tr>
							<td><input type="checkbox"/></td>
							<td>
								mercedes benz
								<small class="form-text text-muted">433xx33</small>
							</td>
							<td>street 34/56</td>
							<td class="text-center"><i class="text-success fas fa-arrow-alt-circle-right"></i></td>
							<td>
								anun azganun
								<small class="form-text text-muted">+37444443344</small>
							</td>
							<td>
								department
							</td>
							<td>
								<div class="border-success fuel_wrapper">
									<div class="h-50 bg_full fuel_first"></div>
								</div>
								<div class="border-success fuel_wrapper ">
									<div class="h-100 fuel_seccond bg_full"></div>
								</div>
							</td>
							<td>
								<div class="bg-success"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td>
								12.12.2018
								<small class="form-text text-muted">19:32</small>
							</td>
							<td>
								<i class="fas fa-play-circle" style="cursor: pointer;"></i>
							</td>

						</tr>
						<tr>
							<td><input type="checkbox"/></td>
							<td>
								mercedes benz
								<small class="form-text text-muted">433xx33</small>
							</td>
							<td>street 34/56</td>
							<td class="text-center"><i class="text-success fas fa-arrow-alt-circle-right"></i></td>
							<td>
								anun azganun
								<small class="form-text text-muted">+37444443344</small>
							</td>
							<td>
								department
							</td>
							<td>
								<div class="border-success fuel_wrapper">
									<div class="h-50 bg_full fuel_first"></div>
								</div>
								<div class="border-success fuel_wrapper ">
									<div class="h-100 fuel_seccond bg_full"></div>
								</div>
							</td>
							<td>
								<div class="bg-success"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td>
								12.12.2018
								<small class="form-text text-muted">19:32</small>
							</td>
							<td>
								<i class="fas fa-play-circle" style="cursor: pointer;"></i>
							</td>

						</tr>
						<tr>
							<td><input type="checkbox"/></td>
							<td>
								mercedes benz
								<small class="form-text text-muted">433xx33</small>
							</td>
							<td>street 34/56</td>
							<td class="text-center"><i class="text-success fas fa-arrow-alt-circle-right"></i></td>
							<td>
								anun azganun
								<small class="form-text text-muted">+37444443344</small>
							</td>
							<td>
								department
							</td>
							<td>
								<div class="border-success fuel_wrapper">
									<div class="h-50 bg_full fuel_first"></div>
								</div>
								<div class="border-success fuel_wrapper ">
									<div class="h-100 fuel_seccond bg_full"></div>
								</div>
							</td>
							<td>
								<div class="bg-success"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td>
								12.12.2018
								<small class="form-text text-muted">19:32</small>
							</td>
							<td>
								<i class="fas fa-play-circle" style="cursor: pointer;"></i>
							</td>

						</tr>
						<tr>
							<td><input type="checkbox"/></td>
							<td>
								mercedes benz
								<small class="form-text text-muted">433xx33</small>
							</td>
							<td>street 34/56</td>
							<td class="text-center"><i class="text-success fas fa-arrow-alt-circle-right"></i></td>
							<td>
								anun azganun
								<small class="form-text text-muted">+37444443344</small>
							</td>
							<td>
								department
							</td>
							<td>
								<div class="border-success fuel_wrapper">
									<div class="h-50 bg_full fuel_first"></div>
								</div>
								<div class="border-success fuel_wrapper ">
									<div class="h-100 fuel_seccond bg_full"></div>
								</div>
							</td>
							<td>
								<div class="bg-success"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td>
								12.12.2018
								<small class="form-text text-muted">19:32</small>
							</td>
							<td>
								<i class="fas fa-play-circle" style="cursor: pointer;"></i>
							</td>

						</tr>
						<tr>
							<td><input type="checkbox"/></td>
							<td>
								mercedes benz
								<small class="form-text text-muted">433xx33</small>
							</td>
							<td>street 34/56</td>
							<td class="text-center"><i class="text-success fas fa-arrow-alt-circle-right"></i></td>
							<td>
								anun azganun
								<small class="form-text text-muted">+37444443344</small>
							</td>
							<td>
								department
							</td>
							<td>
								<div class="border-success fuel_wrapper">
									<div class="h-50 bg_full fuel_first"></div>
								</div>
								<div class="border-success fuel_wrapper ">
									<div class="h-100 fuel_seccond bg_full"></div>
								</div>
							</td>
							<td>
								<div class="bg-success"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td>
								12.12.2018
								<small class="form-text text-muted">19:32</small>
							</td>
							<td>
								<i class="fas fa-play-circle" style="cursor: pointer;"></i>
							</td>

						</tr>
						<tr>
							<td><input type="checkbox"/></td>
							<td>
								mercedes benz
								<small class="form-text text-muted">433xx33</small>
							</td>
							<td>street 34/56</td>
							<td class="text-center"><i class="text-success fas fa-arrow-alt-circle-right"></i></td>
							<td>
								anun azganun
								<small class="form-text text-muted">+37444443344</small>
							</td>
							<td>
								department
							</td>
							<td>
								<div class="border-success fuel_wrapper">
									<div class="h-50 bg_full fuel_first"></div>
								</div>
								<div class="border-success fuel_wrapper ">
									<div class="h-100 fuel_seccond bg_full"></div>
								</div>
							</td>
							<td>
								<div class="bg-success"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td>
								12.12.2018
								<small class="form-text text-muted">19:32</small>
							</td>
							<td>
								<i class="fas fa-play-circle" style="cursor: pointer;"></i>
							</td>

						</tr>
						<tr>
							<td><input type="checkbox"/></td>
							<td>
								mercedes benz
								<small class="form-text text-muted">433xx33</small>
							</td>
							<td>street 34/56</td>
							<td class="text-center"><i class="text-success fas fa-arrow-alt-circle-right"></i></td>
							<td>
								anun azganun
								<small class="form-text text-muted">+37444443344</small>
							</td>
							<td>
								department
							</td>
							<td>
								<div class="border-success fuel_wrapper">
									<div class="h-50 bg_full fuel_first"></div>
								</div>
								<div class="border-success fuel_wrapper ">
									<div class="h-100 fuel_seccond bg_full"></div>
								</div>
							</td>
							<td>
								<div class="bg-success"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td>
								12.12.2018
								<small class="form-text text-muted">19:32</small>
							</td>
							<td>
								<i class="fas fa-play-circle" style="cursor: pointer;"></i>
							</td>

						</tr>
						<tr>
							<td><input type="checkbox"/></td>
							<td>
								mercedes benz
								<small class="form-text text-muted">433xx33</small>
							</td>
							<td>street 34/56</td>
							<td class="text-center"><i class="text-success fas fa-arrow-alt-circle-right"></i></td>
							<td>
								anun azganun
								<small class="form-text text-muted">+37444443344</small>
							</td>
							<td>
								department
							</td>
							<td>
								<div class="border-success fuel_wrapper">
									<div class="h-50 bg_full fuel_first"></div>
								</div>
								<div class="border-success fuel_wrapper ">
									<div class="h-100 fuel_seccond bg_full"></div>
								</div>
							</td>
							<td>
								<div class="bg-success"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td>
								12.12.2018
								<small class="form-text text-muted">19:32</small>
							</td>
							<td>
								<i class="fas fa-play-circle" style="cursor: pointer;"></i>
							</td>

						</tr>
						<tr>
							<td><input type="checkbox"/></td>
							<td>
								mercedes benz
								<small class="form-text text-muted">433xx33</small>
							</td>
							<td>street 34/56</td>
							<td class="text-center"><i class="text-success fas fa-arrow-alt-circle-right"></i></td>
							<td>
								anun azganun
								<small class="form-text text-muted">+37444443344</small>
							</td>
							<td>
								department
							</td>
							<td>
								<div class="border-success fuel_wrapper">
									<div class="h-50 bg_full fuel_first"></div>
								</div>
								<div class="border-success fuel_wrapper ">
									<div class="h-100 fuel_seccond bg_full"></div>
								</div>
							</td>
							<td>
								<div class="bg-success"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td>
								12.12.2018
								<small class="form-text text-muted">19:32</small>
							</td>
							<td>
								<i class="fas fa-play-circle" style="cursor: pointer;"></i>
							</td>

						</tr>
						<tr>
							<td><input type="checkbox"/></td>
							<td>
								mercedes benz
								<small class="form-text text-muted">433xx33</small>
							</td>
							<td>street 34/56</td>
							<td class="text-center"><i class="text-success fas fa-arrow-alt-circle-right"></i></td>
							<td>
								anun azganun
								<small class="form-text text-muted">+37444443344</small>
							</td>
							<td>
								department
							</td>
							<td>
								<div class="border-success fuel_wrapper">
									<div class="h-50 bg_full fuel_first"></div>
								</div>
								<div class="border-success fuel_wrapper ">
									<div class="h-100 fuel_seccond bg_full"></div>
								</div>
							</td>
							<td>
								<div class="bg-success"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td>
								12.12.2018
								<small class="form-text text-muted">19:32</small>
							</td>
							<td>
								<i class="fas fa-play-circle" style="cursor: pointer;"></i>
							</td>

						</tr>
						<tr>
							<td><input type="checkbox"/></td>
							<td>
								mercedes benz
								<small class="form-text text-muted">433xx33</small>
							</td>
							<td>street 34/56</td>
							<td class="text-center"><i class="text-success fas fa-arrow-alt-circle-right"></i></td>
							<td>
								anun azganun
								<small class="form-text text-muted">+37444443344</small>
							</td>
							<td>
								department
							</td>
							<td>
								<div class="border-success fuel_wrapper">
									<div class="h-50 bg_full fuel_first"></div>
								</div>
								<div class="border-success fuel_wrapper ">
									<div class="h-100 fuel_seccond bg_full"></div>
								</div>
							</td>
							<td>
								<div class="bg-success"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td>
								12.12.2018
								<small class="form-text text-muted">19:32</small>
							</td>
							<td>
								<i class="fas fa-play-circle" style="cursor: pointer;"></i>
							</td>

						</tr>
						<tr>
							<td><input type="checkbox"/></td>
							<td>
								mercedes benz
								<small class="form-text text-muted">433xx33</small>
							</td>
							<td>street 34/56</td>
							<td class="text-center"><i class="text-success fas fa-arrow-alt-circle-right"></i></td>
							<td>
								anun azganun
								<small class="form-text text-muted">+37444443344</small>
							</td>
							<td>
								department
							</td>
							<td>
								<div class="border-success fuel_wrapper">
									<div class="h-50 bg_full fuel_first"></div>
								</div>
								<div class="border-success fuel_wrapper ">
									<div class="h-100 fuel_seccond bg_full"></div>
								</div>
							</td>
							<td>
								<div class="bg-success"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td>
								12.12.2018
								<small class="form-text text-muted">19:32</small>
							</td>
							<td>
								<i class="fas fa-play-circle" style="cursor: pointer;"></i>
							</td>

						</tr>


						</tbody>
					</table>

				</div>
			</div>
		</div>


		<div class="col-sm-7">
			<div id="map" style="width: 100%; height: 650px;"></div>
		</div>


	</div>
</div>


<!-- Create Group Modal  Start -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
	 aria-hidden="true">

	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-secondary " style="border-radius: unset;">
				<h5 class="modal-title text-white"><?= lang('create_group') ?></h5>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group row">
						<div class="col-sm-1"></div>
						<label class="col-sm-2 col-form-label"><?= lang('company_name') ?></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" placeholder="<?= lang('company_name') ?>">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-1"></div>
						<label class="col-sm-2 col-form-label"><?= lang('more_info') ?></label>
						<div class="col-sm-8">
							<textarea type="text" class="form-control"
									  placeholder="<?= lang('more_info') ?>"></textarea>
						</div>
					</div>


				</form>
				<hr class="my-2">
				<div class="row mt-1 pl-1 pr-1">
					<input id="sb_s" type="text" class="form-control" placeholder="<?= lang('search') ?>"
						   aria-label="Search" aria-describedby="basic-addon2" style="width: 50%;margin: 3px;">
					<div class="col-sm-6 scroll_style" style="border: 5px solid #00000040;max-height: 300px; min-height: 300px; overflow-y: scroll;">

						<ul style="list-style: decimal;" class="list-group lg_1 mt-1">
							<li style="cursor: pointer" class="p-1 sel_items mt-1 list-group-item">fffff</li>
							<li style="cursor: pointer" class="p-1 sel_items mt-1 list-group-item">gggg</li>
							<li style="cursor: pointer" class="p-1 sel_items mt-1 list-group-item">rrrr</li>
							<li style="cursor: pointer" class="p-1 sel_items mt-1 list-group-item">wwwww</li>
							<li style="cursor: pointer" class="p-1 sel_items mt-1 list-group-item">qqqqq</li>
							<li style="cursor: pointer" class="p-1 sel_items mt-1 list-group-item">ccccc</li>
						</ul>
					</div>
					<div class="col-sm-1 text-center">

						<button class="save_cancel_btn btn btn-success mb-1 p-0 add_lg_2"
								style="margin-top: 100px;min-height: 30px !important;min-width: 35px !important;">
							<i style="font-size: 16px;" class="fas fa-long-arrow-alt-right"> </i>
						</button>

						<button class="save_cancel_btn btn btn-success p-0 remove_lg_2"
								style="min-height: 30px !important;min-width: 35px !important;">
							<i style="font-size: 16px;" class="fas fa-long-arrow-alt-left"> </i>
						</button>

					</div>
					<div class="col-sm-5 scroll_style" style="border: 5px solid #00000040;max-height: 300px; min-height: 300px; overflow-y: scroll;">
						<ul class="list-group lg_2 mt-1">

						</ul>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button id="add_group" type="button"
						class="btn btn-outline-success cancel_btn"><?= lang('save') ?>
				</button>
				<button id="load" class="btn btn-sm btn-success d-none "><img
						style="height: 20px;margin: 0 auto;display: block;text-align: center;"
						src="<?= base_url() ?>assets/images/bars2.svg"/></button>
				<button type="button" class="cancel_btn close btn btn-sm"
						data-dismiss="modal"
						aria-label="Close">
					<?= lang('cancel') ?>
				</button>
			</div>
		</div>
	</div>

</div>

<!-- Create Group Modal End -->


<script>
	$('.sel_all_checkbox').on('change', function () {
		if ($('input.sel_all_checkbox').is(':checked')) {

			$('td input').each(function () {
				$(this).prop('checked', true);
			});
		} else {
			$('td input').each(function () {
				$(this).prop('checked', false);
			});
		}
	});


	$(document).ready(function () {


		$('#example11').DataTable({
			language: {
				search: "<?=lang('search')?>",
				emptyTable: "<?=lang('no_data')?>",
				info: "<?=lang('total')?> _TOTAL_ <?=lang('data')?>",
				infoEmpty: "<?=lang('total')?> 0 <?=lang('data')?>",
				infoFiltered: "(<?=lang('is_filtered')?> _MAX_ <?=lang('total_record')?>)",
				lengthMenu: "<?=lang('showing2')?> _MENU_ <?=lang('record2')?>",
				zeroRecords: "<?=lang('no_matching_records')?>",
				paginate: {
					first: "<?=lang('first')?>",
					last: "<?=lang('last')?>",
					next: "<?=lang('next')?>",
					previous: "<?=lang('prev')?>"
				}
			},
			"columnDefs": [{
				"targets": [0, 2, 3, 4, 5, 6, 7, 8, 9],
				"orderable": false
			}],
			dom: 'Bfrtip',
			"bPaginate": false,
			"scrollY": "500",
			"scrollCollapse": true,
			"paging": false,
			"order": [[1, "desc"]]
		});

	})


	$(document).on('click', '.sel_items', function () {
		if ($(this).hasClass('bg-info')) {
			$(this).removeClass('bg-info text-white');
		} else {
			$(this).addClass('bg-info text-white')
		}
	});

	$(document).on('click', '.added_lg_2', function () {

		array = [];
		if ($(this).hasClass('bg-info')) {
			$(this).removeClass('bg-info text-white');
		} else {
			$(this).addClass('bg-info text-white');
		}
		$('.added_lg_2').each(function () {
			if ($(this).hasClass('bg-info')) {
				arr = {
					'key': $(this).data('key'),
					'name': $(this).text()
				};
				array.push(arr)
			}
		});
	});

	$(document).on('click', '.add_lg_2', function () {


		$('.sel_items').each(function () {
			if ($(this).hasClass('bg-info')) {
				$('.lg_2').append(this);
				$(this).addClass('added_lg_2');
				$(this).remove('.list-group');
				$(this).removeClass('bg-info text-white sel_items');
			}
		});


		//$('.select_all').prop('checked', false);

	});


	$(document).on('click', '.remove_lg_2', function () {
		$('.added_lg_2').each(function () {
			if ($(this).hasClass('bg-info')) {
				$('.lg_1').append(this);
				$(this).remove('.lg_2');
				$(this).removeClass('bg-info text-white added_lg_2');
				$(this).addClass('sel_items');
				$('#nav-tabContent-car').remove();
				$('.tab-pane').children('form').remove();
			}
		});

		//$('.select_all_2').prop('checked', false);

	});


	$('.select_all').on('change', function () {
		if ($('.select_all').is(':checked')) {
			$('.sel_items').addClass('bg-info text-white')
		} else {
			$('.sel_items').removeClass('bg-info text-white');
		}
	});

	$('.delete_all').click(function () {
		$('.sel_items').remove();

		//$('.lg_1').html('<h2 class="text-center" style="opacity: .4;color: gray;margin-top: 40%;" ><?//=lang('select_fleets_from_list')?>//</h2>');
	});

	/***************************************************************/
	$('.select_all_2').on('change', function () {
		if ($('.select_all_2').is(':checked')) {
			$('.added_lg_2').each(function () {
				if (!$(this).hasClass('bg-info text-white')) {
					$(this).trigger('click');
				}
			});
		} else {
			$('.added_lg_2').each(function () {
				if ($(this).hasClass('bg-info text-white')) {
					$(this).trigger('click');
				}
			});
		}
	});

	$('.delete_all_2').click(function () {
		$('.added_lg_2').remove();
		$('#nav-tabContent-car').remove();
		$('.tab-pane').children('form').remove();
		//$('.lg_2').html('<h2 class="text-center" style="opacity: .4;color: gray;margin-top: 40%;" ><?//=lang('move_here_to_see_the_costs')?>//</h2>')
	});


	$(function () {
		$('#sb_s').keyup(function () {
			var val = $(this).val().toLowerCase();
			$(".sel_items ").hide();
			$(".sel_items").each(function () {
				var text = $(this).text().toLowerCase();
				if (text.indexOf(val) != -1) {
					$(this).show();
				}
			});
		});

	});

	$(document).on('click', '.fleets_ul li', function () {
		$(this).toggleClass('fleets_ul_active');
	})

</script>


<script type="text/javascript">


	const db = firebase.firestore();
	db.settings({timestampsInSnapshots: true});
	var d = new Date();
	var t = d.getTime()
	counter = t;


	// setInterval(function () {

	//     lat =  parseFloat(lat + 0.0001);
	//     long = parseFloat(long + 0.0001);


	// var ref = firebase.database().ref('cord/1544097063591/').update({long, lat})
	// },2000);


	// $('button').click(function () {
	// 	var coordinate = [];
	//
	// 	var lat = $('input[name="x"]').val();
	// 	var long = $('input[name="y"]').val();
	// 	var d1 = $('input[name="d1"]').val();
	// 	var d2 = $('input[name="d2"]').val();
	// 	var text = $('input[name="text"]').val();
	//
	// 	counter += 1;
	//
	// 	db.collection('GPS').add({
	// 		cord: {
	// 			'id': counter,
	// 			'lat': lat,
	// 			'long': long,
	// 			'd1': d1,
	// 			'd2': d2,
	// 			'text': text
	// 		}
	// 	});
	//
	//
	// 	$('input').val('');
	// 	db.collection('GPS').get().then((snapshots) => {
	// 		location.reload();
	// 	})
	//
	//
	// });


	var arr = [];
	var d1_arr = [];
	var d2_arr = [];
	var text_arr = [];
	db.collection('GPS').orderBy('cord.id').get().then((snapshots) => {

		snapshots.docs.forEach(doc => {

			lat = doc.data().cord.lat;
			long = doc.data().cord.long;
			d1 = doc.data().cord.d1;
			d2 = doc.data().cord.d2;
			text = doc.data().cord.text;


			arr.push([lat, long]);
			d1_arr.push(d1);
			d2_arr.push(d2);
			text_arr.push(text);


		});
		ymaps.ready(function () {

			if (arr.length == 0) {
				var arr_a = [35.6697343, 19.9361881];
				var zoom = 3;
			} else {
				var arr_a = arr[0];
				var zoom = 17;
			}

			var myMap = new ymaps.Map('map', {
				center: arr_a,
				zoom: zoom,
			});
			console.log(arr)
			var myGeoObject = new ymaps.GeoObject({
				geometry: {
					type: "LineString",
					coordinates: arr
				},
				properties: {
					hintContent: "",
					balloonContent: ""
				}
			}, {
				draggable: false,
				strokeColor: "#4285F4",
				strokeWidth: 5
			});

			//
			// $(document).ready(function () {
			//
			// 	counter += 1;
			//
			// 	var cord = {
			// 		lat: 44.454545,
			// 		long: 43.4545454,
			// 		id: counter
			// 	}
			//
			// 	let db = firebase.database().ref("cord/" + counter);
			// 	db.set(cord);
			// });

			// var pointA = [55.80, 37.50],
			//     pointB = [55.80, 37.40],
			//     pointC = [55.70, 37.50],
			//     pointD = [55.70, 37.40];

			//     var multiRoute = new ymaps.multiRouter.MultiRoute({
			//         referencePoints: [
			//                           '55.80, 37.50',
			//                           '55.80, 37.40',
			//                           '55.70, 37.50',
			//                           '55.70, 37.40'
			//                         ],
			//         params: {
			//             routingMode: ''
			//         }
			//         }, {
			//             boundsAutoApply: false
			//         });

			// // Создаем карту с добавленной на нее кнопкой.
			// var myMap = new ymaps.Map('map', {
			//     center: [55.739625, 37.54120],
			//     zoom: 12,
			// }, {
			//     buttonMaxWidth: 300
			// });

			// // Добавляем мультимаршрут на карту.
			// myMap.geoObjects.add(multiRoute);


			//Car Coordinates

			var cord = firebase.database().ref("cord/");

			console.log(cord)
			var track = [];
			cord.on("child_changed", function (data) {
				var carCoordinate = '';
				cordValue = data.val();
				latitude = cordValue.lat;
				longitude = cordValue.long;

				console.log(latitude);
				console.log(longitude);

				if (track.indexOf([latitude.toFixed(5), longitude.toFixed(5)]) === -1) {
					track.push([latitude.toFixed(5), longitude.toFixed(5)]);

				}

				console.log(track);
				var myGeoObject2 = new ymaps.GeoObject({
					geometry: {
						type: "LineString",
						coordinates: track
					},
					properties: {
						hintContent: "",
						balloonContent: ""
					}
				}, {
					draggable: false,
					strokeColor: "#4285F4",
					strokeWidth: 3
				});
				myMap.geoObjects.add(myGeoObject2);


				carCoordinate = new ymaps.Placemark([latitude, longitude], {
					balloonContentHeader: "",
					balloonContentBody: "<p class='mb-0'>object:<span class='ml-1'><a href='#'>Kamaz</a></span></p>" +
						"<p class='mb-0'>Պետհամարանիշ:<span class='ml-1'>441xs26</span></p>" +
						"<p class='mb-0'>message time:<span class='ml-1'>01.09.28 19:02:01 </span></p>" +
						"<p class='mb-0'>speed<span class='ml-1'>55 km/h</span></p>" +
						"<p class='mb-0'>engine:<span class='ml-1 bg-success' style='display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;'></span></p>" +
						"<p class='mb-0'>driver: <span class='ml-1'>Name Lastname</span></p>" +
						"<p class='mb-0'>fuel:<span class='ml-1'>25l</span></p>" +
						"<p class='mb-0'>place:<span class='ml-1'>Lenigradian 16</span></p>",
					balloonContentFooter: ""
				}, {
					iconLayout: 'default#image',
					iconImageHref: '<?= base_url() ?>assets/images/ymap/car.svg',
					iconImageSize: [35, 30],
					iconImageOffset: [-10, -30]
				});

				myMap.geoObjects.removeAll();
				myMap.geoObjects.add(carCoordinate);


				myMap.geoObjects
					.add(carCoordinate)
					.add(myGeoObject)
					.add(myGeoObject2);


				// var i = 1;
				//
				// $.each(arr, function (e, value) {
				//
				// 	if (i == 1) {
				// 		myPlacemark = new ymaps.Placemark(value, {
				// 			balloonContentHeader: text_arr[e],
				// 			balloonContentBody: "<span>" + d1_arr[e] + "</span>  /  <span>" + d2_arr[e] + "</span>",
				// 			balloonContentFooter: "",
				// 			hintContent: value
				// 		}, {
				// 			preset: 'islands#greenDotIcon',
				// 		});
				// 	} else if (i > 1 && i < arr.length) {
				// 		myPlacemark = new ymaps.Placemark(value, {
				// 				balloonContentHeader: text_arr[e],
				// 				balloonContentBody: "<span>" + d1_arr[e] + "</span>  /  <span>" + d2_arr[e] + "</span>",
				// 				balloonContentFooter: "",
				// 				hintContent: value
				// 			},
				// 			{
				// 				preset: 'islands#blueCircleDotIconWithCaption',
				// 				iconCaptionMaxWidth: '50'
				// 			});
				// 	} else if (i == arr.length) {
				// 		myPlacemark = new ymaps.Placemark(value, {
				// 			balloonContentHeader: text_arr[e],
				// 			balloonContentBody: "<span>" + d1_arr[e] + "</span>  /  <span>" + d2_arr[e] + "</span>",
				// 			balloonContentFooter: "",
				// 			hintContent: value
				// 		}, {
				// 			preset: 'islands#redDotIcon',
				// 		});
				// 	}
				// 	myMap.geoObjects.add(myPlacemark);
				//
				// 	i++;
				//
				// })

			})

			cord.on("child_added", function (data) {
				var carCoordinate = '';
				cordValue = data.val();
				latitude = cordValue.lat;
				longitude = cordValue.long;

				console.log(latitude);
				console.log(longitude);

				carCoordinate = new ymaps.Placemark([latitude, longitude], {
					balloonContentHeader: "",
					balloonContentBody: "<p class='mb-0'>object:<span class='ml-1'><a href='#'>Kamaz</a></span></p>" +
						"<p class='mb-0'>Պետհամարանիշ:<span class='ml-1'>441xs26</span></p>" +
						"<p class='mb-0'>message time:<span class='ml-1'>01.09.28 19:02:01 </span></p>" +
						"<p class='mb-0'>speed<span class='ml-1'>55 km/h</span></p>" +
						"<p class='mb-0'>engine:<span class='ml-1 bg-success' style='display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;'></span></p>" +
						"<p class='mb-0'>driver: <span class='ml-1'>Name Lastname</span></p>" +
						"<p class='mb-0'>fuel:<span class='ml-1'>25l</span></p>" +
						"<p class='mb-0'>place:<span class='ml-1'>Lenigradian 16</span></p>",
					balloonContentFooter: ""
				}, {
					iconLayout: 'default#image',
					iconImageHref: '<?= base_url() ?>assets/images/ymap/car.svg',
					iconImageSize: [35, 30],
					iconImageOffset: [-10, -35]
				});


				myMap.geoObjects
					.add(carCoordinate);
			})


			myMap.geoObjects.add(myGeoObject);
			var i = 1;

			$.each(arr, function (e, value) {

				if (i == 1) {
					myPlacemark = new ymaps.Placemark(value, {
						balloonContentHeader: text_arr[e],
						balloonContentBody: "<span>" + d1_arr[e] + "</span>  /  <span>" + d2_arr[e] + "</span>",
						balloonContentFooter: "",
						hintContent: value
					}, {
						preset: 'islands#greenDotIcon',
					});
				} else if (i > 1 && i < arr.length) {
					myPlacemark = new ymaps.Placemark(value, {
							balloonContentHeader: text_arr[e],
							balloonContentBody: "<span>" + d1_arr[e] + "</span>  /  <span>" + d2_arr[e] + "</span>",
							balloonContentFooter: "",
							hintContent: value
						},
						{
							preset: 'islands#blueCircleDotIconWithCaption',
							iconCaptionMaxWidth: '50'
						});
				} else if (i == arr.length) {
					myPlacemark = new ymaps.Placemark(value, {
						balloonContentHeader: text_arr[e],
						balloonContentBody: "<span>" + d1_arr[e] + "</span>  /  <span>" + d2_arr[e] + "</span>",
						balloonContentFooter: "",
						hintContent: value
					}, {
						preset: 'islands#redDotIcon',
					});
				}
				myMap.geoObjects.add(myPlacemark);

				myMap.geoObjects.add(myPlacemark);
				i++;

			})
		});

	});


</script>
