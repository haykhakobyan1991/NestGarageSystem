<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.buttons.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.colVis.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/gps_tracking/gps_tracking.css"/>
<!--<script src="https://www.gstatic.com/firebasejs/5.6.0/firebase.js"></script>-->
<!--<script src="https://api-maps.yandex.ru/2.1/?apikey=57fb1bc4-e5b4-4fa9-96b8-73ee74c98245&lang=ru_RU"-->
<!--		type="text/javascript"></script>-->

<script type="text/javascript" src="<?= base_url('assets/js/ymap.js') ?>"></script>


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

	.dataTables_filter label {
		font-size: 0px !important;
	}

	#example11_filter label input {
		height: 38px;
	}

	#example11_filter {
		height: 37px;
	}

	td {
		font-size: 11px !important;
	}

	.dataTables_scrollBody {
		height: calc(100% - 315px) !important;
	}

	.custom_fas_trash:hover, .custom_fas_trash:active, .custom_fas_trash:focus {
		color: #6c757d !important;
	}

	.custom_fas_trash_btn, .custom_fas_trash_btn:hover i, .custom_fas_trash_btn:focus i, .custom_fas_trash_btn:active i {
		color: #6c757d !important;
	}

</style>

<div class="container-fluid pl-0 pr-0" style="outline: 1px solid #ccc;">
	<div class="row">
		<div class="col-sm-5">
			<div class="row">
				<div class="col-sm-12 m-2">

					<div class="form-group row ml-2">
						<div class="col-sm-2" style="padding-top: 10px;">
							<img src="<?= base_url() ?>assets/images/icon-car-png-22.png"
								 style="width: 25px;display: inline-block;"/>
							<span class="count_cars_in_table">16</span>
						</div>
						<label style="margin-top: 10px;"><?= lang('group') ?></label>
						<div class="col-sm-3 ml-0">
							<select style="margin-top: 1px;max-width: 220px; z-index: 999;"
									name="group"
									class="form-control form-control-sml sell_group_select">
								<option selected value="all_val"><?= lang('all1') ?></option>
								<? foreach ($result as $row) { ?>
									<option data-id="<?= $row['group_id'] ?>"
											value="<?= $row['fleet_id'] ?>"><?= $row['title'] ?></option>
								<? } ?>
							</select>
						</div>

						<div class="col-sm-2 pl-0" style="padding-top: 4px;">
							<button class="btn btn-sm btn-outline-secondary plus_btn mr-1"
									data-toggle="modal" data-target=".add_group"
									style="width: 20px;padding: 2px !important;"><img
									style="margin-right: 5px;margin-left: -15px;"
									src="<?= base_url() ?>assets/images/gps_tracking/plus-black-symbol.svg"
									class="ml-0 mr-0 "/></button>
							<button class="btn btn-sm btn-outline-secondary set_btn mr-1"
									id="edit_group_modal"
									data-toggle="modal"
									data-target="#edit_group"
									data-toggle2="tooltip"
									data-placement="top"
									style="width: 20px;padding: 2px !important;"><img
									style="margin-right: 5px;margin-left: -15px;"
									src="<?= base_url() ?>assets/images/gps_tracking/settings-work-tool.svg"
									class="ml-0 mr-0 "/></button>
							<button class="custom_fas_trash_btn btn btn-sm btn-outline-secondary delete_btn"
									data-toggle="modal"
									data-target=".del_group_modal"
									style="width: 20px;padding: 2px !important;">
								<i class="custom_fas_trash fas fa-trash"></i>

						</div>
					</div>


					<table id="example11" class="table table-bordered" style="width:100%">
						<thead>
						<tr>
							<th style="font-size: 12px !important;font-weight: 500;color: transparent;font-size: 1px !important;">
								<input class="sel_all_checkbox" style="margin-left: 5px;" type="checkbox"/>Select all
							</th>
							<th
								style="font-size: 12px !important;font-weight: 500;color: transparent;font-size: 1px !important;">
								<i style="font-size: 12px !important;color: #000 !important;"
								   class="fas fa-sort-alpha-up"></i>cars
							</th>
							<th style="min-width: 150px;font-size: 12px !important;font-weight: 500;color: transparent;font-size: 1px !important;">
								<i style="font-size: 12px !important;color: #000 !important;"
								   class="fas fa-map-marker-alt"></i> place
							</th>
							<th style="font-size: 12px !important;font-weight: 500;min-width: 25px !important;"
								class="text-center">
								<i class="fas fa-parking pb-1"></i>
								<i class="fas fa-arrow-alt-circle-right pb-1"></i>
								<i class="fas fa-stop-circle"></i>
							</th>
							<th style="font-size: 12px !important;font-weight: 500;color: transparent !important;font-size: 1px !important;">
								<i style="min-width: 150px;font-size: 12px !important;color: #000 !important;"
								   class="fas fa-user"></i>
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
							<td class="show_car" data-coordinate='40.183605, 44.518732'>
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
							<td class="show_car" data-coordinate='40.170286, 44.525174'>
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
							<td class="show_car" data-coordinate='40.177472, 44.513130'>
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
			<div id="map" style="width: 100%; height: calc(100% - 150px);"></div>
		</div>


	</div>
