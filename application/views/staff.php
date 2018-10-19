<!-- Department Start -->
<div class="tab-pane fade" id="list-department" role="tabpanel"
	 aria-labelledby="list-department-list">

	<div class="tab-pane fade show active" id="list-department" role="tabpanel"
		 aria-labelledby="list-department-list">

		<div class="jumbotron jumbotron-fluid pb-2 pt-2">
			<div class="container">
				<p class="display-5 font-weight-bold mb-0">Section: Departments</p>
			</div>
		</div>

		<div class="jumbotron jumbotron-fluid pb-2 pt-2">
			<div class="container">
				<p class="display-5 font-weight-bold float-left">Ստորաբաժանումների քանակ</p>
				<span
					class="ml-2 mt-1 badge badge-secondary badge-pill">4</span>
				<button class="btn btn-secondary btn-sm float-right" data-toggle="modal"
						data-target=".bd-example-modal-lg">Ստեղծել Ստորաբաժանում
				</button>
				<hr class="my-4">
				<div class="row col-sm-12 col-md-12"
					 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: scroll;">


					<table id="example" class="table table-striped table-bordered"
						   style="width:100%">
						<thead style="background: #545b62;
color: #fff;">
						<tr>
							<th style="font-size: 12px !important;">Ստորաբաժանում</th>
							<th style="font-size: 12px !important;">Մանրամասն</th>
							<th style="font-size: 12px !important;">Անուն</th>
							<th style="font-size: 12px !important;">Ազգանուն</th>
							<th style="font-size: 12px !important;">Հեռ․</th>
							<th style="font-size: 12px !important;">Էլ․ հասցե</th>
							<th style="font-size: 12px !important;">Ստեղծվել է</th>
							<th style="font-size: 12px !important;">Ում կողմից</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>Tiger Nixon</td>
							<td>System Architect</td>
							<td>Edinburgh</td>
							<td>61</td>
							<td>2011/04/25</td>
							<td>$320,800</td>
							<td>$320,800</td>
							<td>$320,800</td>
						</tr>
						<tr>
							<td>Garrett Winters</td>
							<td>Accountant</td>
							<td>Tokyo</td>
							<td>63</td>
							<td>2011/07/25</td>
							<td>$170,750</td>
							<td>$170,750</td>
							<td>$170,750</td>
						</tr>
						<tr>
							<td>Ashton Cox</td>
							<td>Junior Technical Author</td>
							<td>San Francisco</td>
							<td>66</td>
							<td>2009/01/12</td>
							<td>$86,000</td>
							<td>$86,000</td>
							<td>$86,000</td>
						</tr>
						<tr>
							<td>Cedric Kelly</td>
							<td>Senior Javascript Developer</td>
							<td>Edinburgh</td>
							<td>22</td>
							<td>2012/03/29</td>
							<td>$433,060</td>
							<td>$433,060</td>
							<td>$433,060</td>
						</tr>

					</table>


				</div>


				<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
					 aria-labelledby="myLargeModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header bg-dark">
								<h5 class="text-white modal-title dar">New Department</h5>
								<button type="button" class="text-white close"
										data-dismiss="modal"
										aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p>Fill in the following fields</p>

								<form class="new_department">

									<div class="form-group row">

										<label class="col-sm-4 col-form-label">Անվանում</label>
										<div class="col-sm-8">
											<select value=""
													class="currency form-control">
												<option>Անվանում 1</option>
												<option>Անվանում 2</option>
											</select>
										</div>
									</div>


									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Մանրամասն</label>
										<div class="col-sm-8">
											<input value="" type="text"
												   class=" form-control"
												   placeholder="Մանրամասն">
										</div>
									</div>

									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Ղեկավար
											Bank</label>
										<div class="col-sm-8">
											<input type="text"
												   class=" form-control"
												   value=""
												   placeholder="Ղեկավար">
										</div>
									</div>
								</form>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary"
										data-dismiss="modal">
									Close
								</button>
								<button type="button" class="btn btn-secondary">Save</button>
							</div>
						</div>

					</div>
				</div>


				<div class="text-right mt-4 pb-2">
					<button class="btn btn-secondary">Save</button>
					<button class="btn btn-secondary ml-2">Cancel</button>
				</div>


			</div>
		</div>
	</div>

</div>
<!-- Department End -->
