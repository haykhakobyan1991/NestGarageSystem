<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/structure1.css"/>
<!-- Structure Start -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!--[if lt IE 9]>
<script src="https://code.highcharts.com/modules/oldie.js"></script>
<![endif]-->


<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.buttons.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jszip.min.js') ?>"></script>
<!--<script type="text/javascript" src="--><? //=base_url('assets/js/dataTables//vfs_fonts.js')?><!--"></script>-->
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.html5.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.colVis.min.js') ?>"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<?
$time = strtotime(mdate('%Y-%m-%d', now()));
?>

<style>
	.row.bg-secondary {
		min-height: 194px;
	}

	.modal {
		top: 30% !important;
	}

</style>


<div id="add-info">


	<hr class="my-2">

	<div class="container-fluid" style="min-height: 35px;">


		<div style="float: right;">
			<span class="p-3"><?=lang('from')?></span>
			<input type="date" value="<?= date("Y-m-d", strtotime("-1 month", $time)); ?>" name="from"
				   style="border: 1px solid silver;padding: 4px 2px 4px 10px;border-radius: 5px;"/>

			<span class="p-3"><?=lang('to')?></span>
			<input type="date" value="<?= mdate('%Y-%m-%d', now()) ?>" name="to"
				   style="border: 1px solid silver;padding: 4px 2px 4px 10px;;border-radius: 5px;"/>

			<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 10px 24px !important;
    font-weight: 500 !important;margin-top: -4px;min-height: 37px !important;" type="button" id="search"
					class="ml-2 save_cancel_btn btn btn-success">Տեսնել
			</button>
		</div>


	</div>

	<hr class="my-2">

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div id="container" style="width:100%; height:auto;"></div>
			</div>

	</div>

		<hr class="my-2">
		<div id="ex" class="container-fluid"></div>

</div>

<script>

	$(document).ready(function () {


		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/getHistoryAll_ax')?>';
		var date_from = $('input[name="from"]').val();
		var date_to = $('input[name="to"]').val();

		$.ajax({
			url: url,
			type: 'POST',
			data: {from: date_from, to: date_to},
			async: true,
			dataType: "json",
			success: function (data) {
				chart(data);
				$('#ex').html(data.table);

			}
		}).done(function () {
			var table = $('#example').DataTable({
				"paging": false,
				"info": false,
				dom: 'Bfrtip',
				buttons: [
					{
						extend: 'excelHtml5',
						title: '',
						filename: 'excel_file',
						footer: true,
						exportOptions: {
							columns: ':visible'
						}
					},
					'colvis'
				]
			});

			table.buttons().container()
				.appendTo('#example_wrapper #example_filter:eq(0)');
			$('.dt-buttons').css('float', 'left');
		});


		$(document).on('click', '#search', function (e) {
			var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/getHistoryAll_ax')?>';
			var date_from = $('input[name="from"]').val();
			var date_to = $('input[name="to"]').val();


			$.ajax({
				url: url,
				type: 'POST',
				data: {from: date_from, to: date_to},
				async: true,
				dataType: "json",
				success: function (data) {
					chart(data);
					$('#ex').html(data.table);

				}
			}).done(function () {
				var table = $('#example').DataTable({
					"paging": false,
					"info": false,
					dom: 'Bfrtip',
					buttons: [
						{
							extend: 'excelHtml5',
							title: '',
							filename: 'excel_file',
							footer: true,
							exportOptions: {
								columns: ':visible'
							}
						},
						'colvis'
					]
				});

				table.buttons().container()
					.appendTo('#example_wrapper #example_filter:eq(0)');
				$('.dt-buttons').css('float', 'left');
			});




		})

	});

	function chart(data) {
	Highcharts.chart('container', {

		chart: {
			type: 'column'
		},

		title: {
			text: 'Total fruit consumtion, grouped by gender'
		},

		xAxis: {
			categories: data.category
		},

		yAxis: {
			allowDecimals: false,
			min: 0,
			title: {
				text: 'AMD'
			}
		},

		tooltip: {
			formatter: function () {
				return '<b>' + this.x + '</b><br/>' +
					this.series.name + ': ' + this.y + '<br/>' +
					'Ընդհանուր: ' + this.point.stackTotal;
			}
		},



		plotOptions: {
			column: {
				stacking: 'normal'
			},

			series: {
				events: {
					legendItemClick: function (e) {

						$('#ex').html('<img style="z-index: 999; position: fixed; left: 50%; width: 10em" src="http://localhost/NestGarageSystem/assets/images/puff.svg">');

						var hidden = [];

						var chart = this.chart,
							index = this.index,
							tvis = this.visible;


						if(tvis) {
							hidden.push(this.userOptions.table);
						}

						$.each(chart.series,function(i,serie){

							if((!serie.visible) && (serie.index != index)) {
								hidden.push(serie.userOptions.table);
							}

						});

						var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/getHistoryAll_ax')?>';
						var date_from = $('input[name="from"]').val();
						var date_to = $('input[name="to"]').val();

						$.ajax({
							url: url,
							type: 'POST',
							data: {from: date_from, to: date_to, hidden: hidden},
							async: true,
							dataType: "json",
							success: function (data) {
								$('#ex').html(data.table);
							}
						}).done(function () {
							var table = $('#example').DataTable({
								"paging": false,
								"info": false,
								dom: 'Bfrtip',
								buttons: [
									{
										extend: 'excelHtml5',
										title: '',
										filename: 'excel_file',
										footer: true,
										exportOptions: {
											columns: ':visible'
										}
									},
									'colvis'
								]
							});

							table.buttons().container()
								.appendTo('#example_wrapper #example_filter:eq(0)');
							$('.dt-buttons').css('float', 'left');
						});
					}
				}
			}
		},


		series: data.data


	});
	}
</script>