</div>


<!-- Delete Modal start -->
<div class="modal fade bd-example-modal-sm del_group_modal" tabindex="-1" role="dialog"
	 aria-labelledby="mySmallModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title text-secondary text-center" id="exampleModalLabel"
					style="font-size: 12px;"><?= lang('are_you_sure_you_want_to_delete') ?></h6>
			</div>
			<div class="modal-footer text-center">
				<div style="margin: 0 auto;">
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" id="delete_group"
							class="btn btn-outline-success cancel_btn"><?= lang('yes') ?>
					</button>
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" class="btn btn-outline-danger   yes_btn"
							data-dismiss="modal"><?= lang('cancel') ?></button>

					<input type="hidden" name="group_id">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Delete modal End -->

<!-- Edit Group Modal  Start -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
	 aria-hidden="true" id="edit_group">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-secondary " style="border-radius: unset;">
				<h6 class="text-white modal-title dar"><?= lang('EditGroup') ?></h6>
			</div>
			<div class="body-m">
				<img style="height: 50px;margin: 0 auto;display: block;text-align: center;"
					 src="<?= base_url() ?>assets/images/bars.svg"/>
			</div>
		</div>
	</div>
</div>

<!--Edit Group Modal end -->

<!-- Create Group Modal  Start -->

<div class="modal fade bd-example-modal-lg add_group" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
	 aria-hidden="true">

	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-secondary " style="border-radius: unset;">
				<h5 class="modal-title text-white"><?= lang('create_group') ?></h5>
			</div>
			<div class="modal-body">
				<form id="group_add">
					<div class="form-group row">
						<div class="col-sm-1"></div>
						<label class="col-sm-2 col-form-label"><?= lang('company_name') ?></label>
						<div class="col-sm-8">
							<input name="title" type="text" class="form-control"
								   placeholder="<?= lang('company_name') ?>">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-1"></div>
						<label class="col-sm-2 col-form-label"><?= lang('more_info') ?></label>
						<div class="col-sm-8">
							<textarea name="description" type="text" class="form-control"
									  placeholder="<?= lang('more_info') ?>"></textarea>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-1"></div>
						<label class="col-sm-2 col-form-label"><?= lang('geofences') ?></label>
						<select class="form-control form-control-sm col-sm-8">
							<option selected>value 1</option>
							<option>value 2</option>
							<option>value 3</option>
							<option>value 4</option>
							<option>value 5</option>
						</select>

					</div>

					<input type="hidden" name="groups">

				</form>
				<hr class="my-2">
				<div class="row mt-1 pl-1 pr-1">
					<input id="sb_s" type="text" class="form-control" placeholder="<?= lang('search') ?>"
						   aria-label="Search" aria-describedby="basic-addon2" style="width: 50%;margin: 3px;">
					<div class="col-sm-6 scroll_style"
						 style="border: 5px solid #00000040;max-height: 300px; min-height: 300px; overflow-y: scroll;">

						<ul style="list-style: decimal;" class="list-group lg_1 mt-1">
							<? foreach ($result_fleets as $row_fleet) : ?>
								<li data-id="<?= $row_fleet['id'] ?>" style="cursor: pointer"
									class="p-1 sel_items mt-1 list-group-item"><?= $row_fleet['brand_model'] ?></li>
							<? endforeach; ?>
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
				<button id="load" class="btn btn-sm btn-success d-none cancel_btn"><img
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
								<label
									class="colnavbar navbar-expand-lg navbar-light bg-light pl-0 pr-0-sm-6"><?= lang('event') ?></label>
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
<div class="modal fade bd-example-modal-sm del_group_modal" tabindex="-1" role="dialog"
	 aria-labelledby="mySmallModalLabel"
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


