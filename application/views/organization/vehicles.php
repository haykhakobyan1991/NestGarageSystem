<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<style>
	table#example3 thead tr th:last-child:after {
		content: '';
	}

	table#example3 thead tr th:last-child:before {
		content: '';
	}
</style>

<script>
	$(document).ready(function () {
		$('#example3').DataTable({
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
			}
		});
	})
</script>

<?

$total = 0;
$active = 0;
$passive = 0;

foreach ($result_array as $row) :
	$total++;

	if ($row['status'] == 1) {
		$active++;
	} elseif ($row['status'] == -1) {
		$passive++;
	}

endforeach;
?>


<!-- Veichls Start -->
<div class="tab-pane fade show active" id="list-settings" role="tabpanel"
	 aria-labelledby="list-settings-list">

	<div class="tab-pane fade show active" id="list-staff" role="tabpanel" style="padding-top: 10px;"
		 aria-labelledby="list-staff-list">

		<div class="container-fluid">
			<p class="display-5 font-weight-bold mb-0"><?= lang('Veichls') ?></p>
			<hr class="my-2">
		</div>

		<div class="container-fluid">

			<div class="row">
				<diiv class="col-sm-8 pt-2">
					<div class="row">
						<div class="col-sm-6">
							<p class="display-5 font-weight-bold float-left"
							   style="font-size: 13px;"><?= lang('total_vehicles') ?></p> <span
								class="ml-2 mt-1 badge badge-secondary badge-pill"><?= $total ?></span>
						</div>
					</div>
				</diiv>
				<div class="col-sm-4 text-right">
					<a href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->default_lang()) . '/add_vehicles') ?>"
					   class="text-capitalize btn btn-outline-success btn-sm float-right"><?= lang('add_vehicles') ?>
					</a>
				</div>
			</div>

			<hr class="my-2">
		</div>

		<div class="pt-2">
			<div class="">

				<div class="row col-sm-12 col-md-12 ml-0 mr-0"
					 style="background: #fff; padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">


					<table id="example3" class="table table-striped table-borderless"
						   style="width:100%">
						<thead style="background: #fff;
color: #545b62;">
						<tr>
							<th style="font-size: 12px !important;font-weight: 500;"><?= lang('attached') ?></th>
							<th style="font-size: 12px !important;font-weight: 500;"><?= lang('type') ?></th>
							<th style="font-size: 12px !important;font-weight: 500;"><?= lang('brand') . ' ' . lang('model') ?></th>
							<th style="font-size: 12px !important;font-weight: 500;"><?= lang('color') ?></th>
							<th style="font-size: 12px !important;font-weight: 500;"><?= lang('vin') ?></th>
							<th style="font-size: 12px !important;font-weight: 500;"><?= lang('Created_Date') ?></th>
							<th style="font-size: 12px !important;font-weight: 500;"><?= lang('by_whom') ?></th>
							<th style="font-size: 12px !important;font-weight500;min-width: 50px !important;"></th>
						</tr>
						</thead>
						<tbody>
						<? foreach ($result_array as $row) : ?>
							<tr>
								<td><?= $row['staff'] ?></td>
								<td><?= $row['fleet_type'] ?></td>
								<td><?= $row['brand_model'] ?></td>
								<td><span style="display: none">Spitak</span><span class="p-3 m-2 text-white"
																				   style="border-radius: 50%; border: 1px solid #000; background: <?= $row['color'] ?>; display: inline-block;"></span>
								</td>
								<td><?= $row['vin_code'] ?></td>
								<td><?= $row['creation_date'] ?></td>
								<td><?= $row['user_name'] ?></td>
								<td colspan="2">
									<a href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->default_lang()) . '/edit_vehicles/' . $row['id']) ?>"><span
											style="border: none;padding-top: 5px;cursor: pointer;" data-id=""
											id="edit_vehicles_modal"
											data-toggle="modal" class="float-left text-success"
											data-target="#edit_vehicles"><i class="fas fa-edit"></i></span></a>


									<span style="border: none;cursor: pointer;"
										  data-toggle="modal"
										  id="delete_vehicles_modal"
										  class="text-secondary btn"
										  data-target=".bd-example-modal-sm" data-id="<?= $row['id'] ?>"><i class="fas fa-trash"></i></span></td>
								</td>
							</tr>
						<? endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Veichls End -->


<!-- Delete Modal Start -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
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
    font-weight: 500 !important;" type="button" id="delete_vehicles"
							class="btn btn-outline-success cancel_btn"><?= lang('yes') ?>
					</button>
					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 12px 24px !important;
    font-weight: 500 !important;" type="button" class="btn btn-outline-danger yes_btn"
							data-dismiss="modal"><?= lang('cancel') ?></button>

					<input type="hidden" name="vehicle_id">
				</div>
			</div>
		</div>

	</div>
</div>
<!-- Delete Modal End -->


<script>
	$(document).on('click', '#delete_vehicles_modal', function () {
		vehicle_id = $(this).data('id');
		$('input[name="vehicle_id"]').val(vehicle_id);
	});

	$(document).on('click', '#delete_vehicles', function () {
		var id = $('input[name="vehicle_id"]').val();
		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()).'/Organization/delete_vehicles/')?>';

		$.post(url, {vehicle_id: id}, function (result) {
			location.reload();
		});
	});
</script>
