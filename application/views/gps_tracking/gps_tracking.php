<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.buttons.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.colVis.min.js') ?>"></script>
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
<style>
	.btn.btn-secondary.buttons-collection.dropdown-toggle.buttons-colvis {
		display: none;
	}

	.dropdown-menu {
		padding: 0;
	}

	.dropdown-menu a:last-child {
		display: none;
		top: 55px;
		left: -15px;
	}
</style>



<div class="container-fluid pl-0 pr-0" style="outline: 1px solid #ccc;">
	<div class="row">
		<div class="col-sm-5">
			<div class="row">
				<div class="col-sm-12 m-2">

					<div class="form-group row">
						<label style="margin-left: 18px;margin-top: 10px;"><?= lang('group') ?></label>
						<div class="col-sm-4">
							<select style="margin-top: 1px;max-width: 220px;"
									class="form-control form-control-sml">
								<option>group 1</option>
								<option>group 2</option>
								<option>group 3</option>
								<option>group 4</option>
							</select>
						</div>

						<div class="col-sm-4" style="padding-top: 4px;">
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
							<button class="btn btn-sm btn-outline-secondary delete_btn" data-toggle="modal" data-target=".del_group_modal"
									style="width: 20px;padding: 2px !important;"><img
									style="margin-right: 5px;margin-left: -15px;"
									src="<?= base_url() ?>assets/images/gps_tracking/delete.svg"
									class="ml-0 mr-0 "/></button>
						</div>
					</div>


					<table id="example11" class="table table-bordered" style="width:100%">
						<thead>
						<tr>
							<th style="font-size: 12px !important;font-weight: 500;color: transparent;font-size: 1px !important;">
								<input class="sel_all_checkbox" style="margin-left: 5px;" type="checkbox"/>Select all
							</th>
							<th style="font-size: 12px !important;font-weight: 500;color: transparent;font-size: 1px !important;">
								<i style="font-size: 12px !important;color: #000 !important;"
								   class="fas fa-sort-alpha-down"></i>cars
							</th>
							<th style="font-size: 12px !important;font-weight: 500;color: transparent;font-size: 1px !important;">
								<i style="font-size: 12px !important;color: #000 !important;"
								   class="fas fa-map-marker-alt"></i> place
							</th>
							<th style="font-size: 12px !important;font-weight: 500;"
								class="text-center"><?= lang('status') ?></th>
							<th style="font-size: 12px !important;font-weight: 500;color: transparent !important;font-size: 1px !important;">
								<i style="font-size: 12px !important;color: #000 !important;" class="fas fa-user"></i>
								Driver
							</th>
							<th style="font-size: 12px !important;font-weight: 500;"><?= lang('department') ?></th>

							<th style="font-size: 12px !important;font-weight: 500;color: transparent !important;font-size: 1px !important;">
								<i style="color: #000 !important;font-size: 12px !important;"
								   class="fas fa-gas-pump"></i> Fuel
							</th>

							<th style="font-size: 12px !important;font-weight: 500;color: transparent !important;font-size: 1px !important;">
								<i style="color: #000 !important; font-size: 12px  !important;" class="fas fa-wifi"></i>signal
							</th>
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
				<div class="row pl-1 pr-1">
					<input id="sb_s" type="text" class="form-control col-sm-6" placeholder="<?= lang('search') ?>"
						   aria-label="Search" aria-describedby="basic-addon2">
					<div class="col-sm-1"></div>
					<input id="sb_s2" type="text" class="form-control col-sm-5" placeholder="<?= lang('search') ?>"
						   aria-label="Search" aria-describedby="basic-addon2">
				</div>
				<div class="row mt-1 pl-1 pr-1">

					<div class="col-sm-6 scroll_style"
						 style="border: 5px solid #00000040;max-height: 300px; min-height: 300px; overflow-y: scroll;">

						<ul style="list-style: decimal;" class="list-group lg_1 mt-1">
							<li style="cursor: pointer" class="p-1 sel_items mt-1 list-group-item">fffff</li>
							<li style="cursor: pointer" class="p-1 sel_items mt-1 list-group-item">gggg</li>
							<li style="cursor: pointer" class="p-1 sel_items mt-1 list-group-item">rrrr</li>
							<li style="cursor: pointer" class="p-1 sel_items mt-1 list-group-item">wwwww</li>
							<li style="cursor: pointer" class="p-1 sel_items mt-1 list-group-item">qqqqq</li>
							<li style="cursor: pointer" class="p-1 sel_items mt-1 list-group-item">ccccc</li>
							<li style="cursor: pointer" class="p-1 sel_items mt-1 list-group-item">ccccc</li>
							<li style="cursor: pointer" class="p-1 sel_items mt-1 list-group-item">ccccc</li>
							<li style="cursor: pointer" class="p-1 sel_items mt-1 list-group-item">ccccc</li>
							<li style="cursor: pointer" class="p-1 sel_items mt-1 list-group-item">ccccc</li>
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


					<div class="col-sm-5 scroll_style"
						 style="border: 5px solid #00000040;max-height: 300px; min-height: 300px; overflow-y: scroll;">
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


