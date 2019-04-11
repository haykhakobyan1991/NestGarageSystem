<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.buttons.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jszip.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.html5.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.colVis.min.js') ?>"></script>
<!-- Structure Start -->
<style>
	td, th {
		border: 1px solid #c1c9d2 !important;
	}

	thead tr:nth-child(1) th:last-child input {
		display: none;
	}

	#nav-tab > a:nth-child(1), #nav-tab > a:nth-child(2), #nav-tab > a:nth-child(3), #nav-tab > a:nth-child(4) {
		display: none;
	}

	div.dataTables_wrapper div.dataTables_filter {
		margin-right: 155px;
	}

	.btn-group.ml-auto {
		z-index: 999 !important;
		margin-right: 12px;
	}

	table td {
		padding: 0 5px !important;
	}
</style>


<?
if ($this->uri->segment('3') == 'fleet_history') {
	echo '<script src="https://code.highcharts.com/highcharts.js"></script>';
	//---;
	echo '<script src="' . base_url('assets/js/custom-events.js') . '"></script>';
}
$time = strtotime(mdate('%Y-%m-%d', now()));
?>


<script src="<?= base_url('assets/js/go.js') ?>"></script>
<div class="content m-1" style="margin-top: -54px !important;">
	<div class="jumbotron jumbotron-fluid pb-2 pt-2 mb-0 bg-white">
		<div id="sample" style="position:relative;">
			<div>
				<table id="example11" class="table table-striped" style="font-size: 12px; !important">
					<thead>
					<tr>
						<th><?= lang('type') ?></th>
						<th style="font-size: 12px !important;font-weight: 500;"><?= lang('brand') ?></th>
						<th style="font-size: 12px !important;font-weight: 500;"><?= lang('license_plate') ?></th>
						<th style="font-size: 12px !important;font-weight: 500;"><?= lang('driver') ?></th>
						<th style="font-size: 12px !important;font-weight: 500;"><?= lang('department') ?></th>
						<th style="font-size: 12px !important;font-weight: 500;"><?= lang('head') ?></th>
						<th style="font-size: 12px !important;font-weight: 500;max-width: 50px!important;"><i class="pr-2 fas fa-edit"></i></th>
					</tr>
					</thead>
					<tbody style="overflow-y: scroll;">
					<? foreach ($structure as $row) { ?>
						<tr>
							<td>
								<li class="list-group-item d-flex justify-content-between align-items-center p-0"
									style="background: transparent;border: none;">
									<?=
									$row['fleet_type'] .
									'<span style="background: transparent;" class="badge badge-light badge-pill"><img src="' . ($row['fleet_type_id'] == 1 ? base_url('assets/img/fleet_type/car.png') :
										($row['fleet_type_id'] == 2 ? base_url('assets/img/fleet_type/delivery-truck.png') :
											($row['fleet_type_id'] == 3 ? base_url('assets/img/fleet_type/construction-tool-vehicle-with-crane-lifting-materials.png') :
												($row['fleet_type_id'] == 4 ? base_url('assets/img/fleet_type/construction-truck.png') :
													($row['fleet_type_id'] == 5 ? base_url('assets/img/fleet_type/bus-side-view.png') :
														($row['fleet_type_id'] == 6 ? base_url('assets/img/fleet_type/minivan.png') :
															($row['fleet_type_id'] == 7 ? base_url('assets/img/fleet_type/car-with-trailer.png') : ''
															))))))) . '"></span>';
									?>

								</li>
							</td>
							<td data-id="<?= $row['fleet_id'] ?>"><?= $row['model'] ?></td>
							<td><?= $row['fleet_plate_number'] ?></td>
							<td><?= $row['driver'] ?></td>
							<td><?= $row['department'] ?></td>
							<td><?= $row['head'] ?></td>
							<td>
								<a href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/edit_vehicles/' . $row['fleet_id']) ?>"><i
										class="pr-2 fas fa-edit text-success"></i></a></td>
						</tr>
					<? } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		// Setup - add a text input to each footer cell
		$('#example11 thead tr').clone(true).appendTo('#example11 thead');
		$('#example11 thead tr:eq(0) th').each(function (i) {
			var title = $(this).text();

			$(this).html('<input class="form-control form-control-sm" type="text" placeholder="' + title + '" />');

			$('input', this).on('keyup change', function () {
				if (table.column(i).search() !== this.value) {
					table
						.column(i)
						.search(this.value)
						.draw();
				}
			});
		});

		var table = $('#example11').DataTable({
			language: {
				search: "<?=lang('search')?>",
				emptyTable: "<?=lang('no_data')?>",
				info: "<?=lang('total')?> <span id='total'>_TOTAL_</span> <?=lang('data')?>",
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
			"columnDefs": [
				{"orderable": false, "targets": [6]}
			]
		});
	});

</script>