<span class="geofences_coordinate" style="display:none;" data-gCoordinate="[40.19060653826287, 44.50844357516261],
																		   [40.189981206597146, 44.51397965456936],
																		   [40.18741399465704, 44.510246019620624],
																		   [40.19060653826287, 44.50844357516261]"></span>
<span class="geofences_coordinate" style="display:none;" data-gCoordinate="[40.13331860515059,44.44393439075485],
								   					                       [40.09483366177357,44.54555792591108],
								   					                       [40.148601052086335,44.54967779895795],
								   					                       [40.13331860515059,44.44393439075485]"></span>
<span class="geofences_coordinate" style="display:none;" data-gCoordinate="[40.188001002307885,44.52710650739624],
								   				                           [40.17977217076603,44.520068390941155],
								   				                           [40.174702709790814,44.52762149152713],
								   				                           [40.173122540044034,44.54118274030644],
								   				                           [40.18391962756528,44.5442726450916],
								   				                           [40.188001002307885,44.52710650739624]"></span>
<span class="geofences_coordinate" style="display:none;" data-gCoordinate="[40.182152607087005,44.48289401495332],
								   					                       [40.179848435430564,44.49079043829316],
								   					                       [40.181560113314845,44.50478084051483],
								   					                       [40.187320248036535,44.502635073302926],
								   					                       [40.189196299777905,44.487056803344416],
								   					                       [40.182152607087005,44.48289401495332]"></span>