<!-- Settings Modal Start -->

<div class="modal fade bd-example-modal-lg settings_modal" tabindex="-1" role="dialog"
	 aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content settings_modal_content">
			<div class="modal-header bg-dark">
				<h5 class="modal-title text-white"><?= lang('settings') ?></h5>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group row mb-0">
								<label class="col-sm-7"><?= lang('analog_input') ?>: 1</label>
								<input class="col-sm-1 mt-1" type="checkbox"/>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group row mb-0">
								<label class="col-sm-7 text-right"><?= lang('analog_input') ?>: 2</label>
								<input class="col-sm-1 mt-1" type="checkbox"/>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group row mb-0">
								<label class="col-sm-8 text-right"><?= lang('analog_input') ?>: 1 + 2</label>
								<input class="col-sm-1 mt-1" type="checkbox"/>
							</div>
						</div>
					</div>
					<hr class="my-2">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label><?= lang('titles') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label><?= lang('titles') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label><?= lang('titles') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
					</div>
					<hr class="my-2">


					<div class="row">
						<div class="col-sm-6">
							<div class="form-group row mb-0">
								<label class="col-sm-4 mt-2"><?= lang('coefficient') ?></label>
								<input type="number" class="form-control form-control-sm col-sm-2">
								<div class="col-sm-1 mt-2">+</div>
								<input type="number" class="form-control form-control-sm col-sm-2"><span
									class="ml-1 mt-2">*A</span>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group row mb-0">
								<label class="col-sm-4 mt-2"><?= lang('coefficient') ?></label>
								<input type="number" class="form-control form-control-sm col-sm-2">
								<div class="col-sm-1 mt-2">+</div>
								<input type="number" class="form-control form-control-sm col-sm-2"><span
									class="ml-1 mt-2">*A</span>
							</div>
						</div>
					</div>
					<hr class="my-2">

					<div class="row">
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label class=""><?= lang('engine') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label class=""><?= lang('cargo') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label class=""><?= lang('sos') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
					</div>
					<hr class="my-2">


					<div class="row">
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label class=""><?= lang('titles') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label class=""><?= lang('titles') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group mb-0">
								<label class=""><?= lang('titles') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10">
							</div>
						</div>
					</div>
					<hr class="my-2">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group mb-0">
								<label><?= lang('default_speed') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10"/>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group mb-0">
								<label><?= lang('readout_time') ?></label>
								<input type="text" class="form-control form-control-sm col-sm-10"/>
							</div>
						</div>
					</div>
					<hr class="my-2">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group row mb-0">
								<label class="col-sm-6"><?= lang('event') ?></label>
								<input class="col-sm-1 mt-1" type="checkbox"/>
							</div>
						</div>
					</div>
					<hr class="my-2">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group row mb-0 pl-3">
								<select class="form-control form-control-sm col-sm-10">
									<option selected>value 1</option>
									<option>value 2</option>
									<option>value 3</option>
									<option>value 4</option>
									<option>value 5</option>
								</select>
								<div class="col-sm-2">
									<button class="btn btn-sm btn-secondary"
											style="-webkit-border-radius: 50% !important;-moz-border-radius: 50% !important;border-radius: 50% !important;width: 30px !important;height: 30px !important;padding: 0 !important;line-height: unset !important;">
										+
									</button>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button id="add_staff" type="button"
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
<!-- Settings Modal End -->
<!-- Delete Modal start -->
<div class="modal fade bd-example-modal-sm del_group_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title text-secondary text-center" id="exampleModalLabel"
					style="font-size: 15px;"><?= lang('are_you_sure_you_want_to_delete') ?></h6>
			</div>
			<div class="modal-footer text-center">
				<div style="margin: 0 auto;">
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" id="delete_staff"
							class="btn btn-outline-success yes_btn"><?= lang('yes') ?>
					</button>
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" class="btn btn-outline-danger  cancel_btn"
							data-dismiss="modal"><?= lang('cancel') ?></button>

					<input type="hidden" name="staff_id">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Delete modal End -->
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

	var table = $('#example11').DataTable({
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
		buttons: [
			'colvis'
		],
		"bPaginate": false,
		"scrollY": "500",
		"scrollCollapse": true,
		"paging": false,
		"order": [[1, "desc"]]

	});
	table.buttons().container().appendTo('#example11_wrapper #example11_filter:eq(0)');
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
	$(function () {
		$('#sb_s2').keyup(function () {
			var val = $(this).val().toLowerCase();
			$('.added_lg_2').hide();
			$('.added_lg_2').each(function () {
				var text = $(this).text().toLowerCase();
				if (text.indexOf(val) != -1) {
					$(this).show();
				}
			});
		});
	});
	$(document).on('click', '.fleets_ul li', function () {
		$(this).toggleClass('fleets_ul_active');
	});
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
	// 	var lat = $('input[name="x"]').val();
	// 	var long = $('input[name="y"]').val();
	// 	var d1 = $('input[name="d1"]').val();
	// 	var d2 = $('input[name="d2"]').val();
	// 	var text = $('input[name="text"]').val();
	// 	counter += 1;
	// 	db.collection('GPS').add({
	// 	cord: {'id': counter,'lat': lat,'long': long,'d1': d1,'d2': d2,'text': text}
	// 	});
	// 	$('input').val('');
	// 	db.collection('GPS').get().then((snapshots) => {location.reload();})
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
			// $(document).ready(function () {
			// 	counter += 1;
			// 	var cord = {
			// 		lat: 44.454545,
			// 		long: 43.4545454,
			// 		id: counter
			// 	}
			// 	let db = firebase.database().ref("cord/" + counter);
			// 	db.set(cord);
			// });
			// var pointA = [55.80, 37.50],
			//     pointB = [55.80, 37.40],
			//     pointC = [55.70, 37.50],
			//     pointD = [55.70, 37.40];
			//     var multiRoute = new ymaps.multiRouter.MultiRoute({
			//         referencePoints: ['55.80, 37.50','55.80, 37.40','55.70, 37.50','55.70, 37.40'],
			//         params: {routingMode: ''}
			//         }, {boundsAutoApply: false});
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
					balloonContentBody: "<p class='mb-0'><?=lang('object')?>:<span class='ml-1'><a href='#'>Kamaz</a></span></p>" +
						"<p class='mb-0'><?=lang('license_plate')?>:<span class='ml-1'>441xs26</span></p>" +
						"<p class='mb-0'><?=lang('message_time')?>:<span class='ml-1'>01.09.28 19:02:01 </span></p>" +
						"<p class='mb-0'><?=lang('speed')?><span class='ml-1'>55 km/h</span></p>" +
						"<p class='mb-0'><?=lang('engine')?>:<span class='ml-1 bg-success' style='display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;'></span></p>" +
						"<p class='mb-0'><?=lang('driver')?>: <span class='ml-1'>Name Lastname</span></p>" +
						"<p class='mb-0'><?=lang('fuel')?>:<span class='ml-1'>25l</span></p>" +
						"<p class='mb-0'><?=lang('place')?>:<span class='ml-1'>Lenigradian 16</span></p>",
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
				// $.each(arr, function (e, value) {
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
				// 	i++;
				// })
			});
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
	$(document).on('click', '.fas.fa-ellipsis-v', function () {
		$('.btn.btn-secondary.buttons-collection.dropdown-toggle.buttons-colvis').trigger('click')
	})
</script>
