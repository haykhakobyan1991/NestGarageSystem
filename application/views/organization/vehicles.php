<style>
	table#example3 thead tr th:last-child:after {
		content: '';
	}

	table#example3 thead tr th:last-child:before {
		content: '';
	}
</style>

<!-- Veichls Start -->
<div class="tab-pane fade show active" id="list-settings" role="tabpanel"
	 aria-labelledby="list-settings-list">

	<div class="tab-pane fade show active" id="list-staff" role="tabpanel" style="padding-top: 10px;"
		 aria-labelledby="list-staff-list">


		<div class="jumbotron jumbotron-fluid pb-2 pt-2">
			<div class="container">
				<p class="display-5 font-weight-bold mb-0">Section: Veichls</p>
			</div>
		</div>

		<div class=" pb-2 pt-2">
			<div class="">
				<div class="row">
					<div class="col-sm-12 col-md-2 col-2">
						<p class="display-5 font-weight-bold float-left">Toatl Vehicle</p> <span
							class="ml-2 mt-1 badge badge-secondary badge-pill">6</span>
					</div>

					<div class="col-sm-12 col-md-2 col-2">
						<p class="display-5 font-weight-bold float-left">Active Vehicle</p>
						<span
							class="ml-2 mt-1 badge badge-success badge-pill">4</span>
					</div>

					<div class="col-sm-12 col-md-2 col2">
						<p class="display-5 font-weight-bold float-left">Passive Vehicle</p>
						<span
							class="ml-2 mt-1 badge badge-warning badge-pill">2</span>
					</div>

					<div class="col-sm-12 col-md-4 col-4"></div>

					<div class="col-sm-12 col-md-2 col-2">
						<a href="<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->default_lang()).'/add_vehicles')?>" class="btn btn-outline-success">Add Vehicle
						</a>
					</div>

				</div>


				<hr class="my-4">

				<div class="row col-sm-12 col-md-12"
					 style="background: #fff; padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">


					<table id="example3" class="table table-striped table-borderless"
						   style="width:100%">
						<thead style="background: #fff;
color: #545b62;">
						<tr>
							<th style="font-size: 12px !important;font-weight: 500;">Name Lastname</th>
							<th style="font-size: 12px !important;font-weight: 500;">Status</th>
							<th style="font-size: 12px !important;font-weight: 500;">Պաշտոն</th>
							<th style="font-size: 12px !important;font-weight: 500;">Բաժին</th>
							<th style="font-size: 12px !important;font-weight: 500;">ղեկավար</th>
							<th style="font-size: 12px !important;font-weight: 500;">Created date</th>
							<th style="font-size: 12px !important;font-weight: 500;">Ում կողմից</th>
							<th style="font-size: 12px !important;font-weight500;min-width: 50px !important;"></th>
						</tr>
						</thead>
						</tbody>
						<tr>
							<td>Veichls 1</td>
							<td style="text-align: center; vertical-align: middle;">
								<div class="bg-success"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td colspan="2">
										<span style="border: none;padding-top: 5px;cursor: pointer;" data-id=""
											  id="edit_vehicles_modal"
											  data-toggle="modal" class="float-left text-success"
											  data-target="#edit_vehicles"
											  data-toggle2="tooltip"
											  data-placement="top"
											  title="edit"><i class="fas fa-edit"></i></span>

								<span style="border: none;cursor: pointer;" data-id="" id="delet_vehicles_modal"
									  class="btn text-danger"
									  data-toggle2="tooltip"
									  data-placement="top"
									  title="delete"><i class="fas fa-trash"></i></span></td>
						</tr>
						</tr>
						<tr>
							<td>Veichls 2</td>
							<td style="text-align: center;vertical-align: middle;">
								<div class="bg-success"
									 style="display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td colspan="2">
										<span style="border: none;padding-top: 5px;cursor: pointer;" data-id=""
											  id="edit_vehicles_modal"
											  data-toggle="modal" class="float-left text-success"
											  data-target="#edit_vehicles"
											  data-toggle2="tooltip"
											  data-placement="top"
											  title="edit"><i class="fas fa-edit"></i></span>

								<span style="border: none;cursor: pointer;" data-id="" id="delet_vehicles_modal"
									  class="btn text-danger"
									  data-toggle2="tooltip"
									  data-placement="top"
									  title="delete"><i class="fas fa-trash"></i></span></td>
						</tr>
						</tr>
						<tr>
							<td>Veichls 3</td>
							<td style="text-align: center;vertical-align: middle;">
								<div class="bg-danger"
									 style="margin-top: 12%; display: inline-block;width: 8px;height:8px; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"></div>
							</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td colspan="2">
										<span style="border: none;padding-top: 5px;cursor: pointer;" data-id=""
											  id="edit_vehicles_modal"
											  data-toggle="modal" class="float-left text-success"
											  data-target="#edit_vehicles"
											  data-toggle2="tooltip"
											  data-placement="top"
											  title="edit"><i class="fas fa-edit"></i></span>

								<span style="border: none;cursor: pointer;" data-id="" id="delet_vehicles_modal"
									  class="btn text-danger"
									  data-toggle2="tooltip"
									  data-placement="top"
									  title="delete"><i class="fas fa-trash"></i></span></td>
						</tr>

						</tr>


					</table>


				</div>
			</div>
		</div>
	</div>




</div>
<!-- Veichls End -->