<script>

	$('table tr th:nth-child(2)').click(function () {

		if (!$(this).hasClass('az')) {
			$(this).html('<i style="font-size: 12px !important;color: #000 !important;" class="fas fa-sort-alpha-down"></i>');
			$(this).addClass('az');
		} else {
			$(this).html('<i style="font-size: 12px !important;color: #000 !important;" class="fas fa-sort-alpha-up"></i>');
			$(this).removeClass('az');
		}
	});

	$('td input').each(function () {
		$(this).prop('checked', true);
	});
	$('.sel_all_checkbox').prop('checked', true);

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
		"scrollY": "",
		"scrollX": true,
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

	/***************************
	 ****************************
	 *** [ Yandex Map Start ] ***
	 ****************************
	 ***************************/

	//-------------------------------------------------


	// Show All Cars On Maps /--------------
	$(document).ready(function () {

		ymaps.ready(init_all);

		function init_all() {
			var myMap_show_all_cars_onChange = new ymaps.Map("map", {
				center: [55.76, 37.64],
				zoom: 2
			}, {suppressMapOpenBlock: true});

			firstButton = new ymaps.control.Button("<i style='font-size: 20px;' class='fas fa-draw-polygon'></i>");
			myMap_show_all_cars_onChange.controls.add(firstButton, {float: 'right'});

			//Click Function Show All Geofences
			firstButton.events.add(['select', 'deselect'], function (e) {

				if (e.get('type') == 'select') {
					$('.geofences_coordinate').each(function () {

						geoObject_coordinates = $(this).attr('data-gCoordinate');
						array_stting = JSON.parse("[" + geoObject_coordinates + "]");

						var rand_color = '#' + (function co(lor) {
							return (lor += [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f'][Math.floor(Math.random() * 16)]) && (lor.length == 6) ? lor : co(lor);
						})('') + '75';

						var myPolygon = new ymaps.Polygon([
							array_stting
						], {}, {
							editorDrawingCursor: "crosshair",
							fillColor: rand_color,
							strokeColor: rand_color,
							strokeWidth: 2
						});

						myMap_show_all_cars_onChange.geoObjects.add(myPolygon);

						myMap_show_all_cars_onChange.controls.add(new ymaps.control.ZoomControl());
						myMap_show_all_cars_onChange.setBounds(myMap_show_all_cars_onChange.geoObjects.getBounds());

					});

				} else {

					ymaps.ready(init_all);

					$('.show_car').each(function () {
						$('#map').html('')

						if ($(this).parent('tr').children('td:first-child').children('input').is(':checked')) {

							coordinate = $(this).data('coordinate');
							array = JSON.parse("[" + coordinate + "]");

							var carCoordinate = '';

							latitude = array[0];
							longitude = array[1];

							console.log(longitude)

							carCoordinate = new ymaps.Placemark([latitude, longitude], {
								balloonContentHeader: "<p><?=lang('basic_information')?></p>",
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
								iconImageOffset: [-10, -35]
							});

							myMap_show_all_cars_onChange.geoObjects.add(carCoordinate);
							myMap_show_all_cars_onChange.controls.add(new ymaps.control.ZoomControl());
							myMap_show_all_cars_onChange.setBounds(myMap_show_all_cars_onChange.geoObjects.getBounds());
						}
					});
				}


			});

			$('.show_car').each(function () {
				if ($(this).parent('tr').children('td:first-child').children('input').is(':checked')) {

					coordinate = $(this).data('coordinate');
					array = JSON.parse("[" + coordinate + "]");

					var carCoordinate = '';

					latitude = array[0];
					longitude = array[1];

					carCoordinate = new ymaps.Placemark([latitude, longitude], {
						balloonContentHeader: "<p><?=lang('basic_information')?></p>",
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
						iconImageOffset: [-10, -35]
					});

					myMap_show_all_cars_onChange.geoObjects.add(carCoordinate);
					myMap_show_all_cars_onChange.controls.add(new ymaps.control.ZoomControl());
					myMap_show_all_cars_onChange.setBounds(myMap_show_all_cars_onChange.geoObjects.getBounds());
				}
			});
		}

		/* On Click Function Show single Car On Map */

		$('.show_car').click(function () {

			$('#map').html('');

			coordinate = $(this).data('coordinate');
			array = JSON.parse("[" + coordinate + "]");
			// console.log(coordinate);
			// console.log(array);
			ymaps.ready(init_singleCar(array));

			function init_singleCar(array) {
				var myMap_show_singleCar = new ymaps.Map("map", {
					center: [45.8989, 54.56566565],
					zoom: 2
				}, {suppressMapOpenBlock: true});
				var carCoordinate = '';

				firstButton = new ymaps.control.Button("<i style='font-size: 20px;' class='fas fa-draw-polygon'></i>");
				myMap_show_singleCar.controls.add(firstButton, {float: 'right'});

				//Click Function Show All Geofences
				firstButton.events.add(['select', 'deselect'], function (e) {

					if (e.get('type') == 'select') {
						$('.geofences_coordinate').each(function () {

							geoObject_coordinates = $(this).attr('data-gCoordinate');
							array_stting = JSON.parse("[" + geoObject_coordinates + "]");

							var rand_color = '#' + (function co(lor) {
								return (lor += [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f'][Math.floor(Math.random() * 16)]) && (lor.length == 6) ? lor : co(lor);
							})('') + '75';

							myPolygon = new ymaps.Polygon([
								array_stting
							], {}, {
								editorDrawingCursor: "crosshair",
								fillColor: rand_color,
								strokeColor: rand_color,
								strokeWidth: 2
							});

							myMap_show_singleCar.geoObjects.add(myPolygon);
							myMap_show_singleCar.controls.add(new ymaps.control.ZoomControl());
							myMap_show_singleCar.setBounds(myMap_show_singleCar.geoObjects.getBounds());

						});

					} else {

						$('.show_car').each(function () {
							if(coordinate == $(this).data('coordinate')){

								$(this).trigger('click')
							}
							console.log(coordinate + 'geoObject_coordinates')
							console.log($(this).data('coordinate'))

						})



					}
				});

				latitude = array[0];
				longitude = array[1];

				carCoordinate = new ymaps.Placemark([latitude, longitude], {
					balloonContentHeader: "<p><?=lang('basic_information')?></p>",
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
					iconImageOffset: [-10, -35]
				});

				myMap_show_singleCar.geoObjects.add(carCoordinate);

				myMap_show_singleCar.controls.add(new ymaps.control.ZoomControl());
				myMap_show_singleCar.setBounds(myMap_show_singleCar.geoObjects.getBounds(), {checkZoomRange: true});
			}
		});


		/* On Change checkbox  */

		$('tr td input , th input').on('change', function () {
			$('#map').html('');
			ymaps.ready(init_all);

			function init_all() {
				var myMap_show_all_cars = new ymaps.Map("map", {
					center: [55.76, 37.64],
					zoom: 2
				}, {suppressMapOpenBlock: true});

				firstButton = new ymaps.control.Button("<i style='font-size: 20px;' class='fas fa-draw-polygon'></i>");
				myMap_show_all_cars.controls.add(firstButton, {float: 'right'});

				$('.show_car').each(function () {
					if ($(this).parent('tr').children('td:first-child').children('input').is(':checked')) {

						coordinate = $(this).data('coordinate');
						array = JSON.parse("[" + coordinate + "]");
						// console.log(coordinate);
						var carCoordinate = '';

						latitude = array[0];
						longitude = array[1];

						carCoordinate = new ymaps.Placemark([latitude, longitude], {
							balloonContentHeader: "<p><?=lang('basic_information')?></p>",
							balloonContentBody: "<p class='mb-0'><?=lang('object')?>f:<span class='ml-1'><a href='#'>Kamaz</a></span></p>" +
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
							iconImageOffset: [-10, -35]
						});

						myMap_show_all_cars.geoObjects.add(carCoordinate);
						myMap_show_all_cars.controls.add(new ymaps.control.ZoomControl());
						myMap_show_all_cars.setBounds(myMap_show_all_cars.geoObjects.getBounds(), {checkZoomRange: true});
					}
				});
			}
		});
	});


	/*************************
	 **************************
	 *** [ Yandex Map End ] ***
	 **************************
	 *************************/

	$(document).on('click', '.fas.fa-ellipsis-v', function () {
		$('.btn.btn-secondary.buttons-collection.dropdown-toggle.buttons-colvis').trigger('click')
	})

	// add group
	$(document).on('click', '#add_group', function (e) {

		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/add_group_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#group_add')[0]);

		$('input').removeClass('border border-danger');
		$('input').parent('td').removeClass('border border-danger');
		$('select').removeClass('border border-danger');
		loading('start', 'add_group');

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
				loading('start', 'add_group');
				$('.alert-info').removeClass('d-none');
				$('.alert-info').html('<img style="height: 20px;margin: 0 auto;display: block;text-align: center;" src="<?= base_url() ?>assets/images/load.svg" />');
			},
			success: function (data) {
				if (data.success == '1') {
					close_message();
					$('.alert-success').removeClass('d-none');
					$('.alert-success').text(data.message);
					loading('stop', 'add_group');
					var url = "<?=current_url()?>";
					$(location).attr('href', url);
				} else {
					close_message();
					loading('stop', 'add_group');

					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'add_group');
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
	});

	// get edit modal
	$(document).on('click', '#edit_group_modal', function () {
		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/edit_group_modal_ax/')?>' + $('select[name="group"] option:selected').data('id');
		$.get(url, function (result) {
			// update modal content
			$('.body-m').html(result);
			// show modal
			$('#myModal').modal('show');
		});

	});


	$(document).on('click', '#edit_group_btn', function (e) {


		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/edit_group_ax') ?>';
		e.preventDefault();
		var form_data = new FormData($('form#group_edit')[0]);

		$('input').removeClass('border border-danger');
		$('input').parent('td').removeClass('border border-danger');
		$('select').removeClass('border border-danger');

		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function () {


				loading('start', 'edit_group_btn');

			},
			success: function (data) {
				if (data.success == '1') {
					loading('stop', 'edit_group_btn');
					var url = "<?=current_url()?>";
					$(location).attr('href', url);
				} else {
					close_message();
					loading('stop', 'edit_group_btn');

					if ($.isArray(data.error.elements)) {
						scroll_top();
						loading('stop', 'edit_group_btn');
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
	});


	$(document).on('click', '.delete_btn', function () {
		group_id = $('select[name="group"] option:selected').data('id');
		$('input[name="group_id"]').val(group_id);
	});

	$(document).on('click', '#delete_group', function () {
		var id = $('input[name="group_id"]').val();
		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/delete_group/')?>';

		$.post(url, {group_id, id}, function (result) {
			location.reload();
		});
	});


	var dataTable_label = $('.dataTables_filter label').text();
	$('.dataTables_filter input').attr('placeholder', dataTable_label);

	var elem = $('.dataTables_filter label');
	// $(elem).html($(elem).html().replace($(elem).text(), ''));
</script>

<script>
	$(document).ready(function () {
		($('.sell_group_select').val() == 'all_val') ? $('.delete_btn').css('display', 'none') : $('.delete_btn').css('display', 'inline-block');
		$('.sell_group_select').on('change', function () {
			($(this).val() == 'all_val') ? $('.delete_btn').css('display', 'none') : $('.delete_btn').css('display', 'inline-block');
		});
	})
</script>


